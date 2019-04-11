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
      <div class="row justify-content-md-center">
         <table class="table table-sec table-responsive">
            <thead class="bg-green">
               <tr class="text-center">
                  <th class="text-white">Day Hour</th>
                  <th class="text-white">First Name</th>
                  <th class="text-white">Address</th>
                  <th class="text-white">Phone</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td scope="row"><i>You Still dont have reservation</i></td>
                  <td><i>You Still dont have reservation</i></td>
                  <td><i>You Still dont have reservation</i></td>
                  <td><i>You Still dont have reservation</i></td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
</section>
<!-- table-sec-ends -->
@stop