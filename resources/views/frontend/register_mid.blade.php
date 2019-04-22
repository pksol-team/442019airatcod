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
      <!-- Main Content -->
      <!-- Registration-sec -->
      <div class="container">
         <div class="row">
            <div class="col-lg-12 my-5">
            <form action="/register_doctor" method="post" id="postSpecialtyForm">
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <input type="hidden" name="first_name" value="<?= $inputFields['first_name'] ?>">
               <input type="hidden" name="last_name" value="<?= $inputFields['last_name'] ?>">
               <input type="hidden" name="city" value="<?= $inputFields['city'] ?>">
               <input type="hidden" name="forecast" value="<?= $inputFields['forecast'] ?>">
               <input type="hidden" value="<?= $inputFields['gender'] ?>" name="gender">
               <input type="hidden" name="specialty" class="specialty_array">
               <input type="hidden" name="specialtyName" class="specialtyName">

               <div class="about-patients">
                  <div class="patients-head">
                     <h3 class="f-38 font-colr-green">Seleccione su especialidad</h3>
                  </div>
                  <hr>
                  <ul class="list-unstyled row text-center mb-3">
                     <?php if ($allSpecialities != NULL): ?>
                        <?php foreach ($allSpecialities as $key => $specialty): ?>
                           <li class="d-inline-block col-lg-6 text-left">
                              <input data-name="{{ $specialty->name }}" class="mr-2" type="checkbox" name="selectspecialty" value="{{ $specialty->id }}" /><h6 class="d-inline-block f-size">{{ $specialty->name }}</h6>
                           </li>
                        <?php endforeach ?>
                     <?php endif ?>
                  </ul>
               </div>
               <div class="note">
                  <button type="submit" class="btn btn-success">Enviar</button>
               </div>
            </form>
            </div>
         </div>
      </div>
      </div>
      <!-- registration-sec-end -->
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
      <script src="/frontend/assets/js/select2.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
      <script src="/frontend/assets/js/custom.js"></script>
   </body>
</html>