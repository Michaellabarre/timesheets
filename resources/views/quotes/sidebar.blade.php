<div class="list-group">
	@can('create-quote')
		<a href="{{ route('quotes.create') }}" class="list-group-item list-group-item-action  d-flex align-items-center {{ Menu::activeMenu('quotes.create') }}"><i class="mr-3 fa-fw fa fa-plus fa-2x"></i>Add Quote</a>    
	@endcan
</div>