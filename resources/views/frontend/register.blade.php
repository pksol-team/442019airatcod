<?php $user = Auth::user(); ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title><?= $title ?> - psicologos</title>
      <link rel="stylesheet" href="/frontend/assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="/frontend/assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="/frontend/assets/css/croppie.css">
      <link rel="stylesheet" href="/frontend/assets/css/style.css">
   </head>
   <body>
<!-- Header Section -->
<header>
   <div class="row head header-sec bg-green">
      <div class="login-header w-100">
         <div class="container row">
            <div class="col-lg-4">
              <div class="brand">
                <a href="/"><img src="/frontend/assets/img/Original.png" alt="Logo - psicologos"></a>
              </div>
            </div>
            <div class="col-lg-4">
               <div class="search-box float-left">
                  <div class="input-group d-block">
                     <form class="homePageSearch d-flex" action="/searchBySpecialty" method="get">
                        <input class="searchByInput form-control border-0 py-2" type="text" name="searchByInput" placeholder="buscar">
                        <div class="input-group-append bg-white" style="border-radius: 5px; margin-left: -6px;">
                           <button type="submit" class="btn bg-white">
                           <i class="fa fa-search"></i>
                           </button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <div class="col-lg-4 login-header-items float-right w-75">
               <div class="login-header-links registery-items-links float-right">
                  <ul class="list-unstyled">
                     <?php if (Auth::check() != true): ?>
                      <li class="d-inline-block float-left text-white">
                        <button class="btn bg-blue text-white"><a href="/userlogin" class="text-white">Iniciar sesión</a></button>
                      </li>
                     <?php endif ?>
                     
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</header>
<!-- Header End -->
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
                     <span class="point-1">3</span>
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
                  <input type="hidden" name="first_name" value="<?= $inputFields['first_name'] ?>">
                  <input type="hidden" name="last_name" value="<?= $inputFields['last_name'] ?>">
                  <input type="hidden" name="city" value="<?= $inputFields['city'] ?>">
                  <input type="hidden" name="forecast" value="<?= $inputFields['forecast'] ?>">
                  <input type="hidden" value="<?= $inputFields['gender'] ?>" name="gender">
                  <input type="hidden" value="<?= $inputFields['specialty'].',' ?>" name="specialty">
                  <input type="hidden" value="<?= $inputFields['sub_specialty']; ?>" name="sub_specialty">
                  <div class="row">
                     <div class="col-lg-3 col-md-2 col-sm-4 col-3 offset-lg-2 label-sec text-right">
                        <label for="" class="email text-right">Número RUT</label>
                     </div>
                     <div class="col-lg-7 col-md-10 col-sm-8 col-9 login_input-sec">
                        <input type="text" class="form-control" id="RUT_number" name="RUT_number" value="{{ old('RUT_number') }}" placeholder="Entrar Número RUT" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required>
                        <p class="textHelp f-size">Es <strong>imprescindible</strong> para que podamos validar su registro</p>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-5 col-md-2 col-sm-4 col-3 password">
                        <label for="" class="mt-2 pt-2 text-right">Su teléfono celular con prefijo local</label>
                     </div>
                     <div class="col-lg-7 col-md-10 col-sm-8 col-9 login_input-sec">
                        <input type="text" class="form-control mt-2 w-50" id="exampleInputcontact" name="contact" value="{{ old('contact') }}" placeholder="Entrar en contacto" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required>
                        <p class="textHelp f-size"><strong>9 DÍGITOS</strong>. No será visible. Sólo será utilizado por el departamento de soporte de Doctoralia.</p>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-3 col-md-2 col-sm-4 col-3 offset-lg-2 label-sec text-right">
                        <label for="" class="mt-2 pt-2 text-right">correo electrónico</label>
                     </div>
                     <div class="col-lg-7 col-md-10 col-sm-8 col-9 login_input_email-sec">
                        <input type="email" class="form-control mt-2 w-100" id="email" name="email" value="{{ old('email') }}" placeholder="Ingrese correo electrónico" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required>
                        <p class="textHelp f-size text-left">Enviaremos un email de confirmación a esta dirección</p>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-3 col-md-2 col-sm-4 col-3 offset-lg-2 label-sec text-right">
                        <label for="" class="mt-2 pt-2 text-right">Contraseña</label>
                     </div>
                     <div class="col-lg-7 col-md-10 col-sm-8 col-9 login_input_email-sec">
                        <input type="password" class="form-control mt-2 w-50" id="password" name="password" placeholder="Introducir la contraseña" minlength="6" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required>
                        <p class="textHelp f-size text-left">Para iniciar sesión en Doctoralia</p>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-3 col-md-2 col-sm-4 col-3 offset-lg-2 label-sec text-right">
                        <label for="password" class="mt-2 pt-2 text-right">Confirme contraseña</label>
                     </div>
                     <div class="col-lg-7 col-md-10 col-sm-8 col-9 login_input_email-sec">
                        <input type="password" class="form-control mt-2 w-50" id="confirm_password" name="confirm_password" placeholder="Introduzca la contraseña de confirmación" minlength="6" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required>
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
                           <p><strong>Derechos</strong> Acceso, rectificación, y supresion de los datos, asi como otros derechos de protección de datos expresados en la <a target="_blank" href="/">politica de privacidad</a>.</p>
                        </div>
                     </div>
                  </div>
                  <div class="acceptance">
                     <div class="first-terms-cond text-left">
                        <label>
	                        <input type="checkbox" name="" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required>
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
               <h3>Apoyo</h3>
               <p>Si tienes alguna duda, contacta con psicologos.</p>
               <a href="mailto:support-cl@doctorolia.com">support-cl@doctorolia.com</a>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- Main Content -->
      <footer>
         <div class="footer-sec">
            <!-- footer-sec-top-start -->
            <div class="row login header-sec bg-green-dark">
               <div class="login-footer w-100">
                  <div class="container">
                     <div class="login-footer-items float-left w-75 order-2">
                        <div class="login-footer-links float-left">
                           <ul class="list-unstyled">
                              <li class="d-inline-block float-left text-white"><a href="#">Sobre nosotros</a>|</li>
                              <li class="d-inline-block float-left text-white"><a href="/contact_us">Contacto </a>|</li>
                              <li class="d-inline-block float-left text-white"><a href="/frequently">Preguntas frecuentes</a>|</li>
                              <li class="d-inline-block float-left text-white"><a href="#">Blog de salud </a>|</li>
                              <li class="d-inline-block float-left text-white"><a href="#">Uso y política de privacidad</a></li>
                           </ul>
                        </div>
                     </div>
                     <div class="brand float-right w-25 order-1">
                        <a href="#"><img src="/frontend/assets/img/Original.png" alt=""></a>
                     </div>
                  </div>
               </div>
            </div>
            <!-- footer-sec-top-end -->
            <!-- footer-sec-bottom start -->
            <div class="footer-bottom bg-green">
               <div class="terms-and-conditions text-center">
                  <p class="text-white m-0 d-inline-block"><i class="fa fa-copyright" aria-hidden="true"></i>2019 psicologos Internet,SL</p>
                  <a href="#" class="text-white">Sobre Nosotros Contáctenos y Política de Privacidad</a>
               </div>
            </div>
         </div>
         <!-- footer-sec-bottom end -->
      </footer>
      <script src="/frontend/assets/js/jquery-3.3.1.min.js"></script>
      <script src="/frontend/assets/js/bootstrap.min.js"></script>
      <script src="/frontend/assets/js/yearpicker.js"></script>
      <script src="/frontend/assets/js/croppie.js"></script>
      <script src="/frontend/assets/js/select2.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
      <script src="/frontend/assets/js/custom.js"></script>
   </body>
</html>