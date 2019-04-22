<?php $user = Auth::user(); ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>@yield('title')</title>
      <link rel="stylesheet" href="/frontend/assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="/frontend/assets/css/select2.min.css"/>
      <link rel="stylesheet" href="/frontend/assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="/frontend/assets/css/style.css">
   </head>
   <body>
      <!-- Header Section -->
      <div class="header-sec">
         <div class="header-nav w-100">
            <div class="container">
               <div class="brand float-left w-25">
                  <a href="/"><img src="/frontend/assets/img/Original.png" alt="Logo - Doctaria"></a>
               </div>
               <div class="nav-items float-right w-75">
                  <div class=" nav-links float-right">
                     <a href="#" class="text-white">¿Es un profesional de la salud?</a>
                     <?php if (Auth::check() != true): ?>
                     <button class="btn bg-green"><a href="/register_doctor_init" class="text-white">Registrarme</a></button>
                     <button class="btn bg-blue text-white"><a href="/userlogin" class="text-white">Iniciar sesión</a></button>
                     <?php else: ?>
                        <?php if (Auth::user()->type == 'patient'): ?>
                           <button class="btn bg-blue text-white"><a href="/my_data" class="text-white"><?php echo $user->name; ?></a></button>
                        <?php else: ?>
                           <button class="btn bg-blue text-white"><a href="/doctor_full_profile/<?= $user->hash_key; ?>" class="text-white"><?php echo $user->name; ?></a></button>
                        <?php endif ?>
                     <?php endif ?>
                  </div>
               </div>
            </div>
         </div>
         <!-- nav-end -->
      </div>
      <!-- Header End -->
      <!-- Carousel start -->
      <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
         <div class="carousel-inner">
            <div class="carousel-item active">
               <img class="d-block w-100" src="/frontend/assets/img/slider.jpg" alt="First slide">
               <div class="carousel-caption d-md-block ">
                  <h3>Estás en buenas manos.</h3>
                  <p>Elige tu médico  y reserva tu cita</p>
                  <!-- Search form -->
                  <div class="form-search text-center">
                     <div class="form-part">
                        <form class="form-inline homePageSearch" action="/searchBySpecialty" method="get">
                           <input class="searchByInput form-control" type="text" name="searchByInput" />
                           <button type="submit" class="btn bg-blue text-white">Buscar</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <!-- <div class="carousel-item ">
               <img class="d-block w-100" src="/frontend/assets/img/slider.jpg" alt="First slide">
               <div class="carousel-caption d-md-block ">
                  <h3>Estás en buenas manos.</h3>
                  <p>Elige tu médico, consulta las opiniones y reserva tu cita</p>
                  <div class="form-search text-center">
                     <div class="form-part">
                        <form class="form-inline">
                           <input class="form-control form-control-sm  search-input" type="text" placeholder="Search" aria-label="Search">
                           <button class="btn bg-blue text-white"><a href="#" class="text-white ">Search</a></button>
                        </form>
                     </div>
                  </div>
               </div>
            </div> -->
            <!-- <div class="carousel-item">
               <img class="d-block w-100" src="/frontend/assets/img/slider.jpg" alt="First slide">
               <div class="carousel-caption d-md-block ">
                  <h3>Estás en buenas manos.</h3>
                  <p>Elige tu médico, consulta las opiniones y reserva tu cita</p>
                  <div class="form-search text-center">
                     <div class="form-part">
                        <form class="form-inline">
                           <input class="form-control form-control-sm  search-input" type="text" placeholder="Search" aria-label="Search">
                           <button class="btn bg-blue text-white"><a href="#" class="text-white ">Search</a></button>
                        </form>
                     </div>
                  </div>
               </div>
            </div> -->
         </div>
      </div>
      <!-- Carousel-end -->
      <!-- reserva section -->
      <section>
         <div class="row align-items-center bg-blue">
            <div class="col-lg-6 h-100 reserva-content order-2 order-lg-1 py-lg-0 py-5">
               <h2 class="text-white">Reserva City Hoy</h2>
               <hr class="border_bottom">
               <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi dolorem tempore magni, vel quidem odit labore itaque nam, rem saepe ducimus, dolore. Dolores voluptatibus corporis, tenetur. Cumque voluptates debitis iusto.</p>
               <div class="reserva-button">
                  <button class="btn text-white bg-green">Reserva</button>
               </div>
            </div>
            <div class="reserva-image col-lg-6 pr-0 pl-0 order-1 order-lg-2">
               <img src="/frontend/assets/img/reserva.jpg" alt="" class="img-fluid">
            </div>
         </div>
      </section>
      <!-- reserva-section ends -->
      <!-- Doctoralia Section -->
      <section class="doctoralia-section">
         <div class="container">
            <div class="row doctoralia">
               <div class="col-lg-4 col-md-4 col-sm-4 doctoralia-first-col">
                  <h2>Doctorolia En aplasou</h2>
                  <hr class="doctoralia-border_bottom">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt perspiciatis tenetur voluptas corporis, exercitationem amet! Illo rem impedit sed cumque ab iste, quod eveniet, odio quibusdam a tempora voluptates aspernatur.</p>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-4 doctoralia-sec-col">
                  <!-- <div class="col-sm-4 float-left">
                     </div> -->
                  <i class="fa fa-phone" aria-hidden="true"></i>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-4 doctoralia-third-col">
                  <i class="fa fa-envelope" aria-hidden="true"></i>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
               </div>
            </div>
         </div>
      </section>
      <!-- Doctoralia Section Ends -->
      <!-- Centro section -->
      <section>
         <div class="row align-items-center bg-green-light">
            <div class="reserva-image col-lg-6 pr-0 pl-0 order-1 order-lg-2">
               <img src="/frontend/assets/img/centro medico (2).jpg" alt="" class="img-fluid h-100">
            </div>
            <div class="col-lg-6 h-100 reserva-content order-2 order-lg-1 py-lg-0 py-5">
               <h2 class="text-white">Reserva City Hoy</h2>
               <hr class="border_bottom">
               <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi dolorem tempore magni, vel quidem odit labore itaque nam, rem saepe ducimus, dolore. Dolores voluptatibus corporis, tenetur. Cumque voluptates debitis iusto.</p>
               <div class="reserva-button">
                  <button class="btn text-white bg-green">Reserva</button>
               </div>
            </div>
         </div>
      </section>
      <!-- centro-section ends -->
      <!-- Testimonials -->
      <section class="testimonial-area">
         <div class="container">
            <div class="testimonial-upper-div">
               <div class="testimonial-head text-center">
                  <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h2>
                  <hr class="testimonial-border_bottom">
               </div>
               <div class="testimonial-sub-text text-center">
                  <p>veo lo que hemos becho por otros</p>
               </div>
            </div>
            <div class="row testimonials">
               <!--Start single item-->
               <div class="col-sm-4">
                  <div class="single-testimonial-item text-center">
                     <div class="img-holder">
                        <img src="/frontend/assets/img/atip.png" alt="Awesome Image">
                     </div>
                     <div class="text-holder">
                        <h3>Nicol Dreams</h3>
                        <p>Ladies, meet your new hero. Men</p>
                     </div>
                     <div class="name">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum cumque animi eos itaque, labore</p>
                     </div>
                  </div>
               </div>
               <!--End single item-->
               <!--Start single item-->
               <div class="col-sm-4">
                  <div class="single-testimonial-item text-center">
                     <div class="img-holder">
                        <img src="/frontend/assets/img/atip.png" alt="Awesome Image">
                     </div>
                     <div class="text-holder">
                        <h3>Nicol Dreams</h3>
                        <p>Ladies, meet your new hero. Men</p>
                     </div>
                     <div class="name">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum cumque animi eos itaque, labore</p>
                     </div>
                  </div>
               </div>
               <!--End single item-->
               <!--Start single item-->
               <div class="col-sm-4">
                  <div class="single-testimonial-item text-center">
                     <div class="img-holder">
                        <img src="/frontend/assets/img/atip.png" alt="Awesome Image">
                     </div>
                     <div class="text-holder">
                        <h3>Nicol Dreams</h3>
                        <p>Ladies, meet your new hero. Men</p>
                     </div>
                     <div class="name">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum cumque animi eos itaque, labore</p>
                     </div>
                  </div>
               </div>
               <!--End single item-->
            </div>
         </div>
      </section>
      <!-- Testimonial ends -->
      <!-- footer Start -->
      <footer>
         <div class="footer-items clearfix">
            <div class="container">
               <div class="row">
                  <div class="col-12 text-white">
                     <h3><i class="fa fa-bandcamp mr-3" aria-hidden="true"></i>Encuentra tu especialista</h3>
                  </div><!-- /.col-12 -->
                  <div class="col-lg-4">
                     <ul class="link-pages list-unstyled">
                        <li class="p-1"><b>Por especialidad</b></li>
                        <?php if ($allSpecialitiesBottom): ?>
                           <?php foreach ($allSpecialitiesBottom as $key => $allSpecialy): ?>
                              <li class="p-1"><a href="/all_professional?specialty=<?= $allSpecialy->id; ?>&city=&forecast=&searchByInput=" class="text-white"><?= $allSpecialy->name; ?></a></li>
                           <?php endforeach ?>
                        <?php endif ?>
                        <li class="p-1"><a href="/viewFull/Specialty"><b>Ver todo</b></a></li>
                     </ul>
                  </div>
                  <div class="col-lg-4">
                     <ul class="link-pages list-unstyled">
                        <li class="p-1"><b>Por ciudad</b></li>
                        <?php if ($allCities): ?>
                           <?php foreach ($allCities as $key => $allCity): ?>
                              <li class="p-1"><a href="/all_professional?specialty=&city=<?= $allCity->name; ?>&forecast=&searchByInput=" class="text-white"><?= $allCity->name; ?></a></li>
                           <?php endforeach ?>
                        <?php endif ?>
                        <li class="p-1"><a href="/viewFull/City"><b>Ver todo</b></a></li>
                     </ul>
                  </div>
                  <div class="col-lg-4">
                     <ul class="link-pages list-unstyled">
                        <li class="p-1"><b>Por pronóstico</b></li>
                        <?php if ($allForecasts): ?>
                           <?php foreach ($allForecasts as $key => $allForecast): ?>
                              <li class="p-1"><a href="/all_professional?specialty=&city=&forecast=<?= $allForecast->name; ?>&searchByInput=" class="text-white"><?= $allForecast->name; ?></a></li>
                           <?php endforeach ?>
                        <?php endif ?>
                        <li class="p-1"><a href="/viewFull/Forecast"><b>Ver todo</b></a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
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
      </footer>
      <!-- Footer Section End -->
      <script src="/frontend/assets/js/jquery-3.3.1.min.js"></script>
      <script src="/frontend/assets/js/bootstrap.min.js"></script>
      <script src="/frontend/assets/js/yearpicker.js"></script>
      <script src="/frontend/assets/js/select2.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <script src="/frontend/assets/js/croppie.js"></script>
      <script src="/frontend/assets/js/custom.js"></script>
      <script>
         jQuery(document).ready(function($) {
             $('.js-example-basic-single').select2();
         });
      </script>
   </body>
</html>