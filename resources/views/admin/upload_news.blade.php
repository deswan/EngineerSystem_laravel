@extends('layouts.app')
@section('css',asset('css/z_upload.css'))
@section('main')
	<div class="c_upload">
		<p class="n_lo"><a href="/">首页></a><a href="/admin/news">我的资讯></a>上传资讯</p>
		<div class="l_form">
			<form method="post" action="/admin/news/upload">
				{{csrf_field()}}
				<div class="v_name">
					<label>资讯标题：</label><input type="text" name="title">
				</div>
				<div class="z_type">
					<label>资讯类型：</label>
					<input type="radio" name="category" value="2">讲座通知
					<input type="radio" name="category" value="1">行业新闻
				</div>
				<div class="c_type">
					<label>所属课程：</label>
					<input type="radio" name="class" value="2">JAVA
					<input type="radio" name="class" value="3">C++
					<input type="radio" name="class" value="4">PHP
					<input type="radio" name="class" value="5">安卓
					<input type="radio" name="class" value="6">IOS
					<input type="radio" name="class" value="7">.NET
				</div>
				<div class="up_file  up_file2">
					<label>资讯内容：</label>
					<textarea name="text"></textarea>
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
				var ok;
				var title=$.trim($("input[name='title']").val());
				var radioValue1=$("input[name='category']:checked").val();
				var radioValue2=$("input[name='class']:checked").val();
				var content=$.trim($("textarea").val());
				if(title==""){
					alert("资讯标题不能为空");
					ok=true;
				}else if(title.length>50){
					alert("视频名称不能超过50个字");
					ok=true;
				}else if(radioValue1==undefined){
					alert("请选择资讯类型");
					ok=true;
				}else if(radioValue2==undefined){
					alert("请选择资讯所属课程");
					ok=true;
				}else if(content==""){
					alert("请输入资讯内容");
					ok=true;
				}
				if(ok) e.preventDefault();
			});
		})
	</script>
@endsection