<?php
namespace App\Http\Controllers;

use App\Notifications\PresHrdApproveActivity;
use App\Notifications\PresHrdRecommendation;
use App\Notifications\PresApproval;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\EducBackground;
use App\CollegeCampus;
use App\TrainingNeeds;
use App\Administrator;
use App\PDactivity;
use App\PDcategory;
use App\AdminUsers;
use App\Faculty;

use JavaScript;
use Carbon\Carbon;

class PresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
     $this->middleware('auth:president');
    }

    public function index()
    {
      $today = new Carbon('now');
      $fromYear = new Carbon('last year');

      $colleges = CollegeCampus::all();

      $fcas = Faculty::where('college_id', 1)->count();
      $fcbm = Faculty::where('college_id', 4)->count();
      $fcoed = Faculty::where('college_id', 3)->count();
      $fcet = Faculty::where('college_id', 2)->count();
      $fcaramoan = Faculty::where('college_id', 9)->count();
      $flagonoy = Faculty::where('college_id', 6)->count();
      $fsalogon = Faculty::where('college_id', 10)->count();
      $fsanjose = Faculty::where('college_id', 7)->count();
      $ftinambac = Faculty::where('college_id', 11)->count();

      $cas = 1; $cbm = 4; $coed = 3; $cet = 2; $caramoan = 9;
      $lagonoy = 6; $salogon = 10; $sanjose = 7; $tinambac = 11;

      $caspd = 1; $cbmpd = 4; $coedpd = 3; $cetpd = 2; $caramoanpd = 9;
      $lagonoypd = 6; $salogonpd = 10; $sanjosepd = 7; $tinambacpd = 11;

      $collegePD = array("caspd", "cbmpd", "coedpd", "cetpd", "caramoanpd",
                    "lagonoypd", "salogonpd", "sanjosepd", "tinambacpd");

      $college = array("cas", "cbm", "coed", "cet", "caramoan",
                    "lagonoy", "salogon", "sanjose", "tinambac");

      $collegePDresults = compact($collegePD); //PD activities per college
      $facultyPD  = compact($college); //faculty participated on PD

      foreach ($collegePDresults as $pd) {
        $faculties = Faculty::where('college_id', $pd)->pluck('id');

        if ($faculties->count() != 0) {
          $fields = array();
          $facultyWithPD = array();
          foreach ($faculties as $faculty) {
            $fields[]= DB::table('faculty_field')
                      ->where('faculty_id', $faculty)
                      ->pluck('field_id');
            $facultyWithPD[] = DB::table('faculty_p_dactivity')
                          ->where('faculty_id', $faculty)
                          // ->whereBetween('created_at', array($fromYear->toDateTimeString(), $today->toDateTimeString()))
                          ->pluck('faculty_id');
          }
          //PD activities per college
          $employee = new Collection();
          foreach($fields as $items)
          {
              foreach($items as $item)
              {
                  $employee = $employee->unique();
                  $employee->push($item);
              }
          }
          $fieldTag = $employee->unique();
          $fieldTag->values()->all();

          $act = DB::table('field_p_dactivity')
                      ->whereIn('field_id', $fieldTag)
                      ->pluck('p_dactivity_id');

          $activities = array();
          foreach ($act as $key) {
            $activities[] = PDactivity::where('id', $key)
                          ->whereBetween('created_at', array($fromYear->toDateTimeString(), $today->toDateTimeString()))
                          ->pluck('id');
          }

          //College # of PD
          $pdactivities = new Collection();
          foreach($activities as $items)
          {
              foreach($items as $item)
              {
                  $pdactivities = $pdactivities->unique();
                  $pdactivities->push($item);
              }
          }
          $activities = $pdactivities->unique();
          $activities->values()->all();
          $activities = count($activities);

          //faculty participated on PD
          $employee = new Collection();
          foreach($facultyWithPD as $items)
          {
              foreach($items as $item)
              {
                  $employee = $employee->unique();
                  $employee->push($item);
              }
          }
          $faculty = $employee->unique();
          $faculty->values()->all();
          $faculty = count($faculty);

        }else {
          $activities = 0;
          $faculty = 0;
        }
        $collegePDresults[$pd] = $activities; //PD activities per college
        $facultyPD[$pd] = $faculty; //faculty participated on PD
      }

      //panel 1
      $noOfFacultyWithPD = DB::table('faculty_p_dactivity')
                          ->pluck('faculty_id')->unique()->count();

      $allfaculty = Faculty::all()->count();

      if ($allfaculty!=NULL) {
        $allfacultywithPD = $noOfFacultyWithPD*100/$allfaculty;
        $numOfFacultyWithoutPD = $allfaculty - $noOfFacultyWithPD;
      }else {
        $allfacultywithPD = 0;
        $numOfFacultyWithoutPD = 0;
      }

      $facultyPercentage = number_format($allfacultywithPD, 0, '.', ',');
      //panel 1

      //panel 2
      $scholars = EducBackground::where('educ_category_id', '!=', 1)
                                ->whereNotNull('scholarship')
                                ->whereNull('yeargraduated')->count();
      //panel 2

      //panel 3
      $gradStudies = EducBackground::where('educ_category_id', '!=', 1)
                                ->whereNull('yeargraduated')->count();
      //panel 3

      $noOfPdActivities = PDactivity::whereBetween('created_at', array($fromYear->toDateTimeString(), $today->toDateTimeString()))
                          ->pluck('id')->count();

      JavaScript::put([

        'fcas' => $fcas, 'fcbm' => $fcbm, 'fcoed' => $fcoed, 'fcet' => $fcet,
        'fcaramoan' => $fcaramoan, 'ftinambac' => $ftinambac, 'fsalogon' => $fsalogon,
        'fsanjose' => $fsanjose, 'flagonoy' => $flagonoy,

        'cas' => $facultyPD[$cas], 'cbm' => $facultyPD[$cbm], 'coed' => $facultyPD[$coed], 'cet' => $facultyPD[$cet],
        'caramoan' => $facultyPD[$caramoan], 'tinambac' => $facultyPD[$tinambac], 'salogon' => $facultyPD[$salogon],
        'sanjose' => $facultyPD[$sanjose], 'lagonoy' => $facultyPD[$lagonoy],

        'caspd' => $collegePDresults[$caspd], 'cbmpd' => $collegePDresults[$cbmpd],
        'coedpd' => $collegePDresults[$coedpd], 'cetpd' => $collegePDresults[$cetpd],
        'caramoanpd' => $collegePDresults[$caramoanpd], 'tinambacpd' => $collegePDresults[$tinambacpd],
        'salogonpd' => $collegePDresults[$salogonpd], 'sanjosepd' => $collegePDresults[$sanjosepd],
        'lagonoypd' => $collegePDresults[$lagonoypd]
      ]);

      $data = array('facultyPercentage' => $facultyPercentage,
                    'colleges' => $colleges,
                    'scholars' => $scholars,
                    'gradstudies' => $gradStudies,
                    'allfaculty' => $allfaculty,
                    'numOfFacultyWithoutPD' => $numOfFacultyWithoutPD,
                    'noOfPdActivities' => $noOfPdActivities);

      return view('president.index')
                ->with($data);
    }

    public function PresNotification()
    {
      return view('president.notification');
    }

    public function facultydevelopment($id)
    {
      $counter = 0;

      $college = CollegeCampus::all();

      $faculty = Faculty::where('college_id',$id)->sortable('surname')->paginate(10);

      $emp = Faculty::where('college_id',$id)->pluck('id');

      $bacc = EducBackground::whereIn('faculty_id',$emp)->where('educ_category_id',1)->count();

      $mas = EducBackground::whereIn('faculty_id',$emp)->where('educ_category_id',2)->count();

      $doc = EducBackground::whereIn('faculty_id',$emp)->where('educ_category_id',3)->count();

      if ($faculty->count() == NULL) {
        $faculty = NULL;
        $bs = 0; $ms = 0; $phd = 0;
        $colfaculty = 0;
      }else{
        $colfaculty = count($faculty);

        $phd = $doc*100/$colfaculty;
        $phd = number_format($phd, 0, '.', ',');

        $bs = $bacc*100/$colfaculty;
        $bs = number_format($bs, 0, '.', ',');

        $ms = $mas*100/$colfaculty;
        $ms = number_format($ms, 0, '.', ',');

      }
      $name = CollegeCampus::find($id);

      $gradustudents = 0;
      if ($faculty != NULL) {
        foreach ($faculty as $fac) {
          foreach ($fac->educbackground as $e) {
            if ($e->yeargraduated == NULL){
              $gradustudents++;
            }
          }
        }
      }

      //Enrolled

      $data = array('faculties' => $faculty, 'gradstudents' => $gradustudents,
                    'colleges' => $college, 'mas' => $mas,
                    'counter' => $counter, 'doc' => $doc,
                    'collegename' => $name,
                    'numfaculty' => $colfaculty,
                    'ms' => $ms,
                    'phd' => $phd);

      return view('president.facultydevelopment')->with($data);

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
        $colleges = CollegeCampus::all();

        $counter = 0;
        $activity = DB::table('p_dactivities')
                      ->where('activity_status', 0)->pluck('id');

        $activities = array();
        $faculties = array();
        foreach ($activity as $id){
          $faculties[] = DB::table('faculty_p_dactivity')
                        ->where('p_dactivity_id', $id)
                        ->where('status', 1)->count();

          if ($faculties[$counter] != 0) {
            $activities[] = DB::table('p_dactivities')
                          ->where('id', $id)->first();

          }
          $counter++;
        }
        return view('president.show')
                  ->with('faculty', $faculties)
                  ->with('activity', $activities)
                  ->with('colleges', $colleges);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activity = PDactivity::find($id);

        $faculties = DB::table('faculty_p_dactivity')
                      ->where('p_dactivity_id', $id)
                      ->where('status', 1)
                      ->pluck('faculty_id');

        $fac = array();
        foreach ($faculties as $faculty) {
          $fac[]= Faculty::where('id',$faculty)->first();

        }

        $vpaa = array();
        $pdVpaa = array();
        foreach ($faculties as $faculty) {
          $vpaa[]= Faculty::where('id',$faculty)->first();
          $pd = DB::table('faculty_p_dactivity')
                        ->select('p_dactivity_id')
                        ->where('faculty_id', $faculty)
                        ->where('status', 3)
                        ->orderBy('created_at', 'DESC')
                        ->first();
            if ($pd != NULL) {
              $pdVpaa[] = PDactivity::where('id', $pd->p_dactivity_id)->first();
            }else{
              $pdVpaa[] = NULL;
            }
        }


        $approved = DB::table('faculty_p_dactivity')
                      ->where('p_dactivity_id', $id)
                      ->where('status', 2)
                      ->pluck('faculty_id');

        $confirmed = array();
        $pdConfirmed = array();
        foreach ($approved as $faculty) {
          $confirmed[]= Faculty::where('id',$faculty)->first();
          $pd = DB::table('faculty_p_dactivity')
                        ->select('p_dactivity_id')
                        ->where('faculty_id', $faculty)
                        ->where('status', 3)->orderBy('created_at', 'DESC')
                        ->first();
            if ($pd != NULL) {
              $pdConfirmed[] = PDactivity::where('id', $pd->p_dactivity_id)->first();
            }else{
              $pdConfirmed[] = NULL;
            }
        }

        $pdcategory = PDcategory::where('id', $activity->p_dcategory_id)->first();
        $needs = TrainingNeeds::where('id', $activity->training_needs_id)->first();

        //training field
        $field = DB::table('field_p_dactivity')
                      ->where('p_dactivity_id',$id)
                      ->pluck('field_id');

        if ($needs != NULL && $field->count() != NULL) {

            $emp=array();
            foreach ($field as $field) {
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

            $fieldTag = $employee->unique();
            $fieldTag->values()->all();

            //training needs
            $needTag = DB::table('faculty_training_needs')
                              ->where('training_needs_id',$activity->training_needs_id)
                              ->pluck('faculty_id');

            $merged = $fieldTag->intersect($needTag);

            //training frequency
            $frequency= DB::table('faculty_p_dactivity')
                        ->select(DB::raw('faculty_id'), DB::raw('count(*) as count'))
                        ->whereIn('faculty_id',$merged)
                        ->groupBy('faculty_id')
                        ->orderBy('count', 'asc')
                        ->pluck('faculty_id');

            $filterMissing = $merged->diff($frequency);

            $result = $filterMissing->merge($frequency);

        } elseif ($needs != NULL) {
          //training needs
          $result = DB::table('faculty_training_needs')
                            ->where('training_needs_id',$activity->training_needs_id)
                            ->pluck('faculty_id');

        } elseif ($field->count() != NULL) {
          $emp=array();
          foreach ($field as $field) {
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

          $result = $employee->unique();
          $result->values()->all();

        }else{
          $result = NULL;
        }

        if ($result == NULL) {
            $employees = NULL;
        }else {

          foreach ($result as $employee) {
            $employees= DB::table('faculty_p_dactivity')
                          ->where('p_dactivity_id',$id)
                          ->where('status', 0)->pluck('faculty_id');
          }
        }

        $faculty = array();
        $pdEmployee = array();
        foreach ($employees as $employee) {
          $faculty[]= Faculty::where('id',$employee)->first();
          $pd = DB::table('faculty_p_dactivity')
                        ->select('p_dactivity_id')
                        ->where('faculty_id', $faculty)
                        ->where('status', 3)->orderBy('created_at', 'DESC')
                        ->first();
            if ($pd != NULL) {
              $pdEmployee[] = PDactivity::where('id', $pd->p_dactivity_id)->first();
            }else{
              $pdEmployee[] = NULL;
            }

        }
        return view('president.edit')
          ->with('activity', $activity)
          ->with('faculty', $fac)
          ->with('vpaa', $vpaa)
          ->with('pdVpaa', $pdVpaa)
          ->with('confirmed', $confirmed)
          ->with('pdConfirmed', $pdConfirmed)
          ->with('pdcategory', $pdcategory)
          ->with('needs', $needs)
          ->with('employees', $faculty)
          ->with('pdEmployee', $pdEmployee);
    }

    public function adminNotifyFaculty(Request $request, $id)
    {

      $this->validate($request, array(
        'p_dactivity_id' => 'required',
        'faculty_id' => 'required'
      ));

      $faculty_id = $request->faculty_id;
      $activity = PDactivity::where('id',$request->p_dactivity_id)->update(['activity_status' => 1]);

      $pd = PDactivity::select('id','title')->where('id',$request->p_dactivity_id)->first();
      $user = Faculty::select('id')->where('id',$faculty_id)->first();
      $user['message'] = $request->message;
      $user->notify(new adminNotifyFaculty($pd));
      return redirect()->route('president.edit',$request->p_dactivity_id)->with('success', 'Faculty has been notified.');

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
        $pd = PDactivity::find($id);

        if (isset($request->faculty_id)){
          $pd->faculty()->syncWithoutDetaching($request->faculty_id);
        }else{
          $pd->faculty()->sync(array());
        }

        //redirect to another page
        return redirect()->route('president.edit', $id)
                  ->with('success', 'You have successfully recommended a list of participants.');;
    }


    public function updateStatus(Request $request, $id)
    {
        $this->validate($request, array(
          'faculty_id' => 'required',
        ));
        $faculty_id = $request->faculty_id;
        $activity = DB::table('faculty_p_dactivity')
                    ->where('p_dactivity_id', $id)
                    ->where('faculty_id', $faculty_id)
                    ->update(['status' => 2]);

        $pd = PDactivity::select('id','title')->where('id', $id)->first();
        $user = Faculty::select('id')->where('id', $faculty_id)->first();
        $user->notify(new PresApproval($pd));
        $hrd = Administrator::where('designation', 'hrd')->first();
        $hrd->notify(new PresHrdRecommendation($pd));

        return redirect()->route('president.edit', $id)->with('success', 'You have successfully approved '.$user->firstname.' '.$user->surname);
    }

    public function remove(Request $request, $id)
    {
        $this->validate($request, array(
          'faculty_id' => 'required',
        ));
        $faculty_id = $request->faculty_id;
        $activity = DB::table('faculty_p_dactivity')
                    ->where('p_dactivity_id', $id)
                    ->where('faculty_id', $faculty_id)
                    ->update(['status' => 1]);

        return redirect()->route('president.edit', $id)
                ->with('error', 'A faculty was removed from the list.');
    }

    public function approveActivity(Request $request, $id)
    {
        $this->validate($request, array(
          'p_dactivity_id' => 'required'
        ));

        $activity = PDactivity::where('id',$request->p_dactivity_id)
                    ->update(['activity_status' => 1]);
        $pd = PDactivity::find($request->p_dactivity_id);
        $hrd = Administrator::where('designation', 'hrd')->first();
        $hrd->notify(new PresHrdApproveActivity($pd));

        return redirect()->route('president.show',$request->p_dactivity_id)->with('success', $pd->title.' was successfully approved.' );
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

    public function PresidentProfile($id)
    {
      $admin = Administrator::find($id);
      $colleges = CollegeCampus::all();
      return view('president.edit-profile')->withAdmin($admin)->withColleges($colleges);
    }


    public function PresidentProfileUpdate(Request $request, $id)
    {
      //validate the data
      if(Input::get('surname') && Input::get('firstname') && Input::get('middlename') &&
                      Input::get('username') && Input::get('email')) {

        //store in the database
        $admin = AdminUsers::find($id);
        $admin->username = $request->username;
        $admin->surname = $request->surname;
        $admin->firstname = $request->firstname;
        $admin->middlename = $request->middlename;
        $admin->email = $request->email;

        return back()->with('success', 'You have successfully updated your profile.');

      }else {
        return back()->with('error', 'An error has occured while updating your profile.');
      }
      // Session::flash('success', 'An Administrator was successfully registered!');
      //redirect to another page
    }

    public function facultyroster()
    {
      $faculties = Faculty::sortable('surname')->paginate(20);
      $college = CollegeCampus::all();
      $col = CollegeCampus::all();
      $counter = 0;


      return view('president.dashboard.facultyroster')
              ->with('faculties', $faculties)
              ->with('college', $col)
              ->with('colleges', $college)
              ->with('counter', $counter);
    }

    public function facultyscholar()
    {
      $college = CollegeCampus::all();
      $col = CollegeCampus::all();
      $counter = 0;

      $scholars = EducBackground::whereBetween('educ_category_id',  [2,3])
                                ->where('scholarship', '!=', '')
                                ->pluck('faculty_id');

      if ($scholars != NULL) {
        $faculties = array();
        $scholarship = array();
        foreach ($scholars as $key) {
          $faculties[] = Faculty::where('id', $key)->value('id');
          $scholarship[] = EducBackground::where('faculty_id', $key)
                                    ->whereBetween('educ_category_id',  [2,3])
                                    ->whereNotNull('scholarship')
                                    ->whereNull('yeargraduated')->first();
        }
      }else {
        $scholars = NULL;
      }

      $faculty = Faculty::whereIn('id',$faculties)->paginate(10);;

      return view('president.dashboard.facultyscholar')
              ->with('faculties', $faculty)
              ->with('scholarship', $scholarship)
              ->with('college', $col)
              ->with('colleges', $college)
              ->with('counter', $counter);
    }

    public function facultygradstudies()
    {
      $college = CollegeCampus::all();
      $col = CollegeCampus::all();
      $counter = 0;

      $grad = EducBackground::whereIn('educ_category_id', [2,3])->whereNull('yeargraduated')
                              ->pluck('faculty_id');

      if ($grad != NULL) {
        $faculties = array();
        $gradStudies = array();
        foreach ($grad as $key) {
          $faculties[] = Faculty::where('id', $key)->value('id');
          $gradStudies[] = EducBackground::where('faculty_id', $key)
                                    ->whereBetween('educ_category_id',  [2,3])
                                    ->whereNull('yeargraduated')->first();
        }
      }else {
        $gradStudies = NULL;
      }
      $faculty = Faculty::whereIn('id',$faculties)->paginate(10);;

      return view('president.dashboard.facultygradstudies')
              ->with('faculties', $faculty)
              ->with('gradStudies', $gradStudies)
              ->with('college', $col)
              ->with('colleges', $college)
              ->with('counter', $counter);
    }

    public function facultywithPD()
    {
      $today = new Carbon('now');
      $fromYear = new Carbon('last year');

      $college = CollegeCampus::all();
      $col = CollegeCampus::all();
      $counter = 0;

      $noOfFacultyWithPD = DB::table('faculty_p_dactivity')
                          ->whereBetween('created_at', array($fromYear->toDateTimeString(), $today->toDateTimeString()))
                          ->pluck('faculty_id')
                          ->unique();

      if ($noOfFacultyWithPD != NULL) {
        $faculties = array();
        foreach ($noOfFacultyWithPD as $key) {
          $faculties[] = Faculty::where('id', $key)->value('id');
        }
      }else {
        $noOfFacultyWithPD = NULL;
        $faculties = NULL;
      }
      $faculty = Faculty::whereIn('id',$faculties)->sortable('surname')->paginate(10);

      return view('president.dashboard.facultywithPD')
              ->with('faculties', $faculty)
              ->with('noOfFacultyWithPD', $noOfFacultyWithPD)
              ->with('college', $col)
              ->with('colleges', $college)
              ->with('counter', $counter);
    }

    public function facultyneedPD()
    {
      $today = new Carbon('now');
      $fromYear = new Carbon('last year');

      $college = CollegeCampus::all();
      $col = CollegeCampus::all();
      $counter = 0;

      $noOfFacultyWithPD = DB::table('faculty_p_dactivity')
                          ->whereBetween('created_at', array($fromYear->toDateTimeString(), $today->toDateTimeString()))
                          ->pluck('faculty_id')
                          ->unique();

      if ($noOfFacultyWithPD != NULL) {
        $faculty = Faculty::whereNotIn('id', $noOfFacultyWithPD)->pluck('id');
      }

      if ($faculty != NULL) {
        $faculties = array();
        foreach ($faculty as $key) {
          $faculties[] = Faculty::where('id', $key)->value('id');
        }
      }
      else {
        $noOfFacultyWithPD = NULL;
        $faculties = NULL;
      }

      $fac = Faculty::whereIn('id',$faculties)->sortable('surname')->paginate(10);


      return view('president.dashboard.facultyneedPD')
              ->with('faculties', $fac)
              ->with('noOfFacultyWithPD', $noOfFacultyWithPD)
              ->with('college', $col)
              ->with('colleges', $college)
              ->with('counter', $counter);
    }

    public function pdactivities()
    {
      $today = new Carbon('now');
      $fromYear = new Carbon('last year');

      $college = CollegeCampus::all();
      $col = CollegeCampus::all();
      $counter = 0;

      $pdactivities = PDactivity::whereBetween('created_at', array($fromYear->toDateTimeString(), $today->toDateTimeString()))
                        ->orderBy('created_at','desc')->sortable()->paginate(20);

      return view('president.dashboard.pdactivities')
              ->with('pdactivities', $pdactivities)
              ->with('college', $col)
              ->with('colleges', $college)
              ->with('counter', $counter);
    }

    public function viewProfile($id)
    {

      $faculty = Faculty::find($id);
      $educbackground = EducBackground::where('faculty_id',$id)->get();

      $pd = DB::table('faculty_p_dactivity')
                  ->where('faculty_id', $id)
                  ->pluck('p_dactivity_id');

      $seminars = array();
      foreach ($pd as $sem) {
        $seminars[]= PDactivity::where('id',$sem)
                      ->where('p_dcategory_id', '1')
                      ->first();
      }

      $result = array_filter($seminars, function($value) {
      			  return !is_null($value);
      			});

      //DESC
      $result = array_reverse(array_sort($result, function ($value) {
        return $value['created_at'];
      }));

      $training = array();
      foreach ($pd as $sem) {
        $training[]= PDactivity::where('id',$sem)
                      ->where('p_dcategory_id', '2')
                      ->first();
      }

      $resultTraining = array_filter($training, function($value) {
      			  return !is_null($value);
      			});

      $resultTraining = array_reverse(array_sort($resultTraining, function ($value) {
        return $value['created_at'];
      }));

      $course = array();
      foreach ($pd as $sem) {
        $course[]= PDactivity::where('id',$sem)
                      ->where('p_dcategory_id', '4')
                      ->first();
      }

      $resultCourse = array_filter($course, function($value) {
      			  return !is_null($value);
      			});

      $resultCourse = array_reverse(array_sort($resultCourse, function ($value) {
        return $value['created_at'];
      }));

      $data = array('faculty' => $faculty,
                  'educbackground' => $educbackground,
                  'trainings' => $resultTraining,
                  'courses' => $resultCourse,
                  'seminars' => $result);

      return view('viewprofilePres')->with($data);
    }

    public function viewActivity($id)
    {
      $activity = PDactivity::find($id);

      $faculties = DB::table('faculty_p_dactivity')
                    ->where('p_dactivity_id', $id)
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

      return view('activities/activityVpaa')->with('activity', $activity)
                    ->with('faculty', $fac)
                    ->with('confirmed', $confirmed)
                    ->with('pdcategory', $pdcategory);
    }
}
