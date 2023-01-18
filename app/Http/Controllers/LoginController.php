<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccederRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //

    public function show(Request $request)
    {
        return view('auth.login');
    }

    public function login(AccederRequest $request)
    {
        $credentials = $request->getCredentials();

        if (!Auth::validate($credentials)){
            return redirect()->to('Login')
                ->withErrors(trans('auth.failed'));
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    private function authenticated(AccederRequest $request, ?\Illuminate\Contracts\Auth\Authenticatable $user)
    {
        return redirect()->intended();
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('Login');

    }

}
