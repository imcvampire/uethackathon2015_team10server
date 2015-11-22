@extends('app')

@section('styles')
	
	<meta id="s_id" name="s_id" value="{{ $subject->id }}">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    
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
	                    			<a href="/subjects/{{ $subject->id }}">@{{ subject.name }}</a>
	                    			<a class="btn glyphicon glyphicon-thumbs-up @{{ subject.btnLike }}" v-on:click="subjectLike(subject)" >&nbsp;@{{ subject.likes }}</a>
	                    		@if (\Auth::user() != null)
	                    			<a class="btn @{{ subject.btnSelected }} 
	                    			glyphicon glyphicon-check" v-on:click="storeSubject(subject)"> @{{ subject.selected }}</a>
	                    		@endif
	                    		</h3>
	                    	</li>
	                </ul>
	                <button type="submit" class="btn btn-success pull-left btn-select" v-on:click="startSubject += 5">Xem thêm</button>
	                <a href="/articles/create" type="submit" class="btn btn-success pull-right btn-select">Đóng góp</a>
		  </div>
		  <div id="websites" class="tab-pane fade">
		    <ul class="list-group">
	                    	<li class="list-group-item" v-for="website in websites.slice(0, startWebsite)">
	                    		<h3>
		                    		<a href="@{{ website.link }}">@{{ website.name }}</a> 
		                    		<a class="btn glyphicon glyphicon-thumbs-up @{{ website.btnLike }}" v-on:click="websiteLike(website)" >&nbsp;@{{ website.likes }}</a>
		                    	@if (\Auth::user() != null)
	                    			<a class="btn @{{ website.btnSelected }} 
	                    			glyphicon glyphicon-check" v-on:click="storeWebsite(website)"> @{{ website.selected }}</a>
	                    		@endif
	                    		</h3>
	                    		<p>@{{ website.intro }}</p>
	                    	</li>
	                    	
	                </ul>
	                <button type="submit" class="btn btn-success pull-left btn-select" v-on:click="startWebsite += 5">Xem thêm</button>
	                <a href="/subjects/{{ $subject->id }}/add_website" type="submit" class="btn btn-success pull-right btn-select">Đóng góp</a>
		  </div>
		  <div id="persons" class="tab-pane fade">
		    <ul class="list-group">
	                    	<li class="list-group-item" v-for="person in persons.slice(0, startPerson)">
		                    		<h3>
	                    			<a href="@{{ person.link }}">@{{ person.name }}</a>
	                    			<a class="btn glyphicon glyphicon-thumbs-up @{{ person.btnLike }}" v-on:click="personLike(person)" >&nbsp;@{{ person.likes }}</a>
	                    		@if (\Auth::user() != null)
	                    			<a class="btn @{{ person.btnSelected }} 
	                    			glyphicon glyphicon-check" v-on:click="storePerson(person)"> @{{ person.selected }}</a>
	                    		@endif
	                    		</h3>
	                    		<img src="@{{ person.avatar }}">
	                    		<p>@{{ person.intro }}</p>
	                    	</li>
	                </ul>
	                <button type="submit" class="btn btn-success pull-left btn-select" v-on:click="startPerson += 5">Xem thêm</button>	                
	                <a href="/subjects/{{ $subject->id }}/add_person" type="submit" class="btn btn-success pull-right btn-select">Đóng góp</a>
		  </div>
		  <div id="books" class="tab-pane fade">
		  	<ul class="list-group">
	                    	<li class="list-group-item" v-for="book in books.slice(0, startBook)">
	                    		<h3>
	                    			<a href=@{{ book.link }}>@{{ book.name }}</a>
	                    			<a class="btn glyphicon glyphicon-thumbs-up @{{ book.btnLike }}" v-on:click="bookLike(book)" >&nbsp;@{{ book.likes }}</a>
	                    		@if (\Auth::user() != null)
	                    			<a class="btn @{{ book.btnSelected }} 
	                    			glyphicon glyphicon-check" v-on:click="storeBook(book)"> @{{ book.selected }}</a>
	                    		@endif
	                    		</h3>
	                    		<img src="@{{ book.avatar }}">
	                    		<h5>@{{ book.publisher }}</h5>
	                    		<p>@{{ book.intro }}</p>
	                    	</li>
	                </ul>
	                <button type="submit" class="btn btn-success pull-left btn-select" v-on:click="startBook += 5">Xem thêm</button>
	                <a href="/subjects/{{ $subject->id }}/add_book" type="submit" class="btn btn-success pull-right btn-select">Đóng góp</a>
		  </div>
		  <div id="comments" class="tab-pane fade">
		  	@include('subjects.disqus')
		  </div>
		</div>

		@if (\Auth::user() != null)
		<div style="position: fixed; top: 95%; left: 45%;"><a class="btn  btn-danger" href="/users/profile">Profile</a></div>
		@endif
		</div>

@stop

