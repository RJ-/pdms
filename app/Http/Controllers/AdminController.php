<?php

namespace App\Http\Controllers;
use Mail;
use App\Mail\WelcomeMail;

use App\Notifications\HrdFacultyNotifyRequirements;
use App\Notifications\HrdFacultyApproveActivity;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\EducBackground;
use App\Administrator;
use App\CollegeCampus;
use App\TrainingNeeds;
use App\PDcategory;
use App\PDactivity;
use App\AdminUsers;
use App\Category;
use App\AcadRank;
use App\Faculty;
use App\Field;

use JavaScript;
use Session;
use Carbon\Carbon;

class AdminController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  public function admin()
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

    $allfacultywithPD = $noOfFacultyWithPD*100/$allfaculty;

    $numOfFacultyWithoutPD = $allfaculty - $noOfFacultyWithPD;

    $facultyPercentage = number_format($allfacultywithPD, 0, '.', ',');
    //panel 1

    //panel 2
    $scholars = EducBackground::whereIn('educ_category_id',[2,3])
                              ->where('scholarship','!=', '')
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

    return view('admin-dashboard/pages/index')->with($data);
  }

  public function HrdNotification()
  {
    $college = CollegeCampus::all();

    return view('admin-dashboard/pages/includes/notification')
                ->with('colleges', $college);

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

    return view('admin-dashboard/pages/facultydevelopment')->with($data);

  }

  // public function postactivity()
  // {
  //   return view('admin-dashboard/pages/postactivity');
  // }

  public function registerfaculty()
  {
        $college = CollegeCampus::all();
        $rank = AcadRank::all();
        return view('admin-dashboard/pages/registerfaculty')
                ->with('acadrank', $rank)
                ->with('colleges', $college);
  }

  public function saveFaculty(Request $request)
  {
      //validate the data
      $this->validate($request, array(
            'employee_id' => 'required|max:10',
            'email' => 'required|email|max:255',
            'password' => 'required|max:30',
            'surname' => 'required|max:80',
            'firstname' => 'required|max:80',
            'middlename' => 'required|max:80',
            'acadrank_id' => 'required|max:80',
            'college_id' => 'required|max:2'
      ));

      //store in the database
      $faculty = new Faculty;

      //unhashed pdmspassword


      $faculty->employee_id = $request->employee_id;
      $faculty->email = $request->email;
      $faculty->password = bcrypt($request->password);
      $faculty->surname = $request->surname;
      $faculty->firstname = $request->firstname;
      $faculty->middlename = $request->middlename;
      $faculty->acadrank_id = $request->acadrank_id;
      $faculty->college_id = $request->college_id;

      $faculty->save();

      Session::flash('success', 'Faculty was successfully registered!');

      Mail::to($faculty['email'])->send(new WelcomeMail($request));
      //redirect to another page
      return redirect()->route('viewfaculty');
  }

  public function viewfaculty()
  {
      $counter = 1;
      $college = CollegeCampus::all();
      $faculty = Faculty::sortable('college_id')->simplePaginate(10);
      return view('admin-dashboard.pages.viewfaculty')
                ->with('faculty', $faculty)
                ->with('colleges', $college)
                ->with('counter', $counter);
  }

  public function showfaculty($id)
  {
    $college = CollegeCampus::all();
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
                'seminars' => $result,
                'colleges' => $college);

    return view('admin-dashboard.pages.showfaculty')->with($data);
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

    $pd = PDactivity::select('id','title')->where('id',$request->p_dactivity_id)->first();
    $user = Faculty::select('id')->where('id',$faculty_id)->first();
    $user['message'] = "Your application has been approved.";
    $user->notify(new HrdFacultyNotifyRequirements($pd));
    return redirect()->route('approvePdActivity',$id)->with('success', 'Faculty has been approved.');

    return redirect()->route('pdactivity.show', $id);
  }

  public function hrdNotifyFacultyRequirements(Request $request, $id)
  {
    $this->validate($request, array(
      'p_dactivity_id' => 'required'
    ));

    $faculty_id = $request->faculty_id;
    $activity = PDactivity::where('id',$request->p_dactivity_id)->update(['activity_status' => 1]);

    $pd = PDactivity::select('id','title')->where('id',$request->p_dactivity_id)->first();
    $user = Faculty::select('id')->where('id',$faculty_id)->first();
    $user['message'] = $request->message;
    $user->notify(new HrdFacultyNotifyRequirements($pd));
    return redirect()->route('approvePdActivity',$id)->with('success', 'Faculty has been notified.');

  }

  public function hrdApproveActivity(Request $request, $id)
  {
      $this->validate($request, array(
        'p_dactivity_id' => 'required'
      ));
      $faculty_id = $request->faculty_id;
      $activity = DB::table('faculty_p_dactivity')
                  ->where('p_dactivity_id', $id)
                  ->where('faculty_id', $faculty_id)
                  ->update(['status' => 3]);

      $activity = PDactivity::where('id',$request->p_dactivity_id)->where('createdBy', '!=', '0')
                  ->update(['activity_status' => 2]);

      // $activity = PDactivity::where('id',$request->p_dactivity_id)->where('createdBy', '==', '0')
      //             ->update(['activity_status' => 1]);

      $pd = PDactivity::select('id','title')->where('id',$request->p_dactivity_id)->first();
      $user = Faculty::select('id')->where('id',$faculty_id)->first();
      $user->notify(new HrdFacultyApproveActivity($pd));

      return redirect()->route('viewSubmittedPD')->with('success', 'Faculty has been approved.');
  }

  public function HrdProfile($id)
  {
    $college = CollegeCampus::all();
    $admin = Administrator::find($id);
    return view('admin-dashboard.pages.admins.edit-profile')->withAdmin($admin)
                ->with('colleges', $college);
  }


  public function HrdProfileUpdate(Request $request, $id)
  {
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
  }

  public function facultyroster()
  {
    $faculties = Faculty::sortable('surname')->paginate(20);
    $college = CollegeCampus::all();
    $col = CollegeCampus::all();
    $counter = 0;


    return view('admin-dashboard.pages.dashboard.facultyroster')
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
    $faculty = Faculty::whereIn('id',$faculties)->sortable('surname')->paginate(10);

    return view('admin-dashboard.pages.dashboard.facultyscholar')
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
    $faculty = Faculty::whereIn('id',$faculties)->sortable('surname')->paginate(10);

    return view('admin-dashboard.pages.dashboard.facultygradstudies')
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

    return view('admin-dashboard.pages.dashboard.facultywithPD')
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


    return view('admin-dashboard.pages.dashboard.facultyneedPD')
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

    return view('admin-dashboard.pages.dashboard.pdactivities')
            ->with('pdactivities', $pdactivities)
            ->with('college', $col)
            ->with('colleges', $college)
            ->with('counter', $counter);
  }

}
