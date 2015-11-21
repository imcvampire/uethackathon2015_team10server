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
	            <img class="col-sm-3 img-responsive img-thumbnail">

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
	                @if ($subjects->where('finish', 1)->count() == 0)
	                	<h3>Bạn chưa hoàn thành môn học nào</h3>
	                @else
		                @foreach ($subjects->where('finish', 1)->get() as $subject)
		                	<h3><a href="/subjects/{{ $subject->id }}">{{ $subject->name }}</a></h3>
		                	<ul class="list-group">
		                		<li class="list-group-item">
		                			<h4>Sách đã chọn </h4>
		                			<ul class="list-group">
		                				@foreach ($books->where('finish', 1)->get() as $book)
		                					@if ($book->subject == $subject)
		                						<li class="list-group-item">{{ $book->name }}</li>
		                					@endif
		                				@endforeach
		                			</ul>
		                		</li>
		                		<li class="list-group-item">
		                			<h4>Website đã chọn</h4>
		                			<ul class="list-group">
		                				@foreach($websites->where('finish', 1)->get() as $website)
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
	                @if ($subjects->where('finish', 0)->count() == 0)
	                	{{ var_dump($user->studied_subjects()->where('finish', 0)->count()) }}
	                	{{ var_dump($subjects->where('finish', 0)->count()) }}
	                	<h3>Bạn không đang môn học nào</h3>
	                	}
	                @else
		                @foreach ($subjects->where('finish', 0)->get() as $subject)
		                	<h3><a href="/subjects/{{ $subject->id }}">{{ $subject->name }}</a></h3>
		                	<ul class="list-group">
		                		<li class="list-group-item">
		                			<h4>Sách đã chọn </h4>
		                			<ul class="list-group">
		                				@foreach ($books->where('finish', 1)->get() as $book)
		                					@if ($book->subject == $subject)
		                						<input type="checkbox" name="book_select" id="book_select" checked>
		                						<li class="list-group-item">{{ $book->name }}</li>
		                					@endif
		                				@endforeach
		                				@foreach ($book->where('finish', 0)->get() as $book)
		                						<input type="checkbox" name="book_select" id="book_select">
		                						<li class="list-group-item">{{ $book->name }}</li>
		                				@endforeach
		                			</ul>
		                		</li>
		                		<li class="list-group-item">
		                			<h4>Website đã chọn</h4>
		                			<ul class="list-group">
		                				@foreach ($websites->where('finish', 1)->get() as $website)
		                					@if ($website->subject == $subject)
		                						<input type="checkbox" name="website_select" id="website_select" checked>
		                						<li class="list-group-item"><a href="{{ $website->link }}"{{ $website->name }}</a></li>
		                					@endif
		                				@endforeach
		                				@foreach ($website->where('finish', 0)->get() as $website)
		                						<input type="checkbox" name="website_select" id="website_select">
		                						<li class="list-group-item"><a href="{{ $website->link }}"{{ $website->name }}</a></li>
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
	                 	<tbody>
		                    <tr>
		                        <td>tích phân</td>
		                    </tr>
		                    <tr>
		                        <td>đạo hàm</td>
		                    </tr>
	                    </tbody>
	                </table>
	            </div> <!-- .table-responsive -->
	        </div> <!-- #subject -->
	    </div> <!-- .row -->
	</div> <!-- container -->
@stop

@section('scripts')
	<script rel="script" src="/js/jquery.min.js"></script>
	<script rel="script" src="/js/bootstrap.min.js"></script>
@stop