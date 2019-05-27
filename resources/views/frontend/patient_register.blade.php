@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- Login-Section -->
<section>
   <div class="container">
      <div class="row login-sec">
         <div class="col-lg-8">
            <div class="login-main-head">
               <h2 class="border-bottom">registro</h2>
            </div>
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {!! session()->get('error') !!}
                </div>
            @endif
            <div class="login-points">
               <ul class="list-unstyled">
                  <li><i class="fa fa-arrow-right" aria-hidden="true"></i>Si ya eres usuario de psicologos,
                     <a href="/userlogin" class="pl-2">Iniciar sesión </a>
                  </li>
                  <li><i class="fa fa-arrow-right" aria-hidden="true"></i>Registrarse en psicologos es gratis! Registrarte con <a href="{{ route('facebook.login') }}">Facebook</a> o tu correo electrónico:</li>
               </ul>
            </div>
            <div class="login_form registry-form text-center">
               <form method="post" action="/register_check">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="row my-2">
                     <div class="col-lg-2 col-md-2 col-sm-4 col-12 registry-label-sec label-sec">
                        <label for="email" class="email">correo electrónico</label>
                     </div>
                     <div class="col-lg-10 col-md-10 col-sm-4 col-12 registry-emai-sec login_input-sec">
                        <input type="email" class="form-control" value="{{ old('email') }}" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese correo electrónico" oninvalid="this.setCustomValidity('Por favor rellene este campo')" oninput="setCustomValidity('')" required>
                        <small class="float-left">Le enviaremos un correo electrónico de confirmación a esta dirección.</small>
                     </div>
                  </div>
                  <div class="row my-2">
                     <div class="col-lg-2 col-md-2 col-sm-4 col-12 registry-pass">
                        <label for="password" class="mt-2 pt-2">contraseña</label>
                     </div>
                     <div class="col-lg-10 col-md-10 col-sm-4 col-12 registry-pass-input login_input-sec">
                        <input type="password" name="password" class="form-control mt-2 w-50" id="exampleInputPassword1"  placeholder="Introducir la contraseña" minlength="6" oninvalid="this.setCustomValidity('Por favor rellene este campo')" oninput="setCustomValidity('')" required>
                        <small class="float-left">Para iniciar sesión en psicologos</small>
                     </div>
                  </div>
                  <div class="row my-2">
                     <div class="col-lg-2 col-md-2 col-sm-4 col-12 registry-confirm-pas ">
                        <label for="password" class="mt-2 pt-2">Confirmar contraseña</label>
                     </div>
                     <div class="col-lg-10 col-md-10 col-sm-4 col-12 registry-confirm-pas-input  login_input-sec">
                        <input minlength="6" type="password" name="confirm_password" class="form-control mt-2 w-50" id="exampleInputPassword2" placeholder="Confirmar contraseña" oninvalid="this.setCustomValidity('Por favor rellene este campo')" oninput="setCustomValidity('')" required>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-2 col-md-2 col-sm-4 col-2">
                        &nbsp;
                     </div>
                     <div class="col-lg-10 col-md-10 col-sm-4 col-12">
                        <div class="logIn-button registry-link">
                           <button type="submit" class="btn btn-primary text-white">Registro</button>
                        </div>
                        <div class="forget-pas">
                           <small>Al continuar, estás aceptando <a href="" class="text-dark">las condiciones de uso de psicologos</a>
                           </small>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="support">
               <h3>Ventajas del registro.:</h3>
               <div class="reg-list-items">
                  <ul class="list-unstyled">
                     <li>
                        <span><i class="fa fa-check" aria-hidden="true"></i></span>
                        <span><strong>Reserve una cita</strong><small> con su médico</small></span>
                     </li>
                     <li>
                        <span><i class="fa fa-check" aria-hidden="true"></i></span>
                        <span><strong>Comentar </strong><small> sobre médicos y centros.</small></span>
                     </li>
                     <!-- <li>
                        <span><i class="fa fa-check" aria-hidden="true"></i></span>
                        <span><strong>Ask </strong><small> experts</small></span> 
                     </li> -->
                     <li>
                        <small>Todo completamente </small><strong> gratis </strong>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- Login-Section-Ends -->
@stop