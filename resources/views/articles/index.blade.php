@extends('app')

@section('content')
    @include('headers.header2')
    <div class="container">
    <h1>Articles</h1>

    <a href="articles/create" class="btn btn-info" role="button">Send new article</a>

    <hr/>
    <div>
    @foreach($articles as $article)
        <div class = "well well-sm">
            <article>
                <a href= {{ action('ArticlesController@show', [$article->id])}}><h3>{{$article->title}}</h3></a>
                <a href = "#"><h4>{{$article->user->name}}</h4></a>
            </article>
        </div>
    @endforeach
    </div>
    </div>
@stop