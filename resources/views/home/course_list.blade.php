@extends('layouts.app')
@section('css',asset('css/class.css'))
@section('main')
	<div class="class_list">
		<ul>
			@for($i=2;$i<=7;$i++)
			<li><a href="/course_list/{{$i}}"><img src="{{asset('images/class'.($i-1).'.png')}}"></a></li>
			@endfor
			<div class="clear"></div>
		</ul>

	</div>
	<div class="footer">
		<img src="{{asset('images/footer.png')}}">
	</div>
@endsection