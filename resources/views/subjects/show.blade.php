@extends('app')

@section('styles')
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="/css/selector.css">
@stop
    
@section('content')
	<div class="row">
	    <div class="col-sm-9">
	        <div id="tabs">
	            <ul>
	                <li><a href="#can-biet">Cần biết</a></li>
	                <li><a href="#web">Web</a></li>
	                <li><a href="#nguoi">Người</a></li>
	                <li><a href="#sach">Sách</a></li>
	                <li><a href="#kinh-nghiem">Kinh nghiệm</a></li>
	            </ul>
	            <div id="can-biet">
	                <ul class="select-list">
	                    @foreach ($recommend_subjects as $subject)
	                    	<li>
	                    		<input type="checkbox" name="recommend_subject_select" id="recommend_subject_select">
	                    		<h4><a href="/subjects/{{ $subject->id }}">{{ $subject->name }}</a></h4>
	                    		<h3>{{ $subject->selected }} selected, {{ $subject->likes }} likes</h3>
	                    	</li>
	                    @endforeach
	                </ul>
	                <button type="submit" class="btn btn-success pull-left btn-select">Xem thêm</button>
	                <button type="submit" class="btn btn-success pull-right btn-select">Đóng góp</button>
	                <div class="clearfix"></div>
	            </div>
	            <div id="web">
	                <ul class="select-list">
	                	@foreach ($websites as $website)
	                    	<li>
	                    		<input type="checkbox" name="website_select" id="website_select" v-on:change="updateWebsite">
	                    		<h4><a href="{{ $website->link }}">{{ $website->name }}</a></h4>
	                    		<h3>{{ $website->selected }} selected, {{ $website->likes }} likes</h3>
	                    		<p>{{ $website->intro }}</p>
	                    	</li>
	                    @endforeach
	                </ul>
	                <button type="submit" class="btn btn-success pull-left btn-select">Xem thêm</button>
	                <button type="submit" class="btn btn-success pull-right btn-select">Đóng góp</button>
	                <div class="clearfix"></div>
	            </div>
	            <div id="nguoi">
	                <ul class="select-list">
	                    @foreach ($persons as $person)
	                    	<li>
	                    		<input type="checkbox" name="person_select" id="person_select">
	                    		<h4><a href="{{ $person->link }}">{{ $person->name }}</a></h4>
	                    		<img src="{{ $person->avatar }}">
	                    		<h3>{{ $website->selected }} selected, {{ $website->likes }} likes</h3>
	                    		<p>{{ $website->intro }}</p>
	                    	</li>
	                    @endforeach
	                </ul>
	                <button type="submit" class="btn btn-success pull-left btn-select">Xem thêm</button>
	                <button type="submit" class="btn btn-success pull-right btn-select">Đóng góp</button>
	                <div class="clearfix"></div>
	            </div>
	            <div id="sach">
	                <ul class="select-list">
	                    @foreach ($books as $book)
	                    	<li>
	                    		<input type="checkbox" name="book_select" id="book_select">
	                    		<h4>{{ $book->name }}</a></h4>
	                    		<img src="{{ $book->avatar }}">
	                    		<h3>{{ $book->selected }} selected, {{ $book->likes }} likes</h3>
	                    		<h5>{{ $book->publisher }}</h5>
	                    		<p>{{ $book->intro }}</p>
	                    	</li>
	                    @endforeach
	                </ul>
	                <button type="submit" class="btn btn-success pull-left btn-select">Xem thêm</button>
	                <button type="submit" class="btn btn-success pull-right btn-select">Đóng góp</button>
	                <div class="clearfix"></div>
	            </div>
	            <div id="kinh-nghiem">
	                <!-- Disqus -->
	            </div>
	        </div>
	    </div>
	    <div class="col-sm-3">
	        <div id="selected">
	            <div id="selected-list">
	                <p class="text-center">Bạn đã chọn</p>
	            </div>
	            <button type="submit" id="selected-save" class="btn btn-block btn-success">Save</button>
	        </div>

	    </div>
	</div>
@stop

@section('scripts')
	<script rel="script" type="text/javascript" src="/js/jquery.min.js"></script>
	<script rel="script" type="text/javascript" src="/js/jquery-ui.min.js"></script>
	<script rel="script" type="text/javascript" src="/js/bootstrap.min.js"></script>
	<script rel="script" type="text/javascript" src="/js/jquery.hc-sticky.min.js"></script>
	<script src="/js/vue.min.js"></script>
	<script src="/js/vue-resource.min.js"></script>
	<script>
	    //    tab
	    $(function () {
	        $("#tabs").tabs();
	    });

	    //    select
	    $(function () {
	        $(".select-list").selectable();
	    });

	    //    float
	    $(function ($) {
	        $('#selected').hcSticky({
	            stickTo: "document"
	        });
	    });

	    new Vue({
	    	el: '#tabs',
	    	data: {

	    	},
	    	methods: {
	    		updateWebsite: function() {
	    					
	    		}
	    	}
	    });
	</script>
@stop