@extends('layouts.master')



@section('page_title')

	Add new Tasktype

@endsection

@section('content')

<form method="POST" action="{{ route('tasktypes.store') }}">

	{{ csrf_field() }}

	<input type="hidden" name="prev_url" value="{{ URL::previous() }}">

	<div class="form-group">
		{!! Form::label('name', 'Tasktype Name') !!}
		{!! Form::text('name', null, ['class' => 'form-control','placeholder' => 'Tasktype Name', 'required']) !!}
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
