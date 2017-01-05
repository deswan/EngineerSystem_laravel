@extends('layouts.app')
@section('css',asset('css/t_class.css'))
@section('main')
	<div class="p_l">

		<div class="p_loca">
			<p><a href="/">首页></a>我的课程</p>
		</div>
		<div class="up_btn"><a href="/admin/add_course">添加课程</a></div>
		<div class="clear"></div>
	</div>

	<div class="class_data">
		@if(!$courses->count())

		@else

		<div class="d_title">
			<ul>
				<li class="c_name">课程名称</li>
				<li class="upload_v">上传视频</li>
				<li class="upload_d">上传ppt</li>
				<li class="upload_e">上传试卷</li>
				<div class="clear"></div>
			</ul>
		</div>
		<div class="d_list">
			<ul>
				@foreach($courses as $course)
				<li class="d_l_li">
					<ul>
						<li class="c_name"><a style="color:blue;text-decoration:underline" href="/admin/course/{{$course->id}}/video">{{$course->name}}</a></li>
						<li class="upl"><a href="/admin/course/{{$course->id}}/upload/video"><img src="{{asset('images/upload.png')}}"></a></li>
						<li class="upl"><a href="/admin/course/{{$course->id}}/upload/textbook"><img src="{{asset('images/upload.png')}}"></a></li>
						@if($course->exam()->count()===0)
						<li class="upl"><a href="/admin/course/{{$course->id}}/upload/exam"><img src="../images/upload.png"></a></li>
						@else
							<li class="upl" style="color:red"><a>{{$course->exam->name}}</a></li>
							<li class="upl"><a href="/admin/course/exam/{{$course->id}}/delete" style="color:blue">删除试卷</a></li>
						@endif
						<div class="clear"></div>
					</ul>
				</li>
				@endforeach
			</ul>
		</div>
			@endif
	</div>
@endsection