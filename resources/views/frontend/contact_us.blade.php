@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- Contact-us Sec -->
<section class="contact-us">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            @if(session()->has('message'))
                <div class="alert alert-success mt-4">
                    {!! session()->get('message') !!}
                </div>
            @endif
            <div class="who-are-we-sec my-5">
               <div class="who-are-we-head text-center">
                  <h2>Who we are and what we do</h2>
               </div>
               <div class="who-are-we-desc text-center">
                  <p class="f-22">Doctoralia is the   <strong>   world's leading platform </strong> that connects health professionals with patients, transforming and improving the relationship between them.</p>
               </div>
               <div class="who-are-we-img">
                  <img src="/frontend/assets/img/contact-us.jpg" alt="" class="w-100">
               </div>
               <div class="who-we-are-text text-center">
                  <p class="f-22">Ofrecemos <strong> servicios que acercan la salud a los usuarios, </strong> dándoles un espacio donde preguntar, opinar y encontrar al profesional de la salud que mejor se adapte a sus necesidades.</p>
               </div>
            </div>
         </div>
      </div>
      <hr>
   </div>
   <div class="container">
      <div class="row">
         <div class="col-lg-12 my-5">
            <div class="formamos-head text-center my-4">
               <h3>¡Formamos un gran equipo!</h3>
            </div>
            <div class="formas-img">
               <img src="/frontend/assets/img/forma-img.jpg" alt="" class="w-100">
            </div>
            <div class="row my-5">
               <div class="col-lg-4">
                  <div class="formas-officer">
                     <img src="/frontend/assets/img/david.png" alt="" class="w-100">
                  </div>
                  <div class="formas-social-icon">
                     <span class="fa fa-linkedin linkdin-icon-color"></span>
                  </div>
                  <div class="figure-cap text-center my-5">
                     <figcaption>
                        <Strong class="f-18">  Albert Armengol </Strong>
                        <p class="font-weight-bold py-3">COO</p>
                     </figcaption>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="formas-officer">
                     <img src="/frontend/assets/img/albert.png" alt="" class="w-100">
                  </div>
                  <div class="formas-social-icon">
                     <span class="fa fa-linkedin linkdin-icon-color d-block my-2"></span>
                     <span class="fa fa-twitter twitter-icon-color d-block"></span> 
                  </div>
                  <div class="figure-cap text-center my-5">
                     <figcaption>
                        <Strong class="f-18">  Albert Armengol </Strong>
                        <p class="font-weight-bold py-3">CEO</p>
                     </figcaption>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="formas-officer">
                     <img src="/frontend/assets/img/fredi.png" alt="" class="w-100">
                  </div>
                  <div class="formas-social-icon">
                     <span class="fa fa-linkedin linkdin-icon-color d-block my-2"></span>
                     <span class="fa fa-twitter twitter-icon-color d-block"></span> 
                  </div>
                  <div class="figure-cap text-center my-5">
                     <figcaption class="text-center">
                        <Strong class="f-18">  Albert Armengol </Strong>
                        <p class="font-weight-bold py-3"> Global Business Development</p>
                     </figcaption>
                  </div>
               </div>
            </div>
            <div class="formas-desc-pro text-center">
               <p>En 2007, los fundadores de Doctoralia, dos médicos y un tecnólogo, vieron que millones de pacientes usaban la red para resolver necesidades relacionadas con la salud, y que a los profesionales les faltaban las herramientas para llegar a ellos. Años después los resultados hablan por sí mismos y hoy seguimos trabajando para ofrecer más soluciones para conectar pacientes con profesionales.</p>
            </div>
         </div>
      </div>
      <hr>
   </div>
   <div class="container my-5">
      <div class="row">
         <div class="col-lg-4 col-md-12">
            <div class="contactar-con-Doctoralia">
               <div class="contactar-con-Doctoralia-head text-center">
                  <h3>Contactar-con-Doctoralia</h3>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-4">
            <div class="contactar-con-Doctoralia-img">
               <img src="/frontend/assets/img/office_location.png" alt="">
            </div>
         </div>
         <div class="col-lg-4 col-md-6 col-sm-6 col-6">
            <div class="doctoralia-internet clearfix border-right">
               <strong>Doctoralia Internet S.L.</strong>
               <div class="doctoralia-internet-items">
                  <ul class="list-unstyled">
                     <li>
                        <div class="map-icon-area w-11 float-left">
                           <span><i class="fa fa-map-marker font-colr-green f-38" aria-hidden="true"></i></span>
                        </div>
                        <div class="address float-left">
                           <p class="d-inline-block">Josep Pla 2, <br> B2 08019 Barcelona (Spain) </p>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="col-lg-4 col-md-6 col-sm-6 col-6">
            <div class="class-social-list-icon">
               <ul class="list-unstyled">
                  <li>
                     <a href="{{ route('facebook.login') }}" class="btn btn-block btn-social btn-twitter">
                     <span class="fa fa-facebook fb-icon-color"></span> Sign in with Facebook
                     </a>
                  </li>
               </ul>
            </div>
         </div>
      </div>
      <hr>
      <div class="row my-5">
         <div class="col-lg-12">
            <div class="do-you-want-to-contact-us">
               <span><i class="fa fa-envelope"></i></span>
               <p class="d-inline-block"><strong>Hello! Do you want to contact us? Select the reason in the drop-down and we will respond as soon as possible.</strong></p>
            </div>
            <div class="info-contact-us ml-5">
               <span><i class="fa fa-info-circle"></i></span>
               <p class="d-inline-block">* All fields are required.</p>
            </div>
            <div class="row">
               <div class="col-lg-8 offset-md-2">
                  <form action="contact_us_email" method="post">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <div class="row for-contact-label">
                        <div class="col-lg-4 text-right">
                           <label for="">Reason For Contact label</label>
                        </div>
                        <div class="col-lg-8">
                           <select class="form-control w-25" id="sel1" name="reason" required>
                              <option value="Press">Press</option>
                              <option value="Support">Support</option>
                              <option value="Business">Business</option>
                           </select>
                        </div>
                     </div>
                     <div class="row for-contact-label my-2">
                        <div class="col-lg-4 text-right">
                           <label for="">First name</label>
                        </div>
                        <div class="col-lg-8">
                           <input type="text" class="w-100 form-control" name="first_name" required>
                        </div>
                     </div>
                     <div class="row for-contact-label my-2">
                        <div class="col-lg-4 text-right">
                           <label for="">Sur name</label>
                        </div>
                        <div class="col-lg-8">
                           <input type="text" class="w-100 form-control" name="last_name" required>
                        </div>
                     </div>
                     <div class="row for-contact-label my-2">
                        <div class="col-lg-4 text-right">
                           <label for="">E-mail</label>
                        </div>
                        <div class="col-lg-8">
                           <input type="email" class="w-100 form-control" name="email" required>
                        </div>
                     </div>
                     <div class="row for-contact-label my-2">
                        <div class="col-lg-4 text-right">
                           <label for="">Comment</label>
                        </div>
                        <div class="col-lg-8">
                           <textarea id="" cols="30" rows="10" class="form-control" name="comment" required></textarea>
                        </div>
                     </div>
                     <div class="row for-contact-label my-2">
                        <div class="col-lg-4">
                           &nbsp;
                        </div>
                        <div class="col-lg-8">
                           <button type="submit" class="btn btn-primary">Submit</button>
                           <p class="my-2" > <small>By clicking "Send" you agree to <a href="#"> our Data Protection Policies</a></small></p>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- container -->
</section>
<!-- Contact-us sec -->
@stop