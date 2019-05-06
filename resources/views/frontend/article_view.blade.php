<?php use App\Models\Article; ?>
@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- pages-links end -->
<section class="doctor_full_main_page article_view">
   <div class="row quotes-sec mb-3">
      <div class="container">
         <div class="quotes-head text-center">
            <h3>Artículos más leídos</h3>
         </div>
      </div>
   </div>
   <div class="container">
      <div class="row">
         <div class="col-12">
            <?php if ($article): ?>
               <div class="row">                  
                  <div class="col-lg-8">
                     <div class="main-img mb-4">
                        <?php 
                           $UserImageGet = DB::table('uploads')->WHERE('id', $article->image)->first();
                           $UserImage = "/files/$UserImageGet->hash/$UserImageGet->name";
                        ?>
                        <img src="{{ $UserImage }}" alt="{{ $article->title }}" />
                     </div><!-- /.main-img -->
                     <div class="w-100 d-inline-block">
                        <?php $user = Article::with('users')->first(); ?>
                        <span class="float-right mr-4">
                           <?php if (Auth::user()->id == $user->users->id): ?>
                              <a href="/edit_article/{{ $article->id }}/{{ $user->users->id }}/{{ $user->users->hash_key }}"><button class="btn btn-success btn-sm">Editar artículo</button></a>
                           <?php endif ?>
                           - por el doctor 
                           <a href="/doctor_profile_view/{{ $article->user_id }}/{{ $user->users->hash_key }}">{{ $user->users->first_name }}</a>
                        </span>
                     </div>
                     <article class="mb-3">
                        {!! $article->detail !!}
                     </article>
                  </div><!-- /.col-lg-12 -->
                  <div class="col-lg-4">
                     <div class="related-posts">
                        <h4 class="mb-4"><i class="fa fa-file-text" aria-hidden="true"></i>Artículos Recientes</h4>
                        <div class="posts-div"> 
                           <?php if ($all_articles): ?>
                              <?php foreach ($all_articles as $key => $article): ?>
                                 <?php 
                                    $UserImageGet = DB::table('uploads')->WHERE('id', $article->image)->first();
                                    $UserImage = "/files/$UserImageGet->hash/$UserImageGet->name";
                                 ?>
                                 <div class="posts">
                                    <div class="row">
                                       <div class="col-4">                               
                                          <a href="{{ $article->id }}/article_view"><img src="{{ $UserImage }}" alt="{ $article->title }}" /></a>
                                       </div><!-- /.col-4 -->
                                       <div class="col-8">
                                          <a href="{{ $article->id }}/article_view"><p>{{ $article->title }}</p></a>
                                       </div><!-- /.col-4 -->
                                    </div><!-- /.row -->
                                 </div><!-- /.posts -->
                              <?php endforeach ?>
                                 <div class="float-right">
                                    <a href="/blog_article"><i class="fa fa-eye" aria-hidden="true"></i>Ver todo</a>
                                 </div>
                           <?php endif ?>
                        </div><!-- /.posts-div -->
                     </div><!-- /.related-posts -->
                  </div><!-- /.col-lg-4 -->
               </div><!-- /.row -->
            <?php endif ?>
         </div>
      </div>
   </div>
</section>
@stop