@extends('articles.boostrap')

@section('content')
    <h2>Create new article</h2>
    {!! Form::open(['url'=>'articles']) !!}
    @include('articles.form',['submitButtonText'=>'Create']);
    {!! Form::close() !!}
@stop

{{--@include('errors.list');--}}