@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- pages-links -->
<section class="bg-grey">
   <div class="row">
      <div class="container">
         <div class="breadcrumb-links">
            <!-- <ol class="breadcrumb breadcrumb-items float-left">
               <li class="breadcrumb-item active" aria-current="page">Home</li>
               <li class="breadcrumb-item " aria-current="page">Library</li>
            </ol> -->
         </div>
         <div class="social-icons float-right">
            <div class="social-links">
               <ol>
                  <li>
                     <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= Request::fullUrl(); ?>"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                  </li>
                  <li>
                     <a target="_blank" href="https://twitter.com/home?status=<?= Request::fullUrl(); ?>"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
                  </li>
               </ol>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- pages-links end -->
<!--sec-professional--->
<section class="bg-grey">
   <div class="row">
      <div class="container">
         <div class="professional">
            <div class="professional-main-head pt-3 pb-3 pl-4 border">
               <h4>Tu opinión sobre <?= $EmpTbl->first_name; ?></h4>
            </div>
            <div class="professional-content bg-white">
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {!! session()->get('error') !!}
                </div>
            @endif
            <div class="feedback">
               <div class="row">
                  <div id="comment" class="col-lg-12 text-center">
                    <form action="/review_add" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="doctor_id" value="{{ $EmpTbl->id }}">
                        <?php 
                        	if (Auth::check()) {
				                $userID = Auth::user()->id;
		                        echo '<input type="hidden" name="user_id" value="'.$userID.'">';
                        	}
                        ?>
                        <div class="form_select">
                        	<div class="row mb-3">
                        		<div class="col-lg-12">
		                           <label for="location" class="mr-4">Qué lugar visitaste</label>
                                 <input type="text" name="location" class="reason_input" oninvalid="this.setCustomValidity('Por favor rellene este campo')" oninput="setCustomValidity('')" required />
		                           </select>
                        		</div><!-- /.col-lg-12 -->
                        	</div><!-- /.row -->
                        	<div class="row mb-3">
                        		<div class="col-lg-12 facilites-col text-left">
		                           <label for="rating" class="align-top mb-0 p-2">Instalaciones</label>
                        			<div class="rating d-inline-block">
                        			   <input type="radio" id="facilites-star5" name="facilities" value="5" /><label for="facilites-star5" title="Very good">5 stars</label>
                        			   <input type="radio" id="facilites-star4" name="facilities" value="4" /><label for="facilites-star4" title="Good">4 stars</label>
                        			   <input type="radio" id="facilites-star3" name="facilities" value="3" /><label for="facilites-star3" title="Regular">3 stars</label>
                        			   <input type="radio" id="facilites-star2" name="facilities" value="2" /><label for="facilites-star2" title="Bad">2 stars</label>
                        			   <input type="radio" id="facilites-star1" name="facilities" checked value="1" required/><label for="facilites-star1" title="Very bad">1 star</label>
                        			</div>
                        		</div><!-- /.col-lg-12 -->
                        		<div class="col-lg-12 puntuality-col text-left">
		                           <label for="rating" class="align-top mb-0 p-2">Puntualidad</label>
                        			<div class="rating d-inline-block">
                        			   <input type="radio" id="puntuality-star5" name="puntuality" value="5" /><label for="puntuality-star5" title="Very good">5 stars</label>
                        			   <input type="radio" id="puntuality-star4" name="puntuality" value="4" /><label for="puntuality-star4" title="Good">4 stars</label>
                        			   <input type="radio" id="puntuality-star3" name="puntuality" value="3" /><label for="puntuality-star3" title="Regular">3 stars</label>
                        			   <input type="radio" id="puntuality-star2" name="puntuality" value="2" /><label for="puntuality-star2" title="Bad">2 stars</label>
                        			   <input type="radio" id="puntuality-star1" name="puntuality" checked value="1" required/><label for="puntuality-star1" title="Very bad">1 star</label>
                        			</div>
                        		</div>
                        		<div class="col-lg-12 attention-col text-left">
		                           <label for="rating" class="align-top mb-0 p-2">Atención</label>
                        			<div class="rating d-inline-block">
                        			   <input type="radio" id="attention-star5" name="attention" value="5" /><label for="attention-star5" title="Very good">5 stars</label>
                        			   <input type="radio" id="attention-star4" name="attention" value="4" /><label for="attention-star4" title="Good">4 stars</label>
                        			   <input type="radio" id="attention-star3" name="attention" value="3" /><label for="attention-star3" title="Regular">3 stars</label>
                        			   <input type="radio" id="attention-star2" name="attention" value="2" /><label for="attention-star2" title="Bad">2 stars</label>
                        			   <input type="radio" id="attention-star1" name="attention" checked value="1" required/><label for="attention-star1" title="Very bad">1 star</label>
                        			</div>
                        		</div>
                        		<div class="col-lg-12 recommendable-col text-left">
		                           <label for="rating" class="align-top mb-0 p-2">Recomendable</label>
                        			<div class="rating d-inline-block">
                        			   <input type="radio" id="recommendable-star5" name="recommendable" value="5" /><label for="recommendable-star5" title="Very good">5 stars</label>
                        			   <input type="radio" id="recommendable-star4" name="recommendable" value="4" /><label for="recommendable-star4" title="Good">4 stars</label>
                        			   <input type="radio" id="recommendable-star3" name="recommendable" value="3" /><label for="recommendable-star3" title="Regular">3 stars</label>
                        			   <input type="radio" id="recommendable-star2" name="recommendable" value="2" /><label for="recommendable-star2" title="Bad">2 stars</label>
                        			   <input type="radio" id="recommendable-star1" name="recommendable" checked value="1" required/><label for="recommendable-star1" title="Very bad">1 star</label>
                        			</div>
                        		</div>
                        	</div><!-- /.row -->
                        	<div class="row mb-3">
                        		<div class="col-lg-12 pl-0">
                        			<label for="input" class="mr-4">El motivo de la visita.</label>
                        			<input type="text" name="reason" class="reason_input" placeholder="Type reason of the visit" />
                        			<span class="reason-help-text f-12 d-block">Ayudará a otros pacientes a comprender mejor su opinión.</span>
                        		</div><!-- /.col-lg-12 -->
                        	</div><!-- /.row -->
                        	<div class="row mb-3">
                        		<div class="col-lg-12 pl-4">
                        			<label for="input" class="mr-5 mb-0 pb-5 align-top">Qué te gustó</label>
                        			<textarea name="like" class="reason_input"></textarea>
                        			<span class="reason-help-text like-help-text f-12 d-block">Todavía puedes escribir 300 caracteres</span>
                        		</div><!-- /.col-lg-12 -->
                        	</div><!-- /.row -->
                        	<div class="row mb-3">
                        		<div class="col-lg-12 pl-0">
                        			<label for="input" class="mr-3 mb-0 pb-5 align-top">¿Qué podría mejorarse?</label>
                        			<textarea name="improved" class="reason_input"></textarea>
                        			<span class="reason-help-text like-help-text f-12 d-block">Todavía puedes escribir 300 caracteres</span>
                        		</div><!-- /.col-lg-12 -->
                        	</div><!-- /.row -->
                        	<div class="row text-center d-block">
                        		<button type="submit" class="btn btn-success">Continuar</button>
                        		<button type="button" class="btn btn-dark"><a class="text-white" href="/doctor_profile_view/<?= $EmpTbl->id.'/'.$EmpTbl->hash_key ?>">Cancelar</a></button>
                        	</div><!-- /.row -->
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- sec-professional-end -->
<section class="bg-grey">
   <div class="row">
      <div class="container">
      </div>
   </div>
</section>
@stop