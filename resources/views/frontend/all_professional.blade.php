<?php use App\Http\Controllers\Frontend\IndexController; ?>
@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- pages-links -->
<section class="bg-grey">
   <div class="row">
      <div class="container">
         <div class="breadcrumb-links">
            <!-- <ol class="breadcrumb breadcrumb-items float-left">
               <li class="breadcrumb-item active" aria-current="page">Home</li>
               <li class="breadcrumb-item " aria-current="page">Library</li>
            </ol> -->
         </div>
         <div class="social-icons float-right">
            <div class="social-links">
               <ol>
                  <li>
                     <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= Request::fullUrl(); ?>"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                  </li>
                  <li>
                     <a target="_blank" href="https://twitter.com/home?status=<?= Request::fullUrl(); ?>"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
                  </li>
               </ol>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- pages-links end -->
<!--sec-professional--->
<section class="bg-grey">
   <div class="row">
      <div class="container">
         <div class="professional">
            <div class="professional-main-head pt-2 pb-2 pl-2 border">
               <h3>Todos los profesionales</h3>
            </div>
            <div class="professional-content bg-white">
               <h3>Reserve su cita</h3>
               <p class="prof-subtitle">Encuentra a tu médico y reserva tu cita (es fácil y gratis)</p>
            </div>
            <div class="row bg-white">
               <div class="col-11 bg-grey filter_location">
                  <form class="form-inline doctorsPageSearch" action="" method="get">
                  <div class="row w-100">
                     <div class="col-lg-4 col-md-4 col-sm-4 col-11 item-1">
                        <div>
                           <p>Filtrar por especialidad</p>
                              <select class="js-example-basic-single searchBySpecialty" name="specialty">
                                <option value="" hidden></option>
                                <?php if ($allSpecialities): ?>
                                 <?php foreach ($allSpecialities as $key => $specialty): ?>
                                      <option value="<?= $specialty->id; ?>"><?= $specialty->name; ?></option>
                                 <?php endforeach ?>
                                <?php endif ?>
                              </select>
                        </div>
                     </div>
                     <div class="col-lg-3 col-md-3 col-sm-3 col-11 pr-0 pl-0 item-2">
                        <div>
                           <p>Filtrar por ubicación</p>
                           <?php if ($allCities): ?>
                              <select class="js-example-basic-single searchByCity" name="city">
                                <option value="" hidden></option>
                              <?php foreach ($allCities as $key => $city): ?>
                                   <option value="<?= $city->name; ?>"><?= $city->name; ?></option>
                              <?php endforeach ?>
                           <?php endif ?>
                              </select>
                        </div>
                     </div>
                     <div class="col-lg-3 col-md-3 col-sm-3 col-11 pl-0 forecast-filter">
                        <div>
                           <p>Filtrar por previsión</p>
                           <?php if ($allForecasts): ?>
                              <select class="js-example-basic-single searchByForecast" name="forecast">
                                <option value="" hidden></option>
                              <?php foreach ($allForecasts as $key => $forecast): ?>
                                   <option value="<?= $forecast->name; ?>"><?= $forecast->name; ?></option>
                              <?php endforeach ?>
                           <?php endif ?>
                              </select>
                        </div>
                     </div>
                     <div class="col-lg-1 col-md-1 col-sm-1 col-11 pl-0 ml-5 text-right">
                        <div>
                           <p>&nbsp;</p>
                           <button type="submit" class="btn btn-secondary">Buscar</button>
                        </div>
                     </div>
                  </div><!-- /.row -->
                     <input type="hidden" value="" name="searchByInput" />
                  </form>
               </div><!-- /.col-10 -->
            </div>
         </div>
      </div>
   </div>
</section>
<!-- sec-professional-end -->
<section class="bg-grey">
   <div class="row">
      <div class="container">
         <div class="appointments-list bg-white table-responsive">
            <table class="table table-bordered" id="available_times">
               <thead class="bg-green">
                  <tr>
                     <th>DOCTORA</th>
                     <th>&nbsp;</th>
                     <th>lunes</th>
                     <th>martes</th>
                     <th>miércoles</th>
                     <th>jueves</th>
                     <th>viernes</th>
                     <th>sábado</th>
                     <th>domingo</th>
                  </tr>
               </thead>
               <tbody class="all_professional_with_review">
                  <?php if ($allDoctors != NULL): ?>
                     <?php foreach ($allDoctors as $key => $doctor): ?>
                        <tr class="bg-grey">
                           <th>
                              <a href="/doctor_profile_view/<?= $doctor->id.'/'.$doctor->hash_key ?>" style="color:#000;"><?= $doctor->first_name.' '.$doctor->last_name ?> </a>
                              <div id="ratings" class="text-left">
                                <span class="ratingXL">
                                <?php $ratings = $doctor->reviews *20; ?>
                                 <span class="rating-avg-large" style="margin-left: 0 !important;"><span style="width: <?= (int)$ratings ?>%;"></span></span>
                                </span>
                              </div>
                              <p><small><?= $doctor->address ?></small></p>
                           </th>
                           <td class="text-center align-middle">
                              <?php if ($doctor->profile == 'premium'): ?>
                                 <img width="50" src="/frontend/assets/img/premium.png" alt="Premium Member" />
                              <?php endif ?>
                           </td>
                           <td><?php echo IndexController::getTimingDoctor('Monday', $doctor->id); ?></td>
                           <td><?php echo IndexController::getTimingDoctor('Tuesday', $doctor->id); ?></td>
                           <td><?php echo IndexController::getTimingDoctor('Wednesday', $doctor->id); ?></td>
                           <td><?php echo IndexController::getTimingDoctor('Thursday', $doctor->id); ?></td>
                           <td><?php echo IndexController::getTimingDoctor('Friday', $doctor->id); ?></td>
                           <td><?php echo IndexController::getTimingDoctor('Saturday', $doctor->id); ?></td>
                           <td><?php echo IndexController::getTimingDoctor('Sunday', $doctor->id); ?></td>
                        </tr>
                     <?php endforeach ?>
                  <?php else: ?>
                     <tr>
                        <td colspan="12" class="text-center">No hay datos disponibles en la tabla</td>
                        <td class="d-none">&nbsp;</td>
                        <td class="d-none">&nbsp;</td>
                        <td class="d-none">&nbsp;</td>
                        <td class="d-none">&nbsp;</td>
                        <td class="d-none">&nbsp;</td>
                        <td class="d-none">&nbsp;</td>
                        <td class="d-none">&nbsp;</td>
                        <td class="d-none">&nbsp;</td>
                     </tr>
                  <?php endif ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</section>
@stop