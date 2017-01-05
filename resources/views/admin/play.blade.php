@extends('layouts.app')
@section('css',asset('css/v_play.css'))
@section('main')
	<div class="video_area">
			<video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="none" width="1080" height="500" data-setup="{}">
    <source src="/storage/{{$video->url}}" type="video/mp4">
    <source src="http://vjs.zencdn.net/v/oceans.webm" type="video/webm">
    <source src="http://vjs.zencdn.net/v/oceans.ogv" type="video/ogg">


  </video>
	</div>
	<script src="http://vjs.zencdn.net/ie8/1.1.0/videojs-ie8.min.js"></script>
	<script src="http://vjs.zencdn.net/5.0.2/video.js"></script>
@endsection
