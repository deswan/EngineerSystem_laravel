@extends('layouts.app')
@section('css',asset('css/zixun.css'))
@section('main')
	<div class="news_t_l">
		<ul>
			@foreach($alltype as $t)
			<li><a @if($t->id==$type->id) class="n_hover" @endif href="/news/{{$t->id}}">{{$t->name}}</a></li>
			@endforeach
			<div class="clear"></div>
		</ul>
	</div>
	<div class="news">
		@if(!$news->count())

		@else
		<ul>
			@foreach($news as $new)
			<li class="news_li">
				<div class="news_title">{{$new->title}}</div>
				<div class="news_time">{{$new->created_at}}</div>
				<div class="news_type">{{$new->category->name}}</div>
				<div class="clear"></div>
				<p class="news_c">{{$new->text}}</p>
			</li>
			@endforeach
		</ul>
			@endif
	</div>
@endsection
