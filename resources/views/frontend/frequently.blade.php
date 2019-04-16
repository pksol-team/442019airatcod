@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- pages-links -->
<section class="bg-grey">
   <div class="row">
      <div class="post-lead-feedback-wrap mt-5">
         <div class="post-lead-feedback happy">
            
            <h3><i class="fa fa-smile-o post-lead-icon" aria-hidden="true"></i> <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Thank you for your opinion!</font></font></h3>
            <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Your assessment will help millions of patients find the best health professional.</font></font></p>
            <div class="more-reviews">
               <div class="more-reviews-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                  Comment now on someone else!</font></font>
               </div>
               <a class="btn-more-reviews" href="/all_professional"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
               Rate another professional</font></font></a>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- pages-links end -->
@stop