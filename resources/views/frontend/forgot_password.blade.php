@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- Login-Section -->
<section>
   <div class="container">
      <div class="row login-sec">
         <div class="col-lg-8">
            <div class="login-main-head">
               <h2 class="border-bottom">Forgot Password</h2>
            </div>
            <div class="login-points">
               <ul class="list-unstyled">
                  <li><i class="fa fa-arrow-right" aria-hidden="true"></i>Only Patients:<a href="{{ route('facebook.login') }}" class="pl-2">Login With Facebook</a></li>
                  <!-- <li><i class="fa fa-arrow-right" aria-hidden="true"></i>Login With Doctorolia User Account</li> -->
               </ul>
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
            </div>
            <div class="login_form text-center">
               <form method="post" action="/forgot_send_email" class="user-log-form">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="row">
                     <div class="col-lg-2 col-md-2 col-sm-4 col-2 label-sec">
                        <label for="email" class="email">Email</label>
                     </div>
                     <div class="col-lg-10 col-md-10 col-sm-4 col-10 login_input-sec">
                        <input value="{{ old('email') }}" name="email" type="email" id="exampleInputEmail1" aria-describedby="emailHelp" class="form-control element-block" placeholder="Enter Email" required>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-2 col-md-2 col-sm-4 col-2">
                        &nbsp;
                     </div>
                     <div class="col-lg-10 col-md-10 col-sm-4 col-10  mb-4">
                        <div class="radio-sec">
                           <div class="checkbox">
                           </div>
                        </div>
                        <div class="logIn-button">
                           <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="support">
               <h3>Support</h3>
               <p>If you have any questions,contact doctorolia</p>
               <a href="mailto:support-cl@doctorolia.com">support-cl@doctorolia.com</a>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- Login-Section-Ends -->
@stop