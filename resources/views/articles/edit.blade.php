@extends('app')

@section('content')
    @include('headers.header2')
    <div class="container">
    <h1>Edit: {!! $article->title !!}</h1>
    {!! Form::model($article,['method' => 'PATCH', 'action' => ['ArticlesController@update', $article->id]]) !!}
    @include('articles.form',['submitButtonText' => 'Edit']);
    {!! Form::close() !!}
    {!! Form::open([
        'method' => 'DELETE',
        'action' => ['ArticlesController@destroy',$article->id],
    ]) !!}

    <div class="form-group">
        {!! Form::submit('delete', ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}
    @include('errors.list')
    </div>
@stop