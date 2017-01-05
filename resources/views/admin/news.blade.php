@extends('layouts.app')
@section('css',asset('css/my_zixun.css'))
@section('main')
	<div class="class_area">
		<div class="page_l">
			<div class="p_loca">
				<p><a href="/">首页></a>我的资讯</p>
			</div>
			<div class="up_btn"><a href="/admin/news/upload">上传资讯</a></div>
			<div class="clear"></div>
		</div>
		<div class="list_title">
			<ul>
				<li class="c_name">资讯名称</li>
				<li class="c_type">资讯类型</li>
				<li class="c_inner">所属课程</li>
				<div class="clear"></div>
			</ul>
		</div>
		@if(!$news->count())

		@else
		<div class="list_c">
			<ul class="list_ul">
				@foreach($news as $new)
				<li class="list_li">
					<ul class="c_inner">
						<li class="c_n_l"><a>{{$new->title}}</a></li>
						<li class="c_t_l">{{$new->category->name}}</li>
						<li class="c_s_l"><a>{{$new->type->name}}</a></li>
						<li class="c_del"><a href="/admin/news/{{$new->id}}/delete">删除</a></li>
						<div class="clear"></div>
					</ul>
				</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
@endsection