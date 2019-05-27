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
<section class="bg-grey pb-3">

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
               <div class="col-11 bg-grey filter_location mb-4">
                  <form class="form-inline doctorsPageSearch" action="" method="get">
                  <div class="row w-100">
                     <div class="col-lg-3 col-md-3 col-sm-3 col-11 item-1">
                        <div>
                           <p>filtrar por nombre</p>
                           <input class="searchByInput_all_professional" type="text" name="searchByInput" />
                        </div>
                     </div>
                     <div class="col-lg-3 col-md-3 col-sm-3 col-11 item-1">
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
                     <div class="col-lg-3 col-md-2 col-sm-2 col-11 item-2">
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
                     <div class="col-lg-3 col-md-2 col-sm-2 col-11 pl-0 forecast-filter">
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
                     <div class="col-12 text-center">
                        <div>
                           <p>&nbsp;</p>
                           <button type="submit" class="btn btn-dark btn-md">Buscar</button>
                        </div>
                     </div>
                  </div><!-- /.row -->
                  </form>
               </div><!-- /.col-10 -->
            </div>
         </div>
      </div>
   </div>
</section>
<!-- sec-professional-end -->
    <section class="bg-grey detail all_professional_details">
      <div class="container">
        <div class="row">
          <div class="col-md-12 detail-header">
            <div class="row">
              <div class="col-md-7">
                <h5>Profesionales</h5>
              </div>
              <!-- End Col Inner -->
              <?php 
                $days = [
                  '0' => 'Sunday',
                  '1' => 'Monday',
                  '2' => 'Tuesday',
                  '3' => 'Wednesday',
                  '4' => 'Thursday',
                  '5' => 'Friday',
                  '6' => 'Saturday'
                ];
              ?>
              <div class="col-md-5">
                <section class="regular slider new">
                  <div>
                    <span><small>hoy <br /><?= date("d M") ?></small></span>
                  </div>
                  <div>
                    <span><small>Mañana <br /><?= date("d M", strtotime(' + 1 days')) ?></small></span>
                  </div>
                  <div>
                    <span><?= $days[date("w", strtotime(' + 2 days')) ]; ?><br /><?= date("d M", strtotime(' + 2 days')) ?></span>
                  </div>
                  <div>
                    <span><?= $days[date("w", strtotime(' + 3 days')) ]; ?><br /><?= date("d M", strtotime(' + 3 days')) ?></span>
                  </div>
                  <div>
                    <span><?= $days[date("w", strtotime(' + 4 days')) ]; ?><br /><?= date("d M", strtotime(' + 4 days')) ?></span>
                  </div>
                  <div>
                    <span><?= $days[date("w", strtotime(' + 5 days')) ]; ?><br /><?= date("d M", strtotime(' + 5 days')) ?></span>
                  </div>
                  <div>
                    <span><?= $days[date("w", strtotime(' + 6 days')) ]; ?><br /><?= date("d M", strtotime(' + 6 days')) ?></span>
                  </div>
                  <div>
                    <span><?= $days[date("w", strtotime(' + 7 days')) ]; ?><br /><?= date("d M", strtotime(' + 7 days')) ?></span>
                  </div>
                  <div>
                    <span><?= $days[date("w", strtotime(' + 8 days')) ]; ?><br /><?= date("d M", strtotime(' + 8 days')) ?></span>
                  </div>
                  <div>
                    <span><?= $days[date("w", strtotime(' + 9 days')) ]; ?><br /><?= date("d M", strtotime(' + 9 days')) ?></span>
                  </div>
                  <div>
                    <span><?= $days[date("w", strtotime(' + 10 days')) ]; ?><br /><?= date("d M", strtotime(' + 10 days')) ?></span>
                  </div>
                  <div>
                    <span><?= $days[date("w", strtotime(' + 11 days')) ]; ?><br /><?= date("d M", strtotime(' + 11 days')) ?></span>
                  </div>
                  <div>
                    <span><?= $days[date("w", strtotime(' + 12 days')) ]; ?><br /><?= date("d M", strtotime(' + 12 days')) ?></span>
                  </div>
                  <div>
                    <span><?= $days[date("w", strtotime(' + 13 days')) ]; ?><br /><?= date("d M", strtotime(' + 13 days')) ?></span>
                  </div>
                  <div>
                    <span><?= $days[date("w", strtotime(' + 14 days')) ]; ?><br /><?= date("d M", strtotime(' + 14 days')) ?></span>
                  </div>
                </section>
              </div>
              <!-- End Col Inner -->
            </div>
            <!-- End Inner Row -->
          </div>
          <!-- End Coloum -->
          <?php if ($allDoctors != NULL): ?>
            <?php foreach ($allDoctors as $key => $doctor): ?>
          <div class="col-md-12 detail-body">
            <div class="row">
              <div class="col-md-7">
                <div class="col-md-4 profile-image">
                  <?php 
                    if ($doctor->profile_picture != '0') {
                      $profilePic = '/upload/'.$doctor->profile_picture;
                    } else {
                      $profilePic = '/frontend/assets/img/default-doctor_1.png';
                    }
                  ?>
                  <img src="<?= $profilePic; ?>" class="img-responsive" alt="Imagen del doctor">
                </div>
                <div class="col-md-8 profile-details">
                  <a href="/doctor_profile_view/<?= $doctor->id.'/'.$doctor->hash_key ?>">
                    <h5>Doctor {{ $doctor->first_name }} 
                      <?php if ($doctor->profile == 'premium'): ?>
                        <i class="fa fa-check-circle"></i>
                      <?php endif ?>
                    </h5>
                  </a>
                  <div id="addr" class="col-lg-12 text-center mb-4">
                    <?php if ($doctor->profile == 'premium'): ?>
                      <p class="m-0 text-left">{{ $doctor->mobile }}</p>
                    <?php endif ?>
                  </div>
                  <p>Especialista en: 
                    <?php 
                        $oldSpecialty = explode(',', substr($doctor->specialty, 0, -1));
                        $specialty = DB::table('specialities')->where('id', $oldSpecialty[0])->first();
                        echo $specialty->name;
                      ?>
                  </p>
                  <div id="ratings" class="col-lg-12 text-left pl-0">
                    <span class="ratingXL">
                    <?php 
                      $allReviews = DB::table('review_doctors')->where('doctor_id', $doctor->id);
                      $ratings = $doctor->reviews *20;
                    ?>
                      <span class="rating-avg-large ml-0"><span style="width: <?= (int)$ratings ?>%;"></span></span>
                    </span>
                    <small>( <a href="/view_reviews_doctor/<?= $doctor->id.'/'.$doctor->hash_key ?>"><span><?= $allReviews->count(); ?></span> opiniones</a> )</small>
                  </div>
                  <div class="address">
                    <?php if ($doctor->address != ''): ?>
                      <p><i class="fa fa-map-marker" aria-hidden="true"></i><a target="_blank" href="https://www.google.com/maps/place/{{ $doctor->address }}"> {{ $doctor->address }}</a></p>
                    <?php endif ?>
                  </div>
                  <blockquote class="last-opinion small text-muted">
                    <span>
                    <?php $review = $allReviews->orderBy('id', 'DESC')->first(); ?>
                    <?php if ($review != NULL): ?>
                      {{substr($review->like, 0, 20)}}
                    </span>
                    <?php if (strlen($review->like) > 20): ?>
                      <span class="hide">
                        {{substr($review->like, 20)}}
                      </span>
                      <span class="show-para">ver más</span>
                    <?php endif ?>
                    <?php endif ?>
                    
                  </blockquote>
                  <div class="lists">
                    <?php 
                       $arrayServices = unserialize($doctor->services); ?>
                      <?php if ($arrayServices != FALSE): ?>
                        <?php foreach ($arrayServices["service"] as $key => $arrayService): ?>
                          <?php 
                             $rate = $arrayService;
                             $service = $arrayServices['rate'][$key];
                          ?>
                         <p>{{ $rate }} <span>${{ $service }}</span></p>
                      <?php endforeach ?>
                    <?php endif ?>
                  </div>
                </div>
              </div>
              <!-- End Inner Col -->
              <div class="col-md-5">
                <section class="regular slider new doctor_slick">
                  <div>
                    <?= IndexController::getTimingDoctor($days[date("w", strtotime(' + 0 days'))], $doctor->id, date('Y-m-d', strtotime(' + 0 days'))); ?>
                  </div>
                  <div>
                    <?= IndexController::getTimingDoctor($days[date("w", strtotime(' + 1 days'))], $doctor->id, date('Y-m-d', strtotime(' + 1 days'))); ?>
                  </div>
                  <div>
                    <?= IndexController::getTimingDoctor($days[date("w", strtotime(' + 2 days'))], $doctor->id, date('Y-m-d', strtotime(' + 2 days'))); ?>
                  </div>
                  <div>
                    <?= IndexController::getTimingDoctor($days[date("w", strtotime(' + 3 days'))], $doctor->id, date('Y-m-d', strtotime(' + 3 days'))); ?>
                  </div>
                  <div>
                    <?= IndexController::getTimingDoctor($days[date("w", strtotime(' + 4 days'))], $doctor->id, date('Y-m-d', strtotime(' + 4 days'))); ?>
                  </div>
                  <div>
                    <?= IndexController::getTimingDoctor($days[date("w", strtotime(' + 5 days'))], $doctor->id, date('Y-m-d', strtotime(' + 5 days'))); ?>
                  </div>
                  <div>
                    <?= IndexController::getTimingDoctor($days[date("w", strtotime(' + 6 days'))], $doctor->id, date('Y-m-d', strtotime(' + 6 days'))); ?>
                  </div>
                  <div>
                    <?= IndexController::getTimingDoctor($days[date("w", strtotime(' + 7 days'))], $doctor->id, date('Y-m-d', strtotime(' + 7 days'))); ?>
                  </div>
                  <div>
                    <?= IndexController::getTimingDoctor($days[date("w", strtotime(' + 8 days'))], $doctor->id, date('Y-m-d', strtotime(' + 8 days'))); ?>
                  </div>
                  <div>
                    <?= IndexController::getTimingDoctor($days[date("w", strtotime(' + 9 days'))], $doctor->id, date('Y-m-d', strtotime(' + 9 days'))); ?>
                  </div>
                  <div>
                    <?= IndexController::getTimingDoctor($days[date("w", strtotime(' + 10 days'))], $doctor->id, date('Y-m-d', strtotime(' + 10 days'))); ?>
                  </div>
                  <div>
                    <?= IndexController::getTimingDoctor($days[date("w", strtotime(' + 11 days'))], $doctor->id, date('Y-m-d', strtotime(' + 11 days'))); ?>
                  </div>
                  <div>
                    <?= IndexController::getTimingDoctor($days[date("w", strtotime(' + 12 days'))], $doctor->id, date('Y-m-d', strtotime(' + 12 days'))); ?>
                  </div>
                  <div>
                    <?= IndexController::getTimingDoctor($days[date("w", strtotime(' + 13 days'))], $doctor->id, date('Y-m-d', strtotime(' + 13 days'))); ?>
                  </div>
                  <div>
                    <?= IndexController::getTimingDoctor($days[date("w", strtotime(' + 14 days'))], $doctor->id, date('Y-m-d', strtotime(' + 14 days'))); ?>
                  </div>
                </section>
              </div><!-- End Inner Col -->
            </div><!-- End Inner Row -->
          </div><!-- End Detail Body -->
          <?php endforeach ?>
        <?php else: ?>
          <div class="col-md-12 detail-body">
            No hay datos disponibles
          </div>
        <?php endif ?>
        </div><!-- End Row -->
      </div><!-- End Container -->
    </section>
   <?php /*
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
   */ ?>
@stop