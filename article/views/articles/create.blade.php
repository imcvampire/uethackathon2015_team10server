@extends('app')

@section('content')
	@include('headers.header2')
    <h2>Create new article</h2>
    {!! Form::open(['url'=>'articles']) !!}
    @include('articles.form',['submitButtonText'=>'Create']);
    {!! Form::close() !!}
@stop

{{--@include('errors.list');--}}