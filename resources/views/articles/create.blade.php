@extends('app')

@section('content')
	@include('headers.header2')
	<div class="container">
    <h2>Create new article</h2>
    {!! Form::open(['url'=>'articles']) !!}
    @include('articles.form',['submitButtonText'=>'Create']);
    {!! Form::close() !!}
    </div>
@stop

@include('errors.list')