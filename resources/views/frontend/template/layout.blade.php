<?php use Illuminate\Support\Facades\DB; ?>
<?php use storage\framework\sessions; ?>
<?php $user = Auth::user(); ?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>@yield('title')- Doctaria</title>
      <link rel="stylesheet" type="text/css" href="/frontend/assets/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="/frontend/assets/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="/frontend/assets/css/yearpicker.css">
      <link rel="stylesheet" type="text/css" href="/frontend/assets/css/croppie.css">
      <link rel="stylesheet" type="text/css" href="/frontend/assets/css/dropzone.css">
      <link rel="stylesheet" type="text/css" href="/frontend/assets/css/select2.min.css"/>
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css"/>
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>
      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/css/bootstrap4-toggle.min.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
      <link rel="stylesheet" type="text/css" href="/frontend/assets/css/style.css">
   </head>
   <body>
      <!-- Header Section -->
      <header>        
        <div class="row header-sec bg-green">
           <div class="login-header w-100">
              <div class="container">
                 <div class="brand float-left w-25">
                    <a href="/"><img src="/frontend/assets/img/Original.png" alt="Logo - Doctaria"></a>
                 </div>
                 <div class="login-header-items float-right w-75">
                    <div class="login-header-links float-right">
                       <ul class="list-unstyled">
                          <?php if (Auth::check() != true): ?>
                          <li class="d-inline-block float-left text-white mr-4"><button class="btn bg-blue"><a href="/register_doctor_init" class="text-white">Registrarme</a></button></li>
                          <li class="d-inline-block float-left text-white"><button class="btn bg-blue"><a href="/userlogin" class="text-white">Iniciar sesión</a></button></li>
                          <?php endif ?>
                          <?php if (Auth::check() == true): ?>
                          <li class="d-inline-block float-left text-white"><?php echo $user->name; ?> |</li>
                          <li class="d-inline-block float-left text-white"><a href="/">Go to Home Page</a>|</li>
                          <li class="d-inline-block float-left text-white"><a href="/logout" onclick="return confirm('Are you sure want to Logout?')" >Logout</a></li>
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
      @yield('content')
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
      <script src="/frontend/assets/js/select2.min.js"></script>
      <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/js/bootstrap4-toggle.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js"></script>
      <script>
        $('#responsive').slick({
          dots: true,
          infinite: false,
          speed: 300,
          slidesToShow: 3,
          slidesToScroll: 1,
          responsive: [{
                breakpoint: 1024,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 3,
                  infinite: true,
                  dots: true
                }
              },
              {
              breakpoint: 770,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 1
                }
              },
              {
              breakpoint: 480,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  dots: false,
                }
              }
            ]
          });
      </script>
      <script src="/frontend/assets/js/custom.js"></script>

   </body>
</html>
