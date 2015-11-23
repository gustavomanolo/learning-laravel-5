@extends('app')

	@section('content')
		<h1>Edit {{ $article->title }}</h1>


		{!! Form::model($article, ['method'=>'PATCH', 'action'=> ['ArticlesController@update', $article->id] ]) !!}

			@include('articles.form', ['submitButtonText'=>"Update Article"])

		{!! Form::close() !!}


		{{-- Display Errors
            *** A view always have access to an "errors" variable
        --}}

		@include('errors.list')

	@stop