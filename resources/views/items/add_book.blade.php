@extends('app')

@section('content')
    @include('headers.header2')
    <div class="container">
        {!! Form::open(['method' => 'POST' ,'action' => ['SubjectsController@save_book', $id]]) !!}

        <div class="form-group">
            {!! Form::label('name','Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('author','Author:') !!}
            {!! Form::text('author', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('publisher','Publisher:') !!}
            {!! Form::text('publisher', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('intro','Introduce:') !!}
            {!! Form::textarea('intro', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
@stop
