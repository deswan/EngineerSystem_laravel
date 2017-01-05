@extends('layouts.app')
@section('css',asset('css/exam_test.css'))
@section('main')
	<div class="e_paper">
		<p class="paper_t">{{$exam->name}}</p>
		<div class="paper_content">
			<form method="post" action="/user/course/{{$course->id}}/exam">
				{{csrf_field()}}
			<ul class="p_c_ul">
				@foreach($exam->question()->orderBy('num')->get() as $question)
				<li>
					<p>第{{$question->num+1}}题:{{$question->title}}</p>
					<div class="exam_c">
						<div class="a_choose"><input type="radio" name="answer[{{$question->id}}]" value="1"><span>A:{{$question->option_a}}</span></div>
						<div class="a_choose"><input type="radio" name="answer[{{$question->id}}]" value="2"><span>B:{{$question->option_b}}</span></div>
						<div class="a_choose"><input type="radio" name="answer[{{$question->id}}]" value="3"><span>C:{{$question->option_c}}</span></div>
						<div class="a_choose"><input type="radio" name="answer[{{$question->id}}]" value="4"><span>D:{{$question->option_d}}</span></div>
						</div>
				</li>
				@endforeach
			</ul>
				<div class="sub_btn">
					<input type="submit">
				</div>
			</form>
		</div>
	</div>

@endsection