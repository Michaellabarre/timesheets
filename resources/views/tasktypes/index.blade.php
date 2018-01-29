@extends('layouts.master')



@section('page_title')

    Task Types

@endsection

@section('content')

	<table class="table table-hover">
	<thead class="thead-default">
		<tr>
			{{-- <th>id</th> --}}
			<th>Name</th>
			<th class="actions">Actions</th>			
		</tr>
	</thead>
	<tbody>
    @foreach($tasktypes as $tasktype)
		<tr>
			<td>{{$tasktype->name}}</td>
			<td class="actions">
    			{{-- <a class="btn btn-primary mr-1" href="{{ route( 'tasktypes.show', [$tasktype->id] ) }}"><i class="fa fa-fw fa-eye"></i></a> --}}
				<a class="btn btn-info mr-1" href="{{ route('tasktypes.edit', [$tasktype->id]) }}"><i class="fa fa-fw fa-pencil"></i></a>

				<form action="{{ route( 'tasktypes.destroy', [$tasktype->id] ) }}" method="POST" class="d-inline-block">
					{{ method_field('DELETE') }}

					{{ csrf_field() }}
					<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete  {{ $tasktype->name }}?');" name="delete"><i class="fa fa-fw fa-trash-o"></i></button>
				</form>
			</td>
			
	</tr>
    @endforeach
	</tbody>
    </table>

@endsection
