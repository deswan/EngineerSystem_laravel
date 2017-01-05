@extends('layouts.app')
@section('css',asset('css/exam_upd.css'))
@section('main')
	<div class="c_upload">
		<p class="n_lo"><a href="#">首页></a><a href="/admin/courses">我的课程>{{$course->name}}></a>上传试卷</p>
		<form method="post" action="/admin/course/{{$course->id}}/upload/exam">
			{{csrf_field()}}
			<div class="exam_name">
				<label>试卷名称：</label><input type="text" name="name">
			</div>
			@if(count($errors)>0)
				@foreach($errors->all() as $err)
					{{$err}}
				@endforeach
			@endif
			<ul class="exam_area">
				@for($i=0;$i<10;$i++)
				<li class="e_n_li">
					<p class="p_num">第{{$i+1}}题</p>
					<div>
						<div class="problem_c">
							<label>题目内容：</label><textarea name="question[{{$i}}][title]"></textarea>
						</div>
						<ul class="exam_list">
							<li>
								<div class="p_choose">
									<label>A：</label><input type="text" name="question[{{$i}}][optionA]">
								</div>
								<div class="p_choose">
									<label>B：</label><input type="text" name="question[{{$i}}][optionB]">
								</div>
								<div class="p_choose">
									<label>C：</label><input type="text" name="question[{{$i}}][optionC]">
								</div>
								<div class="p_choose">
									<label>D：</label><input type="text" name="question[{{$i}}][optionD]">
								</div>
								<div class="r_answer">
									<label>正确答案：</label>
									<input type="radio" name="question[{{$i}}][correct]" value="1">A
									<input type="radio" name="question[{{$i}}][correct]" value="2">B
									<input type="radio" name="question[{{$i}}][correct]" value="3">C
									<input type="radio" name="question[{{$i}}][correct]" value="4">D
								</div>
								
							</li>
						</ul>
					</div>
				</li>
				@endfor


			</ul>
			<div class="sub_btn">
			<input type="submit" value="上传试题">
				</div>
		</form>
		
		
	</div>
	<script>
		$('.sub_btn').click(function (e) {
			e.preventDefault();
			if(!$('input[name=name]').val()){
				alert('未填写试卷名称');
				return;
			}
			var ok1=false;
			$('.e_n_li').each(function (i) {
				var ok=false;
				if(!$(this).find('textarea').val()){
					alert('第'+(i+1)+'题未填写题目');
					ok1=true;
					return false;
				}
				$(this).find('input[type=text]').each(function (j) {
					if(!$(this).val()){
						alert('第'+(i+1)+'题未完成答案填写');
						ok=true;
						ok1=true;
						return false;
					}
				})
				if(ok) return false;
				if(!$(this).find('input[type=radio]:checked').val()){
					alert('第'+(i+1)+'题未选择正确答案');
					ok1=true;
					return false;
				}
				return true;
			})
			if(ok1) return;
			$('form').submit();
		})

	</script>
@endsection