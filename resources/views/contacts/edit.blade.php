@extends('layouts.master')



@section('page_title')

	Edit Contact <strong>{{ $contact->name }}</strong>

@endsection

@section('content')

<form method="POST" action="{{ route('contacts.update', [$contact->id]) }}">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}

	<input type="hidden" name="prev_url" value="{{ URL::previous() }}">

	<div class="form-group">
		{!! Form::label('client_id', 'Client') !!}
		{!! Form::select('client_id', $clients, $contact->client_id, ['class' => 'form-control','placeholder' => '--- select a client ---', 'required', 'readolny']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('name', 'Name') !!}
		{!! Form::text('name', $contact->name, ['class' => 'form-control','placeholder' => 'Name', 'required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('job_title', 'Job Title') !!}
		{!! Form::text('job_title', $contact->job_title, ['class' => 'form-control','placeholder' => 'Job Title', 'required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('email', 'Email') !!}
		{!! Form::text('email', $contact->email, ['class' => 'form-control','placeholder' => 'Email', 'required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('phone_number', 'Phone Number') !!}
		{!! Form::text('phone_number', $contact->phone_number, ['class' => 'form-control','placeholder' => 'Phone Number', 'required']) !!}
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection

@section('sidebar')
	@include('clients.sidebar')
@endsection