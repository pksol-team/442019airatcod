@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- pages-links -->
<div class="row page-link-nav">
 <div class="container">
    <div class="pages-links">
       <ul class="list-unstyled">
          <?php if ($EmpTbl->type == 'patient'): ?>
            <li class="d-inline-block"><a href="/reservations">Citas</a></li>
            <li class="d-inline-block"><a href="/favourites">Favoritas</a></li>
            <li class="d-inline-block"><a href="/quote_doctor">Cotizar psicólogo</a></li>

          <?php else: ?>
            <li class="d-inline-block"><a href="/doctor_full_profile/<?= $UserTbl->hash_key ?>">Perfil</a></li>
          <?php endif ?>
          <li class="d-inline-block active"><a href="/my_data">Mes données</a></li>
       </ul>
    </div>
 </div>
</div>
<!-- pages-links end -->
<section class="doctor_profile_section">
 <div class="row quotes-sec">
    <div class="container">
       <div class="quotes-head text-center">
          <h3>Mes données</h3>
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
                   <label>Prénom</label>
                   <input type="text" placeholder="Entrez le prénom ici .." class="form-control" name="first_name" value="<?= $EmpTbl->first_name; ?>" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required>
                </div>
                <div class="col-sm-6 form-group">
                   <label>Nom de famille</label>
                   <input type="text" placeholder="Entrez le nom de famille ici .." class="form-control" name="last_name" value="<?= $EmpTbl->last_name; ?>" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-6 form-group">
                   <label>Mobile</label>
                   <input type="text" placeholder="Entrez le numéro de téléphone ici .." class="form-control" name="mobile" value="<?= $EmpTbl->mobile; ?>" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required>
                </div>
                <div class="col-sm-6 form-group">
                   <label>code postal</label>
                   <input type="text" placeholder="Entrez le code postal ici .." class="form-control" name="postal_code" value="<?= $EmpTbl->postal_code; ?>" >
                </div>
             </div>
             <div class="row">
                <div class="col-sm-6 form-group">
                   <label>adresse électronique</label>
                   <input type="email" placeholder="Entrez email ici .." class="form-control" name="email" value="<?= $EmpTbl->email; ?>" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required>
                </div>
                <div class="col-sm-6 form-group">
                   <label>Mot de passe (laissez le champ vide si vous ne voulez pas le changer)</label>
                   <input type="password" name="password" placeholder="Entrez le mot de passe ici .." class="type_password form-control">
                </div>
             </div>
             <div class="row">
                <div class="col-sm-6">
                   <label>Isapre</label>
                   <input type="text" name="isapre" placeholder="Privé sans prévisions" value="<?= $EmpTbl->isapre; ?>" class="form-control">
                   <div class="checkbox-my-data">	
                      <span class="d-block">
                        <input type="checkbox" name="notification" <?= ($EmpTbl->notification == 'on') ? 'checked' : NULL ; ?> >
                        <label for="notification">Recevoir un email d'avis de rendez-vous</label>
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
