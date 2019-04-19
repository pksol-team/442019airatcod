@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/tickets') }}">Ticket</a> :
@endsection
@section("contentheader_description", $ticket->$view_col)
@section("section", "Tickets")
@section("section_url", url(config('laraadmin.adminRoute') . '/tickets'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Tickets Edit : ".$ticket->$view_col)

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::model($ticket, ['route' => [config('laraadmin.adminRoute') . '.tickets.update', $ticket->id ], 'method'=>'PUT', 'id' => 'ticket-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'ticket_title')
					@la_input($module, 'ticket_description')
					@la_input($module, 'user_id')
					@la_input($module, 'date')
					@la_input($module, 'ticket_status')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button type="button" class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/tickets') }}">Cancel</a></button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#ticket-edit-form").validate({
		
	});
});
</script>
@endpush
