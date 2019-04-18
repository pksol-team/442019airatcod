@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- pages-links -->
<section class="bg-grey">
   <div class="row">
      <div class="col-12">
         <div class="mt-5">
            <div class="main_faq">
               <h2 class="d-inline-block">F.A.Q</h2>
               <div class="cant_find d-inline-block float-right">
                  <span class="f-size">if you can't find your question click this button to generate ticket</span>
                  <button class="btn btn-success"><a href="/my_tickets" class="text-white">Ticket</a></button>
               </div>
               <?php if ($question != NULL): ?>
                  <div class="mt-4">
                     <span>Your Question:</span>
                     <span><b><?= $question; ?></b></span>
                  </div>
               <?php endif ?>

               <div id="accordion" class="mt-5">
                  <?php if ($faqs != NULL): ?>
                     <?php foreach ($faqs as $key => $faq): ?>
                        <div class="card border-0">
                           <div class="card card-header border-right-0 border-left-0 border-bottom-0 faq-panel">
                              <a class="<?= ($key != 0) ? "collapsed": NULL ; ?> card-link" data-toggle="collapse" href="#collapseOne<?= $key; ?>">
                              <span class="pr-2"><i class="fa fa-caret-down" aria-hidden="true"></i></span><?= $faq->question; ?>
                              </a>
                           </div>
                           <div id="collapseOne<?= $key; ?>" class="collapse <?= ($key == 0) ? "show": NULL ; ?>" data-parent="#accordion">
                              <div class="card-body border-0">
                                 <?= $faq->answer; ?>
                              </div>
                           </div>
                        </div>
                     <?php endforeach ?>
                  <?php endif ?>
               </div>
            </div>
         </div>
      </div><!-- /.col-10 -->
   </div>
</section>
<!-- pages-links end -->
@stop