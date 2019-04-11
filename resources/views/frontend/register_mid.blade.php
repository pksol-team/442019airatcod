<?php $user = Auth::user(); ?>
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
      <!-- Main Content -->
      <!-- Registration-sec -->
      <div class="container">
         <div class="row">
            <div class="col-lg-12 my-5">
            <form action="/register_doctor" method="post" id="postSpecialtyForm">
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <input type="hidden" name="first_name" value="<?= $inputFields['first_name'] ?>">
               <input type="hidden" name="last_name" value="<?= $inputFields['last_name'] ?>">
               <input type="hidden" value="<?= $inputFields['gender'] ?>" name="gender">
               <input type="hidden" name="specialty" class="specialty_array">

               <div class="about-patients">
                  <div class="patients-head">
                     <h3 class="f-38 font-colr-green">Select your speciality</h3>
                  </div>
                  <hr>
                  <ul class="list-unstyled row text-center mb-3">
                     <?php if ($allSpecialities != NULL): ?>
                        <?php foreach ($allSpecialities as $key => $specialty): ?>
                           <li class="d-inline-block col-lg-6 text-left">
                              <input class="mr-2" type="checkbox" name="selectspecialty" value="{{ $specialty->id }}" /><h6 class="d-inline-block f-size">{{ $specialty->name }}</h6>
                           </li>
                        <?php endforeach ?>
                     <?php endif ?>
                  </ul>
               </div>
               <div class="note">
                  <button type="submit" class="btn btn-success">Submit</button>
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
                              <li class="d-inline-block float-left text-white"><a href="#">About US</a>|</li>
                              <li class="d-inline-block float-left text-white"><a href="#">Contact </a>|</li>
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