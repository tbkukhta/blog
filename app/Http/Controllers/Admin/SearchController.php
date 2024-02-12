<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        return redirect()->route("admin.{$request->folder}.index", ['search' => $request->search]);
    }
}
