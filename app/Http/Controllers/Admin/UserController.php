<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query();
        if (request('search')) {
            $users = $users->search(['name', 'email', 'role', 'status'], request('search'));
        }

        return view('admin.users.' . (request()->ajax() ? 'paginate' : 'index'), [
            'users' => $users->paginate(env('PAGINATION_COUNT'))
        ]);
    }

    public function add()
    {
        return view('admin.users.add');
    }

    public function save(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|min:'.env('MIN_TITLE_LENGTH').'|max:'.env('MAX_TITLE_LENGTH'),
            'email' => 'required|email|unique:users',
            'password' => new Password(),
            'question' => 'nullable|required_with:answer|min:'.env('MIN_STRING_LENGTH').'|max:'.env('MAX_STRING_LENGTH'),
            'answer' => 'nullable|required_with:question|min:'.env('MIN_STRING_LENGTH').'|max:'.env('MAX_STRING_LENGTH'),
            'avatar' => 'nullable|image',
            'is_admin' => 'required|integer',
            'status' => 'required|integer',
        ], attributes: User::getAttributesNames());
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->messages());
        }

        $data['password'] = bcrypt($data['password']);
        if (($image = User::uploadImage($request)) !== false) {
            $data['avatar'] = $image;
        }
        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'User was added');
    }

    public function edit(int $id)
    {
        $user = User::find($id);
        session(['url' => url()->previous()]);

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, int $id)
    {
        $user = User::find($id);
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|min:'.env('MIN_TITLE_LENGTH').'|max:'.env('MAX_TITLE_LENGTH'),
            'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
            'password' => new Password(true),
            'password_confirmation' => 'same:password',
            'question' => 'nullable|required_with:answer|min:'.env('MIN_STRING_LENGTH').'|max:'.env('MAX_STRING_LENGTH'),
            'answer' => 'nullable|required_with:question|min:'.env('MIN_STRING_LENGTH').'|max:'.env('MAX_STRING_LENGTH'),
            'avatar' => 'nullable|image',
        ], ['password_confirmation.same' => 'Password confirmation should match the Password'], User::getAttributesNames());
        if ($validator->fails()) {
            return $request->ajax()
                ? response()->json(['status' => 'errors', 'errors' => $validator->messages()->getMessages()])
                : back()->withInput()->withErrors($validator->messages());
        }

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }
        if (($image = User::uploadImage($request, $user->avatar)) !== false) {
            $data['avatar'] = $image;
        }
        $user->update($data);

        if ($request->ajax()) {
            session()->flash('success', 'Profile was updated');
            return response()->json(['status' => 'success', 'url' => session()->pull('url')]);
        }
        return redirect(session()->pull('url'))->with('success', 'User was updated');
    }

    public function destroy(int $id)
    {
        $user = User::find($id);

        if (count($user->comments)) {
            return redirect()->route('admin.users.index')->with('error', 'Error! Selected user has active comment(s)');
        }

        User::deleteImage($user->avatar);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User was deleted');
    }

    public function create()
    {
        session(['url' => url()->previous()]);

        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:'.env('MIN_TITLE_LENGTH').'|max:'.env('MAX_TITLE_LENGTH'),
            'email' => 'required|email|unique:users',
            'password' => new Password(),
            'password_confirmation' => 'required|same:password',
        ], ['password_confirmation.same' => 'Password confirmation should match the Password'], User::getAttributesNames());

        if ($validator->fails()) {
            return response()->json(['status' => 'errors', 'errors' => $validator->messages()->getMessages()]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        session()->flash('success', 'Successful registration');
        Auth::login($user);

        return response()->json(['status' => 'success', 'url' => session()->pull('url')]);
    }

    public function loginForm()
    {
        session(['url' => url()->previous()]);

        return view('admin.users.login');
    }

    public function login(Request $request)
    {
        $rules = match ($request->scenario) {
            '0' => ['email' => 'required|email', 'password' => 'required'],
            '1' => ['email' => 'required|email'],
            '2' => ['password' => new Password(), 'password_confirmation' => 'required|same:password'],
        };
        $validator = Validator::make($request->all(), $rules, attributes: User::getAttributesNames());
        if ($validator->fails()) {
            return response()->json(['status' => 'errors', 'errors' => $validator->messages()->getMessages()]);
        }

        if ($request->scenario === '1') {
            if ($user = User::where('email', $request->email)->first()) {
                if (empty($request->question)) {
                    if ($user->question) {
                        return response()->json(['status' => 'question', 'question' => $user->question]);
                    }
                    return response()->json([
                        'status' => 'errors',
                        'errors' => ['email' => ['No security question for user with this email.']],
                    ]);
                }
                if ($user->answer !== $request->answer) {
                    return response()->json([
                        'status' => 'errors',
                        'errors' => ['answer' => ['Security answer is incorrect.']],
                    ]);
                }
                session(['user' => $user]);
                return response()->json(['status' => 'answer']);
            } else {
                return response()->json([
                    'status' => 'errors',
                    'errors' => ['email' => ['No user is registered with this email.']],
                ]);
            }
        } else if ($request->scenario === '2') {
            $user = session()->pull('user');
            $user->update($request->all());
        }

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            session()->flash('success', 'Successful authorization');
            return response()->json(['status' => 'success', 'url' => session()->pull('url')]);
        }

        return response()->json(['status' => 'error', 'error' => 'Incorrect E-mail or Password!']);
    }

    public function profile(Request $request)
    {
        $user = User::find(decrypt($request->id));
        session(['url' => url()->previous()]);

        return view('admin.users.profile', compact('user'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect(url()->previous());
    }
}
