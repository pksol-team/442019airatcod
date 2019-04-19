@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- header-end -->
<div class="container my-5 add_appointment_day_time">
   <div class="row">
      <div class=" col-lg-12 consulting-time text-center">
         <h2 class="text-center">Counsulting Time</h2>
      </div>
   </div>
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
   <div class="row my-3">
      <div class="col-lg-4">
      <form method="post" action="/consulting_add" class="user-log-form">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <div class="row">
            <div class="col-lg-10 days justify-content-center">
               <div class="form-group">
                  <label for="sel1">Day</label>
                  <select class="form-control" name="day">
                     <option value="Monday">Monday</option>
                     <option value="Tuesday">Tuesday</option>
                     <option value="Wednesday">Wednesday</option>
                     <option value="Thursday">Thursday</option>
                     <option value="Friday">Friday</option>
                     <option value="Saturday">Saturday</option>
                     <option value="Sunday">Sunday</option>
                  </select>
               </div>
            </div>
            <div class="col-lg-2 button align-middle my-4 py-1">
               <input type="checkbox" class="close_day_button" checked data-toggle="toggle" data-onstyle="success" name="status">
            </div>
         </div>
      </div>
      <div class="col-lg-8 consulting_fields_main">
         <div class="row">
            <div class="col-lg-2">
               <div class="form-group">
                  <label for="sel1">From:</label>
                  <select class="form-control" name="from_time">
                     <option value="1:00">1:00</option>
                     <option value="2:00">2:00</option>
                     <option value="3:00">3:00</option>
                     <option value="4:00">4:00</option>
                     <option value="5:00">5:00</option>
                     <option value="6:00">6:00</option>
                     <option value="7:00">7:00</option>
                     <option value="8:00">8:00</option>
                     <option value="9:00">9:00</option>
                     <option value="10:00">10:00</option>
                     <option value="11:00">11:00</option>
                     <option value="12:00">12:00</option>
                  </select>
               </div>
            </div>
            <div class="col-lg-2">
               <div class="form-group">
                  <label for="sel1">AM / PM</label>
                  <select class="form-control" name="from_AM_PM">
                     <option value="AM">AM</option>
                     <option value="PM">PM</option>
                  </select>
               </div>
            </div>
            <div class="col-lg-2">
               <div class="form-group">
                  <label for="sel1">To :</label>
                  <select class="form-control" name="to_time">
                     <option value="1:00">1:00</option>
                     <option value="2:00">2:00</option>
                     <option value="3:00">3:00</option>
                     <option value="4:00">4:00</option>
                     <option value="5:00">5:00</option>
                     <option value="6:00">6:00</option>
                     <option value="7:00">7:00</option>
                     <option value="8:00">8:00</option>
                     <option value="9:00">9:00</option>
                     <option value="10:00">10:00</option>
                     <option value="11:00">11:00</option>
                     <option value="12:00">12:00</option>
                  </select>
               </div>
            </div>
            <div class="col-lg-2">
               <div class="form-group">
                  <label for="sel1">AM / PM</label>
                  <select class="form-control" name="to_AM_PM">
                     <option value="AM">AM</option>
                     <option value="PM">PM</option>
                  </select>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="form-group">
                  <label for="sel1">Location</label>
                  <input type="text" class="form-control location" placeholder="Enter Location" name="location" required />
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row text-center consulting_fields_main_button">
      <div class="col-12">
         <?php 
            $user_id = Auth::user()->id;
            $EmpTbl = DB::table('employees')->where('id', $user_id)->first();
          ?>
         <a href="/doctor_full_profile/<?= $EmpTbl->hash_key ?>"><button type="button" class="btn btn-dark">Back</button></a>
         <button type="submit" class="btn btn-success">Save Consulting</button> 
      </div><!-- /.col-12 -->
   </div><!-- /.row -->
   </form>
</div>
@stop