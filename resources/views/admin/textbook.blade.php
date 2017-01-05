@extends('layouts.app')
@section('css',asset('css/c_data.css'))
@section('main')
	<div class="c_upload">
		@include('admin.share.detail_bar')
		<div class="data_list">
			<ul class="l_f_ul">
				@foreach($items as $item)
					<li class="list_li">
						<ul class="l_s_ul">
							<li class="vn">{{$item->name}}</li>
							<li class=del ><a href="/admin/course/textbook/{{$item->id}}/delete">删除</a></li>
							<li class=dw ><a href="/download/textbook/{{$item->id}}/">下载</a></li>
							<div class="clear"></div>
						</ul>
					</li>
				@endforeach

				<div class="clear"></div>
			</ul>
		</div>
	</div>
@endsection