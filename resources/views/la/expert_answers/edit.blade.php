@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/expert_answers') }}">Expert Answer</a> :
@endsection
@section("contentheader_description", $expert_answer->$view_col)
@section("section", "Expert Answers")
@section("section_url", url(config('laraadmin.adminRoute') . '/expert_answers'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Expert Answers Edit : ".$expert_answer->$view_col)

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
				{!! Form::model($expert_answer, ['route' => [config('laraadmin.adminRoute') . '.expert_answers.update', $expert_answer->id ], 'method'=>'PUT', 'id' => 'expert_answer-edit-form']) !!}
					{{--
					@la_form($module)
					--}}
					
					@la_input($module, 'question_id', '', '1', 'form-control', ["disabled" => "1"])
					@la_input($module, 'user_id', '', '1', 'form-control', ["disabled" => "1"])
					@la_input($module, 'answer')
					@la_input($module, 'status')
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/expert_answers') }}">Cancel</a></button>
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
	$("#expert_answer-edit-form").validate({
		
	});
});
</script>
@endpush
