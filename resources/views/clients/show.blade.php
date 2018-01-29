@extends('layouts.master')



@section('page_title')

	<strong>{{ $client->name }}</strong>

@endsection

@section('content')

	{{-- <dl>
		<dt>Title:</dt>
		<dd>{{ $client->name }}</dd>
	</dl>

	//show active projects
	<br>
	<br>
	//stats on client	 --}}

	<div class="">
		<div class="col-12">
			<div class="card mb-4">
				<div class="card-header">
				    <h3 class="card-title mb-0">Contacts</h3>
				</div>
				<div class="card-block">
					<table class="table table-hover mb-0">
						<thead>
							<tr>
								<th>Name</th>
								<th>Job Title</th>
								<th>Email</th>
								<th>Phone #</th>
								<th class="actions">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($client->contacts as $contact)
								<tr>
									<td>{{ $contact->name }}</td>
									<td>{{ $contact->job_title }}</td>
									<td><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></td>
									<td><a href="tel:{{ $contact->phone_number }}">{{ $contact->phone_number }}</a></td>
									<td class="actions">
										<a class="btn btn-info mr-1" href="{{ route('contacts.edit', [$contact->id]) }}"><i class="fa fa-fw fa-pencil"></i></a>

										<form action="{{ route( 'contacts.destroy', [$contact->id] ) }}" method="POST" class="d-inline-block">
											{{ method_field('DELETE') }}

											{{ csrf_field() }}
											<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete <?php echo $contact->name; ?>?');" name="delete"><i class="fa fa-fw fa-trash-o"></i></button>
										</form>
									</td>
								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<td colspan='5'>
									<a class="btn btn-primary float-right" href="{{ route( 'contacts.create', ['client_id' => $client->id] ) }}">Add Contact</a>
								</td>
							</tr>
						</tfoot>
					</table>
				</div>			
			</div>
		</div>
		<div class="col-12">
			<div class="card">
				<div class="card-header">
				    <h3 class="card-title mb-0">Jobs</h3>
				</div>
				<div class="card-block">
					<table class="table table-hover $id mb-0">
						<thead>
							<tr>
								<th>Code</th>
								<th>Name</th>
								<th>Active</th>
								<th class="actions">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($client->jobs as $job)
								<tr>
									<td>{{ $job->code }}</td>
									<td>{{ $job->name }}</td>
									<td>{{ $job->active }}</td>		
									<td class="actions">
						    			<a class="btn btn-primary mr-1" href="{{ route( 'jobs.show', [$job->id] ) }}"><i class="fa fa-fw fa-eye"></i></a>
										<a class="btn btn-info mr-1" href="{{ route('jobs.edit', [$job->id]) }}"><i class="fa fa-fw fa-pencil"></i></a>

										<form action="{{ route( 'jobs.destroy', [$job->id] ) }}" method="POST" class="d-inline-block">
											{{ method_field('DELETE') }}

											{{ csrf_field() }}
											<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete <?php echo $job->name; ?>?');" name="delete" ><i class="fa fa-fw fa-trash-o"></i></button>
										</form>
									</td>							
								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<td colspan='4'>
									<a class="btn btn-primary float-right" href="{{ route( 'jobs.create', ['client_id'=>$client->id] ) }}">Add Job</a>
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>

</form>

@endsection