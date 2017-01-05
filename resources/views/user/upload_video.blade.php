@extends('layouts.app')
@section('css',asset('css/v_upload.css'))
@section('main')
	<div class="c_upload">
		@include('admin.share.upload_bar')
		<div class="l_form">
			<form enctype="multipart/form-data" method="post"
				  @if($state==1) action="/admin/course/{{$course->id}}/upload/video">
				@else action="/admin/course/{{$course->id}}/upload/textbook">
				@endif
				{{csrf_field()}}
				<div class="v_name">
					<label>视频名称：</label><input type="text" name="name">
				</div>
				<div class="up_file">
					<label>上传文件：</label><input type="file" name="video">
				</div>
				<div class="sub_btn" margin>
					<input type="submit" value="提交">
				</div>
			</form>
			@if(count($errors)>0)
				@foreach($errors->all() as $err)
					{{$err}}
				@endforeach
			@endif
		</div>
		
	</div>
@endsection