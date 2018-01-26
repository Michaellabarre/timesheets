@extends('layouts.master')



@section('page_title')

	Add new Contact

@endsection

@section('content')

<form method="POST" action="{{ route('contacts.store') }}">

	{{ csrf_field() }}

	<input type="hidden" name="prev_url" value="{{ URL::previous() }}">

	<div class="form-group">
		{!! Form::label('client_id', 'Client') !!}
		{!! Form::select('client_id', $clients, null, ['class' => 'form-control','placeholder' => '--- select a client ---', 'required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('name', 'Name') !!}
		{!! Form::text('name', null, ['class' => 'form-control','placeholder' => 'Name', 'required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('job_title', 'Job Title') !!}
		{!! Form::text('job_title', null, ['class' => 'form-control','placeholder' => 'Job Title', 'required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('email', 'Email') !!}
		{!! Form::text('email', null, ['class' => 'form-control','placeholder' => 'Email', 'required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('phone_number', 'Phone Number') !!}
		{!! Form::text('phone_number', null, ['class' => 'form-control','placeholder' => 'Phone Number', 'required']) !!}
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection

@section('sidebar')
	@include('jobs.sidebar')
@endsection