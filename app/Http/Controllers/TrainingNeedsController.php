<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\TrainingNeeds;
use App\CollegeCampus;
use App\PDactivity;
use Session;

use Carbon\Carbon;

class TrainingNeedsController extends Controller
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
      $needs = TrainingNeeds::all();
      $college = CollegeCampus::all();

      return view('admin-dashboard.pages.needs.index')
              ->withNeeds($needs)
              ->withColleges($college)
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

        $needs = new TrainingNeeds;
        $needs->name = $request->name;

        $needs->save();

        Session::flash('success', 'New Training Needs Category was successfully created!');

        return redirect()->route('needs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $lastyear = new Carbon('last year');
      $today = new Carbon('now');

      $startLastYear =  Carbon::create($lastyear->year, 1, 1, 0, 0, 0);
      $endLastYear =  Carbon::create($lastyear->year, 12, 31, 0, 0, 0);

      $startThisYear =  Carbon::create($today->year, 1, 1, 0, 0, 0);
      $endLastYear =  Carbon::create($today->year, 12, 31, 0, 0, 0);


        $college = CollegeCampus::all();
        $needs = TrainingNeeds::find($id);
        $counter = 1;

        $lastYear = PDactivity::where('training_needs_id', $id)
                              ->where('createdBy', 0)
                              ->whereBetween('created_at', array($startLastYear->toDateTimeString(), $endLastYear->toDateTimeString()))
                              ->orderBy('id', 'desc')->sortable('created_at')->paginate(10);

        $thisYear = PDactivity::where('training_needs_id', $id)
                              ->where('createdBy', 0)
                              ->whereBetween('created_at', array($startThisYear->toDateTimeString(), $endLastYear->toDateTimeString()))
                              ->orderBy('id', 'desc')->sortable('created_at')->paginate(10);

        $activity = PDactivity::where('training_needs_id', $id)
                              ->whereBetween('created_at', array($startThisYear->toDateTimeString(), $endLastYear->toDateTimeString()))->count();

        return view('admin-dashboard.pages.needs.show')
            ->withActivity($activity)
            ->withNeeds($needs)
            ->withColleges($college)
            ->withCounter($counter)
            ->with('lastyear',$lastYear)->with('thisyear',$thisYear);
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
        $needs = TrainingNeeds::find($id);
        return view('admin-dashboard.pages.needs.edit')
                  ->withNeeds($needs)
                  ->withColleges($college)
;
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
        $needs = TrainingNeeds::find($id);
        $this->validate($request,
          ['name' => 'required']
        );

        $needs->name = $request->name;
        $needs->save();

        Session::flash('success', 'You have successfully updated the category!');

        return redirect()->route('needs.show', $needs->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $need = TrainingNeeds::find($id);
        $need->faculty()->detach();

        $need->delete();

        Session::flash('success', 'Category was deleted successfully');

        return redirect()->route('needs.index');
    }
}
