@extends('app')

@section('styles')
	<meta id="token" name="token" value="{{ csrf_token() }}">
	<meta id="s_id" name="s_id" value="{{ $subject->id }}">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <style type="text/css">
    	.active {
    		background-color: green;
    	}
    </style>
@stop
    
@section('content')
	@include('headers.header2')
	<div class="container" id="tabs">
		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#subjects">Môn tiên quyết</a></li>
		  <li><a data-toggle="tab" href="#websites">Websites</a></li>
		  <li><a data-toggle="tab" href="#persons">Chuyên gia</a></li>
		  <li><a data-toggle="tab" href="#books">Sách</a></li>
		  <li><a data-toggle="tab" href="#comments">Bình luận</a></li>
		</ul>
		<div class="tab-content">
		  <div id="subjects" class="tab-pane fade in active">
		    <ul class="list-group">
	                    <li class="list-group-item" v-for="subject in subjects.slice(0, startSubject)">
	                    		<h3>
		                    		<input type="checkbox" 
		                    				name="subject_select" 
		                    				id="subject_select" 
		                    				v-on:change="storeSubject(subject)" 
			                    			v-if="subject.studied"
			                    			checked
			                    	>
			                    	<input type="checkbox" 
		                    				name="subject_select" 
		                    				id="subject_select" 
		                    				v-on:change="storeSubject(subject)" 
			                    			v-if="!subject.studied"
			                    	>
	                    			<a href="/subjects/{{ $subject->id }}">@{{ subject.name }}</a>
	                    			<a class="btn btn-default glyphicon glyphicon-thumbs-up" v-on:click="subjectLike(subject)">&nbsp;@{{ subject.likes }}</a>
	                    			<a class="btn btn-default 
	                    			glyphicon glyphicon-check"> @{{ subject.selected }}</a>
	                    		</h3>
	                    	</li>
	                </ul>
	                <button type="submit" class="btn btn-success pull-left btn-select" v-on:click="startSubject += 5">Xem thêm</button>
	                <button type="submit" class="btn btn-success pull-right btn-select">Đóng góp</button>
	                <div class="clearfix"></div>
		  </div>
		  <div id="websites" class="tab-pane fade">
		    <ul class="list-group">
	                    	<li class="list-group-item" v-for="website in websites.slice(0, startWebsite)">
	                    		<h3>
		                    		<input type="checkbox" 
		                    				name="website_select" 
		                    				id="website_select" 
		                    				v-on:change="storeWebsite(website)" 
			                    			v-if="website.studied"
			                    			checked
		                    		> 
		                    		<input type="checkbox" 
		                    				name="website_select" 
		                    				id="website_select" 
		                    				v-on:change="storeWebsite(website)" 
			                    			v-if="!website.studied"
		                    		> 
		                    		<a href="@{{ website.link }}">@{{ website.name }}</a> 
		                    		<a class="btn btn-default glyphicon glyphicon-thumbs-up" v-on:click="websiteLike(website)">&nbsp;@{{ website.likes }}</a>
		                    		<a class="btn btn-default 
	                    			glyphicon glyphicon-check"> @{{ website.selected }}</a>
	                    		</h3>
	                    		<p>@{{ website.intro }}</p>
	                    	</li>
	                    	
	                </ul>
	                <button type="submit" class="btn btn-success pull-left btn-select" v-on:click="startWebsite += 5">Xem thêm</button>
	                <button type="submit" class="btn btn-success pull-right btn-select">Đóng góp</button>
	                <div class="clearfix"></div>
		  </div>
		  <div id="persons" class="tab-pane fade">
		    <ul class="list-group">
	                    	<li class="list-group-item" v-for="person in persons.slice(0, startPerson)">
		                    		<h3>
		                    			<input type="checkbox" 
		                    				name="person_select" 
		                    				id="person_select" 
		                    				v-on:change="storePerson(person)" 
			                    			v-if="person.studied"
			                    			checked
			                    	>
			                    	<input type="checkbox" 
		                    				name="person_select" 
		                    				id="person_select" 
		                    				v-on:change="storePerson(person)" 
			                    			v-if="!person.studied"
			                    	>
	                    			<a href="@{{ person.link }}">@{{ person.name }}</a>
	                    			<a class="btn btn-default glyphicon glyphicon-thumbs-up" v-on:click="personLike(person)">&nbsp;@{{ person.likes }}</a>
	                    			<a class="btn btn-default 
	                    			glyphicon glyphicon-check"> @{{ person.selected }}</a>
	                    		</h3>
	                    		<img src="@{{ person.avatar }}">
	                    		<p>@{{ person.intro }}</p>
	                    	</li>
	                </ul>
	                <button type="submit" class="btn btn-success pull-left btn-select" v-on:click="startPerson += 5">Xem thêm</button>
	                <button type="submit" class="btn btn-success pull-right btn-select">Đóng góp</button>
	                <div class="clearfix"></div>
		  </div>
		  <div id="books" class="tab-pane fade">
		  	<ul class="list-group">
	                    	<li class="list-group-item" v-for="book in books.slice(0, startBook)">
	                    		<h3>
	                    			<input type="checkbox" 
	                    				name="book_select" 
	                    				id="book_select" 
	                    				v-on:change="storeBook(book)" 
		                    		 	v-if="book.studied"
		                    			checked
		                    		>
		                    		<input type="checkbox" 
		                    				name="book_select" 
		                    				id="book_select" 
		                    				v-on:change="storeBook(book)" 
			                    		 	v-if="!book.studied"
		                    		>
	                    			<a href=@{{ book.link }}>@{{ book.name }}</a>
	                    			<a class="btn btn-default glyphicon glyphicon-thumbs-up" v-on:click="bookLike(book)">&nbsp;@{{ book.likes }}</a>
	                    			<a class="btn btn-default 
	                    			glyphicon glyphicon-check"> @{{ book.selected }}</a>
	                    		</h3>
	                    		<img src="@{{ book.avatar }}">
	                    		<h5>@{{ book.publisher }}</h5>
	                    		<p>@{{ book.intro }}</p>
	                    	</li>
	                </ul>
	                <button type="submit" class="btn btn-success pull-left btn-select" v-on:click="startBook += 5">Xem thêm</button>
	                <button type="submit" class="btn btn-success pull-right btn-select">Đóng góp</button>
	                <div class="clearfix"></div>
		  </div>
		  <div id="comments" class="tab-pane fade">
		  	@include('subjects.disqus')
		  </div>
		</div>
		</div>

	
