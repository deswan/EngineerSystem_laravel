<?php

namespace App\Http\Controllers\Admin;

use Log;
use Illuminate\Http\Request;
use App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function courses()
    {
        $courses = auth('admin')->user()->courses;
        return view('admin.courses',compact('courses'));
    }
    
    public function video_list(App\Course $course)
    {
        $state=1;
        $items = $course->video;
        return view('admin.video',compact('state','course','items'));
    }
    public function textbook_list(App\Course $course)
    {
        $state=2;
        $items = $course->textbooks;
        return view('admin.textbook',compact('state','course','items'));
    }
    public function news()
    {
        $news = auth('admin')->user()->information;
        return view('admin.news',compact('news'));
    }
    
    //上传视频和上传课件页面共用一个模板
    public function upload_video(App\Course $course){
        $state=1;
        return view('admin.upload_video',compact('course','state'));
    }
    public function upload_textbook(App\Course $course){
        $state=2;
        return view('admin.upload_video',compact('course','state'));
    }
    public function upload_news(){
        return view('admin.upload_news');
    }
    public function upload_exam(App\Course $course){
        return view('admin.upload_exam',compact('course'));
    }
    public function add_course(){
        $types = App\Type::all();
        return view('admin.add_course',compact('types'));
    }
    public function add_course_validate(Request $r){
        $code=0;
        $msg = [
            'required'=>1,
            'between'=>2,
            'unique'=>2,
            'max'=>3,
        ];
        $this->validate($r,[
            'name'=>'required|unique:courses|max:50',
            'type_id'=>'required|Integer|between:2,7'
            ],$msg);
        return response()->json(['code'=>$code]);
    }
    public function add_course_deal(Request $r){
        $this->validate($r,['name'=>'required|unique:courses|max:50','type_id'=>'required|Integer|between:2,7']);
        $c = new App\Course(['name'=>$r->name,'type_id'=>$r->type_id]);
        auth('admin')->user()->courses()->save($c);
        return redirect("admin/courses");
    }

    public function upload_video_validate(Request $r,App\Course $course){
        $code=0;
        $msg=['required'=>0,'max'=>1];
        $this->validate($r,['name'=>'required|max:20'],$msg);
        if($course->video()->where('name',$r->name)->get()->count()){
            $code=1;
        }
        return response()->json(['code'=>$code]);
    }
    public function upload_textbook_validate(Request $r,App\Course $course){
        $code=0;
        $msg=['required'=>0,'max'=>1];
        $this->validate($r,['name'=>'required|max:20'],$msg);
        if($course->textbooks()->where('name',$r->name)->get()->count()){
            $code=1;
        }
        return response()->json(['code'=>$code]);
    }

    //处理上传
    public function upload_video_deal(Request $r,App\Course $course){
        $this->validate($r,['name'=>'required|max:20','file'=>'mimetypes:video/mp4']);
        $file = $r->file('video');
        if ($r->file('video')->isValid()){
            $path = $file->store('video');
            $v = new App\Video([
                'name'=>$r->name,
                'url'=>$path,
                'size'=>$file->getClientSize(),
                'extension'=>$file->extension()]);
            $course->video()->save($v);

        }
        return redirect('/admin/course/'.$course->id.'/video');
    }
    public function upload_textbook_deal(Request $r,App\Course $course){
        
        $this->validate($r,['name'=>'required|max:20','file'=>'mimes:ppt,pptx']);
        $file = $r->file('video');
        if ($r->file('video')->isValid()){
            $path = $file->store('video');
            $v = new App\Textbook([
                'name'=>$r->name,
                'url'=>$path,
                'size'=>$file->getClientSize(),
                'extension'=>$file->extension()]);
            $course->textbooks()->save($v);
        }
        return redirect('/admin/course/'.$course->id.'/textbook');
    }
    public function upload_news_deal(Request $r){
        $this->validate($r,['title'=>'required|max:20',
                        'category'=>'required|numeric|between:1,2',
                        'class'=>'required|numeric|between:2,7',
                        'text'=>'required']);
            $news = new App\Information([
                'title'=>$r->title,
                'category_id'=>$r->category,
                'type_id'=>$r->class,
                'text'=>$r->text]);
        auth('admin')->user()->information()->save($news);
        return redirect('/admin/news');
    }
    public function upload_exam_deal(Request $r,App\Course $course){
        $this->validate($r,['name'=>'required|max:20',
            'question'=>'required|array']);
        foreach($r->question as $item){
            $item['correct'] = (int)$item['correct'];
            if($item['correct']>4||$item['correct']<1){
                return abort(404);
            }
        }
        DB::transaction(function () use($r,$course){
            $exam = new App\Exam([
                'name'=>$r->name,
                'course_id'=>$course->id]);
            $exam->save();
            foreach($r->question as $num=>$item){
                $question = new App\Question([
                            'title'=>$item['title'],
                            'option_a'=>$item['optionA'],
                            'option_b'=>$item['optionB'],
                            'option_c'=>$item['optionC'],
                            'option_d'=>$item['optionD'],
                            'correct'=>$item['correct'],
                            'num'=>$num]);
                $exam->question()->save($question);
            }
        });
        return redirect("admin/courses");
    }


    //删除
    public function delete_video(App\Video $video){
        $video->delete();
        return back();
    }
    public function delete_textbook(App\Textbook $textbook){
        $textbook->delete();
        return back();
    }
    public function delete_news(App\Information $information){
        $information->delete();
        return back();
    }
    public function delete_exam(Request $r,App\Course $course){
        $course->exam->question->map(function($item,$key){
            $item->delete();
        });
        if(auth('admin')->user()->courses->contains($course)){
            $course->exam->delete();

        }
        return redirect('/admin/courses');
    }

    public function play(App\Video $video)
    {
        return view('admin.play',compact('video'));
    }
    public function loginAjax(Request $r){
        
    }

}
