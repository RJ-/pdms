<?php

namespace App\Http\Controllers;

use App\Notifications\HrdDeanNewActivityPost;
use App\Notifications\NewActivityPost;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\TrainingNeeds;
use App\CollegeCampus;
use App\JoinActivity;
use App\PDactivity;
use App\PDcategory;
use App\Category;
use App\Faculty;
use App\Field;
use App\Dean;

use Notification;
use Purifier;
use Session;
use Carbon\Carbon;

class PDactivityController extends Controller
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
      $lastyear = new Carbon('last year');
      $today = new Carbon('now');

      $startLastYear =  Carbon::create($lastyear->year, 1, 1, 0, 0, 0);
      $endLastYear =  Carbon::create($lastyear->year, 12, 31, 0, 0, 0);

      $startThisYear =  Carbon::create($today->year, 1, 1, 0, 0, 0);
      $endLastYear =  Carbon::create($today->year, 12, 31, 0, 0, 0);

      $lastYear = PDactivity::where('createdBy', 0)
                            ->whereBetween('created_at', array($startLastYear->toDateTimeString(), $endLastYear->toDateTimeString()))
                            ->orderBy('id', 'desc')->sortable('created_at')->paginate(10);

      $thisYear = PDactivity::where('createdBy', 0)
                            ->whereBetween('created_at', array($startThisYear->toDateTimeString(), $endLastYear->toDateTimeString()))
                            ->orderBy('id', 'desc')->sortable('created_at')->paginate(10);

      $college = CollegeCampus::all();
      $counter = 1;

      return view('admin-dashboard.pages.activities.viewactivities')
          ->with('lastyear',$lastYear)->with('thisyear',$thisYear)
          ->withCounter($counter)
          ->with('colleges', $college);
    }

    public function viewSubmittedPD()
    {
      $college = CollegeCampus::all();
      $counter = 1;
      $activities = DB::table('faculty_p_dactivity')
                    ->where('status', 2)
                    ->where('faculty_response', 1)
                    ->distinct()
                    ->pluck('p_dactivity_id');


      $pdactivity = array();
      foreach ($activities as $activity) {
        $pdactivity[]= PDactivity::where('id',$activity)->where('activity_status', 1)->first();
      }
      //DESC
      $pdactivity = array_reverse(array_sort($pdactivity, function ($value) {
        return $value['created_at'];
      }));

      $pdactivity = array_filter($pdactivity);

      return view('admin-dashboard.pages.activities.approvePD')
              ->with('activities', $pdactivity)
              ->with('counter', $counter)
              ->with('colleges', $college);
    }

    public function approvePdActivity($id)
    {
        $college = CollegeCampus::all();

        $activity = PDactivity::find($id);

        $faculties = DB::table('faculty_p_dactivity')
                      ->where('p_dactivity_id', $id)
                      ->where('status', 2)
                      ->pluck('faculty_id');

        $fac = array();
        $certificate = array();
        foreach ($faculties as $key => $faculty) {
          $fac[] = Faculty::where('id',$faculty)->first();
          $certificate[] = DB::table('faculty_p_dactivity')
                        ->select('file','uploaded_at')
                        ->where('p_dactivity_id', $id)
                        ->where('faculty_id', $faculty)
                        ->where('status', 2)->first();
        }

        $pdcategory = PDcategory::where('id', $activity->p_dcategory_id)->first();

        return view('admin-dashboard.pages.activities.approvePdActivity')
          ->with('activity', $activity)
          ->with('certificate', $certificate)
          ->with('faculty', $fac)
          ->with('pdcategory', $pdcategory)
          ->with('colleges', $college);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $college = CollegeCampus::all();

      $field = Field::all();
      $category = Category::all();
      $pdcategory = PDcategory::all();
      $needs = TrainingNeeds::all();
      return view('admin-dashboard.pages.activities.postactivity')
          ->withNeeds($needs)
          ->withFields($field)
          ->withCategories($category)
          ->withPdcategories($pdcategory)
          ->with('colleges', $college);
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
          'title' => 'required',
          'p_dcategory_id' => 'required',
          'venue' => 'required',
          'sponsor' => 'required',
          'dateFrom' => 'required',
          'dateTo' => 'required',
          'details' => 'required'
        ));

        //store in the database
        $activity = new PDactivity;

        $activity->title = $request->title;
        $activity->p_dcategory_id = $request->p_dcategory_id;
        $activity->venue = $request->venue;
        $activity->sponsor = $request->sponsor;
        $activity->dateFrom = $request->dateFrom;
        $activity->dateTo = $request->dateTo;
        $activity->details = Purifier::clean($request->details);
        $activity->training_needs_id = $request->training_needs_id;
        $activity->save();

        //$activity->activity()->sync($request->p_dactivity_id, false);

        //notification according to needs
        if ($request->training_needs_id != NULL) {

          $activity->need_category = TrainingNeeds::where('id', $request->training_needs_id)->value('name');

          $faculty = DB::table('faculty_training_needs')
                          ->where('training_needs_id', $request->training_needs_id)
                          ->pluck('faculty_id');

          foreach ($faculty as $employee) {
            $user = Faculty::find($employee);
            $user->notify(new NewActivityPost($activity));
          }

        }

        if ($request->fields != NULL) {
          $activity->field()->sync($request->fields, false);

          //notification according to fields
          $emp=array();
          foreach ($request->fields as $field) {
            $emp[] = DB::table('faculty_field')
                            ->where('field_id',$field)
                            ->pluck('faculty_id');
          }

          $employee = new Collection();
          foreach($emp as $items)
          {
              foreach($items as $item)
              {
                  $employee = $employee->unique();
                  $employee->push($item);
              }
          }

          $uniqueEmp = $employee->unique();
          $uniqueEmp->values()->all();

          $employees=array();
          foreach ($uniqueEmp as $employee) {
            $user = Faculty::select('id')->where('id', $employee)->first();
            $user->notify(new NewActivityPost($activity));
          }

          //save faculty
          $act = new JoinActivity;

          foreach ($uniqueEmp as $id) {
            $act->p_dactivity_id = $activity->id;
            $act->faculty_id = $id;
          }

          $act->save();
          // $collegeID = array();
          // foreach ($uniqueEmp as $employee) {
          //   $collegeID[] = Faculty::where('id', $employee)
          //           ->pluck('college_id');
          // }
          //
          // $college = new Collection();
          // foreach($collegeID as $items)
          // {
          //     foreach($items as $item)
          //     {
          //         $college = $college->unique();
          //         $college->push($item);
          //     }
          // }
          //
          // $collegeID = $college->unique();
          // $collegeID->values()->all();
          //
          // foreach ($collegeID as $college) {
          //   $dean = Dean::where('college_campus_id', $college)->value('faculty_id');
          //   $user = Faculty::find($dean);
          //   $user2->notify(new HrdDeanNewActivityPost($activity));
          // }

        }

        //
        // foreach ($act as $key) {
        //   $user = Faculty::find($key);
        //   $user->notify(new NewActivityPost($activity));
        // }

        Session::flash('success', 'The activity was successfully save!');

        //redirect to another page
        return redirect()->route('pdactivity.show', $activity->id);
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

        $activity = PDactivity::find($id);

        $faculties = DB::table('faculty_p_dactivity')
                      ->where('p_dactivity_id', $id)
                      ->where('status', '!=', 2)
                      ->pluck('faculty_id');
        $fac = array();
        foreach ($faculties as $faculty) {
          $fac[]= Faculty::where('id',$faculty)->first();
        }

        $approved = DB::table('faculty_p_dactivity')
                      ->where('p_dactivity_id', $id)
                      ->where('status', 2)
                      ->pluck('faculty_id');
        $confirmed = array();
        foreach ($approved as $faculty) {
          $confirmed[]= Faculty::where('id',$faculty)->first();
        }

        $pdcategory = PDcategory::where('id', $activity->p_dcategory_id)->first();
        $needs = TrainingNeeds::where('id', $activity->training_needs_id)->first();

        return view('admin-dashboard.pages.activities.showactivity')
          ->with('activity', $activity)
          ->with('faculty', $fac)
          ->with('confirmed', $confirmed)
          ->with('pdcategory', $pdcategory)
          ->with('needs', $needs)
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

      $activity = PDactivity::find($id);
      $pdcategory = PDcategory::all();
      $category = Category::all();
      $cat = array();
      foreach ($pdcategory as $pdcategories) {
        $cat[$pdcategories->id] = $pdcategories->name;
      }

      $needs = TrainingNeeds::all();
      $facneed = array();
      foreach ($needs as $need) {
        $facneed[$need->id] = $need->name;
      }

      $fields = Field::all();
      $fields2 = array();
      foreach ($fields as $field) {
        $fields2[$field->id] = $field->name;
      }
      return view('admin-dashboard.pages.activities.editactivity')->with('activity', $activity)
          ->withFields($fields2)
          ->withPdcategory($cat)
          ->withCategories($category)
          ->withNeeds($facneed)
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
      //validate the data
      $this->validate($request, array(
        'title' => 'required',
        'p_dcategory_id' => 'required',
        'venue' => 'required',
        'sponsor' => 'required',
        'dateFrom' => 'required',
        'dateTo' => 'required',
        'details' => 'required'
      ));

      //store in the database
      $activity = PDactivity::find($id);

      $activity->title = $request->input('title');
      $activity->p_dcategory_id = $request->input('p_dcategory_id');
      $activity->venue = $request->input('venue');
      $activity->sponsor = $request->input('sponsor');
      $activity->dateFrom = $request->input('dateFrom');
      $activity->dateTo = $request->input('dateTo');
      $activity->details = Purifier::clean($request->input('details'));
      $activity->training_needs_id = $request->input('training_needs_id');

      $activity->save();

      if (isset($request->fields)){
        $activity->field()->sync($request->fields);
      }else{
        $activity->field()->sync(array());
      }


      Session::flash('success', 'The activity was successfully updated!');

      //redirect to another page
      return redirect()->route('pdactivity.show', $activity->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $activity = PDactivity::find($id);
      $activity->faculty()->detach();
      $activity->field()->detach();

      $activity->delete();
      Session::flash('success', 'The activity was deleted successfully');

      return redirect()->route('pdactivity.index');
    }

}
