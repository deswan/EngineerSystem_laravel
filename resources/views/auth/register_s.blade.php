@extends('layouts.app')
@section('css',asset('css/zhuce.css'))
@section('main')
	<div class="login_data">
		<p class="f_title">学生注册</p>

		<form method="post" action="/user/register">
			{{csrf_field()}}
			<div class="t_name">
				<label>姓名：</label><input type="text" name="name" value="{{old('name')}}">
			</div>
			<div class="t_phone">
				<label>手机：</label><input type="text" name="phone" value="{{old('phone')}}">
			</div>
			<div class="t_mail">
				<label>邮箱：</label><input type="text" name="email" value="{{old('email')}}">
			</div>

			<div class="t_psd">
				<label>密码：</label><input type="password" name="password" value="{{old('password')}}">
			</div>	
			<div class="t_c_psd">
				<label>确认密码：</label><input type="text" name="password_confirmation" value="{{old('password_confirmation')}}">
			</div>	
			<div class="submit_btn">
				<input type="submit" value="提交">
			</div>
			
		</form>
	</div>
	<script type="text/javascript">
		$(function(){
			$(".submit_btn").click(function(e){
				e.preventDefault();
				var name=$.trim($("input[name=name]").val());
				var phone=$.trim($("input[name=phone]").val());
				var mail=$.trim($("input[name=email]").val());
				var psd=$.trim($("input[name=password]").val());
				var c_psd=$.trim($("input[name=password_confirmation]").val());

				if(name==""){
					alert("姓名不能为空");
					return;
				}else if(phone==""){
					alert("手机不能为空");
					return;
				}else if(mail==""){
					alert("邮箱不能为空");
					return;
				}else if(psd==""){
					alert("密码不能为空");
					return;
				}else if(c_psd==""){
					alert("确认密码不能为空");
					return;
				}else if(name.length<2||name.length>20){
					alert("姓名的长度必须在3-20之间");
					return;
				}else if(phone!=""&&phone.length!=11){
					alert("手机号长度必须为11位");
					return;
				}else if(psd!=""&&(psd.length<6||psd.length>20)){
					console.log(psd.length);
					alert("密码的长度必须在6-20位");
					return;
				}else if(psd!=c_psd){
					alert("密码和确认密码不一致");
					return;
				}else{

					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
					$.ajax({
						type: "POST",
						url: "/user/register/validate",
						data: {
							"name": name,
							"email": mail,
							"phone": phone,
							"password": psd,
							"password_confirmation": c_psd
						},
						success: function (d) {
							if(d.code===0){
								console.log('suc');
								$('form').submit();
							}else{
								console.log(d);
								for(key in d){
									var msg='';
									var m1 = '已被注册过';
									var nick = {name:'姓名',phone:'手机号',email:'邮箱',password:'密码'};
									if(key=='phone'){
										msg+=nick[key]
										switch(d[key][0]){
											case "2":msg+=m1;break;
											case '3':msg+='必须只包含数字并且长度为11位';break;
										}
									}else if(key=='email'){
										msg+=nick[key]
										switch(d[key][0]){
											case '2':msg+=m1;break;
											case '3':msg+='格式不合法';break;
										}
									}
									else if(key=='password'){
										msg+=nick[key]
										switch(d[key][0]){
											case '4':msg+='必须只包含字母或数字';break;
										}
									}
									if(msg!==''){
										alert(msg);
									}
								}
							}
						}
					});
				}
			});
		})
	</script>
@endsection