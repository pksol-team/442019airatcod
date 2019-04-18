@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- pages-links -->
<section class="bg-grey">
   <div class="row">
      <div class="post-lead-feedback-wrap mt-5">
         <div class="post-lead-feedback happy">
            
            <h3><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $message }}</font></font></h3>
            <div class="more-reviews">
               <a class="btn-more-reviews" href="/userlogin"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
               Login</font></font></a>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- pages-links end -->
@stop