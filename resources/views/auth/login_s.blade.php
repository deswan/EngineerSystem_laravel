@extends('layouts.app')
@section('css',asset('css/login.css'))
@section('main')
	<div class="login_area">
		<div class="login_logo">
			<img src="{{asset('images/logo3.png')}}">
		</div>
		
		<div class="login_f">
			<div class="login_admin">
				<ul>
					<li><a href="/user/login" class="c_hover">学生</a></li>
					<li><a href="/admin/login">教师</a></li>
				</ul>
				<div class="clear"></div>
			</div>

			<form method="post" action="/user/login">
				{{ csrf_field() }}
				<div class="admin_input">
					<label>手机号：</label><input type="text" name="phone" class="adm_phone">
				</div>
				<div class="admin_psd">
					<label>密码：</label><input type="password" name="password" class="adm_psd">
				</div>
				<input class="submit_btn" type="submit" value="登录">
			</form>
		</div>
		<div class="line">
			<img src="{{asset('images/line.png')}}">
		</div>
		<div class="none_admin">
			<div class="n_tips">
				<img src="{{asset('images/logo4.png')}}">
			</div>
			<div class="c_btn">
				<ul>
					<li><a href="/user/register">我是学生</a></li>
					<li><a href="/admin/register">我是教师</a></li>
				</ul>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<script type="text/javascript">

		$(".submit_btn").click(function(e){
			e.preventDefault();
			var adm_phone=$.trim($(".adm_phone").val());
			var adm_psd=$(".adm_psd").val();
			if(adm_phone==""){
				alert("用户名不能为空");
			}else if(adm_psd==""){
				alert("密码不能为空");
			}else{
				$.ajaxSetup({ headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				} });
				$.ajax({
					type: "POST",
					url: "/user/login/validate",
					data: {"phone":adm_phone,"password":adm_psd},
					dataType: "json",
					success: function (result) {
						console.log(result);
						var d = result.code;
						if(d==0){
							$('form').submit();
						}else if(d==1){
							alert("用户名不存在");
							return;
						}else if(d==2){
							alert("密码不正确");
							return;
						}
					},
					complete:function (result) {
						console.log(result);
					}
				});
			}

		})
	</script>

@endsection
