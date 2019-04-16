@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!--sec-professional--->
<section class="bg-grey doctor_view_review">
   <div class="row">
      <div class="container">
         <div class="professional">
            <div class="feedback">
               <div class="row pt-2">
                  <div class="col-12 professional-main-head pt-3 pb-3 review-pat-head">
                     <h4 class="d-inline-block text-left">REVIEWS OF PATIENTS</h4>
                     <button class="btn btn-success d-inline-block float-right"><a href="/doctor_profile_view/<?= $UserTbl->id.'/'.$UserTbl->hash_key; ?>" class="text-white">Go Back</a></button>
                  </div>
                  <?php if ($reviews): ?>
                  	<?php foreach ($reviews as $key => $review): ?>
		                  <div id="comment" class="col-lg-12">
		                     <h4>
		                     	<?php 
			                      $patientName = DB::table('employees')->where('id', $review->patient_id)->first();
			                      echo $patientName->first_name;
		                     	 ?>
		                     </h4>
		                     <div id="ratings" class="col-lg-12 text-left">
		                       <span class="ratingXL">
		                       <?php $ratings = ($review->total /4)*20; ?>
		                         <span class="rating-avg-large ml-0"><span style="width: <?= (int)$ratings ?>%;"></span></span>
		                       </span>
		                     </div>
		                     <p><b>Reason : </b><?= $review->reason; ?></p>
		                     <p><b>Like : </b><?= $review->like; ?></p>
		                     <p><b>Improved : </b><?= $review->improved; ?></p>
		                  </div>
                  	<?php endforeach ?>
                  	<?php else: ?>
                  		<div id="comment" class="col-lg-12">
                  		   <p>Not rated Yet</p>
                  		</div>
                  <?php endif ?>
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