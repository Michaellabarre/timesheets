@extends('layouts.master')



@section('page_title')

    Clients

@endsection

@section('content')
	
	<table class="table table-hover $id">
	<thead class="thead-default">
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th class="actions">Actions</th>
		</tr>
	</thead>
    <tbody>
    	@foreach($clients as $client)
    			<tr>
    				<td><?php echo $client->id; ?></td>
    				<td><?php echo $client->name; ?></td>
    				<td class="actions">
    					<a class="btn btn-primary mr-1" href="{{ route( 'clients.show', [$client->id] ) }}"><i class="fa fa-fw fa-eye"></i></a>
    					<a class="btn btn-info mr-1" href="{{ route( 'clients.edit', [$client->id] ) }}"><i class="fa fa-fw fa-pencil"></i></a>
    					
						<form action="{{ route( 'clients.destroy', [$client->id] ) }}" method="POST" class="d-inline-block">
							{{ method_field('DELETE') }}							
							{{ csrf_field() }}
							<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete <?php echo $client->name; ?>?');" name="delete"><i class="fa fa-fw fa-trash-o"></i></button>
						</form>
    				</td>

    			</tr>
    	@endforeach
    </tbody>
    </table>

@endsection

