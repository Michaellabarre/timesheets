@extends('layouts.master')



@section('page_title')

	Add new Job

@endsection

@section('content')

<form method="POST" action="{{ route('jobs.store') }}">

	{{ csrf_field() }}

	<input type="hidden" name="prev_url" value="{{ URL::previous() }}">

	<div class="form-group">
		{!! Form::label('client_id', 'Client') !!}
		{!! Form::select('client_id', $clients, null, ['class' => 'form-control','placeholder' => '--- select a client ---', 'required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('code', 'Job Code') !!}
		{!! Form::text('code', null, ['class' => 'form-control','placeholder' => 'Job Code', 'required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('name', 'Job Name') !!}
		{!! Form::text('name', null, ['class' => 'form-control','placeholder' => 'Job Name', 'required']) !!}
	</div>

	<div class="form-check">
		<label class="form-check-label">
			{!! Form::checkbox('active', '1', false, ['class' => 'form-check-input']); !!}
			Job Active?
		</label>
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
