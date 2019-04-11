@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/specialities') }}">Speciality</a> :
@endsection
@section("contentheader_description", $speciality->$view_col)
@section("section", "Specialities")
@section("section_url", url(config('laraadmin.adminRoute') . '/specialities'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Specialities Edit : ".$speciality->$view_col)

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
				{!! Form::model($speciality, ['route' => [config('laraadmin.adminRoute') . '.specialities.update', $speciality->id ], 'method'=>'PUT', 'id' => 'speciality-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'name')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/specialities') }}">Cancel</a></button>
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
	$("#speciality-edit-form").validate({
		
	});
});
</script>
@endpush
