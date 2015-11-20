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
	                    <li class="ui-widget-content">1</li>
	                    <li class="ui-widget-content">2</li>
	                    <li class="ui-widget-content">3</li>
	                    <li class="ui-widget-content">4</li>
	                    <li class="ui-widget-content">5</li>
	                </ul>
	                <button type="submit" class="btn btn-success pull-left btn-select">Xem thêm</button>
	                <button type="submit" class="btn btn-success pull-right btn-select">Đóng góp</button>
	                <div class="clearfix"></div>
	            </div>
	            <div id="web">
	                <ul class="select-list">
	                	@foreach ($websites as $website)
	                    	<li>
	                    		<h4>{{ $website->name }}</h4>
	                    		<h3>{{ $website->selected }} selected, {{ $website->likes }} likes</h3>
	                    		<p>{{ link_to($website->link) }}</p>
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
	                    <li></li>
	                    <li></li>
	                    <li></li>
	                    <li></li>
	                    <li></li>
	                </ul>
	                <button type="submit" class="btn btn-success pull-left btn-select">Xem thêm</button>
	                <button type="submit" class="btn btn-success pull-right btn-select">Đóng góp</button>
	                <div class="clearfix"></div>
	            </div>
	            <div id="sach">
	                <ul class="select-list">
	                    <li></li>
	                    <li></li>
	                    <li></li>
	                    <li></li>
	                    <li></li>
	                </ul>
	                <button type="submit" class="btn btn-success pull-left btn-select">Xem thêm</button>
	                <button type="submit" class="btn btn-success pull-right btn-select">Đóng góp</button>
	                <div class="clearfix"></div>
	            </div>
	            <div id="kinh-nghiem">
	                <ul class="select-list">
	                    <li></li>
	                    <li></li>
	                    <li></li>
	                    <li></li>
	                    <li></li>
	                </ul>
	                <button type="submit" class="btn btn-success pull-left btn-select">Xem thêm</button>
	                <button type="submit" class="btn btn-success pull-right btn-select">Đóng góp</button>
	                <div class="clearfix"></div>
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
	<script rel="script" type="text/javascript" src="js/jquery.min.js"></script>
	<script rel="script" type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script rel="script" type="text/javascript" src="js/bootstrap.min.js"></script>
	<script rel="script" type="text/javascript" src="js/jquery.hc-sticky.min.js"></script>
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
	</script>
@stop