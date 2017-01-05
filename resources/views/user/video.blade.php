@extends('layouts.app')
@section('css',asset('css/c_data.css'))
@section('main')
	<div class="c_upload">
		@include('user.share.detail_bar')
		<div class="data_list">
			<ul class="l_f_ul">
				@foreach($items as $item)
				<li class="list_li">
					<ul class="l_s_ul">
						<li class="vn">{{$item->name}}</li>
						<li class=dw><a href="/user/video/{{$item->id}}/play">播放</a></li>
						<div class="clear"></div>
					</ul>
				</li>
				@endforeach

				<div class="clear"></div>
			</ul>
		</div>
	</div>
@endsection