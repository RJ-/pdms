<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CollegeCampus;
use App\Faculty;
use App\Dean;
use Session;

class CollegeCampusController extends Controller
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
        $counter = 1;
        $cc = CollegeCampus::all();
        return view('admin-dashboard.pages.collegecampus.index')
                ->withColleges($cc)
                ->withCounter($counter);
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
        $this->validate($request, array(
            'name' => 'required|max:255'
        ));

        $cc = new CollegeCampus;
        $cc->name = $request->name;

        $cc->save();

        Session::flash('success', 'New College/Campus was successfully created!');

        return redirect()->route('campus-college.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $college = CollegeCampus::all();
        $cc = CollegeCampus::find($id);
        $faculty = Faculty::where('college_id',$id)->get();
        $dean = Dean::where('college_campus_id',$id)->value('faculty_id');
        $deans = Faculty::find($dean);
        $counter = 1;
        return view('admin-dashboard.pages.collegecampus.show')
            ->withCollege($cc)
            ->withDeans($deans)
            ->withFaculty($faculty)
            ->withCounter($counter)
            ->with('colleges', $college);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $college = CollegeCampus::all();
        $cc = CollegeCampus::find($id);
        $deans = Faculty::where('college_id',$id)->get();
        $deans2 = array();
        foreach ($deans as $dean) {
          $deans2[$dean->id] = $dean->surname;
        }

        return view('admin-dashboard.pages.collegecampus.edit')
                  ->withCollege($cc)
                  ->withDeans($deans)
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
        $cc = CollegeCampus::find($id);
        $this->validate($request,
          ['name' => 'required']
        );

        $cc->name = $request->name;

        $cc->save();

        if (isset($request->dean)){
          $cc->dean()->sync($request->dean);
        }else{
          $cc->dean()->sync(array());
        }

        Session::flash('success', 'You have successfully updated the college/campus!');

        return redirect()->route('campus-college.show', $cc->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
