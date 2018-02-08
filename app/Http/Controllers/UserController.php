<?php

namespace App\Http\Controllers;

use App\User;
use App\Field;
use App\Faculty;
use App\PDactivity;
use App\PDcategory;
use App\Administrator;
use App\JoinActivity;
use App\TrainingNeeds;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Notifications\FacultyHrdJoinActivity;


class UserController extends Controller
{
    public function welcome()
    {
      if (Auth::check()) {
        return redirect()->route('home');
      }else{
        return view('welcome');
      }
    }

    public function home()
    {
      $activity = PDactivity::where('createdBy', 0)
                        ->where('activity_status', 0)->orderBy('created_at', 'desc')->paginate(10);
      $pdcategory = PDcategory::all();
      $needs = TrainingNeeds::all();

      $fneeds = array();
      foreach ($activity as $key => $act) {
        $fneeds[] = TrainingNeeds::where('id', $act->training_needs_id)->value('name');
      }

      return view('home')
            ->with('fneeds', $fneeds)
            ->with('needs', $needs)
            ->with('activities', $activity)
            ->with('categories', $pdcategory);
    }

    public function categories($id)
    {
      $activity = PDactivity::where('p_dcategory_id', $id)->where('createdBy', 0)
                        ->where('activity_status', 0)->orderBy('created_at', 'desc')->paginate(10);
      $pdcategory = PDcategory::all();
      $needs = TrainingNeeds::all();

      $fneeds = array();
      foreach ($activity as $key => $act) {
        $fneeds[] = TrainingNeeds::where('id', $act->training_needs_id)->value('name');
      }

      return view('categories')
                ->with('fneeds', $fneeds)
              ->with('needs', $needs)
              ->with('activities', $activity)
              ->with('categories', $pdcategory);
    }

    public function facultyneeds($id)
    {
      $activity = PDactivity::where('training_needs_id', $id)->where('createdBy', 0)
                        ->where('activity_status', 0)->orderBy('created_at', 'desc')->paginate(10);
      $pdcategory = PDcategory::all();
      $needs = TrainingNeeds::all();

      $fneeds = array();
      foreach ($activity as $key => $act) {
        $fneeds[] = TrainingNeeds::where('id', $act->training_needs_id)->value('name');
      }

      return view('faculty-needs')
              ->with('fneeds', $fneeds)
              ->with('needs', $needs)
              ->with('activities', $activity)
              ->with('categories', $pdcategory);
    }

    public function research()
    {
      return view('activities/research');
    }

    public function application($id)
    {
        //
    }
    public function joinActivity(Request $request)
    {

      $this->validate($request, array(
        'p_dactivity_id' => 'required',
        'faculty_id' => 'required'
      ));

      $faculty_response = 1;
      $status = 1;

      $activity = new JoinActivity;

      $activity->p_dactivity_id = $request->p_dactivity_id;
      $activity->faculty_id = $request->faculty_id;
      $activity->status = $status;
      $activity->faculty_response = $faculty_response;


      $pd = PDactivity::select('id','title')->where('id',$activity->p_dactivity_id)->first();
      $hrd = Administrator::select('id')->where('designation', 'hrd')->first();
      $hrd->notify(new FacultyHrdJoinActivity($pd));
      $activity->save();

      return redirect()->route('activity', $activity->p_dactivity_id)->with('success','Application on '.$pd->title.' was successfully submitted.');
    }

    public function acceptActivity(Request $request, $id)
    {
      $this->validate($request, array(
        'faculty_response' => 'required',
        'p_dactivity_id' => 'required',
        'faculty_id' => 'required'
      ));

      $activity = JoinActivity::where('p_dactivity_id', $request->p_dactivity_id)
                              ->where('faculty_id', $request->faculty_id)->first();
      if ($activity == NULL) {
        $activity = new JoinActivity;

        $activity->p_dactivity_id = $request->p_dactivity_id;
        $activity->faculty_id = $request->faculty_id;
        $activity->faculty_response = $request->faculty_response;
      }else{
        $activity->faculty_response = $request->input('faculty_response');
      }

      $activity->save();

      // $pd = PDactivity::select('id','title')->where('id',$activity->p_dactivity_id)->first();
      // $hrd = Administrator::select('id')->where('designation', 'hrd')->first();
      // $hrd->notify(new FacultyHrdJoinActivity($pd));
      // $activity->save();

      return redirect()->route('activity', $activity->p_dactivity_id)->with('success','You have successfully accepted the invitation.');
    }

    public function declineActivity(Request $request, $id)
    {

      $this->validate($request, array(
        'faculty_response' => 'required',
        'p_dactivity_id' => 'required',
        'faculty_id' => 'required'
      ));

      $activity = JoinActivity::where('p_dactivity_id', $request->p_dactivity_id)
                              ->where('faculty_id', $request->faculty_id)->first();

      if ($activity == NULL) {
        $activity = new JoinActivity;

        $activity->p_dactivity_id = $request->p_dactivity_id;
        $activity->faculty_id = $request->faculty_id;
        $activity->faculty_response = $request->faculty_response;
      }else{
        $activity->faculty_response = $request->input('faculty_response');
      }

      $activity->save();

      // $pd = PDactivity::select('id','title')->where('id',$activity->p_dactivity_id)->first();
      // $hrd = Administrator::select('id')->where('designation', 'hrd')->first();
      // $hrd->notify(new FacultyHrdJoinActivity($pd));
      // $activity->save();

      return redirect()->route('activity', $activity->p_dactivity_id)->with('error','You have declined the invitation.');
    }

    public function postSignIn(Request $request)
    {
      $this->validate($request, [
        'employee_id' => 'required',
        'password' => 'required'
      ]);
      if(Auth::attempt(['employee_id' => $request['employee_id'], 'password' => $request['password']])){
        return redirect()->route('home');
      }
      return back()->with('error', 'Invalid Username or Password. Please Try Again.');
    }

    public function getLogout()
    {
      Auth::logout();
      return redirect()->route('welcome');
    }

    //
    // public function postSignUp(Request $request)
    // {
    //   $this->validate($request, [
    //     'email' => 'required|email|unique:users',
    //     'first_name' => 'required|max:120',
    //     'password' => 'required|min:4'
    //   ]);
    //   $email = $request['email'];
    //   $first_name = $request['first_name'];
    //   $password = bcrypt($request['password']);
    //
    //   $user = new User();
    //   $user->email = $email;
    //   $user->first_name = $first_name;
    //   $user->password = $password;
    //
    //   $user->save();
    //
    //   Auth::login($user);
    //
    //   return redirect()->route('dashboard');
    // }
    //

    //
    // public function getAccount()
    // {
    //   return view('account', ['user' => Auth::user()]);
    // }
    //
    // public function saveAccount(Request $request)
    // {
    //   $this->validate($request, [
    //     'first_name' => 'required|max:120'
    //   ]);
    //
    //   $user = Auth::user();
    //   $user->first_name = $request['first_name'];
    //   $user->update();
    //
    //   $file = $request->file('image');
    //   $filename = $request['first_name'] . '-' . $user->id . '.jpg';
    //   if($file){
    //     Storage::disk('local')->put($filename, File::get($file));
    //   }
    //   return redirect()->route('account');
    // }
    //
    // public function getUserImage($filename)
    // {
    //   $file = Storage::disk('local')->get($filename);
    //   return new Response($file, 200);
    // }
    //

}
