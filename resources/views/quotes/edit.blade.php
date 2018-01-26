@extends('layouts.master')



@section('page_title')

	Edit Quote for Job {{ $quote->job->code }}

@endsection

@section('content')

<form method="POST" action="{{ route('quotes.update', [$quote->id]) }}">
	{{ method_field('PATCH') }}

	{{ csrf_field() }}

	<input type="hidden" name="prev_url" value="{{ URL::previous() }}">

	<div class="form-group">
		{!! Form::label('job_id', 'Job Code') !!}
		<div class="well">{{ $quote->job->code }}</div>
		<p class="text-danger small">Job code cannot be edited</p>
	</div>

	<div class="form-group">
		<div class="row">
			<div class="col-sm-4">
				{!! Form::label('pm_hours', 'PM Hours') !!}
				{!! Form::number('pm_hours', $quote->pm_hours, ['class' => 'form-control','placeholder' => 'PM hours', 'required']) !!}
			</div>
			<div class="col-sm-4">
				{!! Form::label('dev_hours', 'Development Hours') !!}
				{!! Form::number('dev_hours', $quote->dev_hours, ['class' => 'form-control','placeholder' => 'Design Hours', 'required']) !!}
			</div>
			<div class="col-sm-4">
				{!! Form::label('design_hours', 'Design Hours') !!}
				{!! Form::number('design_hours', $quote->design_hours, ['class' => 'form-control','placeholder' => 'Design Hours', 'required']) !!}
			</div>
		</div>
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
