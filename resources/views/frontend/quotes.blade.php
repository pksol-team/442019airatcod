<?php use App\Http\Controllers\Frontend\IndexController; ?>
@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- pages-links -->
<div class="row page-link-nav">
   <div class="container">
      <div class="pages-links">
         <ul class="list-unstyled">
            <li class="d-inline-block active"><a href="/reservations">Quotes</a></li>
            <li class="d-inline-block"><a href="/favourites">Favourites</a></li>
            <li class="d-inline-block"><a href="/quote_doctor">Quote PSYCHOLOGIST</a></li>
            <li class="d-inline-block"><a href="/my_data">My Data</a></li>
         </ul>
      </div>
   </div>
</div>
<!-- pages-links end -->
<section>
   <div class="row quotes-sec">
      <div class="container">
         <div class="quotes-head text-center">
            <h3>UPCOMING APPOINTMENTS</h3>
         </div>
      </div>
   </div>
</section>
<!-- table-sec -->
<section>
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            @if(session()->has('message'))
                <div class="alert alert-success mt-4 text-left d-block w-100"> 
                    {!! session()->get('message') !!}
                </div>
            @endif
            <table class="table table-sec table-bordered">
               <thead class="bg-green">
                  <tr class="text-center">
                     <th class="text-white">Date</th>
                     <th class="text-white">Day</th>
                     <th class="text-white">Time</th>
                     <th class="text-white">Doctor Name</th>
                     <th class="text-white">Address</th>
                     <th class="text-white">Phone</th>
                     <th class="text-white">Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php if ($upcomingAppointments != NULL): ?>
                     <?php foreach ($upcomingAppointments as $key => $upcommingAppointment): ?>
                        <tr>
                           <td><?= substr($upcommingAppointment->appointment_date,0,10); ?></td>
                           <td><?= $upcommingAppointment->day ?></td>
                           <td><?= $upcommingAppointment->from_time.' '.$upcommingAppointment->from_AM_PM ?></td>
                           <td>
                              <?php 
                                 $doctor = IndexController::getDoctorInfo($upcommingAppointment->doctor_id);
                                 echo '<a href="doctor_profile_view/'.$doctor->id.'/'.$doctor->hash_key.'">Dr. '.$doctor->first_name.'</a>';
                              ?>
                           </td>
                           <td><?= $upcommingAppointment->location ?></td>
                           <td>
                              <?php 
                                 $doctor = IndexController::getDoctorInfo($upcommingAppointment->doctor_id);
                                 echo $doctor->mobile;
                              ?>
                           </td>
                           <td>
                              <?php $doctor = IndexController::getDoctorInfo($upcommingAppointment->doctor_id); ?>
                              <a href="<?= '/deleteReservations/'.$upcommingAppointment->id ?>" onclick="return confirm('Are you sure?')"><button class="btn btn-sm btn-danger">Delete</button></a>
                           </td>
                        </tr>
                     <?php endforeach ?>
                  <?php else: ?>
                     <tr><td colspan="12"><i>You Still dont have reservation</i></td></tr>
                  <?php endif ?>
               </tbody>
            </table>
         </div><!-- /.col-lg-12 -->
      </div>
   </div>
</section>
<!-- table-sec-ends -->
@stop