@stop

@section('scripts')
	<script rel="script" type="text/javascript" src="/js/jquery.min.js"></script>
	<script rel="script" type="text/javascript" src="/js/bootstrap.min.js"></script>
	<script src="/js/vue.min.js"></script>
	<script src="/js/vue-resource.min.js"></script>
	<script>
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

	    		subjectLike: function(subject) {
	    			subject.likes += 1;
	    			this.$http.post('/subjects/subjects/like', {id: subject.id});
	    		},

	    		personLike: function(person) {
	    			person.likes += 1;
	    			this.$http.post('/subjects/persons/like', {id: person.id});
	    		},

	    		websiteLike: function(website) {
	    			website.likes += 1;
	    			this.$http.post('/subjects/websites/like', {id: website.id});
	    		},

	    		bookLike: function(book) {
	    			book.likes += 1;
	    			this.$http.post('/subjects/books/like', {id: book.id});
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
	    		storeWebsite: function(website) {
	    			website.selected += 1;
	    			this.$http.post('/subjects/websites', {id: website.id});

	    		},
	    		storeSubject: function(subject) {
	    			subject.selected += 1;
	    			this.$http.post('/subjects/subjects', {id: subject.id});
	    		},
	    		storePerson: function(person) {
	    			person.selected += 1;
	    			this.$http.post('/subjects/persons', {id: person.id});
	    		},
	    		storeBook: function(book) {
	    			book.selected += 1;
	    			this.$http.post('/subjects/books', {id: book.id});
	    		}
	    	}
	    });
	</script>
@stop