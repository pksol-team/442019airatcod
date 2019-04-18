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
<section class="doctor_profile_section">
 <div class="row quotes-sec">
    <div class="container">
       <div class="quotes-head text-center">
          <h3>MY DATA</h3>
       </div>
    </div>
 </div>
 <div class="row justify-content-center">
    <div class="container">
       <form action="/update_my_data" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="my-data">
        @if(session()->has('message'))
             <div class="alert alert-success">
                 {!! session()->get('message') !!}
             </div>
         @endif
         @if(session()->has('error'))
             <div class="alert alert-danger">
                 {!! session()->get('error') !!}
             </div>
         @endif
             <div class="row">
                <div class="col-sm-6 form-group">
                   <label>First Name</label>
                   <input type="text" placeholder="Enter First Name Here.." class="form-control" name="first_name" value="<?= $EmpTbl->first_name; ?>" required>
                </div>
                <div class="col-sm-6 form-group">
                   <label>Last Name</label>
                   <input type="text" placeholder="Enter Last Name Here.." class="form-control" name="last_name" value="<?= $EmpTbl->last_name; ?>" required>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-6 form-group">
                   <label>Mobile</label>
                   <input type="text" placeholder="Enter Mobile Number Here.." class="form-control" name="mobile" value="<?= $EmpTbl->mobile; ?>" required>
                </div>
                <div class="col-sm-6 form-group">
                   <label>Postal Code</label>
                   <input type="text" placeholder="Enter Postal Code Here.." class="form-control" name="postal_code" value="<?= $EmpTbl->postal_code; ?>" >
                </div>
             </div>
             <div class="row">
                <div class="col-sm-6 form-group">
                   <label>Email</label>
                   <input type="email" placeholder="Enter email Here.." class="form-control" name="email" value="<?= $EmpTbl->email; ?>" required>
                </div>
                <div class="col-sm-6 form-group">
                   <label>Password (leave it blank if you don't want to change it)</label>
                   <input type="password" name="password" placeholder="Enter password Here.." class="type_password form-control">
                </div>
             </div>
             <div class="row">
                <div class="col-sm-6">
                   <label>Isapre</label>
                   <input type="text" name="isapre" placeholder="Private Without Forecast" value="<?= $EmpTbl->isapre; ?>" class="form-control">
                   <div class="checkbox-my-data">	
                      <span class="d-block">
                        <input type="checkbox" name="notification" <?= ($EmpTbl->notification == 'on') ? 'checked' : NULL ; ?> >
                        <label >Recieve Appointment Opinion Email</label>
                      </span>   
                      
                   </div>
                </div>
                <div class="col-sm-6 form-group submit-button">
                   <button type="submit" class="btn text-white bg-green">actualizar</button>
                </div>
             </div>
          </div>
       </form>
    </div>
 </div>
</section>
@stop
