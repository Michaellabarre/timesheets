@extends('layouts.master')



@section('page_title')

    Timesheets

@endsection

@section('content')

	<table class="table $id table-hover mb-0">
				<thead class="thead-default">
					<tr>
						<th>User</th>
						<th>Date</th>
						<th>Job Code</th>
						<th>Task Type</th>
						<th>Description</th>
						<th>Hours</th>
						<th class="actions">Actions</th>
					</tr>
				</thead>
				<tbody>					
					@foreach($timesheets as $timesheet)
						<tr>
							<td>{{ $timesheet->user->name }}</td>
							<td>{{ $timesheet->date }}</td>
							<td><a href="{{ route('jobs.show', $timesheet->job->id) }}">{{ $timesheet->job->code }}</a></td>
							<td>{{ $timesheet->tasktype->name }}</td>
							<td>{{ $timesheet->description }}</td>
							<td>{{ $timesheet->hours }}</td>
							
								<td class="actions">
					    			{{-- <a class="btn btn-primary mr-1" href="{{ route( 'timesheets.show', [$job->id] ) }}"><i class="fa fa-fw fa-eye"></i></a> --}}
									<a class="btn btn-info mr-1" href="{{ route('timesheets.edit', [$timesheet->id]) }}"><i class="fa fa-fw fa-pencil"></i></a>

									<form action="{{ route( 'timesheets.destroy', [$timesheet->id] ) }}" method="POST" class="d-inline-block">
										{{ method_field('DELETE') }}

										{{ csrf_field() }}
										<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?');" name="delete"><i class="fa fa-fw fa-trash-o"></i></button>
									</form>
								</td>
								
							
						</tr>
					@endforeach
				</tbody>
			</table>
			{{ $timesheets->links() }}
@endsection