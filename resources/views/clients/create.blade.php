@extends('layouts.master')



@section('page_title')

	Add new Client

@endsection

@section('content')

<form method="POST" action="{{ route('clients.store') }}">

	{{ csrf_field() }}

	<input type="hidden" name="prev_url" value="{{ URL::previous() }}">

	<div class="form-group">
		{!! Form::label('name', 'Client Name') !!}
		{!! Form::text('name', null, ['class' => 'form-control','placeholder' => 'Client Name', 'required']) !!}
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection