@extends('app')

	
	@section('content')

		<h2>Hello, {{ $first }} {{$last}}</h2>
	

		@if ( count($people)>0 )
			<h3>People i like</h3>

			<ul>
				@foreach ($people as $person)
					<li> {{$person}} </li>
				@endforeach
			</ul>
		@endif

		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

	@stop
