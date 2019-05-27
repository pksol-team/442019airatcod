@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="row page-link-nav">
   <div class="container">
      <div class="pages-links">
         <ul class="list-unstyled">
            <li class="d-inline-block active"><a href="/doctor_full_profile/<?= $UserTbl->hash_key ?>">PERFIL</a></li>
            <li class="d-inline-block"><a href="<?= '/doctor_appointments/'.$EmpTbl->id.'/'.$EmpTbl->hash_key ?>">CITA DE RESERVA</a></li>
         </ul>
      </div>
   </div>
</div>
<div class="row bg-white">
   <div class="container">
      <div class="pages-links text-gray-dark">
         <ul class="list-unstyled">
            <li class="d-inline-block active"><a href="/doctor_full_profile/<?= $UserTbl->hash_key ?>" class="text-dark">PERFIL</a></li>
            <li class="d-inline-block"><a href="/my_data" class="text-dark">Mis datos</a></li>
            <?php if ($EmpTbl->profile == 'premium'): ?>
              <li class="d-inline-block"><a href="<?= '/write_article/'.$EmpTbl->id.'/'.$EmpTbl->hash_key ?>" class="text-dark">Escribe un artículo</a></li>
            <?php endif ?>
            <li class="d-inline-block">Perfil premium</li>
         </ul>
      </div>
   </div>
