<p class="n_lo"><a href="/user/courses">我的课程></a>{{$course->name}}</p>
<div class="n_list">
	<ul>
		@if($state==1)
			<li class="c_link"><a href="/user/course/{{$course->id}}/video">课程视频</a></li>
			<li><a href="/user/course/{{$course->id}}/textbook">课程ppt</a></li>
		@else
			<li><a href="/user/course/{{$course->id}}/video">课程视频</a></li>
			<li class="c_link"><a href="/user/course/{{$course->id}}/textbook">课程ppt</a></li>
		@endif
		<div class="clear"></div>
	</ul>
	<div class="clear"></div>
</div>