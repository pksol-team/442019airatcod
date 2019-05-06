@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- Login-Section -->
<section class="reset_password">
   <div class="container">
      <div class="row login-sec">
         <div class="col-lg-8">
            <div class="login-main-head">
               <h2 class="border-bottom">Restablecer la contraseña</h2>
            </div>
            <div class="login-points">
               <ul class="list-unstyled">
                  <li><i class="fa fa-arrow-right" aria-hidden="true"></i>Solo pacientes:<a href="{{ route('facebook.login') }}" class="pl-2">Iniciar sesión con Facebook</a></li>
               </ul>
               @if(session()->has('error'))
                   <div class="alert alert-danger">
                       {!! session()->get('error') !!}
                   </div>
               @endif
            </div>
            <div class="login_form text-center">
               <form method="post" action="/forgot_reset_password" class="user-log-form forgot_reset_password">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="GUID" value="<?= Route::input('GUID') ?>">
                  <div class="row">
                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-2 password">
                        <label for="password" class="mt-2 pt-2">Nueva contraseña</label>
                     </div>
                     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-10 login_input-sec">
                        <input title="6 characters Minimum" minlength="4" name="password" type="password" id="exampleInputPassword" class="exampleInputPassword form-control mt-2 w-70" placeholder="Introduzca nueva contraseña" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-2 password">
                        <label for="confirm_password" class="mt-2 pt-2">Confirmar contraseña</label>
                     </div>
                     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-10 login_input-sec">
                        <input title="6 characters Minimum" minlength="4" name="confirm_password" type="password" id="exampleInputConfirmPassword" class="exampleInputConfirmPassword form-control mt-2 w-70" placeholder="Ingresar Confirmar Contraseña" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-2 col-md-2 col-sm-4 col-2">
                        &nbsp;
                     </div>
                     <div class="col-lg-10 col-md-10 col-sm-4 col-10">
                        <div class="radio-sec">
                           <div class="checkbox">
                           </div>
                        </div>
                        <div class="logIn-button">
                           <button type="submit" class="btn btn-primary">Cambio</button>
                        </div>
                        <div class="forget-pas">
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="support">
               <h3>Apoyo</h3>
               <p>Si tienes alguna duda, contacta con psicologos.</p>
               <a href="mailto:psicologoschile@vibemar.com">psicologoschile@vibemar.com</a>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- Login-Section-Ends -->
@stop