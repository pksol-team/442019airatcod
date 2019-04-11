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
               <h3>Professionals</h3>
            </div>
            <div class="professional-content bg-white">
               <h3>Book Your Appointment</h3>
               <p class="prof-subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
            <div class="row bg-white">
               <div class="col-10 bg-grey filter_location">
                  <div class="row">
                     <div class="col-lg-5 col-md-6 col-sm-6 col-11 pr-0 pl-0 item-2">
                        <div>
                           <p>Filter by location</p>
                           <input type="text" class="form-control mt-2 w-50" id="exampleInputEmail1" placeholder="cludad">
                        </div>
                     </div>
                     <div class="col-lg-5 col-md-6 col-sm-6 col-11 pl-0 item-3">
                        <div>
                           <p>Filter by forecast</p>
                           <select name="filter_speciality" class="form-control" id="filter_speciality">
                              <option value="a">a</option>
                           </select>
                        </div>
                     </div>
                  </div><!-- /.row -->
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
                     <th>AVAILABLE <br> APPOINTMENTS</th>
                     <th>&nbsp;</th>
                     <th>Monday</th>
                     <th>Tuesday</th>
                     <th>Wednesday</th>
                     <th>Thursday</th>
                     <th>Friday</th>
                     <th>Saturday</th>
                     <th>Sunday</th>
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
                           <td>&nbsp;</td>
                           <td><?php echo IndexController::getTimingDoctor('Monday', $doctor->id); ?></td>
                           <td><?php echo IndexController::getTimingDoctor('Tuesday', $doctor->id); ?></td>
                           <td><?php echo IndexController::getTimingDoctor('Wednesday', $doctor->id); ?></td>
                           <td><?php echo IndexController::getTimingDoctor('Thursday', $doctor->id); ?></td>
                           <td><?php echo IndexController::getTimingDoctor('Friday', $doctor->id); ?></td>
                           <td><?php echo IndexController::getTimingDoctor('Saturday', $doctor->id); ?></td>
                           <td><?php echo IndexController::getTimingDoctor('Sunday', $doctor->id); ?></td>
                        </tr>
                     <?php endforeach ?>
                  <?php endif ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</section>
@stop