@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- pages-links end -->
<section class="doctor_full_main_page bg-grey">
   <div class="row quotes-sec">
      <div class="container">
         <div class="quotes-head text-center">
            <h3>Artículos más leídos</h3>
         </div>
      </div>
   </div>
   <div class="container">
      <div class="row">
         <div class="col-12">
            <?php if ($all_articles->total() > 0): ?>
               <?php foreach ($all_articles as $key => $article): ?>
                  <article class="row mb-2 mt-2 bg-white pt-2">
                     <div class="col-3">
                        <div class="card-image">
                           <figure class="">
                              <?php 
                                 $UserImageGet = DB::table('uploads')->WHERE('id', $article->image)->first();
                                 $UserImage = "/files/$UserImageGet->hash/$UserImageGet->name";
                              ?>
                              <img width="100%" class="boosted-image" src="{{ $UserImage }}" alt="">
                           </figure>
                        </div>
                     </div>
                     <div class="column col-9">
                        <div class="article-content-expanded mt-4">
                           <a href="{{ $article->id }}/article_view" class="columns">
                              <span class="is-size-5 has-text-weight-bold py-2">{{ $article->title }}</span>
                           </a> 
                           <p class="article-content-description">
                              {{ $article->short_description }}
                           </p>
                           <div class="section list-butttons-wrapper">
                              <a href="{{ $article->id }}/article_view" class="button is-small is-fullwidth is-rounded is-info is-outlined has-nice-shadow">
                                 <span>Sigue leyendo este articulo</span>
                              </a>
                           </div>
                        </div>
                     </div>
                  </article>
               <?php endforeach ?>
               <nav aria-label="Page navigation" class="page-navigation">
                  {{ $all_articles->links() }}
               </nav>
            <?php else: ?>
               <article class="row mb-2 mt-2 bg-white pt-2">
                  <div class="p-5">
                     ningún record fue encontrado
                  </div>
               </article>
            <?php endif ?>
         </div>
      </div>
   </div>
</section>
@stop