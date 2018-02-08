<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VpaaLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:vpaa', ['except' => ['logout']]);
    }
    public function showLoginForm()
    {
      return view('auth.vpaa-login');
    }
    public function login(Request $request)
    {
      //validate the form data
      $this->validate($request, [
        'username' => 'required',
        'password' => 'required'
      ]);

      $designation = 'vpaa';
      //attempt to log the user in
      if (Auth::guard('vpaa')->attempt([
        'username' => $request->username,
        'password' => $request->password,
        'designation' => $designation
      ])) {
        //if successfull
        return redirect()->intended(route('vpaa.index'));
      }

      //if hindi successfull
      return redirect()->back()->with('error', 'Your username and password did not match. Please try again.');
    }

    public function logout()
    {
        Auth::guard('vpaa')->logout();

        // $request->session()->flush();//logout all users
        //
        // $request->session()->regenerate();

        return redirect('vpaa');
    }
}
