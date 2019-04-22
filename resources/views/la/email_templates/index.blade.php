@extends("la.layouts.app")

@section("contentheader_title", "Plantilla de correo electrónico")
@section("contentheader_description", "Plantilla de correo electrónico listado")
@section("section", "Plantilla de correo electrónico")
@section("sub_section", "listado")
@section("htmlheader_title", "Plantilla de correo electrónico listado")

@section("headerElems")
@la_access("Email_Templates", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Añadir plantilla de correo electrónico</button>
@endla_access
@endsection

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

<div class="box box-success">
	<!--<div class="box-header"></div>-->
	<div class="box-body">
		<table id="example1" class="table table-bordered">
		<thead>
		<tr class="success">
			@foreach( $listing_cols as $col )
			<th>{{ $module->fields[$col]['label'] or ucfirst($col) }}</th>
			@endforeach
			@if($show_actions)
			<th>Comportamiento</th>
			@endif
		</tr>
		</thead>
		<tbody>
			
		</tbody>
		</table>
	</div>
</div>

@la_access("Email_Templates", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Añadir plantilla de correo electrónico</h4>
			</div>
			{!! Form::open(['action' => 'LA\Email_TemplatesController@store', 'id' => 'email_template-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
					{{--
                    @la_form($module)
					--}}
					
					@la_input($module, 'options')
					@la_input($module, 'email_content', '', '', 'form-control summernote_description')
					@la_input($module, 'subject')
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				{!! Form::submit( 'Enviar', ['class'=>'btn btn-success']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endla_access

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
<script>
$(function () {
	$("#example1").DataTable({
		processing: true,
        serverSide: true,
        ajax: "{{ url(config('laraadmin.adminRoute') . '/email_template_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Buscar",
			url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#email_template-add-form").validate({
		
	});

	$('.summernote_description').summernote();
});
</script>
@endpush
