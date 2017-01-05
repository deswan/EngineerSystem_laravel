@extends('layouts.app')
@section('css',asset('css/s_class.css'))
@section('main')
	<div class="p_loca">
		<p><a href="/">首页></a>我的课程</p>
	</div>
	<div class="class_data">
		@if(!$courses->count())

		@else

		<div class="d_title">
			<ul>
				<li class="c_name">课程名称</li>
				<li class="download_v">视频播放</li>
				<li class="download_d">ppt下载</li>
				<li class="download_e">考试</li>
				<div class="clear"></div>
			</ul>
		</div>
		<div class="d_list">
			<ul>
				@foreach($courses as $course)
				<li class="d_l_li">
					<ul>
						<li class="c_name"><a>{{$course->name}}</a></li>
						<li class="dwl"><a href="/user/course/{{$course->id}}/video"><img src="{{asset('images/play.png')}}"></a></li>
						<li class="dwl"><a href="/user/course/{{$course->id}}/textbook"><img src="{{asset('images/download.png')}}"></a></li>
						@if($course->pivot->state===0)
							@if($course->exam()->count()>0)
						<li class="dwl"><a href="/user/course/{{$course->id}}/exam">进入考试</a></li>
							@else
								<li class="dwl"><a>试卷未上传</a></li>
							@endif
						@else
							<li class="dwl"><a style="color:red">成绩:{{$course->pivot->mark}}</a></li>
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