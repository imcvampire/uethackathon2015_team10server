@extends('app')

@section('content')
    @include('headers.header2')
    <div class="jumbotron">
        <h2>Title: {{$article ->title}}</h2>
        <article>
            <h4>{{$article->body}}</h4>
        </article>

        {{-- neu la tac gia thi can co edit o phia ben duoi--}}
        @if(\Auth::user() == $article->user)
            <a href= {{ action('ArticlesController@edit', [$article->id])}} class = "btn btn-info" role="button">Edit</a>

            {!! Form::open(['method' => 'DELETE', 'style' => 'display: inline' , 'class' => 'form-inline', 'action' => ['ArticlesController@destroy', $article->id]]) !!}
            <div class="form-group">
                {!! Form::submit('Delete', ['class' => 'btn btn-danger form-control']) !!}
            </div>
            {!! Form::close() !!}
        @endif
    </div>

    <hr/>
    <h2>Comment: </h2>
    @if($article->comments != null)
         @foreach($article->comments()->latest()->get() as $comment)
             <div class = "well well-sm">
                <h5><b>Nguoi tra loi:</b> {{$comment->user->name}}</h5>
                <h5><b>Noi dung:</b> {{$comment->content}}</h5>
            </div>
             <hr/>
        @endforeach
    @endif

    {!! Form::open(['method' => 'POST', 'action' => ['ArticlesController@saveComment', $article->id]]) !!}
    <div class="form-group">
        {!! Form::label('content','Your comment here:') !!}
        {!! Form::textarea('content', null, ['class' => 'form-control', 'rows'=>'3']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit("Comment", ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}
@stop