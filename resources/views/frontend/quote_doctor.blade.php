<?php use App\Http\Controllers\Frontend\IndexController; ?>
@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- pages-links -->
<div class="row page-link-nav">
 <div class="container">
    <div class="pages-links">
       <ul class="list-unstyled">
          <?php if ($EmpTbl->type == 'patient'): ?>
            <li class="d-inline-block"><a href="/reservations">Quotes</a></li>
            <li class="d-inline-block"><a href="/favourites">Favourites</a></li>
            <li class="d-inline-block"><a href="/quote_doctor">Quote PSYCHOLOGIST</a></li>

          <?php else: ?>
            <li class="d-inline-block"><a href="/doctor_full_profile/<?= $UserTbl->hash_key ?>">Profile</a></li>
          <?php endif ?>
          <li class="d-inline-block active"><a href="/my_data">My Data</a></li>
       </ul>
    </div>
 </div>
</div>
<!-- pages-links end -->
<!--sec-professional--->
<section class="bg-grey pt-5">
   <div class="row">
      <div class="container">
         <div class="professional">
            <div class="professional-main-head pt-2 pb-2 pl-2 border">
               <h2>Quote PSYCHOLOGIST</h2>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- sec-professional-end -->
<section class="bg-grey">
   <div class="row">
      <div class="container">
         <div class="appointments-list bg-white table-responsive mb-5">
        @if(session()->has('error'))
            <div class="alert alert-danger">
                {!! session()->get('error') !!}
            </div>
        @endif
        @if(session()->has('message'))
            <div class="alert alert-success">
                {!! session()->get('message') !!}
            </div>
        @endif
            <form action="/send_quote_email" method="POST">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <label>Full Name</label>
               <div class="form-group">
                  <input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="Enter Your Name">
               </div>
               <label>Contact</label>
               <div class="form-group">
                  <input type="number" class="form-control" value="{{ old('contact') }}" name="contact" placeholder="Enter Your Contact Number" required>
               </div>
               <label>Email</label>
               <div class="form-group">
                  <input type="email" class="form-control" value="{{ old('email') }}" name="email" placeholder="Enter Your Surname" required>
               </div>
               <label>Region</label>
               <select class="form-control" name="forecast" required>
                   <option value="" hidden></option>
                    <?php if ($allForecasts): ?>
                          <?php foreach ($allForecasts as $key => $forecast): ?>
                               <option value="<?= $forecast->name; ?>"><?= $forecast->name; ?></option>
                          <?php endforeach ?>
                    <?php endif ?>
               </select>
               <label>City</label>
	            <select class="form-control" name="city" required>
	                <option value="" hidden></option>
	                 <?php if ($allCities): ?>
	                       <?php foreach ($allCities as $key => $city): ?>
	                            <option value="<?= $city->name; ?>"><?= $city->name; ?></option>
	                       <?php endforeach ?>
	                 <?php endif ?>
	            </select>
               <label>Specialty</label>
               <select class="form-control" name="specialty" required>
                   <option value="" hidden></option>
                    <?php if ($allSpecialities): ?>
                          <?php foreach ($allSpecialities as $key => $specialty): ?>
                               <option value="<?= $specialty->name; ?>"><?= $specialty->name; ?></option>
                          <?php endforeach ?>
                    <?php endif ?>
               </select>
               <label>Note</label>
               <textarea class="form-control" name="note" id="" cols="20" rows="4" required></textarea>
               <br>
               <div class="quote-btn">
                  <button type="submit" class="btn btn-primary">Submit</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</section>
@stop