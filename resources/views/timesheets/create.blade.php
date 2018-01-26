@extends('layouts.master')



@section('page_title')

	Add new Timesheet

@endsection

@section('content')


<form method="POST" action="{{ route('timesheets.store') }}">

	{{ csrf_field() }}

	<div class="form-group">
		{!! Form::label('user_id', 'User') !!}
		
		@if( $user->inRole('administrator') )
			{!! Form::select('user_id', $users, null, ['class' => 'form-control select2','placeholder' => '--- select a user ---', 'required']) !!}	
		@else
			{!! Form::hidden('user_id', $user->id, ['class' => 'form-control disabled','placeholder' => '', 'required', 'readonly']) !!}	
			{!! Form::text('user', $user->name, ['class' => 'form-control disabled','placeholder' => '', 'required', 'readonly']) !!}	
		@endif

	</div>
	
	<table class="table table-hover $id" id="timesheets_tbl">
		<thead class="thead-default">
			<tr>
				<th class="">Date</th>
				<th class="">Job</th>
				<th class="w-50">Description</th>
				<th class="">Task Type</th>
				<th class="">Hours</th>
				<th class="">Actions</th>
			</tr>
		</thead>
		<tbody>
			<tr id="orig_form_row">
				<td>{!! Form::date('timesheet[date][]', \Carbon\Carbon::now(), ['class'=>'form-control']); !!}</td>
				<td>{!! Form::select('timesheet[job_id][]', $jobs, null, ['class' => 'form-control select2','placeholder' => '--- select a job ---', 'required']) !!}</td>
				<td>{!! Form::text('timesheet[description][]', null, ['class' => 'form-control','placeholder' => 'description', 'required']) !!}</td>
				<td>{!! Form::select('timesheet[tasktype_id][]', $tasktypes, null, ['class' => 'form-control','placeholder' => '--- select a task type ---', 'required']) !!}</td>
				<td>{!! Form::number('timesheet[hours][]', null, ['class' => 'form-control', 'required', 'step'=>'0.5']) !!}</td>
				<td class="text-center"><div class="btn btn-danger remove-row"><i class="fa fa-trash-o"></i></div></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="6">
					<a id="add_form_row" class="btn btn-light float-left">Add New Row</a>
				</td>
			</tr>
		</tfoot>
	</table>



	<input type="hidden" name="prev_url" value="{{ URL::previous() }}">	
	<button type="submit" class="btn btn-primary float-right">Submit</button>
</form>

@endsection

@section('footer_scripts')
	<script type="text/javascript">
		$('#add_form_row').on('click',function () {
			$('select.select2').select2('destroy');
			var clone = $('#orig_form_row').clone(false,false);
			clone.find("*").removeAttr("id");
			clone.find("input:not([type='date'])").val('');
			clone.appendTo('table#timesheets_tbl>tbody');
			$('select.select2').select2({theme: "bootstrap"});
		});
		$('#timesheets_tbl').on('click', '.remove-row', function () {
			$(this).parents('tr').remove();
		});
	</script>
@endsection