</div>
<!-- header-end -->
<section class="professional-page">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 professional-page-main">
            <div class="prof-page-head text-center">
               <h1 class="f-30">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A quas illo odio eius dolorem doloribus.</h1>
            </div>
         </div>
      </div>
      <div class="row pro-page-columns mb-3">
         <div class="col-lg-4 pro-page-column-first text-center">
            <div class="pro-page-column-first-img">
               <i class="fa fa-picture-o" aria-hidden="true"></i>
            </div>
            <div class="pro-page-first-column-text">
               <p>Encontraras mas</p>
            </div>
            <div class="pro-page-sec-desc">
               <div class="pro">
                  <div class="pro-page-desc-icon">
                     <i class="fa fa-check" aria-hidden="true"></i>
                  </div>
                  <div class="pro-page-desc">
                     <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis enim quo, accusamus aperiam id velit in ullam odit suscipit.</p>
                  </div>
               </div>
               <div class="pro-page-link text-center">
                  <a href="">¿Por qué me encontrarán más?</a>
               </div>
            </div>
         </div>
         <div class="col-lg-4  pro-page-column-sec text-center">
            <div class="pro-page-column-first-img">
               <i class="fa fa-picture-o" aria-hidden="true"></i>  
            </div>
            <div class="pro-page-column-sec-text">
               <p>Encontraras mas</p>
            </div>
            <div class="pro-page-sec-desc">
               <div class="pro">
                  <div class="pro-page-desc-icon">
                     <i class="fa fa-check" aria-hidden="true"></i>
                  </div>
                  <div class="pro-page-desc">
                     <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis enim quo, accusamus aperiam id velit in ullam odit suscipit.</p>
                  </div>
               </div>
               <div class="pro-page-link text-center">
                  <a href="">¿Por qué me encontrarán más?</a>
               </div>
            </div>
         </div>
         <div class="col-lg-4  pro-page-column-third text-center">
            <div class="pro-page-column-third-img">
               <i class="fa fa-picture-o" aria-hidden="true"></i>  
            </div>
            <div class="pro-page-column-third-text">
               <p>Encontraras mas</p>
            </div>
            <div class="pro-page-third-desc">
               <div class="pro">
                  <div class="pro-page-desc-icon">
                     <i class="fa fa-check" aria-hidden="true"></i>
                  </div>
                  <div class="pro-page-desc">
                     <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis enim quo, accusamus aperiam id velit in ullam odit suscipit.</p>
                  </div>
               </div>
               <div class="pro-page-link text-center">
                  <a href="">¿Por qué me encontrarán más?</a>
               </div>
            </div>
         </div>
      </div>
      <!-- row -->
         @if(session()->has('message'))
    	    <div class="alert alert-success">
    	        {!! session()->get('message') !!}
    	    </div>
       	@endif
      <?php if ( $EmpTbl->subscription_id == ''): ?>
         <!-- choose-your-premium-plan -->
         <div class="choose-your-premium-plan text-center">
            <div class="choose-your-plan-area ">
               <ul class="list-unstyled">
                  <li>
                     <span style="color: #4CAF51;">Por sólo $ 131079.83</span>
                  </li>
                  <li class="my-2"><a href="/subscribe/monthly6"><button class="btn btn-primary">Elija el plan Premium por 6 meses</button></a>
                  <li>
                     <span style="color: #4CAF51;">Por sólo $ 335.880</span>
                  </li>
                  <li class="my-2"><a href="/subscribe/yearly"><button class="btn btn-primary">Elija plan premium por 1 año </button></a>
                  </li>
               </ul>
            </div>
         </div>
         <!--choose-your-premium-plan-end  -->
      <?php else: ?>
      <!-- CANCEL-your-premium-plan -->
         <div class="choose-your-premium-plan text-center">
            <div class="choose-your-plan-area ">
               <ul class="list-unstyled">
                  <li class="my-2"><a onclick="return confirm('¿Estás seguro de que quieres cancelar la suscripción?');" href="<?= ($EmpTbl->status != 'Pedido pendiente')? '/unsubscribe' : '#'?>"><button class="btn btn-primary"><?= $EmpTbl->status?></button></a>
                  </li>
               </ul>
            </div>
         </div>
      <?php endif ?>

      <!-- compare your current -->
      <div class="compre-your-account my-5">
         <div class="compare-your-premium-acc-head text-center my-5">
            <h2>Compara tu perfil actual con el básico</h2>
         </div>
         <div class="compare-your-basic-table table-responsive">
            <table class="table">
               <thead>
                  <tr>
                     <th>Visibility in psicologos</th>
                     <th class="text-center">Basic <?= ($EmpTbl->profile == 'basic') ? '<br> Perfil actual' : NULL; ?></th>
                     <th class="text-center">Premium <?= ($EmpTbl->profile == 'premium') ? '<br> Perfil actual' : NULL; ?> </th>
                  </tr>
               </thead>
               <tbody class="table-body">
                  <tr class="border border-bottom-0 border-left-0 border-right-0">
                     <td>Better Positioning<i class="fa fa-question-circle pl-2" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-times" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-check" aria-hidden="true"></i></td>
                  </tr>
                  <tr>
                     <th>Online Credibility and prestige</th>
                  </tr>
                  <tr>
                     <td>Better Positioning<i class="fa fa-question-circle pl-2" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-times" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-check" aria-hidden="true"></i></td>
                  </tr>
                  <tr>
                     <td>Better Positioning<i class="fa fa-question-circle pl-2" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-times" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-check" aria-hidden="true"></i></td>
                  </tr>
                  <tr>
                     <td>Better Positioning<i class="fa fa-question-circle pl-2" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-times" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-check" aria-hidden="true"></i></td>
                  </tr>
                  <tr>
                     <td>Better Positioning<i class="fa fa-question-circle pl-2" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-times" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-check" aria-hidden="true"></i></td>
                  </tr>
                  <tr>
                     <th>Better Ways TO Contact</th>
                  </tr>
                  <tr>
                     <td>Better Positioning<i class="fa fa-question-circle pl-2" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-times" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-check" aria-hidden="true"></i></td>
                  </tr>
                  <tr>
                     <td>Better Positioning<i class="fa fa-question-circle pl-2" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-times" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-check" aria-hidden="true"></i></td>
                  </tr>
                  <tr>
                     <td>Better Positioning<i class="fa fa-question-circle pl-2" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-times" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-check" aria-hidden="true"></i></td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
      <!-- compare your current end -->
      <!-- advantages of the Premium Profile -->
      <div class="premium-profile text-center">
         <div class="premium-profile-head">
            <h2>Ventaja de la página de perfil premium</h2>
         </div>
         <div class="premium-profile-page-content">
            <div class="row profile-first-row">
               <div class="col-lg-6">
                  <div class="you-will-find-more clearfix">
                     <div class="you-will-find-more-head">
                        <h3 class="text-left">>Encontraras mas</h3>
                     </div>
                     <div class="you-will-find">
                        <div class="you-will-find-div-area">
                           <div class="you-will-find-more-first-list-items">
                              <div class="you-will-find-more-list-items-icon">
                                 <i class="fa fa-check" aria-hidden="true"></i>
                              </div>
                              <div class="you-will-find-more-list-items-text">
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing</p>
                              </div>
                           </div>
                           <div class="you-will-find-more-sec-list-items">
                              <div class="you-will-find-more-list-items-icon">
                                 <i class="fa fa-check" aria-hidden="true"></i>
                              </div>
                              <div class="you-will-find-more-list-items-text">
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing</p>
                              </div>
                           </div>
                        </div>
                        <div class="you-will-find-more-visit clearfix">
                           <div class="you-will-visit">
                              <div class="you-will-find-visit">
                                 <h4>Visit x3</h4>
                              </div>
                              <div class="you-will-find-more-premium-text">
                                 <p>Lorem ipsum dolor sit amet, consectetur</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="adv-of-pro text-left my-3">
                        <a href="">Lorem ipsum dolor sit amet ?</a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="premiumpro-image">
                     <img src="/frontend/assets/img/img1.jpg" alt="">
                  </div>
               </div>
            </div>
            <!-- row -->
            <div class="row profile-sec-row">
               <div class="col-lg-6">
                  <div class="premiumpro-image">
                     <img src="/frontend/assets/img/img1.jpg" alt="">
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="you-will-find-more clearfix">
                     <div class="you-will-find-more-head">
                        <h3 class="text-left">>Encontraras mas</h3>
                     </div>
                     <div class="you-will-find">
                        <div class="you-will-find-div-area">
                           <div class="you-will-find-more-first-list-items">
                              <div class="you-will-find-more-list-items-icon">
                                 <i class="fa fa-check" aria-hidden="true"></i>
                              </div>
                              <div class="you-will-find-more-list-items-text">
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing</p>
                              </div>
                           </div>
                           <div class="you-will-find-more-sec-list-items">
                              <div class="you-will-find-more-list-items-icon">
                                 <i class="fa fa-check" aria-hidden="true"></i>
                              </div>
                              <div class="you-will-find-more-list-items-text">
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing</p>
                              </div>
                           </div>
                        </div>
                        <div class="you-will-find-more-visit clearfix">
                           <div class="you-will-visit">
                              <div class="you-will-find-visit">
                                 <h4>Visit x3</h4>
                              </div>
                              <div class="you-will-find-more-premium-text">
                                 <p>Lorem ipsum dolor sit amet, consectetur</p>
                              </div>
                           </div>
                        </div>
                        <div class="adv-of-pro text-left my-3">
                           <a href="">Lorem ipsum dolor sit amet ?</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row profile-first-row">
               <div class="col-lg-6">
                  <div class="you-will-find-more clearfix">
                     <div class="you-will-find-more-head">
                        <h3 class="text-left">>Encontraras mas</h3>
                     </div>
                     <div class="you-will-find">
                        <div class="you-will-find-div-area">
                           <div class="you-will-find-more-first-list-items">
                              <div class="you-will-find-more-list-items-icon">
                                 <i class="fa fa-check" aria-hidden="true"></i>
                              </div>
                              <div class="you-will-find-more-list-items-text">
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing</p>
                              </div>
                           </div>
                           <div class="you-will-find-more-sec-list-items">
                              <div class="you-will-find-more-list-items-icon">
                                 <i class="fa fa-check" aria-hidden="true"></i>
                              </div>
                              <div class="you-will-find-more-list-items-text">
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing</p>
                              </div>
                           </div>
                        </div>
                        <div class="you-will-find-more-visit clearfix">
                           <div class="you-will-visit">
                              <div class="you-will-find-visit">
                                 <h4>Visit x3</h4>
                              </div>
                              <div class="you-will-find-more-premium-text">
                                 <p>Lorem ipsum dolor sit amet, consectetur</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="adv-of-pro text-left my-3">
                        <a href="">Lorem ipsum dolor sit amet ?</a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="premiumpro-image">
                     <img src="/frontend/assets/img/img1.jpg" alt="">
                  </div>
               </div>
            </div>
         </div>
         <!-- premium-profile-page-content -->
      </div>
      <!-- advantages of the premium profile end -->
      <!-- already-premium -->
      <div class="premium-already-members text-center">
         <div class="premium-head my-3">
            <h4>Más de 1,000 profesionales en Chile ya son Premium.</h4>
         </div>
      </div>
      <div class="row">
         <div id="responsive" class="container">
          <?php if ($allPremiumDoctors): ?>
            <?php foreach ($allPremiumDoctors as $key => $premiumDoctor): ?>
              <div class="col-lg-12">
                 <div class="box border">
                    <div class="row">
                       <div class="col-4 p-0">
                          <div class="box-img">
                            <?php 
                              if ($premiumDoctor->profile_picture != '0') {
                                $profilePic = '/upload/'.$premiumDoctor->profile_picture;
                              } else {
                                $profilePic = '/frontend/assets/img/default-doctor_1.png';
                              }
                             ?>
                             <img src="<?= $profilePic; ?>" alt="" class="w-100 img-fluid">
                          </div>
                       </div>
                       <div class="col-8 my-3">
                          <div class="box-desc">
                             <div class="box-head">
                                <h4>Dr. <?= $premiumDoctor->first_name; ?></h4>
                             </div>
                             <div class="box-desc">
                                <p class="f-13 mb-0"><?= substr($premiumDoctor->about, 0, 35).'...'; ?></p>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
            <?php endforeach ?>
          <?php endif ?>
         </div>
      </div>
      <div class="faq-section clearfix my-5">
         <div class="faq-head text-center my-4">
            <h4>Pregunta frecuente sobre el Perfil Premium</h4>
         </div>
         <div class="frequently-asked-questions">
            <div class="container">
               <div id="accordion">
                  <div class="card border-0">
                     <div class="card card-header border-right-0 border-left-0 border-bottom-0 faq-panel">
                        <a class="card-link"  data-toggle="collapse" href="#collapseOne">
                        <span class="pr-2"><i class="fa fa-caret-down" aria-hidden="true"></i></span>¿Qué es el Perfil Premium?
                        </a>
                     </div>
                     <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body border-0">
                           El Perfil Premium es el perfil más completo que un médico puede tener :

                           Perfil completo y profesional.:
                           • Amplíe el contenido de su perfil para mejorar su reputación en línea. 
                           • Agregue su experiencia en pruebas y enfermedades para mejorar sus resultados de búsqueda. 
                           • Las fotos

                           Más visibilidad en los listados.:
                           • Aparecen por encima de los perfiles básicos. 
                           • Consigue una insignia Premium.

                           Más opciones para contactarte:
                           • Acepte reservas de citas en línea: los pacientes pueden solicitar una cita las 24 horas desde su computadora o dispositivo móvil. 
                        </div>
                     </div>
                  </div>
                  <div class="card border-0">
                     <div class="card card-header faq-panel border-right-0 border-left-0 border-bottom-0">
                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                        <span class="pr-2"><i class="fa fa-caret-down" aria-hidden="true"></i></span>¿Cómo activar la suscripción al Perfil Premium?
                        </a>
                     </div>
                     <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body border-0">
                           Para comenzar a disfrutar de todas las ventajas del Perfil Premium, siga los siguientes pasos:

                           1. Vaya a la parte superior derecha de la página de inicio de Doctoralia y encontrará la opción "Iniciar sesión". 2. Ingrese su correo electrónico y contraseña y haga clic en el botón "Iniciar sesión". De esta manera, ingresará a su área privada y verá la opción "Elegir plan Premium" en la parte superior derecha de la pantalla. 3. Busque la opción "Suscribirse" y elija entre las opciones de pago mensuales o anuales. 4. Finalmente, para pagos mensuales o anuales, debe elegir entre agregar la información de su tarjeta de crédito o la opción de débito directo y hacer clic en la opción "Activar perfil Premium"
                            .
                            De esta manera, el proceso se completará y podrá disfrutar de los beneficios de este servicio.
                        </div>
                     </div>
                  </div>
                  <div class="card border-0">
                     <div class="card card-header  border-right-0 border-left-0 border-bottom-0 faq-panel">
                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                        <span class="pr-2"><i class="fa fa-caret-down" aria-hidden="true"></i></span>Condiciones y permanencia del Perfil Premium.
                        </a>
                     </div>
                     <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <div class="card-body border-0">
                           Dependerá de la modalidad que se haya contratado, anual o mensualmente. En el modo mensual, se aplica una estancia mínima de 6 meses para poder medir los resultados obtenidos de manera más efectiva. En el modo anual, puede darse de baja en cualquier momento y será efectivo al final del período contratado. La cancelación del servicio se realiza desde su área privada a la que tendrá acceso en todo momento.
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- container -->
</section>
@stop