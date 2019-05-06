<?php use App\Http\Controllers\Frontend\IndexController; ?>
@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- pages-links -->
<div class="row page-link-nav">
 <div class="container">
    <div class="pages-links">
       <ul class="list-unstyled">
        <?php if ($EmpTbl != NULL): ?>
          
          <?php if ($EmpTbl->type == 'patient'): ?>
            <li class="d-inline-block"><a href="/reservations">Citas</a></li>
            <li class="d-inline-block"><a href="/favourites">Favoritas</a></li>
            <li class="d-inline-block"><a href="/quote_doctor">Cotizar psicólogo</a></li>

          <?php else: ?>
            <li class="d-inline-block"><a href="/doctor_full_profile/<?= $EmpTbl->hash_key ?>">Perfil</a></li>
          <?php endif ?>
          <li class="d-inline-block active"><a href="/my_data">Mis datos</a></li>
        
        <?php endif ?>
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
               <h2>Cotizar psicólogo</h2>
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
              <input autocomplete="off" type="hidden" name="_token" value="{{ csrf_token() }}">
               <label for="name">Nombre completo</label>
               <div class="form-group">
                  <input autocomplete="off" type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="Introduzca su nombre" oninvalid="this.setCustomValidity('Por favor rellene este campo')" oninput="setCustomValidity('')" required>
               </div>
               <label for="contact">Número de teléfono</label>
               <div class="form-group">
                  <input autocomplete="off" type="number" class="form-control" value="{{ old('contact') }}" name="contact" placeholder="Ingrese su número de contacto" oninvalid="this.setCustomValidity('Por favor rellene este campo')" oninput="setCustomValidity('')" required>
               </div>
               <label for="email">correo electrónico</label>
               <div class="form-group">
                  <input autocomplete="off" type="email" class="form-control" value="{{ old('email') }}" name="email" placeholder="Introduce tu correo electrónico" oninvalid="this.setCustomValidity('Por favor rellene este campo')" oninput="setCustomValidity('')" required>
               </div>
               <label for="forecast">PREVISION DE SALUD</label>
               <select class="form-control" name="forecast" oninvalid="this.setCustomValidity('Por favor rellene este campo')" oninput="setCustomValidity('')" required>
                   <option value="" hidden></option>
                    <?php if ($allForecasts): ?>
                          <?php foreach ($allForecasts as $key => $forecast): ?>
                               <option value="<?= $forecast->name; ?>"><?= $forecast->name; ?></option>
                          <?php endforeach ?>
                    <?php endif ?>
               </select>
               <label for="city">Región</label>
	            <select class="form-control" name="city" oninvalid="this.setCustomValidity('Por favor rellene este campo')" oninput="setCustomValidity('')" required>
	                <option value="" hidden></option>
	                 <?php if ($allCities): ?>
	                       <?php foreach ($allCities as $key => $city): ?>
	                            <option value="<?= $city->name; ?>"><?= $city->name; ?></option>
	                       <?php endforeach ?>
	                 <?php endif ?>
	            </select>
               <label for="specialty">Especialidad</label>
               <select class="specialty_quote form-control" name="specialty[]" multiple="multiple" required>
                    <?php if ($allSpecialities): ?>
                        <?php foreach ($allSpecialities as $key => $specialty): ?>
                             <option value="<?= $specialty->name; ?>"><?= $specialty->name; ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
               </select>
               <label for="note">Nota</label>
               <textarea class="form-control" name="note" id="" cols="20" rows="4" oninvalid="this.setCustomValidity('Por favor rellene este campo')" oninput="setCustomValidity('')" required></textarea>
               <br>
               <div class="quote-btn">
                  <button type="submit" class="btn btn-primary">Enviar</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</section>
@stop