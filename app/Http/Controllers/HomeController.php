<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
    public function index()
    {
        return view('home.index',compact('auth'));
    }
    //课程首页
    public function courses(Request $r)
    {
        return view('home.course_list');
    }
    //二级
    public function course_list(Request $r,App\Type $type)
    {
        $courses = $type->courses()->orderBy('created_at','desc')->get();
        return view('home.course_lists',compact('type','courses'));
    }
   
    //收藏课程
    public function course_collect(Request $r,App\Course $course)
    {
        $q = DB::table('course_user')->where([
            ['user_id','=',Auth::user()->id],
            ['course_id','=',$course->id]])->get();
        if(!$q->count()){
            Auth::user()->courses()->attach($course);
            return redirect('user/courses');
        }
        //!!须提示给用户"该课程已经收藏过";
        return abort(501,"该课程已经收藏过");
    }
    public function course_collect_validate(Request $r,App\Course $course)
    {
        $code=0;
        if(auth('admin')->check()){
            $code=1;    //教师身份
        }else if(auth()->check()){
            $q = DB::table('course_user')->where([
                ['user_id','=',Auth::user()->id],
                ['course_id','=',$course->id]])->get();
            if($q->count()){
                $code=2;    //已收藏
            }
        }
        return response()->json(['code'=>$code]);
    }
    public function download_video(App\Video $video){   
        return response()->download('storage/'.$video->url,$video->name.'.'.$video->extension,[
            'Content-type'=>'application/octet-stream',
            'Content-Transfer-Encoding'=>'binary',
            'Accept-Ranges'=>'bytes',
            'Content-Length'=>$video->size,
            'Content-Disposition'=>"attachment; filename=\".$video->name".'.'."$video->extension\""
        ]);
    }
    public function download_textbook(App\Textbook $textbook){
        return redirect('storage/'.$textbook->url);
    }
    //资讯
    public function news(Request $r,App\Type $type)
    {
        $alltype = App\Type::all();
        $news = $type->information()->orderBy('created_at','desc')->get();
        return view('home.news',compact('news','alltype','type'));
    }

    
}
