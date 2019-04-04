@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- Login-Section -->
<section>
   <div class="container">
      <div class="row reg login-sec">
         <div class="col-lg-8">
            <div class="login-main-head">
               <h2 class="border-bottom">Registro de Professional</h2>
            </div>
            <div class="login-points">
               <ul class="list-unstyled">
                  <li>
                     <span class="point-1">3</span>
                     <span class="point-1-head">
                        <h4>Validación de su cuenta en Doctoralia</h4>
                     </span>
                  </li>
                  <li class="reg-pro-sub-valid sub-valid"><i class="fa fa-info-circle info" aria-hidden="true"></i>Consulte su email para continuar con el registro</li>
               </ul>
            </div>
            <div class="points-of-validation-acc">
               <ul class="list-unstyled">
                  @if(session()->has('error'))
                      <div class="alert alert-danger">
                          {!! session()->get('error') !!}
                      </div>
                  @endif
                  <li>
                     <form action="/update_email" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ $NewUser->id }}">
                        <input type="email" name="email" class="form-control email mb-4" value="{{ old('email') }}" required />
                        <button class="btn btn-info" type="submit">Change Email</button>
                     </form>
                  </li>
               </ul>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="support">
               <h3>Support</h3>
               <p>If you have any questions,contact doctorolia</p>
               <a href="mailto:support-cl@doctorolia.com">support-cl@doctorolia.com</a>
            </div>
         </div>
      </div>
   </div>
</section>
@stop