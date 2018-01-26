@extends('layouts.master')



@section('page_title')

    Users

@endsection

@section('content')

	<table class="table table-hover $id">
	<thead class="thead-default">
		<tr>
			{{-- <th>id</th> --}}
			<th>Username</th>
			<th>Email</th>
			<th>Role</th>
			<th class="actions">Actions</th>			
		</tr>
	</thead>
	<tbody>
    @foreach($users as $user)
		<tr>
			<td>{{$user->name}}</td>
			<td>{{$user->email}}</td>
			<td>
				{{ implode(', ', $user->roles()->pluck('name')->toArray() ) }}
				
			</td>
			<td class="actions">
				<a class="btn btn-primary mr-1" href="{{ route('users.show', [$user->id]) }}"><i class="fa fa-fw fa-eye"></i></a>
				<a class="btn btn-info mr-1" href="{{ route('users.edit', [$user->id]) }}"><i class="fa fa-fw fa-pencil"></i></a>

				<form action="{{ route( 'users.destroy', [$user->id] ) }}" method="POST" class="d-inline-block">
					{{ method_field('DELETE') }}

					{{ csrf_field() }}
					<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete  {{ $user->name }}?');" name="delete" value="Delete"><i class="fa fa-fw fa-trash-o"></i></button>
				</form>
			</td>
			
	</tr>
    @endforeach
	</tbody>
    </table>

@endsection