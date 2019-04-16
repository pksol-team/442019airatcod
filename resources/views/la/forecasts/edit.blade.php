@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/forecasts') }}">Forecast</a> :
@endsection
@section("contentheader_description", $forecast->$view_col)
@section("section", "Forecasts")
@section("section_url", url(config('laraadmin.adminRoute') . '/forecasts'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Forecasts Edit : ".$forecast->$view_col)

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
				{!! Form::model($forecast, ['route' => [config('laraadmin.adminRoute') . '.forecasts.update', $forecast->id ], 'method'=>'PUT', 'id' => 'forecast-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'name')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/forecasts') }}">Cancel</a></button>
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
	$("#forecast-edit-form").validate({
		
	});
});
</script>
@endpush
