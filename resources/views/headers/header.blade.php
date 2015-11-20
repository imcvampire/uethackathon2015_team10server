
@if(\Auth::user())
	<div class="container">
		<img class="img-responsive">
	    <div class="btn-group pull-right">
	        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
	                aria-expanded="false">
	            <span id="member-name">{{ \Auth::user()->name }}</span>
	            <span class="caret"></span>
	        </button>
	        <ul class="dropdown-menu">
	            <li><a href="#">Profile</a></li>
	            <li><a href="#">Log out</a></li>
	        </ul>
	    </div>
	</div>
@endif