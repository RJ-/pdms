<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Faculty;
use App\Dean;

class DeanLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:dean', ['except' => ['logout']]);
    }
    public function showLoginForm()
    {
      return view('auth.dean-login');
    }
    public function login(Request $request)
    {
      //validate the form data
      $this->validate($request, [
        'employee_id' => 'required',
        'password' => 'required'
      ]);

      $faculty = Faculty::where('employee_id', $request->employee_id)->first();

      $dean = Dean::where('faculty_id', $faculty->id)->first();

      if($dean){
        //attempt to log the user in
        if (Auth::guard('dean')->attempt([
          'employee_id' => $request->employee_id,
          'password' => $request->password
          ])) {
          //if successfull
          return redirect()->intended(route('dean.index'));
        }
      }

      //if hindi successfull
      return redirect()->back()->with('error', 'Your username and password did not match. Please try again.');
    }

    public function logout()
    {
        Auth::guard('dean')->logout();

        // $request->session()->flush();//logout all users
        //
        // $request->session()->regenerate();

        return redirect('dean');
    }
}
