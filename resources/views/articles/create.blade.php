@extends('app')

@section('content')
	
	<h1>Write a new article</h1>
	<hr />
	
	{!! Form::open(['url'=>'/articles']) !!}
		<div class="form-group">
			{!! Form::label('title', "Title: ") !!}
			{!! Form::text('title', null, ['class'=>'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('body', "Body: ") !!}
			{!! Form::textarea('body', null, ['class'=>'form-control']) !!}
		</div>

		{!! Form::submit('Add article', ['class'=>'btn btn-primary form-control']) !!}

	{!! Form::close() !!}

@stop