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
                  <a href="/"><img src="/frontend/assets/img/Original.png" alt="Logo - PSICOLOGOS VIBEMAR"></a>
               </div>
               <div class="nav-items float-right w-75">
                  <div class=" nav-links float-right">
                     <a href="/questions-responses" class="text-white">Pregunta al psicólogo</a>
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
                  <h3>BUSCA TU PSICÓLOGO POR CIUDAD</h3>
                  <p>Elige el psicólogo que mas te guste</p>
                  <!-- Search form -->
                  <div class="w-100 text-center">
                     <div class="form-part">
                        <!-- <form class="form-inline homePageSearch" action="/searchBySpecialty" method="get">
                           <input class="searchByInput form-control" type="text" name="searchByInput" />
                           <button type="submit" class="btn bg-blue text-white">Buscar</button>
                        </form> -->
                        <form class="form-inline homePageSearch" action="/searchBySpecialty" method="get">
                        <div class="row w-100">
                           <div class="col-5 mb-3">
                              <div>
                                 <input class="searchByInput_all_professional" type="text" name="searchByInput" placeholder="especialidad o apellido" />
                              </div>
                           </div>
                           <div class="col-lg-4 col-md-4 col-sm-4 col-11 item-2">
                              <div>
                                 <?php if ($allCitiesSearch): ?>
                                    <select class="js-example-basic-single searchByCity" name="city">
                                      <option value="" hidden disabled selected>ciudad o comuna</option>
                                    <?php foreach ($allCitiesSearch as $key => $city): ?>
                                         <option value="<?= $city->name; ?>"><?= $city->name; ?></option>
                                    <?php endforeach ?>
                                 <?php endif ?>
                                    </select>
                              </div>
                           </div>
                           <div class="col-2 text-center mt-1">
                              <div>
                                 <button type="submit" class="btn bg-blue text-white"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                              </div>
                           </div>
                        </div><!-- /.row -->
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            
         </div>
      </div>
      <!-- Carousel-end -->
      <!-- reserva section -->
      <section>
         <div class="row align-items-center bg-blue">
            <div class="col-lg-6 h-100 reserva-content order-2 order-lg-1 py-lg-0 py-5">
               <h2 class="text-white">Encuentra a los mejores psicólogos en Vibemar</h2>
               <hr class="border_bottom">
               <p class="text-white">Pide hora en línea, revisa las opiniones de los profresionales, hazle preguntas, cotiza las mejores opciones</p>
               <div class="reserva-button">
                  <a href="/all_professional"><button class="btn text-white bg-green">Reservar hora</button></a>
               </div>
            </div>
            <div class="reserva-image col-lg-6 pr-0 pl-0 order-1 order-lg-2">
               <img src="/frontend/assets/img/reserva.jpg" alt="" class="img-fluid">
            </div>
         </div>
      </section>
      <!-- reserva-section ends -->
      <!-- Testimonials -->
      <section class="testimonial-area">
         <div class="container">
            <div class="testimonial-upper-div">
               <div class="testimonial-head text-center"></div>
               <div class="testimonial-sub-text text-center"></div>
            </div>
            <div class="row testimonials">
               <!--Start single item-->
               <div class="col-sm-4">
                  <div class="single-testimonial-item text-center">
                     <div class="img-holder">
                        <a href="/blog_article"><img src="/frontend/assets/img/picture1.png" alt="ARTICULOS DE NUESTROS PSICÓLOGOS"></a>
                     </div>
                     <div class="text-holder">
                        <h5>ARTICULOS DE NUESTROS PSICÓLOGOS</h5>
                     </div>
                     <div class="name">
                        <p>Acá podrás leer artículos muy interesantes realizados por los propios psicólogos de nuestro portal</p>
                     </div>
                  </div>
               </div>
               <!--End single item-->
               <!--Start single item-->
               <div class="col-sm-4">
                  <div class="single-testimonial-item text-center">
                     <div class="img-holder">
                        <a href="/frequently"><img src="/frontend/assets/img/picture2.png" alt="PREGUNTA A NUESTROS PSICÓLOGOS"></a>
                     </div>
                     <div class="text-holder">
                        <h5>PREGUNTA A NUESTROS PSICÓLOGOS</h5>
                     </div>
                     <div class="name">
                        <p>¿Tienes dudas de tratamientos o necesitas saber algo? pregúntale a nuestros psicólogos Vibemar</p>
                     </div>
                  </div>
               </div>
               <!--End single item-->
               <!--Start single item-->
               <div class="col-sm-4">
                  <div class="single-testimonial-item text-center">
                     <div class="img-holder">
                        <a href="/contact_us#contact_id_us"><img src="/frontend/assets/img/picture3.png" alt="CONTÁCTANOS"></a>
                     </div>
                     <div class="text-holder">
                        <h5>CONTÁCTANOS</h5>
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
                        <li class="p-1"><b>Por región</b></li>
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
                              <li class="d-inline-block float-left text-white"><a href="/blog_article">Blog de salud </a>|</li>
                              <li class="d-inline-block float-left text-white"><a href="#">Uso y política de privacidad</a></li>
                           </ul>
                        </div>
                     </div>
                     <div class="brand float-right w-25 order-1">
                        <a href="/"><img src="/frontend/assets/img/Original.png" alt="Logo - PSICOLOGOS VIBEMAR"></a>
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