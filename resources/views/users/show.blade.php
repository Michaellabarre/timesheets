@extends('layouts.master')



@section('page_title')

	{{ $user->name }}

@endsection

@section('content')

	<div class="card">
		<div class="card-header">
		    <h3 class="card-title mb-0">Timesheets</h3>
		</div>
		<table class="table $id table-hover mb-0">
			<thead class="thead-default">
				<tr>
					{{-- <th>User</th> --}}
					<th>Date</th>
					<th>Task Type</th>
					<th>Description</th>
					<th  class="text-right">Hours</th>
				</tr>
			</thead>
			<tbody>
				
				@foreach($timesheets as $timesheet)
					<tr>
						{{-- <td>{{ $timesheet->user->name }}</td> --}}
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
						<strong>Total Hours:</strong> {{ $user->getTime() }}
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
			var $data = {!! json_encode($user->getTimeByTask()) !!};
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

		$(function () {
			var data = {!! json_encode($user->getTimeByDate()) !!};
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