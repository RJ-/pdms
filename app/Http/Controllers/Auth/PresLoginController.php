<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PresLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:president', ['except' => ['logout']]);
    }
    public function showLoginForm()
    {
      return view('auth.president-login');
    }
    public function login(Request $request)
    {
      //validate the form data
      $this->validate($request, [
        'username' => 'required',
        'password' => 'required'
      ]);

      $designation = 'president';
      //attempt to log the user in
      if (Auth::guard('president')->attempt([
        'username' => $request->username,
        'password' => $request->password,
        'designation' => $designation
        ])) {
        //if successfull
        return redirect()->intended(route('president.index'));
      }

      //if hindi successfull
      return redirect()->back()->with('error', 'Your username and password did not match. Please try again.');
    }

    public function logout()
    {
        Auth::guard('president')->logout();

        // $request->session()->flush();//logout all users
        //
        // $request->session()->regenerate();

        return redirect('president');
    }
}
