@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- Login-Section -->
<section class="register-doctor">
   <div class="container">
      <div class="row reg login-sec">
         <div class="col-lg-8">
            <div class="login-main-head">
               <h2 class="border-bottom">Registro de Professional</h2>
            </div>
			@if(session()->has('error'))
                <div class="alert alert-danger">
                    {!! session()->get('error') !!}
                </div>
            @endif
            <div class="login-points">
               <ul class="list-unstyled">
                  <li>
                     <span class="point-1">2</span>
                     <span class="point-1-head">
                        <h4>Su cuenta de usuario en Doctoralia</h4>
                     </span>
                  </li>
                  <li class="sub-valid"><i class="fa fa-info-circle info" aria-hidden="true"></i>* Todos los campos son obligatorios.</li>
               </ul>
            </div>
            <div class="login_form text-center">
               <form method="post" action="/register_check">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="row">
                     <div class="col-lg-3 col-md-2 col-sm-4 col-3 offset-lg-2 label-sec text-right">
                        <label for="" class="email text-right">Número RUT</label>
                     </div>
                     <div class="col-lg-7 col-md-10 col-sm-8 col-9 login_input-sec">
                        <input type="text" class="form-control" id="RUT_number" name="RUT_number" value="{{ old('RUT_number') }}" placeholder="Entrar Número RUT" required>
                        <p class="textHelp f-size">Es <strong>imprescindible</strong> para que podamos validar su registro</p>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-5 col-md-2 col-sm-4 col-3 password">
                        <label for="" class="mt-2 pt-2 text-right">Su teléfono celular con prefijo local</label>
                     </div>
                     <div class="col-lg-7 col-md-10 col-sm-8 col-9 login_input-sec">
                        <input type="text" class="form-control mt-2 w-50" id="exampleInputcontact" name="contact" value="{{ old('contact') }}" placeholder="Entrar en contacto" required>
                        <p class="textHelp f-size"><strong>9 DÍGITOS</strong>. No será visible. Sólo será utilizado por el departamento de soporte de Doctoralia.</p>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-3 col-md-2 col-sm-4 col-3 offset-lg-2 label-sec text-right">
                        <label for="" class="mt-2 pt-2 text-right">Email</label>
                     </div>
                     <div class="col-lg-7 col-md-10 col-sm-8 col-9 login_input_email-sec">
                        <input type="email" class="form-control mt-2 w-100" id="email" name="email" value="{{ old('email') }}" placeholder="Ingrese correo electrónico" required>
                        <p class="textHelp f-size text-left">Enviaremos un email de confirmación a esta dirección</p>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-3 col-md-2 col-sm-4 col-3 offset-lg-2 label-sec text-right">
                        <label for="" class="mt-2 pt-2 text-right">Contraseña</label>
                     </div>
                     <div class="col-lg-7 col-md-10 col-sm-8 col-9 login_input_email-sec">
                        <input type="password" class="form-control mt-2 w-50" id="password" name="password" placeholder="Introducir la contraseña" required>
                        <p class="textHelp f-size text-left">Para iniciar sesión en Doctoralia</p>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-3 col-md-2 col-sm-4 col-3 offset-lg-2 label-sec text-right">
                        <label for="password" class="mt-2 pt-2 text-right">Confirme contraseña</label>
                     </div>
                     <div class="col-lg-7 col-md-10 col-sm-8 col-9 login_input_email-sec">
                        <input type="password" class="form-control mt-2 w-50" id="confirm_password" name="confirm_password" placeholder="Introduzca la contraseña de confirmación" required>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-3 col-md-2 col-sm-4 col-3 offset-lg-2 label-sec text-right">
                        <label for="password" class="mt-2 pt-2 text-right">¿Cómo nos ha conocido?</label>
                     </div>
                     <div class="col-lg-7 col-md-10 col-sm-8 col-9 login_input_email-sec">
	                      <select class="form-control w-100 text-left how_did_know" name="how_did_know" id="dropdownMenuButton" required>
	                      	<option value="" hidden>--- por favor, seleccionar</option>
	                      	<option value="1">Por recomendación de un compañero de profesión</option>
	                      	<option value="2">A través de un conocido o familiar</option>
	                      	<option value="3">A través de un paciente</option>
	                      	<option value="4">He leído sobre vosotros en la prensa</option>
	                      	<option value="5">Os he encontrado buscando en Google o en otros buscadores</option>
	                      	<option value="6">Os he visto en un anuncio en Internet</option>
	                      	<option value="7">Os he visto en redes sociales (Facebook, Twitter, LinkedIn, etc.)</option>
	                      	<option value="8">Tras oír hablar sobre Doctoralia en conferencias o eventos</option>
	                      </select>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="instruction-head text-center">
                           <h5>
                              INFORMACIÓN BÁSICA SOBRE PROTECCIÓN DE DATOS
                           </h5>
                        </div>
                        <div class="reg-instruction text-left">
                           <p><strong>Responsable</strong>Doctoralia Internet S.L</p>
                           <p><strong>Finalidad</strong> Prestación de los servicios solicitados a través de nuestra plataforma online.</p>
                           <p><strong>Legitimación</strong> La ejecución de un contrato y, en su caso, el consentimiento del interesado.</p>
                           <p><strong>Destinatarios</strong> Directorio de Doctoralia y otros terceros, como se indica en la información adicional.</p>
                           <p><strong>Derechos</strong> Acceso, rectificación, y supresion de los datos, asi como otros derechos de protección de datos expresados en la <a target="_blank" href="http://www.doctoralia.cl/legal.aspx#privacidadpro">politica de privacidad</a>.</p>
                        </div>
                     </div>
                  </div>
                  <div class="acceptance">
                     <div class="first-terms-cond text-left">
                        <label>
	                        <input type="checkbox" name="" required>
	                        <span>Acepto las <a href="#">condiciones de uso</a> la <a href="#">política de privacidad</a> y el tratamiento de mis datos</span>
                        </label>
                     </div>
                     <div class="sec-term-cond text-left">
                        <label>
	                        <input type="checkbox" name="notification">
	                        <span>Me gustaría recibir notificaciones sobre nuevas citas, consejos y ofertas</span>
                        </label>
                     </div>
                  </div>
            </div>
            <div class="registration">
               <div class="reg-submit text-center">
                  <button type="submit" class="btn btn-primary">Continuar</button>
                  <a href="/">Cancelar registro</a>
               </div>
            </div>
         </div>
	     </form>
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