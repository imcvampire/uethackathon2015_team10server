@extends('app')

@section('styles')
	<meta id="token" name="token" value="{{ csrf_token() }}">
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
	                    @foreach ($recommend_subjects as $recommend_subject)
	                    	<li>
	                    		<input type="checkbox" 
	                    				name="recommend_subject_select" 
	                    				id="recommend_subject_select" 
	                    				v-on:change="storeSubject({{ $recommend_subject->id }})" 
		                    		@if (\Auth::user()->studied_subjects()->where('subject_id', $subject->id)->count() > 0)
		                    			checked
		                    		@endif
	                    		>
	                    		<h4><a href="/subjects/{{ $subject->id }}">{{ $recommend_subject->name }}</a></h4>
	                    		<h3>{{ $recommend_subject->selected }} selected, {{ $recommend_subject->likes }} likes</h3>
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
	                    		
	                    		<input type="checkbox" 
	                    				name="website_select" 
	                    				id="website_select" 
	                    				v-on:change="storeWebsite({{ $website->id }})" 
		                    		@if (\Auth::user()->studied_websites()->where('website_id', $website->id)->count() > 0)
		                    			checked
		                    		@endif
	                    		>
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
	                    		<input type="checkbox" 
	                    				name="person_select" 
	                    				id="person_select" 
	                    				v-on:change="storePerson({{ $person->id }})" 
		                    		@if (\Auth::user()->studied_persons()->where('person_id', $person->id)->count() > 0)
		                    			checked
		                    		@endif
	                    		>
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
	                    		<input type="checkbox" 
	                    				name="book_select" 
	                    				id="book_select" 
	                    				v-on:change="storeBook({{ $book->id }})" 
		                    		@if (\Auth::user()->studied_books()->where('book_id', $book->id)->count() > 0)
		                    			checked
		                    		@endif
	                    		>
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
	    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
	    new Vue({
	    	el: '#tabs',
	    	data: {

	    	},
	    	methods: {
	    		storeWebsite: function(websiteId) {
	    			this.$http.post('/subjects/websites', {id: websiteId});
	    		},
	    		storeSubject: function(subjectId) {
	    			this.$http.post('/subjects/subjects', {id: subjectId});
	    		},
	    		storePerson: function(personId) {
	    			this.$http.post('/subjects/persons', {id: personId});
	    		},
	    		storeBook: function(bookId) {
	    			this.$http.post('/subjects/books', {id: bookId});
	    		}
	    	}
	    });
	</script>
@stop