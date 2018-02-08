<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\EducBackground;
use App\EducCategory;

class EducBackgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
      $degree = EducCategory::where('id', $request->educ_category_id)->first();

      if(Input::get('faculty_id') && Input::get('educ_category_id') && Input::get('course')
                   && Input::get('school') && Input::get('yearstarted')) {

    

        $educ = new EducBackground;

        $educ->faculty_id = $request->faculty_id;
        $educ->educ_category_id = $request->educ_category_id;
        $educ->course = $request->course;
        $educ->major = $request->major;
        $educ->school = $request->school;
        $educ->scholarship = $request->scholarship;
        $educ->award = $request->award;
        $educ->yearstarted = $request->yearstarted;
        $educ->yeargraduated = $request->yeargraduated;

        $educ->save();

        return redirect()->route('faculty.show', $educ->faculty_id)->with('success', 'Your '.$degree->name.' was added to your profile successfully.');;
      }else{
        return back()->with('error', 'Your '.$degree->name.' was not saved. Please try again.');
      }
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
      $educbackground = EducBackground::where('faculty_id',$id)->get();

      $data = array('educbackground' => $educbackgroundy);

      return view('profile')->with($data);

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
        'educ_category_id' => 'required|max:10',
        'course' => 'required',
        'school' => 'required',
        'yearstarted' => 'required|min:4|max:4'
      ));

      $educ = EducBackground::find($id);
      $educ->faculty_id = $request->input('faculty_id');
      $educ->educ_category_id = $request->input('educ_category_id');
      $educ->course = $request->input('course');
      $educ->major = $request->input('major');
      $educ->school = $request->input('school');
      $educ->scholarship = $request->input('scholarship');
      $educ->award = $request->input('award');
      $educ->yearstarted = $request->input('yearstarted');

      if (empty($request->yeargraduated)) {
        $educ->yeargraduated = NULL;
      }else{
        $educ->yeargraduated = $request->input('yeargraduated');
      }


      $educ->save();

      return redirect()->route('faculty.show', $educ->faculty_id);
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
