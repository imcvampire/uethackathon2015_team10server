@extends('app')

@section('styles')
	<link rel="stylesheet" type="text/css" href="/css/profile.css">
	<style>
		h3 {
			text-align: center; 
			color: red;
		}
	</style>
@stop

@section('content')
	<div class="container">
	    <div class="row">
	        <span class="col-xs-12 text-center text-info text-capitalize">{{ $user->name }}</span>

	        <div class="row" id="info">
	            <img class="col-sm-3 img-responsive img-thumbnail" src="http://www.gravatar.com/avatar/{{ md5(strtolower(trim($user->email))) }}">

	            <div class="col-sm-9">
	                <p>Tên: {{ $user->name }}</p>

	                <p>Email: {{ $user->email }}</p>

	                <p>Điểm số: {{ $user->score }}</p>

	            </div> <!-- .col-sm-9 -->
	        </div> <!-- .row #info -->
	        <div id="subject">
	            <div class="table-responsive">
	                <table class="table table-hover table-bordered">
	                    <thead>
		                    <tr>
		                        <td><b>Môn học đã hoàn thành</b></td>
		                    </tr>
	                    </thead>
	                </table>
	                @if ($subjects1->count() == 0)
	                	<h3>Bạn chưa hoàn thành môn học nào</h3>
	                @else
		                @foreach ($subjects1 as $subject)
		                	<h3><a href="/subjects/{{ $subject->id }}">{{ $subject->name }}</a></h3>
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
	            </div> <!-- .table-responsive -->
	            <div class="table-responsive">
	                <table class="table table-hover table-bordered">
	                    <thead>
	                    <tr>
	                        <td><b>Môn học đang học</b></td>
	                    </tr>
	                    </thead>
	                </table>
	                @if ($subjects0->count() == 0)
	                	<h3>Bạn không đang học môn học nào</h3>
	                @else
		                @foreach ($subjects0 as $subject)
		                	<h3><a href="/subjects/{{ $subject->id }}">{{ $subject->name }}</a></h3>
		                	<ul class="list-group">
		                		<li class="list-group-item">
		                			<h4>Sách đã chọn </h4>
		                			<ul class="list-group">
		                				@foreach ($books as $book)
		                					@if ($book->subject == $subject)
		                						<input type="checkbox" name="book_select" id="book_select">
		                						<li class="list-group-item">{{ $book->name }}</li>
		                					@endif
		                				@endforeach
		                				@foreach ($books as $book)
		                						<input type="checkbox" name="book_select" id="book_select">
		                						<li class="list-group-item">{{ $book->name }}</li>
		                				@endforeach
		                			</ul>
		                		</li>
		                		<li class="list-group-item">
		                			<h4>Website đã chọn</h4>
		                			<ul class="list-group">
		                				@foreach ($websites as $website)
		                					@if ($website->subject == $subject)
		                						<input type="checkbox" name="website_select" id="website_select" >
		                						<li class="list-group-item"><a href="{{ $website->link }}"{{ $website->name }}</a></li>
		                					@endif
		                				@endforeach
		                				@foreach ($websites as $website)
		                						<input type="checkbox" name="website_select" id="website_select">
		                						<li class="list-group-item"><a href="{{ $website->link }}">{{ $website->name }}</a></li>
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
	            </div> <!-- .table-responsive -->
	            <div class="table-responsive">
	                <table class="table table-hover table-bordered">
	                    <thead>
		                    <tr>
		                        <td>Đóng góp</td>
		                    </tr>
	                    </thead>
	                </table>

             		<ul class="list-group">
                    	<h3>Môn học</h3>
                    	@foreach ($user->created_subjects as $subject)
                    		<li class="list-group-item"><a href="/subjects/{{ $subject->id }}"></a>{{ $subject->name }}</a></li>
                    	@endforeach
                    </ul>

                    <ul class="list-group">
                    	<h3>Sách</h3>
                    	@foreach ($user->created_books as $book)
                    		<li class="list-group-item">{{ $book->name }}</li>
                    	@endforeach
                    </ul>

                    <ul class="list-group">
                    	<h3>Websites</h3>
                    	@foreach ($user->created_websites as $website)
                    		<li class="list-group-item"><a href="{{ $website->link }}">{{ $website->name }}</a></li>
                    	@endforeach
                    </ul>

                    <ul class="list-group">
                    	<h3>Chuyên gia</h3>
                    	@foreach ($user->created_persons as $person)
                    		<li class="list-group-item"><a href="{{ $person->link }}">{{ $person->name }}</a></li>
                    	@endforeach
                    </ul>
	            </div> <!-- .table-responsive -->
	        </div> <!-- #subject -->
	    </div> <!-- .row -->
	</div> <!-- container -->
@stop

@section('scripts')
	<script rel="script" src="/js/jquery.min.js"></script>
	<script rel="script" src="/js/bootstrap.min.js"></script>
@stop