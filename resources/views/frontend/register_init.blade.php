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
            <div class="col-lg-7 my-5">
               <div class="about-patients">
                  <div class="patients-head">
                     <h3 class="f-38 font-colr-green">Empieza a llenar tu agenda con pacientes</h3>
                  </div>
                  <hr>
                  <div class="row patients-sub-info-sec-list-item">
                     <div class="col-lg-3 patient-info-sec-point-icon">
                        <img src="/frontend/assets/img/nineoutoften.PNG" alt="" class="w-100">
                     </div>
                     <div class="col-lg-9 patient-info-sec-point my-4">
                        <p>9 de cada 10 de nuestros usuarios <strong> recomendarían </strong> psicólogos a otro profesional de la salud. *</p>
                     </div>
                  </div>
                  <hr>
                  <div class="row patients-sub-info-third-list-item">
                     <div class="col-lg-3 patient-info-third-point-icon">
                        <img src="/frontend/assets/img/twom.PNG" alt="" class="w-100">
                     </div>
                     <div class="col-lg-9 patient-info-third-point my-4">
                        <p>La plataforma líder en Chile con más de <strong> 2 millones de usuarios mensuales.</strong></p>
                     </div>
                  </div>
                  <hr>
               </div>
               <div class="note">
                  <small>* Datos basados en un estudio realizado en septiembre de 2016.</small>
               </div>
            </div>
            <div class="col-lg-5 my-5">
               <div class="registration-doctors bg-grey py-4 border">
                  <div class="row registration-part">
                     <div class="col-lg-6 registration-part-head">
                        <h2 class="f-18">Inscripción gratuita</h2>
                     </div>
                     <div class="col-lg-6 not-professional text-right">
                        <a href="/patient_register" class="f-12">No soy profesional</a>
                     </div>
                  </div>
                  <div class="row doc-pro-registration">
                     <div class="col-lg-12 pro-head pl-4">
                        <!-- <div class="pro-head">
                           <input class="mr-2" type="radio" name="selectprofession" value="medico" /><h5 class="d-inline-block">Centro Medico</h5>
                        </div>
                        <div class="pro-sec-info">
                           <p>For health professionals who visit in one or several private consultations or medical centers.</p>
                        </div> -->
                        <!-- <div class="centro-medico pro-reg-sec d-none">
                           <form action="/register_doctor_mid" method="post">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <div class="doc-fname-label">
                                 <label for="">Nombre del centro médico</label>
                                 <input type="text" class="form-control" name="name_medical" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required>
                              </div>
                              <div class="doc-sname-label">
                                 <label for="">Región</label>
                                 <input type="text" class="form-control" name="region" required>
                              </div>
                              <div class="doc-sname-label">
                                 <label for="">Localidad</label>
                                 <input type="text" class="form-control" name="location" required>
                              </div>
                              <div class="doc-sname-label">
                                 <label for="">Dirección</label>
                                 <input type="text" class="form-control" name="direction" required>
                              </div>
                              <div class="doc-sname-label">
                                 <label for="">Teléfono</label>
                                 <input type="text" class="form-control" name="mobile" required>
                              </div>
                              <div class="doc-geneder-sec my-2">
                                 <div class="form-check-inline ml-3">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" value="Male" name="gender" checked>Male
                                    </label>
                                 </div>
                                 <div class="form-check-inline ml-4">
                                    <label class="form-check-label">
                                  <input type="radio" class="form-check-input" value="Female" name="gender">Female
                                    </label>
                                 </div>
                              </div>
                              <div class="register-button">
                                 <button type="submit" class="btn btn-primary w-100">REGISTER FOR FREE</button>
                              </div>
                           </form>
                           <div class="terms-conditions-doc-reg">
                              <a href="/patient_register">I am not a health professional, register as a patient</a>
                              <p><small>A team of experts validates all the records to <strong>ensure the veracity of the information.</strong></small></p>
                           </div>
                        </div> -->
                     </div>
                     <div class="col-lg-12 pro-head pl-4 professional_register_box">
                        <div class="pro-head">
                           <!-- <input class="mr-2" type="radio" name="selectprofession" value="professional" checked /> -->
                           <h5 class="d-inline-block">Profesional</h5>
                        </div>
                        <div class="pro-sec-info">
                           <p>Si quieres formar parte de Piscologos Vibemar rellena el siguiente formulario.</p>
                        </div>
                        <div class="centro-professional pro-reg-sec">
                           <form action="/register_doctor_mid" method="post">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <div class="doc-fname-label">
                                 <label for="first_name">Nombre</label>
                                 <input type="text" class="form-control" name="first_name" oninvalid="this.setCustomValidity('Por favor rellene este campo')" oninput="setCustomValidity('')" required>
                              </div>
                              <div class="doc-sname-label">
                                 <label for="last_name">Apellidos</label>
                                 <input type="text" class="form-control" name="last_name" oninvalid="this.setCustomValidity('Por favor rellene este campo')" oninput="setCustomValidity('')" required>
                              </div>
                              <div class="doc-sname-label">
                                 <label for="city">Región</label>
                                 <select class="form-control" name="city" oninvalid="this.setCustomValidity('Por favor rellene este campo')" oninput="setCustomValidity('')" required>
                                   <option value="" hidden></option>
                                    <?php if ($allCities): ?>
                                          <?php foreach ($allCities as $key => $city): ?>
                                               <option value="<?= $city->name; ?>"><?= $city->name; ?></option>
                                          <?php endforeach ?>
                                    <?php endif ?>
                                 </select>
                              </div>
                              <div class="doc-geneder-sec my-2">
                                 <div class="form-check-inline ml-3">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" value="Male" name="gender" checked>Hombre
                                    </label>
                                 </div>
                                 <div class="form-check-inline ml-4">
                                    <label class="form-check-label">
                                  <input type="radio" class="form-check-input" value="Female" name="gender">Mujer
                                    </label>
                                 </div>
                              </div>
                              <div class="register-button">
                                 <button type="submit" class="btn btn-primary w-100">REGISTRATE GRATIS</button>
                              </div>
                           </form>
                           <div class="terms-conditions-doc-reg">
                            <a href="/patient_register">¿No eres psicologo? Registrate como paciente.</a>
                            <p>garantizar la</p>
                            <p> <small>Nuestro equipo revisará tu información para garantizar la veracidad de esta..</small></p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
      <!-- registration-sec-end -->
      <!-- anas-html-sec-start -->
      <section class="part1 clearfix">
         <div id="part1" class="doctralia container">
            <h2>¿Por qué psicologos?</h2>
            <div class="row">
               <div class="patients col-lg-4 col-12">
                  <img id="arrow" class="d-none d-sm-none d-md-none d-lg-block" src="/frontend/assets/img/Untitled-7.png"><br>
                  <img id="icon" src="/frontend/assets/img/Untitled-4.png">
                  <h3>Más pacientes</h3>
                  <p>Miles de pacientes contactan a diario con un especialista a través de psicologos.</p>
               </div>
               <div class="patients1 col-lg-4 col-12">
                  <img id="arrow1" class="d-none d-sm-none d-md-none d-lg-block" src="/frontend/assets/img/Untitled-2.png"><br>
                  <img id="icon1" src="/frontend/assets/img/Untitled-1.png">
                  <h3>Más comodidad</h3>
                  <p>Sus pacientes podrán reservar cita al instante, durante las 24 horas, 7 días a la semana.</p>
               </div>
               <div class="patients2 col-lg-4 col-12">
                  <img id="arrow2" class="d-none d-sm-none d-md-none d-lg-block" src="/frontend/assets/img/Untitled-3.png"><br>
                  <img id="icon2" src="/frontend/assets/img/Untitled-78.png">
                  <h3>Más confianza</h3>
                  <p>Valoraciones y preguntas de pacientes harán que mejore su reputación online.</p>
               </div>
            </div>
         </div>
      </section>
      <section class="part2">
         <div id="part2" class="doctralia container">
            <h2>Nuestros clientes explican por qué confían en psicologos</h2>
            <div class="row">
               <div id="doctor" class="col-lg-4 col-12">
                  <figure>
                     <img id="docimg" src="/frontend/assets/img/female.jpg">
                  </figure>
                  <h3>Daniela Soledad Sanhueza</h3>
                  <p class="speciality">Psicóloga, Providencia</p>
                  <div id="doctor">
                     <div class="testimony-text">
                        <blockquote>psicologos me permite aumentar mi cartera de pacientes, darme a conocer a usuarios que necesitan alguno de los servicios que ofrezco.
                        </blockquote>
                     </div>
                  </div>
               </div>
               <div id="doctor" class="col-lg-4 col-12">
                  <figure>
                     <img id="docimg" src="/frontend/assets/img/male.jpg">
                  </figure>
                  <h3>Prof. César Castillo</h3>
                  <p class="speciality">Psicólogo, Santiago</p>
                  <div id="doctor">
                     <div class="testimony-text">
                        <blockquote>psicologos es un directorio de profesionales de salud en formato de red social. Me ha permitido obtener mayor visibilidad.
                        </blockquote>
                     </div>
                  </div>
               </div>
               <div id="doctor" class="col-lg-4 col-12">
                  <figure>
                     <img id="docimg" src="/frontend/assets/img/male2.jpg">
                  </figure>
                  <h3>Dr. Alejandro Barrón Balderas</h3>
                  <p class="speciality">Urgenciólogo, Guadalajara</p>
                  <div id="doctor">
                     <div class="testimony-text">
                        <blockquote>psicologos es una excelente ayuda para el paciente, o el familiar de este, a encontrar al médico más adecuado a su problema. A los profesionales de la salud, nos permite acercarnos más a los pacientes de manera individualizada, sobre todo en el ámbito privado
                        </blockquote>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- anas-html-sec-end -->
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