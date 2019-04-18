@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/tickets_replies') }}">Tickets reply</a> :
@endsection
@section("contentheader_description", $tickets_reply->$view_col)
@section("section", "Tickets replies")
@section("section_url", url(config('laraadmin.adminRoute') . '/tickets_replies'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Tickets replies Edit : ".$tickets_reply->$view_col)

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
				{!! Form::model($tickets_reply, ['route' => [config('laraadmin.adminRoute') . '.tickets_replies.update', $tickets_reply->id ], 'method'=>'PUT', 'id' => 'tickets_reply-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'ticket_id')
					@la_input($module, 'reply_date')
					@la_input($module, 'user_id')
					@la_input($module, 'message')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/tickets_replies') }}">Cancel</a></button>
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
	$("#tickets_reply-edit-form").validate({
		
	});
});
</script>
@endpush
