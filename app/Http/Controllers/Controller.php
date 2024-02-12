<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function callAction($method, $parameters)
    {
        if (
            (session()->has('url') || session()->has('user'))
            && explode('@', class_basename(Route::currentRouteAction()))[0] !== 'UserController'
        ) {
            if (session()->has('url')) session()->forget('url');
            if (session()->has('user')) session()->forget('user');
        }

        return parent::callAction($method, $parameters);
    }
}
