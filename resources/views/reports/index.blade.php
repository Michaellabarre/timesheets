@extends('layouts.master')



@section('page_title')

    Timesheets By Project

@endsection

@section('content')

<ol>
	<li>Choose a Job <strong>OR</strong> a client</li>
	<li>Choose a user (optional)</li>
	<li>Select a Date Range</li>
</ol>


<form method="POST" action="{{ route('reports.generate') }}" id="generate_report">

	{{ csrf_field() }}



	<div class="form-group">
		<div class="row">
			<div class="col-md-4">
				{!! Form::label('job_id', 'Job') !!}
				{!! Form::select('job_id', $jobs, null, ['class' => 'form-control select2','placeholder' => '--- select a job ---']) !!}	
			</div>
			<div class="col-md-4">
				{!! Form::label('client_id', 'Client') !!}
				{!! Form::select('client_id', $clients, null, ['class' => 'form-control select2','placeholder' => '--- select a client ---']) !!}
			</div>
			<div class="col-md-4">
				{!! Form::label('user_id', 'User') !!}
				{!! Form::select('user_id', $users, null, ['class' => 'form-control select2','placeholder' => '--- select a user ---']) !!}	
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="row">
			<div class="col-sm-5">
				{!! Form::label('start_date', 'Start Date') !!}
				{!! Form::date('start_date', null, ['class' => 'form-control']) !!}
			</div>
			<div class="col-sm-5">
				{!! Form::label('end_date', 'End Date') !!}
				{!! Form::date('end_date', null, ['class' => 'form-control']) !!}
				
			</div>
			<div class="col-sm-2 report_submit" >
				<button type="submit" class="btn btn-primary btn-block">Submit</button>				
			</div>
		</div>
	</div>
</form>
<hr>

	
	<div class="row">
		<div class="col-xs-12">
			<table class="table table-hover" id="timesheets-table">
			    <thead>
			        <tr>
			            <th>ID</th>
			            <th>Client</th>
			            <th>Job</th>
			            <th>User</th>
			            <th>Tasktype</th>
			            <th>Date</th>
			            <th>description</th>
			            <th>hours</th>
			        </tr>
			    </thead>
			    <tfoot>
			            <tr>
			                <th colspan="7" style="text-align:right">Total:</th>
			                <th></th>
			            </tr>
			        </tfoot>
			</table>
		</div>
	</div>


@endsection

@section('header_scripts')
@endsection

@section('footer_scripts')
<script type="text/javascript">
	(function($){

		
		    // var $inputs = $('input[name=job_id],input[name=client_id]');
		    // $inputs.on('input', function () {
		    //     // Set the required property of the other input to false if this input is not empty.
		    //     $inputs.not(this).prop('required', !$(this).val().length);
		    // });
		

		
		    var table = $('#timesheets-table').DataTable({
		    	dom: '<"row" <"col-xs-12" <"pull-left" l><"pull-right" B>><"col-xs-12" t><"col-xs-12" pi>r>',
		    	buttons: [
					'copy', 'csv', 'excel', 'print', 'colvis'
				],
		        processing: true,
		        serverSide: true,
		        ajax: {
				    url: '{{ route('reports.generate') }}',
				    data: function (d) {
				        d.job_id = $('select[name=job_id]').val();
				        d.user_id = $('select[name=user_id]').val();
				        d.client_id = $('select[name=client_id]').val();
				        d.start_date = $('input[name=start_date]').val();
				        d.end_date = $('input[name=end_date]').val();
				    }
				},
		        columns: [
		            { data: 'id', name: 'id' },
		            { data: 'client', name: 'client' },
		            { data: 'jobcode', name: 'jobcode' },
		            { data: 'username', name: 'username' },
		            { data: 'tasktype', name: 'tasktype' },
		            { data: 'date', name: 'date' },
		            { data: 'description', name: 'description' },
		            { data: 'hours', name: 'hours' }
		        ],
		        footerCallback: function ( row, data, start, end, display ) {
                    var api = this.api(), data;
         
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
         
                    // Total over all pages
                    // total = api
                    //     .column( 7 )
                    //     .data()
                    //     .reduce( function (a, b) {
                    //         return intVal(a) + intVal(b);
                    //     }, 0 );
                    var json = api.ajax.json();
                    
         
                    // Total over this page
                    pageTotal = api
                        .column( 7, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Update footer
                    $( api.column( 7 ).footer() ).html(
                        ''+pageTotal +' ( '+ json.total +' total)'
                    );
                }
		    });
		    $('#generate_report').on('submit',function(e){
		    	if($('#generate_report')[0].checkValidity()){
		        	table.draw();
			        e.preventDefault(e);
		    	}
		     //    if($('#generate_report')[0].checkValidity()){
		    	//     $.ajax({
		    	//         type:"POST",
		    	//         url:'{{ route('reports.generate') }}',
		    	//         data:$(this).serialize(),
		    	//         dataType: 'json',
		    	//         success: function(data){ console.log(data); },
		    	//         error: function(data){ }
		    	//     });
		    	// }
		    });

		

	})($);

</script>
@endsection
