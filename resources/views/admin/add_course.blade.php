@extends('layouts.app')
@section('css',asset('css/v_upload.css'))
@section('main')
	<div class="c_upload">
		<p class="n_lo"><a href="#">首页></a><a href="/admin/courses">我的课程></a>添加课程</p>
		
		<div class="l_form">
			<form method="post" action="/admin/add_course">
				{{csrf_field()}}
				<div class="v_name">
					<label>课程名称：</label><input type="text" name="name">
				</div>
				<div class="c_type">
					<label>课程类型：</label>
					@foreach($types as $type)
					<input type="radio" name="type_id" value={{$type->id}}>{{$type->name}}
					@endforeach
				</div>
				<div class="sub_btn">
					<input type="submit">
				</div>
			</form>
		</div>
		
	</div>
	<script type="text/javascript">
		$(function(){

			$(".sub_btn").click(function(e){
				e.preventDefault();
				var name=$.trim($("input[name=name]").val());
				var radioValue=$("input[name='type_id']:checked").val();
				if(name==""){
					alert("课程名称不能为空");
					return;
				}else if(name.length>50){
					alert("课程名称不能超过50个字");
					return;
				}else if(!radioValue){
					alert("请选择课程类型");
					return;
				}else{
					$.ajaxSetup({ headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					} });
					$.ajax({
						type: "POST",
						url: "/admin/add_course/validate",
						data: {"name":name,'type_id':radioValue},
						success: function (d) {
							if(d.code===0){
								$('form').submit();
							}else if(d.name[0]==="2"){
								alert("该课程名称已经存在");
								return;
							}
						}
					});
				}
			});
		})
	</script>
@endsection