@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/cities') }}">Ciudades</a> :
@endsection
@section("contentheader_description", $city->$view_col)
@section("section", "Ciudades")
@section("section_url", url(config('laraadmin.adminRoute') . '/cities'))
@section("sub_section", "Editar")

@section("htmlheader_title", "Ciudades Editar : ".$city->$view_col)

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
				{!! Form::model($city, ['route' => [config('laraadmin.adminRoute') . '.cities.update', $city->id ], 'method'=>'PUT', 'id' => 'city-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'name')
					@la_input($module, 'code')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Actualizar', ['class'=>'btn btn-success']) !!} <button type="button" class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/cities') }}">Cerrar</a></button>
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
	$("#city-edit-form").validate({
		
	});
});
</script>
@endpush
