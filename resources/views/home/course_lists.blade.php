@extends('layouts.app')
@section('css',asset('css/class_list.css'))
@section('main')
	<div class="class_area">
		<div class="page_l">
			<p><a href="/course_list">课程></a>{{$type->name}}课程列表</p>
		</div>
		@if(!$courses->count())

		@else
		<div class="list_title">
			<ul>
				<li class="c_name">课程名称</li>
				<li class="c_teacher">授课老师</li>
				<li class="c_save"></li>
				<div class="clear"></div>
			</ul>
		</div>
		<div class="list_c">
			<ul class="list_ul">
				@foreach($courses as $course)
					<li class="list_li">
					<ul class="c_inner">
						<li class="c_n_l"><a>{{$course->name}}</a></li>
						<li class="c_t_l">{{$course->admin->name}}</li>
						<li class="c_s_l"><a data-id="{{$course->id}}" href="/course/{{$course->id}}/collect">收藏</a></li>
						<div class="clear"></div>
					</ul>
					</li>
				@endforeach
			</ul>
		</div>
			@endif
	</div>
	<script type="text/javascript">
		$(function(){
			$(".c_s_l").click(function(e){
				e.preventDefault();
				var cid = $(this).find('a').data('id');
				$.ajaxSetup({ headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				} });
				$.ajax({
					type: "GET",
					url: "/course/"+cid+"/collect/validate",
					success: function (result) {
						var d = result.code;
						if(d==0){
							window.location.href="/course/"+cid+"/collect";
						}else if(d==1){
							alert("教师不能收藏");
							return;
						}else if(d==2){
							alert("你已经收藏过该课程");
							return;
						}
					}
				});
			});
		})
	</script>
@endsection