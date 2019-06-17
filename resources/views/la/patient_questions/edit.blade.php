@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/patient_questions') }}">Patient Question</a> :
@endsection
@section("contentheader_description", $patient_question->$view_col)
@section("section", "Patient Questions")
@section("section_url", url(config('laraadmin.adminRoute') . '/patient_questions'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Patient Questions Edit : ".$patient_question->$view_col)

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
				{!! Form::model($patient_question, ['route' => [config('laraadmin.adminRoute') . '.patient_questions.update', $patient_question->id ], 'method'=>'PUT', 'id' => 'patient_question-edit-form']) !!}
					{{--
					@la_form($module)
					--}}
					
					@la_input($module, 'question')
					@la_input($module, 'specialty', '', '1', 'form-control', ["disabled" => "1"])
					@la_input($module, 'email', '', '1', 'form-control', ["disabled" => "1"])
					@la_input($module, 'user_id', '', '1', 'form-control', ["disabled" => "1"])
					@la_input($module, 'status')
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/patient_questions') }}">Cancel</a></button>
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
	$("#patient_question-edit-form").validate({
		
	});
});
</script>
@endpush
