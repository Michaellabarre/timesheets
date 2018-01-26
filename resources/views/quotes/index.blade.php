@extends('layouts.master')



@section('page_title')

    Quotes	

@endsection

@section('content')
	
	<table class="table table-hover $id">
	<thead class="thead-default">
		<tr>
			<th>ID</th>
			<th>Job ID</th>
			<th>PM Hours</th>
			<th>Dev Hours</th>
			<th>Design Hours</th>
			<th class="actions">Actions</th>
		</tr>
	</thead>
    <tbody>
    	@foreach($quotes as $quote)
    			<tr>
    				<td><?php echo $quote->id; ?></td>
    				<td><a href="{{ route('jobs.show', $quote->job->id) }}">{{ $quote->job->code }} - {{ $quote->job->name }}</a></td>
    				<td><?php echo $quote->pm_hours; ?></td>
    				<td><?php echo $quote->dev_hours; ?></td>
    				<td><?php echo $quote->design_hours; ?></td>
    				

    				<td class="actions">
    					{{-- <a class="btn btn-primary mr-1" href="{{ route( 'quotes.show', [$quote->id] ) }}"><i class="fa fa-fw fa-eye"></i></a> --}}
    					<a class="btn btn-info mr-1" href="{{ route( 'quotes.edit', [$quote->id] ) }}"><i class="fa fa-fw fa-pencil"></i></a>
    					
						<form action="{{ route( 'quotes.destroy', [$quote->id] ) }}" method="POST" class="d-inline-block">
							{{ method_field('DELETE') }}							
							{{ csrf_field() }}
							<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete <?php echo $quote->id; ?>?');" name="delete"><i class="fa fa-fw fa-trash-o"></i></button>
						</form>
    				</td>

    			</tr>
    	@endforeach
    </tbody>
    </table>

@endsection
