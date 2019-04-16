<?php use App\Http\Controllers\Frontend\IndexController; ?>
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
            <div class="professional-main-head pt-2 pb-2 pl-2 border">
               <h3><?= $heading; ?></h3>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- sec-professional-end -->
<section class="bg-grey">
   <div class="row">
      <div class="container">
         <div class="appointments-list bg-white table-responsive">
            <ul class="link-pages list-unstyled bg-white">
               <?php if ($allTags): ?>
                  <?php if ($table == 'specialities'): ?>
                     <?php foreach ($allTags as $key => $all): ?>
                        <li class="p-1"><a href="/all_professional?specialty=<?= $all->id; ?>&city=&forecast=&searchByInput="><?= $all->name; ?></a></li>
                     <?php endforeach ?>
                  <?php endif ?>
                  <?php if ($table == 'cities'): ?>
                     <?php foreach ($allTags as $key => $all): ?>
                        <li class="p-1"><a href="/all_professional?specialty=&city=<?= $all->name; ?>&forecast=&searchByInput="><?= $all->name; ?></a></li>
                     <?php endforeach ?>
                  <?php endif ?>
                  <?php if ($table == 'forecasts'): ?>
                     <?php foreach ($allTags as $key => $all): ?>
                        <li class="p-1"><a href="/all_professional?specialty=&city=&forecast=<?= $all->name; ?>&searchByInput="><?= $all->name; ?></a></li>
                     <?php endforeach ?>
                  <?php endif ?>
               <?php endif ?>
            </ul>
         </div>
      </div>
   </div>
</section>
@stop