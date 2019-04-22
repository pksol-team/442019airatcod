@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')

<!-- appointment-sec-start -->
<section class="bg-lightgrey pb-3">
   <div class="container">
   <div class="row">
      <div class="col-lg-12 card bg-lightgrey d-flex align-self-center py-3">
         <h3 class="text-left align-middle">Cita de reserva</h3>
         <p>Vas a programar una cita para el <strong><?= $consultantTime->day ?>, 
            <?php 
               $date = new DateTime();
               $date->modify($consultantTime->day);
               echo $date->format('F d, Y'); ?>
          at <?= $consultantTime->from_time.' '.$consultantTime->from_AM_PM ?></strong></p>
      </div>
   </div>
   <div class="row main-booking-part bg-white">
      <div class="col-lg-8 py-3">
         <form method="post" action="/booked_appointment">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="doctor_id" value="<?= $doctor->id ?>">
            <input type="hidden" name="appointment_date" value="<?= $date->format('Y-m-d'); ?>">
            <input type="hidden" name="day" value="<?= $consultantTime->day ?>">
            <input type="hidden" name="from_time" value="<?= $consultantTime->from_time ?>">
            <input type="hidden" name="from_AM_PM" value="<?= $consultantTime->from_AM_PM ?>">
            <input type="hidden" name="location" value="<?= $consultantTime->location ?>">
            <input type="hidden" name="patient_id" value="<?= (Auth::user()) ? Auth::user()->id: 0; ?>">
            <?php echo $date->format('Y-m-d'); ?>
            <div class="row">
               <div class="col-lg-12 express-booking">
                  <ul class="list-unstyled">
                     <li class="sub-valid"><i class="fa fa-info bgg-green text-white express-acc" aria-hidden="true"></i>Reserva Express con su <a href="/userlogin" class="pr-2">psicologos Cuenta</a>or<a href="{{ route('facebook.login') }}" class="pl-2">Facebook</a></li>
                  </ul>
               </div>
            </div>
            <!-- <div class="row my-3">
               <div class="col-lg-4 text-right">
                  <label for="" class="text-right">Who is the appointment for?</label>
               </div>
               <div class="col-lg-6">
                  <input type="radio" id="noCheck"> <span class="pr-3">For me</span>
                  <input type="radio" class="pl-3"> <span>For another person</span>
               </div>
            </div> -->
            <!-- display on radio button checked -->
            <!-- <div class="displayonradio-checked" id="ifYes" style="display:none">
               <div class="row my-3">
                  <div class="col-lg-4 text-right">
                     <label for="" class="text-right">Your Name</label>
                  </div>
                  <div class="col-lg-6">
                     <input type="text" class="form-control border-dark w-75">
                  </div>
               </div>
               <div class="row my-3">
                  <div class="col-lg-4 text-right">
                     <label for="" class="text-right">Your Last Name</label>
                  </div>
                  <div class="col-lg-6">
                     <input type="text" class="form-control border-dark w-100">
                  </div>
               </div>
            </div> -->
            <!-- display on radio button checked -->
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {!! session()->get('error') !!}
                </div>
            @endif
            <div class="row my-3">
               <div class="col-lg-4 text-right">
                  <label for="" class="text-right">¿Es la primera visita?</label>
               </div>
               <div class="col-lg-6">
                  <input name="first_visit" type="radio" checked> <span class="pr-3">Sí</span>
                  <input name="first_visit" type="radio" class="pl-3"> <span>No</span>
               </div>
            </div>
            <div class="row my-3">
               <div class="col-lg-4 text-right">
                  <label for="first_name" class="text-right">Tu nombre *</label>
               </div>
               <div class="col-lg-6">
                  <input name="first_name" value="<?= ($loginUser != NULL) ? $loginUser->first_name : old('first_name'); ?>" type="text" class="form-control border-dark w-75" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required>
               </div>
            </div>
            <div class="row my-3">
               <div class="col-lg-4 text-right">
                  <label for="last_name" class="text-right">Tu apellido *</label>
               </div>
               <div class="col-lg-6">
                  <input name="last_name" value="<?= ($loginUser != NULL) ? $loginUser->last_name : old('last_name'); ?>" type="text" class="form-control border-dark w-100" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required>
               </div>
            </div>
            <div class="row my-3">
               <div class="col-lg-4 text-right">
                  <label for="email" class="text-right">Tu correo electrónico *</label>
               </div>
               <div class="col-lg-6">
                  <input name="email" type="text" value="<?= ($loginUser != NULL) ? $loginUser->email : old('email'); ?>" class="form-control border-dark w-75" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required>
               </div>
            </div>
            <div class="row my-3">
               <div class="col-lg-4 text-right">
                  <label for="mobile" class="text-right">Tu celular *</label>
               </div>
               <div class="col-lg-6">
                  <input name="mobile" type="text" value="<?= ($loginUser != NULL) ? $loginUser->mobile : old('mobile'); ?>" class="form-control border-dark w-50" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required>
                  <p><small>Verifique sus datos para asegurarse de que puedan contactarlo.</small></p>
               </div>
            </div>
            <div class="row my-3">
               <div class="col-lg-4">
                  <label for="comments" class="text-right">Comentarios para el profesional (opcional)</label>
               </div>
               <div class="col-lg-6">
                  <textarea name="comments" id="" cols="42" rows="5" class="border-dark"></textarea>
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
                     <p><strong>Responsable</strong>psicologos Internet S.L</p>
                     <p><strong>Finalidad</strong> Prestación de los servicios solicitados a través de nuestra plataforma online.</p>
                     <p><strong>Legitimación</strong> La ejecución de un contrato y, en su caso, el consentimiento del interesado.</p>
                     <p><strong>Destinatarios</strong> Directorio de psicologos y otros terceros, como se indica en la información adicional.</p>
                     <p><strong>Derechos</strong> Acceso, rectificación, y supresion de los datos, asi como otros derechos de protección de datos expresados en la <a target="_blank" href="#">politica de privacidad</a>.</p>
                  </div>
               </div>
            </div>
            <div class="acceptance">
               <div class="first-terms-cond text-left">
                  <label>
                     <input type="checkbox" name="terms" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required>
                  <span>Acepto las <a href="#">condiciones de uso</a> la <a href="#">política de privacidad</a> y el tratamiento de mis datos
                  </span>
                  </label>
               </div>
               <div class="sec-term-cond text-left">
                  <label for="notification"><input type="checkbox" name="notification">
                     <span>Me gustaría recibir notificaciones sobre nuevas citas, consejos y ofertas</span>
                  </label>
               </div>
            </div>
            <div class="row my-3">
               <div class="col-lg-4">
                  &nbsp;
               </div>
               <div class="col-lg-6">
                  <button class="btn btn-primary px-4"> Enviar </button>
                  <a href="<?= '/doctor_profile_view/'.$doctor->id.'/'.$doctor->hash_key?>"> Cancelar cita</a>
               </div>
            </div>
         </form>
      </div>
      <div class="col-lg-4 booking-app-sidebar py-2">
         <div class=" row sidebar">
            <div class="col-lg-4">
               <?php
               if ($doctor->profile_picture != '0') {
                 $profilePic = '/upload/'.$doctor->profile_picture;
               } else {
                 $profilePic = '/frontend/assets/img/default-doctor_1.png';
               } ?>
               <img class="img-fluid" src="<?= $profilePic ?>" alt="Doctor Picture">
            </div>
            <div class="col-lg-8">
               <div class="doc-name">
                  <p class="mb-0"><?= $doctor->first_name.' '.$doctor->last_name ?></p>
                  <small class="title-color">Psicóloga</small>
               </div>
            </div>
         </div>
         <hr>
         <div class=" row sidebar">
            <div class="col-lg-12">
               <div class="appointment-date">
                  <p class="mb-0 title-color">CITA</p>
                  <p class="f-12"><span><i class="fa fa-calendar pr-2"></i></span><?= $consultantTime->day ?>, 
                  <?= $date->format('F d, Y'); ?>
                   at <?= $consultantTime->from_time.' '.$consultantTime->from_AM_PM ?></p>
               </div>
            </div>
         </div>
         <hr>
         <div class=" row sidebar">
            <div class="col-lg-12">
               <div class="appointment-loc">
                  <p class="mb-0 title-color">Ubicación</p>
                  <p class="f-12"><span><i class="fa fa-map-marker pr-2"></i></span><?= $consultantTime->location ?></p>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- appointment-sec-end-->
@stop