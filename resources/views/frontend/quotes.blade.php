<?php use App\Http\Controllers\Frontend\IndexController; ?>
@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- pages-links -->
<div class="row page-link-nav">
   <div class="container">
      <div class="pages-links">
         <ul class="list-unstyled">
            <li class="d-inline-block active"><a href="/reservations">Citas</a></li>
            <li class="d-inline-block"><a href="/favourites">Favoritas</a></li>
            <li class="d-inline-block"><a href="/questions-responses">Cotizar psicólogo</a></li>
            <li class="d-inline-block"><a href="/my_data">Mis datos</a></li>
         </ul>
      </div>
   </div>
</div>
<!-- pages-links end -->
<section>
   <div class="row quotes-sec">
      <div class="container">
         <div class="quotes-head text-center">
            <h3>NOMBRES PRÓXIMOS</h3>
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
                     <th class="text-white">Fecha</th>
                     <th class="text-white">Día</th>
                     <th class="text-white">Hora</th>
                     <th class="text-white">Nombre del doctor</th>
                     <th class="text-white">Dirección</th>
                     <th class="text-white">Teléfono</th>
                     <th class="text-white">Acción</th>
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
                              <a href="<?= '/deleteReservations/'.$upcommingAppointment->id ?>" onclick="return confirm('¿Estás seguro?')"><button class="btn btn-sm btn-danger">Borrar</button></a>
                           </td>
                        </tr>
                     <?php endforeach ?>
                  <?php else: ?>
                     <tr><td colspan="12"><i>Todavía no tienes reserva</i></td></tr>
                  <?php endif ?>
               </tbody>
            </table>
         </div><!-- /.col-lg-12 -->
      </div>
   </div>
</section>
<!-- table-sec-ends -->
@stop