@extends('layouts.master')



@section('page_title')

	Edit Tasktype

@endsection

@section('content')

<form method="POST" action="{{ route('tasktypes.update', [$tasktype->id]) }}">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}

	<input type="hidden" name="prev_url" value="{{ URL::previous() }}">

	<div class="form-group">
		{!! Form::label('name', 'Tasktype Name') !!}
		{!! Form::text('name', $tasktype->name, ['class' => 'form-control','placeholder' => 'Tasktype Name', 'required']) !!}
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
