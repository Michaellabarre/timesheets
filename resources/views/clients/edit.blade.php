@extends('layouts.master')



@section('page_title')

	Edit Client <strong>{{ $client->name }}</strong>

@endsection

@section('content')

<form method="POST" action="{{ route('clients.update', [$client->id]) }}">
	{{ method_field('PATCH') }}

	{{ csrf_field() }}

	<div class="form-group">
		{!! Form::label('name', 'Client Name') !!}
		{!! Form::text('name', $client->name, ['class' => 'form-control','placeholder' => 'Client Name', 'required']) !!}
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection