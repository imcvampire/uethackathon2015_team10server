@extends('app')

@section('styles')
	<link rel="stylesheet" type="text/css" href="/css/profile.css">
	<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
	<style>
		h3 {
			text-align: center; 
			color: red;
		}
	</style>
	<meta id="token" name="token" value="{{ csrf_token() }}">
	
	<meta id="user_id" name="user_id" value="{{ $user->id }}">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.vertical-tabs.min.css">
@stop

@section('content')
	@include('headers.header2')
	<div class="container">
	    <div class="row">

	        <div id="info" class="col-xs-12 col-md-5">
	            <img class="col-xs-4 col-xs-offset-4 img-responsive img-thumbnail" src="http://www.gravatar.com/avatar/{{ md5(strtolower(trim($user->email))) }}" style="width: 200px">

	            <div class="col-xs-4 col-xs-offset-4">
	                <p><b>Tên</b>: {{ $user->name }}</p>

	                <p><b>Email</b>: {{ $user->email }}</p>

	                <p><b>Điểm số</b>: {{ $user->score }}</p>

	            </div> <!-- .col-sm-9 -->
	        </div> <!--  #info -->


    
	<div class="col-xs-12 col-md-7" id="tabs">
		<ul class="nav nav-tabs">
		  <li><a data-toggle="tab" href="#unfinished">Đang học</a></li>
		  <li><a data-toggle="tab" href="#finished">Đã hoàn thành</a></li>
		  <li><a data-toggle="tab" href="#contribute">Đóng góp</a></li>
		</ul>
		<div class="tab-content">
		  <div id="unfinished" class="tab-pane fade in active">
			<h3>Sách</h3>
		    <ul class="list-group" v-for="book in books">
				<li class="list-group-item">
					<a class="btn @{{ book.btnSelected }} 
	                    			glyphicon glyphicon-check" v-on:click="finishBook(book)"></a>
					@{{ book.name }} (@{{ book.subject.name }})
				</li>
		    </ul>
			<h3>Websites</h3>
		    <ul class="list-group" v-for="website in websites">
				<li class="list-group-item">
					<a class="btn @{{ website.btnSelected }} 
	                    			glyphicon glyphicon-check" v-on:click="finishWebsite(website)"></a>
					@{{ website.name }} (@{{ website.subject.name }})
				</li>
		    </ul>
		    	
		  </div>
		  <div id="finished" class="tab-pane fade">

		        <ul class="list-group">
		        <h3>Sách</h3>
		   		@foreach($user->studied_books()->where('finish', 1)->get() as $book)
		            <li class="list-group-item">{{ $book->name }} ({{ $book->subject->name }})</li>
		        @endforeach
		        </ul>

		        <ul class="list-group">
		        <h3>Websites</h3>
		   		@foreach($user->studied_websites()->where('finish', 1)->get() as $website)
		            <li class="list-group-item">{{ $website->name }} ({{ $website->subject->name }})</li>
		        @endforeach
		        </ul>	

		        <ul class="list-group">
		        <h3>Chuyên gia</h3>
		   		@foreach($user->studied_persons as $person)
		            <li class="list-group-item">{{ $person->name }} ({{ $person->subject->name }})</li>
		        @endforeach
		        </ul>	
		  </div>
		  <div id="contribute" class="tab-pane fade">
		  		<div class="col-xs-3"> <!-- required for floating -->
			    <!-- Nav tabs -->
			    <ul class="nav nav-tabs tabs-left">
			      <li class="active"><a href="#subjects" data-toggle="tab">Môn học</a></li>
			      <li><a href="#books" data-toggle="tab">Sách</a></li>
			      <li><a href="#websites" data-toggle="tab">Websites</a></li>
			      <li><a href="#persons" data-toggle="tab">Chuyên gia</a></li>
			    </ul>
			</div>

			<div class="col-xs-9">
			    <!-- Tab panes -->
			    <div class="tab-content">
			      <div class="tab-pane active" id="subjects">
			      <ul class="list-group">
                    	<h3>Môn học</h3>
                    	@foreach ($user->created_subjects as $subject)
                    		<li class="list-group-item"><a href="/subjects/{{ $subject->name }}"></a>{{ $subject->name }}</a></li>
                    	@endforeach
                    </ul></div>
			      <div class="tab-pane" id="books">
			      	<ul class="list-group">
                    	<h3>Sách</h3>
                    	@foreach ($user->created_books as $book)
                    		<li class="list-group-item">{{ $book->name }}</li>
                    	@endforeach
                    </ul>
			      </div>
			      <div class="tab-pane" id="websites">
			      	<ul class="list-group">
                    	<h3>Websites</h3>
                    	@foreach ($user->created_websites as $website)
                    		<li class="list-group-item"><a href="{{ $website->link }}">{{ $website->name }}</a></li>
                    	@endforeach
                    </ul>
			      </div>
			      <div class="tab-pane" id="persons">
			      	<ul class="list-group">
                    	<h3>Chuyên gia</h3>
                    	@foreach ($user->created_persons as $person)
                    		<li class="list-group-item"><a href="{{ $person->link }}">{{ $person->name }}</a></li>
                    	@endforeach
                    </ul>
			      </div>
			    </div>
			</div>  
		  </div>
		</div>
		</div>

	
@stop

@section('scripts')
	<script rel="script" src="/js/jquery.min.js"></script>
	<script rel="script" src="/js/bootstrap.min.js"></script>
	<script>
		Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
		new Vue({
			el: '#tabs',
			data: {
				books: [], websites: [],
				id: 0
			},
			ready: function() {
				id = document.querySelector('#user_id').getAttribute('value');
				this.initialize();
			},
			methods: {
				initialize: function() {
					this.getBooks();
					this.getWebsites();
				},
				getBooks: function() {
					this.$http.post('/users/books', function(books) {
						for (var i = 0; i < books.length; ++i)
							books[i].btnSelected = 'btn-default';
						this.$set('books', books);
					});
				},
				getWebsites: function() {
					this.$http.post('/users/websites', {id: id}, function(websites) {
						for (var i = 0; i < websites.length; ++i)
							websites[i].btnSelected = 'btn-default';
						this.$set('websites', websites);
					});
				},
				finishBook: function(book) {
					book.finish = !book.finish;
					if (book.finish) book.btnSelected = 'btn-warning';
					else book.btnSelected = 'btn-default';
					this.$http.post('/users/books/remove', {id: book.id});
				},
				finishWebsite: function(website) {
					website.finish = !website.finish;
					if (website.finish) website.btnSelected = 'btn-warning';
					else website.btnSelected = 'btn-default';
					this.$http.post('/users/websites/remove', {id: website.id});
				},

			}
		});
	</script>
@stop