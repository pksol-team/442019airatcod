@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')

<!-- appointment-sec-start -->
<section class="bg-lightgrey pb-3">
   <div class="container">
   <div class="row">
      <div class="col-lg-12 card bg-lightgrey d-flex align-self-center py-3">
         <h3 class="text-left align-middle">Booking Appointment</h3>
         <p>You are going to schedule an appointment for <strong>Monday, April 8, 2019 at 10:00</strong></p>
      </div>
   </div>
   <div class="row main-booking-part bg-white">
      <div class="col-lg-8 py-3">
         <form action="">
            <div class="row">
               <div class="col-lg-12 express-booking">
                  <ul class="list-unstyled">
                     <li class="sub-valid"><i class="fa fa-info bgg-green text-white express-acc" aria-hidden="true"></i>Express Booking with your <a href="#" class="pr-2">Doctaria Account</a>or<a href="#" class="pl-2">Facebook</a></li>
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
            <div class="displayonradio-checked" id="ifYes" style="display:none">
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
            </div>
            <!-- display on radio button checked -->
            <div class="row my-3">
               <div class="col-lg-4 text-right">
                  <label for="" class="text-right">Is it the first visit?</label>
               </div>
               <div class="col-lg-6">
                  <input type="radio" > <span class="pr-3">Yes</span>
                  <input type="radio" class="pl-3"> <span>Do not</span>
               </div>
            </div>
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
                  <label for="" class="text-right">Your last name</label>
               </div>
               <div class="col-lg-6">
                  <input type="text" class="form-control border-dark w-100">
               </div>
            </div>
            <div class="row my-3">
               <div class="col-lg-4 text-right">
                  <label for="" class="text-right">Your Email</label>
               </div>
               <div class="col-lg-6">
                  <input type="text" class="form-control border-dark w-75">
               </div>
            </div>
            <div class="row my-3">
               <div class="col-lg-4 text-right">
                  <label for="" class="text-right">Your cellphone</label>
               </div>
               <div class="col-lg-6">
                  <input type="text" class="form-control border-dark w-50">
                  <p><small>Check your data to make sure they can contact you.</small></p>
               </div>
            </div>
            <div class="row my-3">
               <div class="col-lg-4">
                  <label for="" class="text-right">Comments for the professional(optional)</label>
               </div>
               <div class="col-lg-6">
                  <textarea name="" id="" cols="42" rows="5" class="border-dark"></textarea>
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
                  <label><input type="checkbox" value="">
                  <span>Acepto las <a href="">condiciones de uso</a> la <a href="">política de privacidad</a> y el tratamiento de mis datos
                  </span>
                  </label>
               </div>
               <div class="sec-term-cond text-left">
                  <label>
                  <input type="checkbox" value="">
                  <span>
                  Me gustaría recibir notificaciones sobre nuevas citas, consejos y ofertas
                  </span>
                  </label>
               </div>
            </div>
            <div class="row my-3">
               <div class="col-lg-4">
                  &nbsp;
               </div>
               <div class="col-lg-6">
                  <button class="btn btn-primary px-4"> Submit </button>
                  <a href=""> Cancel Appointment</a>
               </div>
            </div>
         </form>
      </div>
      <div class="col-lg-4 booking-app-sidebar py-2">
         <div class=" row sidebar">
            <div class="col-lg-4">
               <img class="img-fluid" src="/upload/15548078125cac7c0403ecf.png" alt="Doctor Picture">
            </div>
            <div class="col-lg-8">
               <div class="doc-name">
                  <p class="mb-0">Aksana Silvankova</p>
                  <small class="title-color">Psychologist</small>
               </div>
            </div>
         </div>
         <hr>
         <div class=" row sidebar">
            <div class="col-lg-12">
               <div class="appointment-date">
                  <p class="mb-0 title-color">APPOINTMENT</p>
                  <p class="f-12"><span><i class="fa fa-calendar pr-2"></i></span>Monday, April 8, 2019 at 10:00</p>
               </div>
            </div>
         </div>
         <hr>
         <div class=" row sidebar">
            <div class="col-lg-12">
               <div class="appointment-loc">
                  <p class="mb-0 title-color">Location</p>
                  <p class="f-12"><span><i class="fa fa-map-marker pr-2"></i></span>Monday, April 8, 2019 at 10:00</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- appointment-sec-end-->
@stop