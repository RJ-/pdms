<?php
namespace App\Http\Controllers;

use App\Notifications\FacultyHrdPdApplication;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\EducBackground;
use App\CollegeCampus;
use App\TrainingNeeds;
use App\Administrator;
use App\EducCategory;
use App\JoinActivity;
use App\PDActivity;
use App\PDcategory;
use App\Category;
use App\Faculty;
use App\Field;

use Purifier;
use Session;
use Hash;
use Auth;
use Image;
use Storage;
use ImageOptimizer;
use Carbon\Carbon;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      $this->middleware('auth:web');
    }
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
        return view('/admin-dashboard/pages/registerfaculty');
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
      // $this->validate($request, array(
      //   'title' => 'required',
      //   'p_dcategory_id' => 'required',
      //   'venue' => 'required',
      //   'sponsor' => 'required',
      //   'dateFrom' => 'required',
      //   'dateTo' => 'required',
      //   'details' => 'required',
      //   'createdBy' => 'required',
      //   'faculty_id' => 'required',
      //   'status' => 'required'
      // ));
      $activity_status = 1;
      $pdType = PDcategory::where('id', $request->p_dcategory_id)->first();

      if(Input::get('title') && Input::get('p_dcategory_id') && Input::get('venue')
                   && Input::get('sponsor') && Input::get('dateFrom')
                   && Input::get('dateTo') && Input::get('createdBy')
                   && Input::get('details')) {

        //store in the database
        $activity = new PDactivity;

        $activity->title = $request->title;
        $activity->activity_status = $activity_status;
        $activity->p_dcategory_id = $request->p_dcategory_id;
        $activity->venue = $request->venue;
        $activity->sponsor = $request->sponsor;
        $activity->dateFrom = $request->dateFrom;
        $activity->dateTo = $request->dateTo;
        $activity->createdBy = $request->createdBy;
        $activity->details = Purifier::clean($request->details);

        $activity->save();

        $status = 2;
        $faculty_response = 1;

        $hrd = Administrator::select('id')->where('designation', 'hrd')->first();
        $hrd->notify(new FacultyHrdPdApplication($activity));

        $pd = new JoinActivity;
        $pd->p_dactivity_id = $activity->id;
        $pd->faculty_id = $request->faculty_id;
        $pd->status = $status;
        $pd->faculty_response = $faculty_response;

        if($request->hasFile('file')){
          $file = $request->file('file');
          $filename = Auth::user()->id . '-' . Auth::user()->surname . '-' . time() . '.' . $file->getClientOriginalExtension();
          $location = public_path('files/' .$filename);
          Image::make($file)->save($location);
          $oldFilename = $activity->file;

          $pd->file = $filename;
          $pd->uploaded_at = Carbon::now();

        }

        $pd->save();

        Session::flash('success', 'Your '.$pdType->name.' was added to your profile successfully.');

        //redirect to another page
        return redirect()->route('faculty.show', $activity->createdBy);
      }else{
        return back()->with('error', 'Your '.$pdType->name.' was not saved. Please try again.');
      }
    }

    public function activity($id)
    {
      $activity = PDactivity::find($id);

      $faculties = DB::table('faculty_p_dactivity')
                    ->where('p_dactivity_id', $id)
                    ->pluck('faculty_id');
      $isSet = FALSE;
      $fac = array();
      $response = array();
      foreach ($faculties as $faculty) {
        $fac[]= Faculty::where('id',$faculty)->first();
        $response[] = DB::table('faculty_p_dactivity')
                      ->where('p_dactivity_id', $id)
                      ->where('faculty_id', $faculty)
                      ->value('faculty_response');
      }

      foreach ($fac as $key => $f) {
        if ($f->id == Auth::user()->id) {
            if ($response[$key] == NULL) {
              $isSet = FALSE;
              break;
            }else {
              $isSet = TRUE;
              break;
            }
        }
      }

      $approved = DB::table('faculty_p_dactivity')
                    ->where('p_dactivity_id', $id)
                    ->where('status', 2)
                    ->pluck('faculty_id');
      $confirmed = array();
      foreach ($approved as $faculty) {
        $confirmed[]= Faculty::where('id',$faculty)->first();
      }

      //if faculty has the same field as of the activity
      $faculty_hit = FALSE;
      foreach ($activity->field as $key => $field) {
        foreach (Auth::user()->field as $faculty) {
          if ($field->name == $faculty->name) {
            $faculty_hit = TRUE;
          }
        }
      }

      $pdcategory = PDcategory::where('id', $activity->p_dcategory_id)->first();

      return view('activities/activity')->with('activity', $activity)
                    ->with('faculty', $fac)
                    ->with('confirmed', $confirmed)
                    ->with('pdcategory', $pdcategory)
                    ->with('isset', $isSet)
                    ->with('response', $response)
                    ->with('faculty_hit', $faculty_hit);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $category = Category::all();
      $faculty = Faculty::find($id);
      $educbackground = EducBackground::where('faculty_id',$id)->get();

      $pd = DB::table('faculty_p_dactivity')
                  ->where('faculty_id', $id)
                  ->where('faculty_response',1)
                  ->where('status', '>=', 2)
                  ->orderBy('created_at', 'desc')
                  ->pluck('p_dactivity_id');

      $seminars = array();
      $counter = 0;
      $seminar_status = array();
      foreach ($pd as $key => $sem) {
        $seminars[]= PDactivity::where('id',$sem)
                      ->where('p_dcategory_id', '1')
                      ->first();
        if($seminars[$key] != null){
          $seminar_status[] = DB::table('faculty_p_dactivity')
                      ->where('p_dactivity_id', $sem)
                      ->where('faculty_id', $id)
                      ->value('status');
        }
      }

      $result = array_filter($seminars, function($value) {
      			  return !is_null($value);
      });

      // //DESC
      // $result = array_reverse(array_sort($result, function ($value) {
      //   return $value['created_at'];
      // }));

      $training = array();
      $training_status = array();
      foreach ($pd as $key => $sem) {
        $training[]= PDactivity::where('id',$sem)
                      ->where('p_dcategory_id', '2')
                      ->first();
        if($training[$key] != null){
          $training_status[] = DB::table('faculty_p_dactivity')
                      ->where('p_dactivity_id', $sem)
                      ->where('faculty_id', $id)
                      ->value('status');
        }
      }

      $resultTraining = array_filter($training, function($value) {
      			  return !is_null($value);
      });

      // $resultTraining = array_reverse(array_sort($resultTraining, function ($value) {
      //   return $value['created_at'];
      // }));

      $course = array();
      $course_status = array();
      foreach ($pd as $key =>$sem) {
        $course[]= PDactivity::where('id',$sem)
                      ->where('p_dcategory_id', '4')
                      ->first();
        if($course[$key] != null){
          $course_status[] = DB::table('faculty_p_dactivity')
                      ->where('p_dactivity_id', $sem)
                      ->where('faculty_id', $id)
                      ->value('status');
        }
      }

      $resultCourse = array_filter($course, function($value) {
      			  return !is_null($value);
      			});

      // $resultCourse = array_reverse(array_sort($resultCourse, function ($value) {
      //   return $value['created_at'];
      // }));

      $data = array('faculty' => $faculty,
                  'educbackground' => $educbackground,
                  'trainings' => $resultTraining,
                  'courses' => $resultCourse,
                  'seminars' => $result,
                  'categories' => $category,
                  'seminar_status' => $seminar_status,
                  'training_status' => $training_status,
                  'course_status' => $course_status);

      return view('profile')->with($data);
    }

    public function pdrecord($id)
    {
      $faculty = Faculty::find($id);

      $data = array('faculty' => $faculty);


      return view('faculty.pages.edit-pdrecord')->with($data);
    }

    public function updatepdrecord(Request $request, $id)
    {
      //validate the data
      $pdType = PDcategory::where('id', $request->p_dcategory_id)->first();

      if(Input::get('title') && Input::get('p_dcategory_id') && Input::get('venue')
                   && Input::get('sponsor') && Input::get('dateFrom')
                   && Input::get('dateTo') && Input::get('createdBy')
                   && Input::get('details')) {


          //store in the database
          $activity = PDactivity::find($id);

          $activity->title = $request->input('title');
          $activity->p_dcategory_id = $request->input('p_dcategory_id');
          $activity->venue = $request->input('venue');
          $activity->sponsor = $request->input('sponsor');
          $activity->dateFrom = $request->input('dateFrom');
          $activity->dateTo = $request->input('dateTo');
          $activity->createdBy = $request->input('createdBy');
          $activity->details = Purifier::clean($request->input('details'));

          $pd = JoinActivity::where('p_dactivity_id',$id)
                      ->where('faculty_id',Auth::user()->id)
                      ->first();

          if($request->hasFile('file')){
            $file = $request->file('file');
            $filename = Auth::user()->id . '-' . Auth::user()->surname . '-' . time() . '.' . $file->getClientOriginalExtension();
            $location = public_path('files/' .$filename);
            //ImageOptimizer::optimize($location);
            Image::make($file)->save($location);
            $oldFilename = $pd->file;

            $pd->file = $filename;
            $pd->uploaded_at = Carbon::now();

            Storage::delete($oldFilename);
          }


          $activity->save();
          $pd->save();

          Session::flash('success', 'Your '.$pdType->name.' information was updated successfully.');

          //redirect to another page
          return redirect()->route('faculty.show', $activity->createdBy);
        }else{
          return back()->with('error', 'Your '.$pdType->name.' was not updated. Please try again.');
        }
    }

    public function updatepdactivity(Request $request, $id)
    {
          $pd_id = $request->p_dactivity_id;
          $faculty = $request->faculty_id;
          //store in the database
          $activity = JoinActivity::where('p_dactivity_id',$pd_id)
                      ->where('faculty_id',$faculty)
                      ->first();

          if($request->hasFile('file')){
            $file = $request->file('file');
            $filename = Auth::user()->id . '-' . Auth::user()->surname . '-' . time() . '.' . $file->getClientOriginalExtension();
            $location = public_path('files/' .$filename);
            Image::make($file)->save($location);
            $oldFilename = $activity->file;

            $activity->file = $filename;
            $activity->uploaded_at = Carbon::now();

            Storage::delete($oldFilename);

          }
          else{
            return back()->with('error', 'Your certificate was not submitted. Please try again.');
          }

          $activity->save();

          Session::flash('success', 'Your certificate was submitted successfully.');

          //redirect to another page
          return redirect()->route('faculty.show', $faculty);

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faculty = Faculty::find($id);
        $field = Field::all();
        $college = CollegeCampus::all();
        $category = Category::all();
        $cols = array();
        foreach ($college as $colleges) {
          $cols[$colleges->id] = $colleges->name;
        }

        $fields = Field::all();
        $fields2 = array();
        foreach ($fields as $field) {
          $fields2[$field->id] = $field->name;
        }

        $needs = TrainingNeeds::all();
        $needs2 = array();
        foreach ($needs as $need) {
          $needs2[$need->id] = $need->name;
        }

        $data = array('faculty' => $faculty,
                    'fields' => $fields2,
                    'colleges' => $cols,
                    'needs' => $needs2,
                    'categories' => $category);

        return view('faculty.pages.edit-profile')->with($data);
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
      if(Input::get('surname') && Input::get('firstname') && Input::get('middlename') &&
                      Input::get('birthdate') && Input::get('email')) {

        $faculty = Faculty::find($id);
        $faculty->surname = $request->input('surname');
        $faculty->firstname = $request->input('firstname');
        $faculty->middlename = $request->input('middlename');
        $faculty->birthdate = $request->input('birthdate');
        $faculty->email = $request->input('email');
        $faculty->college_id  = $request->input('college_id');

        $faculty->save();

        if (isset($request->fields)){
          $faculty->field()->sync($request->fields);
        }else{
          $faculty->field()->sync(array());
        }

        if (isset($request->needs)){
          $faculty->needs()->sync($request->needs);
        }else{
          $faculty->needs()->sync(array());
        }

        Session::flash('success', 'Profile successfully updated.');
        //redirect to another page
        return redirect()->route('faculty.show', $faculty->id);
      }else{
        return back()->with('error', 'Changes were not saved.');
      }
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
