<?php $user = Auth::user(); ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>@yield('title')</title>
      <link rel="stylesheet" href="/frontend/assets/css/bootstrap.min.css">
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
                  <p>Elige tu médico, consulta las opiniones y reserva tu cita</p>
                  <!-- Search form -->
                  <div class="form-search text-center">
                     <div class="form-part">
                        <form class="form-inline">
                           <input class="form-control form-control-sm  search-input" type="text" placeholder="Search" aria-label="Search">
                           <button class="btn bg-blue text-white"><a href="#" class="text-white ">Search</a></button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <div class="carousel-item ">
               <img class="d-block w-100" src="/frontend/assets/img/slider.jpg" alt="First slide">
               <div class="carousel-caption d-md-block ">
                  <h3>Estás en buenas manos.</h3>
                  <p>Elige tu médico, consulta las opiniones y reserva tu cita</p>
                  <!-- Search form -->
                  <div class="form-search text-center">
                     <div class="form-part">
                        <form class="form-inline">
                           <input class="form-control form-control-sm  search-input" type="text" placeholder="Search" aria-label="Search">
                           <button class="btn bg-blue text-white"><a href="#" class="text-white ">Search</a></button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <div class="carousel-item">
               <img class="d-block w-100" src="/frontend/assets/img/slider.jpg" alt="First slide">
               <div class="carousel-caption d-md-block ">
                  <h3>Estás en buenas manos.</h3>
                  <p>Elige tu médico, consulta las opiniones y reserva tu cita</p>
                  <!-- Search form -->
                  <div class="form-search text-center">
                     <div class="form-part">
                        <form class="form-inline">
                           <input class="form-control form-control-sm  search-input" type="text" placeholder="Search" aria-label="Search">
                           <button class="btn bg-blue text-white"><a href="#" class="text-white ">Search</a></button>
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
                  <div class="col-lg-3">
                     <article>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente doloribus distinctio adipisci repudiandae delectus, illum quos eum eos explicabo dolor voluptate velit nesciunt! Ex quisquam nihil harum in amet eum.</article>
                  </div>
                  <div class="col-lg-3">
                     <ul class="link-pages ">
                        <li><a href="" class="text-white">Home</a></li>
                        <li><a href="" class="text-white">Home</a></li>
                        <li><a href="" class="text-white">Home</a></li>
                        <li><a href="" class="text-white">Home</a></li>
                        <li><a href="" class="text-white">Home</a></li>
                     </ul>
                  </div>
                  <div class="col-lg-3">
                     <h3>Contact</h3>
                     <div class="info">
                        <ul class="list-unstyled">
                           <li>
                              <dt class="d-inline-block">Address:</dt>
                              <dd class="d-inline-block">pksol</dd>
                           </li>
                           <li>
                              <dt class="d-inline-block">Contact</dt>
                              <dd class="d-inline-block">pksol</dd>
                           </li>
                           <li>
                              <dt class="d-inline-block">Email:</dt>
                              <dd class="d-inline-block">pksol</dd>
                           </li>
                           <li>
                              <a href="" class="text-white"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                              <a href="" class="text-white"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                              <a href="" class="text-white"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
                              <a href="" class="text-white"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-lg-3">
                     <h3>Recent Tweets</h3>
                     <ul class="tweets">
                        <li class="list-unstyled d-inline-block">
                           <i class="fa fa-twitter d-inline-block" aria-hidden="true"></i>
                           <dd class="float-right"><a href="" class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde iste ipsa eaque nesciunt harum consequatur numquam </a></dd>
                        </li>
                        <li class="list-unstyled d-inline-block">
                           <i class="fa fa-twitter d-inline-block" aria-hidden="true"></i>
                           <dd class="float-right"><a href="" class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde iste ipsa eaque nesciunt harum consequatur numquam </a></dd>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="footer-bottom bg-green">
            <div class="terms-and-conditions text-center">
               <p class="text-white m-0">Copyrights Rights Reserved<i class="fa fa-copyright" aria-hidden="true"></i>2007-2019</p>
            </div>
         </div>
      </footer>
      <!-- Footer Section End -->
      <script src="/frontend/assets/js/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="/frontend/assets/js/bootstrap.min.js"></script>
   </body>
</html>