@extends('layouts.app')
@section('css',asset('css/v_upload.css'))
@section('main')
	<div class="c_upload">
		@include('admin.share.upload_bar')
		<div class="l_form">
			<form data-state="{{$state}}" data-id="{{$course->id}}" enctype="multipart/form-data" method="post"
				  @if($state==1) action="/admin/course/{{$course->id}}/upload/video" accept="video/mp4">
				@else action="/admin/course/{{$course->id}}/upload/textbook" accept="application/vnd.ms-powerpoint">
				@endif
				{{csrf_field()}}
				<div class="v_name">
					<label>@if($state==1) 视频名称
						@else 课件名称
						@endif：</label><input type="text" name="name">
				</div>
				<div class="up_file">
					<label>上传文件：</label><input type="file" name="video"
											   @if($state==1)  accept="video/mp4">
												@else  accept="application/vnd.ms-powerpoint">
												@endif
				</div>
				<div class="sub_btn" margin>
					<input type="submit" value="提交">
				</div>
			</form>
			@if($state==1) 注:只能上传mp4格式视频
			@endif
		</div>
	</div>
	<script type="text/javascript">
		$(function(){
			$(".sub_btn").click(function(e){
				e.preventDefault();
				var name=$.trim($("input[name=name]").val());
				var file=$.trim($("input[name=video]").val());
				var cid = $('form').data('id');
				if($('form').data('state')==1){
					var categ = 'video';
				}else{
					var categ = 'textbook';
				}
				if(name==""){
					alert("名称不能为空");
					return;
				}else if(name.length>20){
					alert("名称不能超过20个字");
					return;
				}else if(!file){
					alert("请选择文件");
					return;
				}else{
					$.ajaxSetup({ headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					} });
					$.ajax({
						type: "POST",
						url: "/admin/course/"+cid+"/upload/"+categ+'/validate',
						data: {"name":name},
						success: function (result) {
							var d = result.code;
							if(d===0){
								console.log('gogo');
								$('form').submit();
							}else if(d===1){
								alert("该名称已经存在");
								return;
							}
						}
					});
				}
			});
		})
	</script>
@endsection