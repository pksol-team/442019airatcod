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
               <h4>Your opinion about <?= $EmpTbl->first_name; ?></h4>
            </div>
            <div class="professional-content bg-white">
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
		                           <label for="select" class="mr-4">Where did you visit</label>
		                           <select name="location">
		                              <option value="Karachi">Karachi</option>
		                              <option value="Lahore">Lahore</option>
		                              <option value="Islamabad">Islamabad</option>
		                              <option value="Multan">Multan</option>
		                           </select>
                        		</div><!-- /.col-lg-12 -->
                        	</div><!-- /.row -->
                        	<div class="row mb-3">
                        		<div class="col-lg-12 facilites-col text-left">
		                           <label for="rating" class="align-top mb-0 p-2">Facilities</label>
                        			<div class="rating d-inline-block">
                        			   <input type="radio" id="facilites-star5" name="facilities" value="5" /><label for="facilites-star5" title="Very good">5 stars</label>
                        			   <input type="radio" id="facilites-star4" name="facilities" value="4" /><label for="facilites-star4" title="Good">4 stars</label>
                        			   <input type="radio" id="facilites-star3" name="facilities" value="3" /><label for="facilites-star3" title="Regular">3 stars</label>
                        			   <input type="radio" id="facilites-star2" name="facilities" value="2" /><label for="facilites-star2" title="Bad">2 stars</label>
                        			   <input type="radio" id="facilites-star1" name="facilities" value="1" required/><label for="facilites-star1" title="Very bad">1 star</label>
                        			</div>
                        		</div><!-- /.col-lg-12 -->
                        		<div class="col-lg-12 puntuality-col text-left">
		                           <label for="rating" class="align-top mb-0 p-2">Puntuality</label>
                        			<div class="rating d-inline-block">
                        			   <input type="radio" id="puntuality-star5" name="puntuality" value="5" /><label for="puntuality-star5" title="Very good">5 stars</label>
                        			   <input type="radio" id="puntuality-star4" name="puntuality" value="4" /><label for="puntuality-star4" title="Good">4 stars</label>
                        			   <input type="radio" id="puntuality-star3" name="puntuality" value="3" /><label for="puntuality-star3" title="Regular">3 stars</label>
                        			   <input type="radio" id="puntuality-star2" name="puntuality" value="2" /><label for="puntuality-star2" title="Bad">2 stars</label>
                        			   <input type="radio" id="puntuality-star1" name="puntuality" value="1" required/><label for="puntuality-star1" title="Very bad">1 star</label>
                        			</div>
                        		</div>
                        		<div class="col-lg-12 attention-col text-left">
		                           <label for="rating" class="align-top mb-0 p-2">Attention</label>
                        			<div class="rating d-inline-block">
                        			   <input type="radio" id="attention-star5" name="attention" value="5" /><label for="attention-star5" title="Very good">5 stars</label>
                        			   <input type="radio" id="attention-star4" name="attention" value="4" /><label for="attention-star4" title="Good">4 stars</label>
                        			   <input type="radio" id="attention-star3" name="attention" value="3" /><label for="attention-star3" title="Regular">3 stars</label>
                        			   <input type="radio" id="attention-star2" name="attention" value="2" /><label for="attention-star2" title="Bad">2 stars</label>
                        			   <input type="radio" id="attention-star1" name="attention" value="1" required/><label for="attention-star1" title="Very bad">1 star</label>
                        			</div>
                        		</div>
                        		<div class="col-lg-12 recommendable-col text-left">
		                           <label for="rating" class="align-top mb-0 p-2">Recommendable</label>
                        			<div class="rating d-inline-block">
                        			   <input type="radio" id="recommendable-star5" name="recommendable" value="5" /><label for="recommendable-star5" title="Very good">5 stars</label>
                        			   <input type="radio" id="recommendable-star4" name="recommendable" value="4" /><label for="recommendable-star4" title="Good">4 stars</label>
                        			   <input type="radio" id="recommendable-star3" name="recommendable" value="3" /><label for="recommendable-star3" title="Regular">3 stars</label>
                        			   <input type="radio" id="recommendable-star2" name="recommendable" value="2" /><label for="recommendable-star2" title="Bad">2 stars</label>
                        			   <input type="radio" id="recommendable-star1" name="recommendable" value="1" required/><label for="recommendable-star1" title="Very bad">1 star</label>
                        			</div>
                        		</div>
                        	</div><!-- /.row -->
                        	<div class="row mb-3">
                        		<div class="col-lg-12">
                        			<label for="input" class="mr-3">The reason of the visit</label>
                        			<input type="text" name="reason" class="reason_input" placeholder="Type reason of the visit" />
                        			<span class="reason-help-text f-12 d-block">It will help other patients to better understand your opinion.</span>
                        		</div><!-- /.col-lg-12 -->
                        	</div><!-- /.row -->
                        	<div class="row mb-3">
                        		<div class="col-lg-12">
                        			<label for="input" class="mr-5 mb-0 pb-5 align-top">What did you like</label>
                        			<textarea name="like" class="reason_input"></textarea>
                        			<span class="reason-help-text like-help-text f-12 d-block">You can still write 300 characters</span>
                        		</div><!-- /.col-lg-12 -->
                        	</div><!-- /.row -->
                        	<div class="row mb-3">
                        		<div class="col-lg-12">
                        			<label for="input" class="mr-1 mb-0 pb-5 align-top">What could be improved</label>
                        			<textarea name="improved" class="reason_input"></textarea>
                        			<span class="reason-help-text like-help-text f-12 d-block">You can still write 300 characters</span>
                        		</div><!-- /.col-lg-12 -->
                        	</div><!-- /.row -->
                        	<div class="row text-center d-block">
                        		<button type="submit" class="btn btn-success">Continue</button>
                        		<button type="button" class="btn btn-dark"><a class="text-white" href="/doctor_profile_view/<?= $EmpTbl->id.'/'.$EmpTbl->hash_key ?>">Cancel</a></button>
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