<p class="n_lo"><a href="/admin/courses">我的课程></a><a href="/admin/course/{{$course->id}}/video">{{$course->name}}></a>上传</p>
<div class="n_list">
	<ul>
		@if($state==1)

			<li class="c_link"><a href="/admin/course/{{$course->id}}/upload/video">课程视频</a></li>
			<li><a href="/admin/course/{{$course->id}}/upload/textbook">课程ppt</a></li>
		@else
			<li><a href="/admin/course/{{$course->id}}/upload/video">课程视频</a></li>
			<li class="c_link"><a href="/admin/course/{{$course->id}}/upload/textbook">课程ppt</a></li>
		@endif
		<div class="clear"></div>

	</ul>
</div>