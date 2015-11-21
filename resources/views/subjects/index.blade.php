@extends('app')

@section('content')
    <div class="container">
    	<form>
            <div class="form-group">
    	       <input type="search" id="search" class="form-control" placeholder="Search" v-model='query' v-on:keyup="search" class="form-control">
            </div>
    	</form>

        <ul class="list-group">
        	<li class="list-group-item" v-for="subject in subjects | orderBy 'totalSearch' -1">
        		<h4><a href="/subjects/@{{ subject.id }}">@{{ subject.name }}</a></h4>
        		<h3>@{{ subject.totalSearch }}</h3>
        	</li>
        </ul>
    </div>
@stop

@section('scripts')
	<script src="/js/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/vue.min.js"></script>
	<script src="/js/algoliasearch.min.js"></script>
	<script>
        
		new Vue({
            el: 'body',
            data: { query: '', subjects: [] },
            ready: function() {
                this.client = algoliasearch("Z3FQB6D6HE", "1a935447a04085b30e10986d9eca2453");
                this.index = this.client.initIndex('subjects');
            },
            methods: {
                search: function() {
                    this.index.search(this.query, function(error, results) {
                        this.subjects = results.hits;
                    }.bind(this));
                }
            }
        });
	</script>
@stop

