@extends('app')

@section('styles')
	<meta id="token" name="token" value="{{ csrf_token() }}">
	<meta id="s_id" name="s_id" value="{{ $subject->id }}">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="/css/selector.css">
    <style type="text/css">
    	.active {
    		background-color: green;
    	}
    </style>
@stop
    
@section('content')
	<div class="row">
	    <div class="col-sm-10 col-sm-offset-1">
	        <div id="tabs">
	            <ul>
	                <li><a href="#can-biet">Cần biết</a></li>
	                <li><a href="#web">Websites</a></li>
	                <li><a href="#nguoi">Người</a></li>
	                <li><a href="#sach">Sách</a></li>
	                <li><a href="#kinh-nghiem">Bình luận</a></li>
	            </ul>
	            <div id="can-biet">
	                <ul class="list-group">
	                    	<li class="list-group-item" v-for="subject in subjects.slice(0, startSubject)">
	                    		<h3>
		                    		<input type="checkbox" 
		                    				name="subject_select" 
		                    				id="subject_select" 
		                    				v-on:change="storeSubject(subject.id)" 
			                    			v-if="subject.studied"
			                    			checked
			                    	>
			                    	<input type="checkbox" 
		                    				name="subject_select" 
		                    				id="subject_select" 
		                    				v-on:change="storeSubject(subject.id)" 
			                    			v-if="!subject.studied"
			                    	>
	                    			<a href="/subjects/{{ $subject->id }}">@{{ subject.name }}</a>
	                    			<a class="btn btn-default glyphicon glyphicon-thumbs-up" v-on:click="subjectLike(subject.id, subject)"></a>
	                    		</h3>
	                    		<h4>@{{ subject.selected }} lần chọn, @{{ subject.likes }} likes</h4>
	                    		<h5>@{{ subject.totalSearch }} lần tìm kiếm</h5>
	                    	</li>
	                </ul>
	                <button type="submit" class="btn btn-success pull-left btn-select" v-on:click="startSubject += 5">Xem thêm</button>
	                <button type="submit" class="btn btn-success pull-right btn-select">Đóng góp</button>
	                <div class="clearfix"></div>
	            </div>
	            <div id="web">
	                <ul class="list-group">
	                    	<li class="list-group-item" v-for="website in websites.slice(0, startWebsite)">
	                    		<h3>
		                    		<input type="checkbox" 
		                    				name="website_select" 
		                    				id="website_select" 
		                    				v-on:change="storeWebsite(website.id)" 
			                    			v-if="website.studied"
			                    			checked
		                    		> 
		                    		<input type="checkbox" 
		                    				name="website_select" 
		                    				id="website_select" 
		                    				v-on:change="storeWebsite(website.id)" 
			                    			v-if="!website.studied"
		                    		> 
		                    		<a href="@{{ website.link }}">@{{ website.name }}</a> 
		                    		<a class="btn btn-default glyphicon glyphicon-thumbs-up" v-on:click="websiteLike(website.id, website)"></a>
	                    		</h3>
	                    		<h4>@{{ website.selected }} lần chọn, @{{ website.likes }} likes</h4>
	                    		<p>@{{ website.intro }}</p>
	                    	</li>
	                    	
	                </ul>
	                <button type="submit" class="btn btn-success pull-left btn-select" v-on:click="startWebsite += 5">Xem thêm</button>
	                <button type="submit" class="btn btn-success pull-right btn-select">Đóng góp</button>
	                <div class="clearfix"></div>
	            </div>
	            <div id="nguoi">
	                <ul class="list-group">
	                    	<li class="list-group-item" v-for="person in persons.slice(0, startPerson)">
		                    		<h3>
		                    			<input type="checkbox" 
		                    				name="person_select" 
		                    				id="person_select" 
		                    				v-on:change="storePerson(person.id)" 
			                    			v-if="person.studied"
			                    			checked
			                    	>
			                    	<input type="checkbox" 
		                    				name="person_select" 
		                    				id="person_select" 
		                    				v-on:change="storePerson(person.id)" 
			                    			v-if="!person.studied"
			                    	>
	                    			<a href="@{{ person.link }}">@{{ person.name }}</a>
	                    			<a class="btn btn-default glyphicon glyphicon-thumbs-up" v-on:click="personLike(person.id, person)"></a>
	                    		</h3>
	                    		<img src="@{{ person.avatar }}">
	                    		<h4>@{{ person.selected }} lần chọn, @{{ person.likes }} likes</h4>
	                    		<p>@{{ person.intro }}</p>
	                    	</li>
	                </ul>
	                <button type="submit" class="btn btn-success pull-left btn-select" v-on:click="startPerson += 5">Xem thêm</button>
	                <button type="submit" class="btn btn-success pull-right btn-select">Đóng góp</button>
	                <div class="clearfix"></div>
	            </div>
	            <div id="sach">
	                <ul class="list-group">
	                    	<li class="list-group-item" v-for="book in books.slice(0, startBook)">
	                    		<h3>
	                    			<input type="checkbox" 
	                    				name="book_select" 
	                    				id="book_select" 
	                    				v-on:change="storeBook(book.id)" 
		                    		 	v-if="book.studied"
		                    			checked
		                    		>
		                    		<input type="checkbox" 
		                    				name="book_select" 
		                    				id="book_select" 
		                    				v-on:change="storeBook(book.id)" 
			                    		 	v-if="!book.studied"
		                    		>
	                    			<a href=@{{ book.link }}>@{{ book.name }}</a>
	                    			<a class="btn btn-default glyphicon glyphicon-thumbs-up" v-on:click="bookLike(book.id, book)"></a>
	                    		</h3>
	                    		<img src="@{{ book.avatar }}">
	                    		<h4>@{{ book.selected }} lần chọn, @{{ book.likes }} likes</h4>
	                    		<h5>@{{ book.publisher }}</h5>
	                    		<p>@{{ book.intro }}</p>
	                    	</li>
	                </ul>
	                <button type="submit" class="btn btn-success pull-left btn-select" v-on:click="startBook += 5">Xem thêm</button>
	                <button type="submit" class="btn btn-success pull-right btn-select">Đóng góp</button>
	                <div class="clearfix"></div>
	            </div>
	            <div id="kinh-nghiem">
	                @include('subjects.disqus')
	            </div>
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
	    		id: 0,
	    		startSubject: 5,
	    		subjects: [],
	    		startBook: 5,
	    		books: [],
	    		startPerson: 5,
	    		persons: [],
	    		startWebsite: 5,
	    		websites: [],
	    	},
	    	ready: function() {
	    		var id = document.querySelector('#s_id').getAttribute('value');
	    		this.initialize(id);
	    	},
	    	methods: {

	    		initialize: function(id) {
	    			this.getSubjects(id);
		    		this.getBooks(id);
		    		this.getWebsites(id);
		    		this.getPersons(id);
	    		},

	    		subjectLike: function(id, subject) {
	    			subject.likes += 1;
	    			this.$http.post('/subjects/subjects/like', {id: id});
	    		},

	    		personLike: function(id, person) {
	    			person.likes += 1;
	    			this.$http.post('/subjects/persons/like', {id: id});
	    		},

	    		websiteLike: function(id, website) {
	    			website.likes += 1;
	    			this.$http.post('/subjects/websites/like', {id: id});
	    		},

	    		bookLike: function(id, book) {
	    			book.likes += 1;
	    			this.$http.post('/subjects/books/like', {id: id});
	    		},
	    	
	    		getSubjects: function(subjectId) {
	    			if (this.subjects.length > 0) return;
	    			this.$http.post('/subjects/subjects/more', {id: subjectId, start: this.startSubject}, function(subjects) {
	    				this.$set('subjects', subjects);
	    			});
	    		},
	    		getBooks: function(id) {
	    			if (this.books.length > 0) return;
	    			this.$http.post('/subjects/books/more', {id: id, start: this.startBook}, function(books) {
	    				this.$set('books', books);
	    			});
	    		},
	    		getWebsites: function(id) {
	    			if (this.websites.length > 0) return;
	    			this.$http.post('/subjects/websites/more', {id: id, start: this.startWebsite}, function(websites) {
	    				this.$set('websites', websites);
	    			});
	    		},
	    		getPersons: function(id) {
	    			if (this.persons.length > 0) return;
	    			this.$http.post('/subjects/persons/more', {id: id, start: this.startSubject}, function(persons) {
	    				this.$set('persons', persons);
	    			});
	    		},
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