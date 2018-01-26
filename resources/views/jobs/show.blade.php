@extends('layouts.master')



@section('page_title')

	{{ $job->code }} - {{ $job->name }}

@endsection

@section('content')

	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<div class="card mb-4">
				<table class="table $id mb-0">
					<thead class="thead-default">
						<tr>
							<th>Code</th>
							<th>Client</th>
							<th>Title</th>
							<th>Active</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $job->code }}</td>
							<td><a href="{{ route('clients.show', $job->client_id) }}">{{ $job->client->name }}</a></td>
							<td>{{ $job->name }}</td>
							<td>{{ $job->active }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-xs-12 col-sm-3">
			<div class="card mb-4">
				<table class="table $id mb-0 text-center">
					<thead class="thead-default">
						<tr>
							<th>PM Hours</th>
							<th>Dev Hours</th>
							<th>Design Hours</th>
							<th>Total Hours</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="{{ ( $job->pmOverTime() ?'table-danger':'table-success' ) }}">
								<span title="Used">{{ $job->getTaskTime('Project Management') }}</span> / <span title="Quoted">{{ $job->quote->pm_hours }}</span>
								<span title="Remaining">({{  $job->quote->pm_hours - $job->getTaskTime('Project Management') }})</span>
							</td>
							<td class="{{ ( $job->devOverTime() ?'table-danger':'table-success') }}">
								<span title="Used">{{ $job->getTaskTime('Development') }}</span> / <span title="Quoted">{{ $job->quote->dev_hours }}</span>
								<span title="Remaining">({{  $job->quote->dev_hours - $job->getTaskTime('Development') }})</span>
							</td>
							<td class="{{ ( $job->designOverTime() ?'table-danger':'table-success') }}">
								<span title="Used">{{ $job->getTaskTime('Design') }}</span> / <span title="Quoted">{{ $job->quote->design_hours }}</span>
								<span title="Remaining">({{  $job->quote->design_hours - $job->getTaskTime('Design') }})</span>
							</td>
							<td class="{{ ( $job->totalOverTime() ?'table-danger':'table-success') }}">
								<strong><span title="Used">{{ $job->getTime() }}</span> / <span title="Quoted">{{ $job->getTotalQuotedTime() }}</span>
									<span title="Remaining">({{  $job->getTotalQuotedTime() - $job->getTime() }})</span></strong>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
		    <h3 class="card-title mb-0">Timesheets</h3>
		</div>
		<table class="table $id table-hover mb-0">
			<thead class="thead-default">
				<tr>
					<th>User</th>
					<th>Date</th>
					<th>Task Type</th>
					<th>Description</th>
					<th  class="text-right">Hours</th>
				</tr>
			</thead>
			<tbody>
				
				@foreach($timesheets as $timesheet)
					<tr>
						<td>{{ $timesheet->user->name }}</td>
						<td>{{ $timesheet->date }}</td>
						<td>{{ $timesheet->tasktype->name }}</td>
						<td>{{ $timesheet->description }}</td>
						<td class="text-right">{{ $timesheet->hours }}</td>
					</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<td colspan="5" class="text-right">
						<strong>Total Hours:</strong> {{ $job->getTime() }}
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="row mt-4">
		<div class="col-xs-12 col-md-3">
			<div class="card">
				<div class="card-header">
				    <h3 class="card-title mb-0">Hours by Task Type</h3>
				</div>
				<div class="card-body">
					<div id="hours_by_task"></div>
				</div>

			</div>
		</div>
		<div class="col-xs-12 col-md-3">
			<div class="card">
				<div class="card-header">
				    <h3 class="card-title mb-0">Hours By User</h3>
				</div>
				<div class="card-body"><div id="hours_by_user"></div></div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6">
			<div class="card">
				<div class="card-header">
				    <h3 class="card-title mb-0">Hours By Date</h3>
				</div>
				<div class="card-body"><div id="hours_by_date"></div></div>
			</div>
		</div>
	</div>
@endsection



@section('footer_scripts')
	<script type="text/javascript">

		$(function(){

			var $data = {!! json_encode($job->getTimeByTask()) !!};
			$columns = Object.keys($data).map(function(val) { return [val, $data[val]]; });
	
			//#hours_by_task
			var chart = c3.generate({
			    bindto: '#hours_by_task',
			    donut: {
			      title: "Hours by Task"
			    },
			    data: {
			      type : 'donut',
			      columns: $columns
			    }
			});

		});

		$(function(){
			var $data = {!! json_encode($job->getTimeByUser()) !!};
			$columns = Object.keys($data).map(function(val) { return [val, $data[val]]; });
			//console.log($columns)
			//#hours_by_task
			var chart = c3.generate({
			    bindto: '#hours_by_user',
			    donut: {
			      title: "Hours by User"
			    },
			    data: {
			      type : 'donut',
			      columns: $columns
			    }
			});
		});

		$(function () {
			var data = {!! json_encode($job->getTimeByDate()) !!};
			var dates = data.map(
				function(o){
					return o.date;
				}
			);
			var hours = data.map(
				function(o){
					return o.hours;
				}
			);
			dates.splice(0, 0, 'x');
			hours.splice(0, 0, 'Overall Hours');
			var chart = c3.generate({
			    bindto: '#hours_by_date',
			    data: {
			      type: 'bar',
			      x: 'x',
			      columns: [
			      	dates,
			      	hours
			      ]
			    },
			    bar: {
		            width: {
		                ratio: 0.1 // this makes bar width 50% of length between ticks
		            }
		            // or
		            //width: 100 // this makes bar width 100px
		        },
			    axis: {
			    	x: {
			    		type: 'timeseries',
    		            tick: {
    		            	rotate: 45,
    		            	multiline: false,
    		                format: '%B %d, %Y'
    		            }
			    	}
			    }
			});				
		});

		
		
	</script>
@endsection