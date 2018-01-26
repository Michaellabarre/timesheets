@extends('layouts.master')



@section('page_title')

    Jobs

@endsection

@section('content')

	<table class="table table-hover $id">
	<thead class="thead-default">
		<tr>
			{{-- <th>id</th> --}}
			<th>Job Code</th>
			<th>Name</th>
			<th>Client</th>
			<th>Active</th>
			<th class="actions">Actions</th>
			
		</tr>
	</thead>
	<tbody>
    @foreach($jobs as $job)
		<tr>
			<td>{{$job->code}}</td>
			<td>{{$job->name}}</td>
			<td><a href="{{ route('clients.show', $job->client->id ) }}">{{$job->client->name}}</a></td>
			<td>{{$job->active}}</td>
			<td class="actions">
    			<a class="btn btn-primary mr-1" href="{{ route( 'jobs.show', [$job->id] ) }}"><i class="fa fa-fw fa-eye"></i></a>
				<a class="btn btn-info mr-1" href="{{ route('jobs.edit', [$job->id]) }}"><i class="fa fa-fw fa-pencil"></i></a>

				<form action="{{ route( 'jobs.destroy', [$job->id] ) }}" method="POST" class="d-inline-block">
					{{ method_field('DELETE') }}

					{{ csrf_field() }}
					<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete  {{ $job->name }}?');" name="delete"><i class="fa fa-fw fa-trash-o"></i></button>
				</form>
			</td>
			
	</tr>
    @endforeach
	</tbody>
    </table>

@endsection
