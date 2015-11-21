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
	<meta id="s_id" name="s_id" value="subject_id">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.vertical-tabs.min.css">
@stop

@section('content')
	@include('headers.header2')
	<div class="container">
	    <div class="row">

	        <div class="row" id="info">
	            <img class="col-xs-4 col-xs-offset-4 img-responsive img-thumbnail" src="http://www.gravatar.com/avatar/{{ md5(strtolower(trim($user->email))) }}" style="width: 200px">

	            <div class="col-xs-4 col-xs-offset-4">
	                <p><b>Tên</b>: {{ $user->name }}</p>

	                <p><b>Email</b>: {{ $user->email }}</p>

	                <p><b>Điểm số</b>: {{ $user->score }}</p>

	            </div> <!-- .col-sm-9 -->
	        </div> <!-- .row #info -->


    
	<div class="container" id="tabs">
		<ul class="nav nav-tabs">
		  <li><a data-toggle="tab" href="#unfinished">Đang học</a></li>
		  <li><a data-toggle="tab" href="#finished">Đã hoàn thành</a></li>
		  <li><a data-toggle="tab" href="#contribute">Đóng góp</a></li>
		  <li><a data-toggle="tab" href="#wall">Lời nhắn</a></li>
		</ul>
		<div class="tab-content">
		  <div id="unfinished" class="tab-pane fade in active">
		    <ul class="list-group">
	                    @if ($subjects0->count() == 0)
	                	<h3>Bạn không đang học môn học nào</h3>
	                @else
		                @foreach ($subjects0 as $subject)
		                	<h3><a href="/subjects/">{{ $subject->name }}</a></h3>
		                	<div class="row">
		                	<ul class="list-group">
		                		<li class="list-group-item col-xs-4">
		                			<h4>Sách đã chọn </h4>
		                			<ul class="list-group">
		                				@foreach ($books as $book)
		                					@if ($book->subject == $subject)
		                						<li class="list-group-item">{{ $book->name }}</li>
		                					@endif
		                				@endforeach
		                			</ul>
		                		</li>
		                		<li class="list-group-item col-xs-4">
		                			<h4>Website đã chọn</h4>
		                			<ul class="list-group">
		                				@foreach ($websites as $website)
		                					@if ($website->subject == $subject)
		                						<li class="list-group-item"><a href="{{ $website->link }}"{{ $website->name }}</a></li>
		                					@endif
		                				@endforeach
		                			</ul>
		                		</li>
		                		<li class="list-group-item col-xs-4">
		                			<h4>Người đã chọn</h4>
		                			<ul class="list-group">
		                				@foreach($persons as $person)
		                					@if ($person->subject == $subject)
		                						<li class="list-group-item">
		                							<a href="{{ $person->link }}">{{ $person->name }}</a>
		                						</li>
		                					@endif
		                				@endforeach
		                			</ul>
		                		</li>
		                	</ul>
		                	</div>
		                @endforeach	
	                @endif
		  </div>
		  <div id="finished" class="tab-pane fade">
		     @if ($subjects1->count() == 0)
	                	<h3>Bạn chưa hoàn thành môn học nào</h3>
	                @else
		                @foreach ($subjects1 as $subject)
		                	<h3><a href="/subjects/"></a></h3>
		                	<ul class="list-group">
		                		<li class="list-group-item">
		                			<h4>Sách đã chọn </h4>
		                			<ul class="list-group">
		                				@foreach ($books as $book)
		                					@if ($book->subject == $subject)
		                						<li class="list-group-item">{{ $book->name }}</li>
		                					@endif
		                				@endforeach
		                			</ul>
		                		</li>
		                		<li class="list-group-item">
		                			<h4>Website đã chọn</h4>
		                			<ul class="list-group">
		                				@foreach($websites as $website)
		                					@if ($website->subject == $subject)
		                						<li class="list-group-item"><a href="{{ $website->link }}"{{ $website->name }}</a></li>
		                					@endif 
		                				@endforeach
		                			</ul>
		                		</li>
		                		<li class="list-group-item">
		                			<h4>Người đã chọn</h4>
		                			<ul class="list-group">
		                				@foreach($persons as $person)
		                					@if ($person->subject == $subject)
		                						<li class="list-group-item">
		                							<a href="{{ $person->link }}">{{ $person->name }}</a>
		                						</li>
		                					@endif
		                				@endforeach
		                			</ul>
		                		</li>
		                	</ul>
		                @endforeach	
	                @endif
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
		  
		  <div id="wall" class="tab-pane fade">
		  	@include('subjects.disqus')
		  </div>
		</div>
		</div>

	
@stop

@section('scripts')
	<script rel="script" src="/js/jquery.min.js"></script>
	<script rel="script" src="/js/bootstrap.min.js"></script>
@stop