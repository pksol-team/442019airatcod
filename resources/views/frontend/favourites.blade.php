@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- pages-links -->
<div class="row page-link-nav">
   <div class="container">
      <div class="pages-links">
         <ul class="list-unstyled">
            <li class="d-inline-block"><a href="/reservations">Quotes</a></li>
            <li class="d-inline-block active"><a href="/favourites">Favourites</a></li>
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
            <h3>MY FAVOURITE DOCTORS</h3>
         </div>
      </div>
   </div>
</section>
<!-- table-sec -->
<section>
   <div class="container">
      <div class="row justify-content-md-center">
         <table class="table table-sec">
            <thead class="bg-green">
               <tr>
                  <th class="text-white">Doctor Name</th>
                  <!-- <th class="text-white">Specially</th> -->
               </tr>
            </thead>
            <tbody>
               <?php if ($favourite != NULL): ?>                  
                  <?php $allDoctorsIDs = explode(',', $favourite->doctors_list); ?>
                  <?php foreach ($allDoctorsIDs as $key => $DoctorsID): ?>
                     <?php $getDoctor = DB::table('employees')->where([['type', 'doctor'], ['id', (int)$DoctorsID]])->first(); ?>
                     <tr>
                        <td scope="row"><i><a href="/doctor_profile_view/<?= $getDoctor->id.'/'.$getDoctor->hash_key ?>"><?= $getDoctor->first_name; ?></a></i></td>
                        <!-- <td><i>You Still dont have reservation</i></td> -->
                     </tr>
                  <?php endforeach ?>
               <?php else: ?>
                  <tr>
                     <td colspan="12">You don't make any doctor favourite yet</td>
                  </tr>
               <?php endif ?>
            </tbody>
         </table>
      </div>
   </div>
</section>
<!-- table-sec-ends -->
@stop