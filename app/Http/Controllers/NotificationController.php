<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\PDactivity;
use App\Field;
use Session;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // $counter = 1;
      // $id = Auth::id();
      //
      // $fields = DB::table('faculty_field')
      //             ->where('faculty_id', $id)
      //             ->pluck('field_id');
      //
      // $pdactivity = array();
      // foreach ($fields as $field) {
      //   $activities = DB::table('field_p_dactivity')
      //               ->where('field_id', $field)
      //               ->pluck('p_dactivity_id');
      //   foreach ($activities as $activity) {
      //     $pdactivity[]= PDactivity::where('id',$activity)->first();
      //   }
      // }
      // $unique = array_unique($pdactivity);
      // $data = array('pdactivities' => $unique);

      return view('faculty.pages.notification');
      // $counter = 1;
      // $id = Auth::id();
      // $activities= DB::table('faculty_p_dactivity')
      //             ->where('faculty_id', $id)
      //             ->pluck('p_dactivity_id');
      //
      // $pdactivity = array();
      // foreach ($activities as $activity) {
      //     $pdactivity[]= PDactivity::where('id',$activity)->first();
      // }
      //
      // $data = array('activities' => $activities,
      //           'pdactivities' => $pdactivity);
      //
      // return view('faculty.pages.notification')->with($data)->withCounter($counter);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
