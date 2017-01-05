<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
 *
     * @return \Illuminate\Http\Response
     */
    public function courses()
    {
        $courses = auth()->user()->courses;
        return view('user.courses',compact('courses'));
    }

    public function video_list(App\Course $course)
    {
        $state=1;   //bar当前所在页css切换用(共用detail_bar母版)
        $items = $course->video;
        return view('user.video',compact('state','course','items'));
    }
    public function textbook_list(App\Course $course)
    {
        $state=2;
        $items = $course->textbooks;
        return view('user.textbook',compact('state','course','items'));
    }
    public function play(App\Video $video)
    {
        return view('user.play',compact('video'));
    }
    public function exam(App\Course $course){

        $exam=$course->exam;
        return view('user.exam',compact('exam','course'));
    }
    public function exam_deal(Request $r, App\Course $course){
        $questions = $course->questions->keyBy('id');
        $sum = $questions->count();
        foreach($r->answer as $id=>$answer){
            if($questions->get($id)->correct===intval($answer)){
                $questions->forget($id);
            }
        }
        $mark = ($sum-$questions->count())/$sum*100;
        auth()->user()->courses()->updateExistingPivot($course->id, ['state'=>1,'mark'=>$mark]);
        return redirect('user/courses');
    }
}
