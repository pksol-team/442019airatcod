@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- Login-Section -->
<section>
   <div class="container">
      <div class="row login-sec">
         <div class="col-lg-8">
            <div class="login-main-head">
               <h2 class="border-bottom">Registry</h2>
            </div>
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {!! session()->get('error') !!}
                </div>
            @endif
            <div class="login-points">
               <ul class="list-unstyled">
                  <li><i class="fa fa-arrow-right" aria-hidden="true"></i>If you are already a Doctoralia user,
                     <a href="/userlogin" class="pl-2">Login </a>
                  </li>
                  <li><i class="fa fa-arrow-right" aria-hidden="true"></i>Registration in Doctoralia is free! Sign up with <a href="{{ route('facebook.login') }}">Facebook</a> or your email:</li>
               </ul>
            </div>
            <div class="login_form registry-form text-center">
               <form method="post" action="/register_check">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="row my-2">
                     <div class="col-lg-2 col-md-2 col-sm-4 col-12 registry-label-sec label-sec">
                        <label for="email" class="email">Email</label>
                     </div>
                     <div class="col-lg-10 col-md-10 col-sm-4 col-12 registry-emai-sec login_input-sec">
                        <input type="email" class="form-control" value="{{ old('email') }}" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                        <small class="float-left">We will send a confirmation email to this address</small>
                     </div>
                  </div>
                  <div class="row my-2">
                     <div class="col-lg-2 col-md-2 col-sm-4 col-12 registry-pass">
                        <label for="password" class="mt-2 pt-2">password</label>
                     </div>
                     <div class="col-lg-10 col-md-10 col-sm-4 col-12 registry-pass-input login_input-sec">
                        <input type="password" name="password" class="form-control mt-2 w-50" id="exampleInputPassword1"  placeholder="Enter password" minlength="6" required>
                        <small class="float-left">To log in to Doctoralia</small>
                     </div>
                  </div>
                  <div class="row my-2">
                     <div class="col-lg-2 col-md-2 col-sm-4 col-12 registry-confirm-pas ">
                        <label for="password" class="mt-2 pt-2">Confirm Password</label>
                     </div>
                     <div class="col-lg-10 col-md-10 col-sm-4 col-12 registry-confirm-pas-input  login_input-sec">
                        <input minlength="6" type="password" name="confirm_password" class="form-control mt-2 w-50" id="exampleInputPassword2" placeholder="Confirm password" required>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-2 col-md-2 col-sm-4 col-2">
                        &nbsp;
                     </div>
                     <div class="col-lg-10 col-md-10 col-sm-4 col-12">
                        <div class="logIn-button registry-link">
                           <button type="submit" class="btn btn-primary text-white">Register</button>
                        </div>
                        <div class="forget-pas">
                           <small>By continuing, you are accepting the <a href="" class="text-dark">conditions of use of Doctoralia</a>
                           </small>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="support">
               <h3>Advantages of registration:</h3>
               <div class="reg-list-items">
                  <ul class="list-unstyled">
                     <li>
                        <span><i class="fa fa-check" aria-hidden="true"></i></span>
                        <span><strong>Book an Appointment</strong><small> with your doctor</small></span>
                     </li>
                     <li>
                        <span><i class="fa fa-check" aria-hidden="true"></i></span>
                        <span><strong>Comment </strong><small> on doctors and centers</small></span>
                     </li>
                     <li>
                        <span><i class="fa fa-check" aria-hidden="true"></i></span>
                        <span><strong>Ask </strong><small> experts</small></span> 
                     </li>
                     <li>
                        <small>All completely </small><strong> free </strong>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- Login-Section-Ends -->
@stop