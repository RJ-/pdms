<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PDactivity;

use Helper;

class DemoController extends Controller
{

    public function loadData()
    {
        $activities = PDactivity::orderBy('created_at','DESC')->limit(2)->get();
        dd($activities);
        return view('demos.loaddata')->withActivities($activities);
    }

    public function loadDataAjax(Request $request)
    {
        $output = '';
        $id = $request->id;

        $activities = PDactivity::where('id','<',$id)->orderBy('created_at','DESC')->limit(2)->get();
        if(!$activities->isEmpty())
        {
            foreach($activities as $activity)
            {
                $details = substr(strip_tags($activity->details),0,500);
                $details .= strlen(strip_tags($activity->details))>500?"...":"";

                $output .= '<div class="mdl-grid mdl-cell mdl-cell--12-col  mdl-shadow--4dp">
                                <div class="post">
                                    <a href="'.$url.'" class="nounderline" ><h2 class="post-title" >'.$activity->title.'</h2></a>
                                    <div class="row">
                                       <div class="col-md-6">
                                           <h5 class="post-date" >Published:'.date('M j, Y', strtotime($activity->created_at)).'</h5>
                                       </div>
                                   </div>
                                    <div class="row">

                                        <div class="col-md-8">
                                            <p class="text-justify">'.$details.'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }

            $output .= '<div id="remove-row">
                            <button id="btn-more" data-id="'.$activity->id.'" class="nounderline btn-block mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" > Load More </button>
                        </div>';

            echo $output;
        }
    }
}
