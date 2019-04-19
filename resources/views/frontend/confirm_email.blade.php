<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title><?= $title ?> - Doctaria</title>
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
                   <a href="/"><img src="/frontend/assets/img/Original.png" alt="Logo - Doctaria"></a>
                 </div>
               </div>
               <div class="col-lg-4">
                  <div class="search-box float-left">
                     <div class="input-group">
                        <input class="form-control border-0 py-2" type="search" value="search">
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
<?php $NewUser = DB::table('users')->WHERE('hash_key', Route::input('hash_key'))->first(); ?>
<section>
   <div class="container">
      <div class="row reg login-sec">
         <div class="col-lg-8">
            <div class="login-main-head">
               <h2 class="border-bottom">Registro <?= ($NewUser->type == 'doctor') ? 'de Professional' : NULL; ?></h2>
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
                  <li>
                     <i class="fa fa-arrow-right" aria-hidden="true"></i>Has Not the confirmation email arrive ?
                     <ul>
                        <li>The email <?= $NewUser->email ?>, is it correct? <a href="/change_register_email/<?= $NewUser->hash_key ?>">Change Email</a></li>
                        <li>If the email is correct, please check your spam folder</li>
                     </ul>
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
                        <li class="d-inline-block float-left text-white"><a href="#">About US</a>|</li>
                        <li class="d-inline-block float-left text-white"><a href="/contact_us">Contact </a>|</li>
                        <li class="d-inline-block float-left text-white"><a href="/frequently">Frequent questions </a>|</li>
                        <li class="d-inline-block float-left text-white"><a href="#">Health blog </a>|</li>
                        <li class="d-inline-block float-left text-white"><a href="#">Use and Privacy Policy</a></li>
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
            <p class="text-white m-0 d-inline-block"><i class="fa fa-copyright" aria-hidden="true"></i>2019 Doctrolia Internet,SL</p>
            <a href="#" class="text-white">About US Contact Us And Privacy Policy</a>
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