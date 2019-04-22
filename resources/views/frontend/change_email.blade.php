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
                     <div class="input-group">
                        <input class="form-control border-0 py-2" type="search" value="buscar">
                        <div class="input-group-append bg-white">
                           <button class="btn bg-white">
                           <i class="fa fa-search"></i>
                           </button>
                        </div>
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
                     <span class="point-1">5</span>
                     <span class="point-1-head">
                        <h4>Validación de su cuenta en psicologos</h4>
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
                        <input type="email" name="email" class="form-control email mb-4" value="{{ old('email') }}" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required />
                        <button class="btn btn-info" type="submit">Cambiar e-mail</button>
                        &nbsp; O &nbsp;
                        <a href="/userlogin"><button class="btn btn-info" type="button">Iniciar sesión</button></a>
                     </form>
                  </li>
               </ul>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="support">
               <h3>Apoyo</h3>
               <p>Si tienes alguna duda, contacta con psicologos</p>
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
                        <li class="d-inline-block float-left text-white"><a href="/frequently">Preguntas frecuentes </a>|</li>
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
<script src="/frontend/assets/js/custom.js"></script>
</body>
</html>