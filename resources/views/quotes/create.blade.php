@extends('layouts.master')



@section('page_title')

	Add new Quote

@endsection

@section('content')

<form method="POST" action="{{ route('quotes.store') }}">

	{{ csrf_field() }}

	<input type="hidden" name="prev_url" value="{{ URL::previous() }}">

	<div class="form-group">
		{!! Form::label('job_id', 'Job Code') !!}
		{!! Form::select('job_id', $jobs, null, ['class' => 'form-control select2','placeholder' => '--- select a job ---', 'required']) !!}
	</div>

	<div class="form-group">
		<div class="row">
			<div class="col-sm-4">
				{!! Form::label('pm_hours', 'PM Hours') !!}
				{!! Form::number('pm_hours', null, ['class' => 'form-control','placeholder' => 'PM hours', 'required']) !!}
			</div>
			<div class="col-sm-4">
				{!! Form::label('dev_hours', 'Development Hours') !!}
				{!! Form::number('dev_hours', null, ['class' => 'form-control','placeholder' => 'Design Hours', 'required']) !!}
			</div>
			<div class="col-sm-4">
				{!! Form::label('design_hours', 'Design Hours') !!}
				{!! Form::number('design_hours', null, ['class' => 'form-control','placeholder' => 'Design Hours', 'required']) !!}
			</div>
		</div>
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