@section('scripts')

	<script rel="script" type="text/javascript" src="/js/jquery.min.js"></script>
	<script rel="script" type="text/javascript" src="/js/bootstrap.min.js"></script>
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
	    			if (!subject.likeChange) {
	    				subject.likes += 1;
	    				subject.btnLike = 'btn-success';
	    			}
	    			else {
	    				subject.likes -= 1;
	    				subject.btnLike = 'btn-default';
	    			}
	    			subject.likeChange = !subject.likeChange;
	    			this.$http.post('/subjects/subjects/like', {id: subject.id});
	    		},

	    		personLike: function(person) {
	    			if (!person.likeChange) {
	    				person.likes += 1;
	    				person.btnLike = 'btn-success';
	    			}
	    			else {
	    				person.likes -= 1;
	    				person.btnLike = 'btn-default';
	    			}
	    			person.likeChange = !person.likeChange;
	    			this.$http.post('/subjects/persons/like', {id: person.id});
	    		},

	    		websiteLike: function(website) {
	    			if (!website.likeChange) {
	    				website.likes += 1;
	    				website.btnLike = 'btn-success';
	    			}
	    			else {
	    				website.likes -= 1;
	    				website.btnLike = 'btn-default';
	    			}
	    			website.likeChange = !website.likeChange;
	    			this.$http.post('/subjects/websites/like', {id: website.id});
	    		},

	    		bookLike: function(book) {
	    			if (!book.likeChange) {
	    				book.likes += 1;
	    				book.btnLike = 'btn-success';
	    			}
	    			else {
	    				book.likes -= 1;
	    				book.btnLike = 'btn-default';
	    			}
	    			book.likeChange = !book.likeChange;
	    			this.$http.post('/subjects/books/like', {id: book.id});
	    		},
	    	
	    		getSubjects: function(subjectId) {
	    			if (this.subjects.length > 0) return;
	    			this.$http.post('/subjects/subjects/more', {id: subjectId, start: this.startSubject}, function(subjects) {
	    				for (var i = 0; i < subjects.length; ++i) {
	    					subjects[i].likeChange = false;
	    					subjects[i].btnLike = 'btn-default';
	    					subjects[i].btnSelected = 'btn-default';
	    					if (subjects[i].studied)
	    						subjects[i].btnSelected = 'btn-info';
	    				}
	    				this.$set('subjects', subjects);
	    			});
	    		},
	    		getBooks: function(id) {
	    			if (this.books.length > 0) return;
	    			this.$http.post('/subjects/books/more', {id: id, start: this.startBook}, function(books) {
	    				for (var i = 0; i < books.length; ++i) {
	    					books[i].likeChange = false;
	    					books[i].btnLike = 'btn-default';
	    					books[i].btnSelected = 'btn-default';
	    					if (books[i].studied)
	    						books[i].btnSelected = 'btn-info';
	    				}
	    				this.$set('books', books);
	    			});
	    		},
	    		getWebsites: function(id) {
	    			if (this.websites.length > 0) return;
	    			this.$http.post('/subjects/websites/more', {id: id, start: this.startWebsite}, function(websites) {
	    				for (var i = 0; i < websites.length; ++i) {
	    					websites[i].likeChange = false;
	    					websites[i].btnLike = 'btn-default';
	    					websites[i].btnSelected = 'btn-default';
	    					if (websites[i].studied)
	    						websites[i].btnSelected = 'btn-info';
	    				}
	    				this.$set('websites', websites);
	    			});
	    		},
	    		getPersons: function(id) {
	    			if (this.persons.length > 0) return;
	    			this.$http.post('/subjects/persons/more', {id: id, start: this.startSubject}, function(persons) {
	    				for (var i = 0; i < persons.length; ++i) {
	    					persons[i].likeChange = false;
	    					persons[i].btnLike = 'btn-default';
	    					persons[i].btnSelected = 'btn-default';
	    					if (persons[i].studied)
	    						persons[i].btnSelected = 'btn-info';
	    				}
	    				this.$set('persons', persons);
	    			});
	    		},
	    		storeWebsite: function(website) {
	    			if (website.studied) {
	    				website.selected -= 1;
	    				website.btnSelected = 'btn-default';
	    			}
	    			else {
	    				website.selected += 1;
	    				website.btnSelected = 'btn-info';
	    			}
	    			website.studied = !website.studied;
	    			this.$http.post('/subjects/websites', {id: website.id});
	    		},
	    		storeSubject: function(subject) {
	    			if (subject.studied) {
	    				subject.selected -= 1;
	    				subject.btnSelected = 'btn-default';
	    			}
	    			else {
	    				subject.selected += 1;
	    				subject.btnSelected = 'btn-info';
	    			}
	    			subject.studied = !subject.studied;
	    		},
	    		storePerson: function(person) {
	    			if (person.studied) {
	    				person.selected -= 1;
	    				person.btnSelected = 'btn-default';
	    			}
	    			else {
	    				person.selected += 1;
	    				person.btnSelected = 'btn-info';
	    			}
	    			person.studied = !person.studied;
	    			this.$http.post('/subjects/persons', {id: person.id});
	    		},
	    		storeBook: function(book) {
	    			if (book.studied) {
	    				book.selected -= 1;
	    				book.btnSelected = 'btn-default';
	    			}
	    			else {
	    				book.selected += 1;
	    				book.btnSelected = 'btn-info';
	    			}
	    			book.studied = !book.studied;
	    			this.$http.post('/subjects/books', {id: book.id});
	    		}
	    	}
	    });
	</script>
@stop