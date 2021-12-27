<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAttemptRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view("authentication.login");
    }

    public function attempt(LoginAttemptRequest $request)
    {
        if (Auth::attempt($request->only(["email", "password"]))) {
            return redirect()
                ->route("posts.index")
                ->with("success", "your are successfully login");
        }
        return redirect()->back()->with("error", "something went wrong");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("login")->with("success", "your logout successfully");
    }
}
