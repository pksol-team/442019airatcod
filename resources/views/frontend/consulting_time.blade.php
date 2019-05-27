@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- header-end -->
<div class="container my-5 add_appointment_day_time">
   <div class="row">
      <div class=" col-lg-12 consulting-time text-center">
         <h2 class="text-center">Tiempo de consulta</h2>
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
                  <label for="sel1">Día</label>
                  <select class="form-control" name="day">
                     <option value="Monday">lunes</option>
                     <option value="Tuesday">martes</option>
                     <option value="Wednesday">miércoles</option>
                     <option value="Thursday">jueves</option>
                     <option value="Friday">viernes</option>
                     <option value="Saturday">sábado</option>
                     <option value="Sunday">domingo</option>
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
                  <label for="sel1">Desde:</label>
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
                  <label for="sel1">a :</label>
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
                  <input type="text" class="form-control location" placeholder="Ingresar Ubicación" name="location" oninvalid="this.setCustomValidity('Por favor rellene este campo')" oninput="setCustomValidity('')" required />
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
         <a href="/doctor_full_profile/<?= $EmpTbl->hash_key ?>"><button type="button" class="btn btn-dark">Espalda</button></a>
         <button type="submit" class="btn btn-success">Guardar Consultoría</button> 
      </div><!-- /.col-12 -->
   </div><!-- /.row -->
   </form>
</div>
@stop