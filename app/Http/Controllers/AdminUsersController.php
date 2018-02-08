<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\CollegeCampus;
use App\AdminUsers;
use Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
      $this->middleware('auth:admin');
    }
    public function index()
    {
      $college = CollegeCampus::all();
      $admins = AdminUsers::all();
      $counter = $admins->count();
      $cc = 1;

      return view('admin-dashboard/pages/admins.index')
        ->with('cc', $cc)
        ->with('admins', $admins)
        ->with('counter', $counter)
        ->with('colleges', $college);
    }

    public function registeradmin()
    {
      $college = CollegeCampus::all();

      return view('admin-dashboard/pages/admins.registeradmin')->with('colleges', $college);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //validate the data
      $this->validate($request, array(
            'username' => 'required|max:15',
            'password' => 'required|max:30',
            'surname' => 'required|max:80',
            'firstname' => 'required|max:80',
            'designation' => 'required|max:15'
      ));

      //store in the database
      $admin = new AdminUsers;

      $admin->username = $request->username;
      $admin->password = bcrypt($request->password);
      $admin->surname = $request->surname;
      $admin->firstname = $request->firstname;
      $admin->middlename = $request->middlename;
      $admin->email = $request->email;
      $admin->designation = $request->designation;

      $admin->save();

      Session::flash('success', 'An Administrator was successfully registered!');
      //redirect to another page
      return redirect()->route('administrators.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = AdminUsers::find($id);
        $college = CollegeCampus::all();

        //redirect to another page
        return view('admin-dashboard.pages.admins.edit')
                  ->with('admin', $admin)
                  ->with('colleges', $college);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
          'designation' => 'required',
          'username' => 'required',
          'surname' => 'required',
          'firstname' => 'required',
          'middlename' => 'required',
          'email' => 'required'
        ));

        $admin = AdminUsers::find($id);

        $admin->designation = $request->input('designation');
        $admin->username = $request->input('username');
        $admin->surname = $request->input('surname');
        $admin->firstname = $request->input('firstname');
        $admin->middlename = $request->input('middlename');
        $admin->email = $request->input('email');

        $admin->save();

        Session::flash('success', 'Administrator details was successfully save!');

        //redirect to another page
        return redirect()->route('administrators.index', $admin->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = AdminUsers::find($id);
        $admin->delete();
        Session::flash('success', 'Administrator was remove successfully');
        return redirect()->route('administrators.index');
    }
}
