@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="row page-link-nav">
   <div class="container">
      <div class="pages-links">
         <ul class="list-unstyled">
            <li class="d-inline-block active"><a href="">PERFIL</a></li>
            <li class="d-inline-block"><a href="<?= '/doctor_appointments/'.$EmpTbl->id.'/'.$EmpTbl->hash_key ?>">CITA DE RESERVA</a></li>
         </ul>
      </div>
   </div>
</div>
<div class="row bg-white">
   <div class="container">
      <div class="pages-links text-gray-dark">
         <ul class="list-unstyled">
            <li class="d-inline-block active"><a href="" class="text-dark">PERFIL</a></li>
            <li class="d-inline-block"><a href="/my_data" class="text-dark">Mis datos</a></li>
            <?php if ($EmpTbl->profile == 'premium'): ?>
              <li class="d-inline-block"><a href="<?= '/write_article/'.$EmpTbl->id.'/'.$EmpTbl->hash_key ?>" class="text-dark">ARTICULOS PSICÓLOGOS</a></li>
            <?php endif ?>
            <li class="d-inline-block"><a href="<?= '/premium_profile/'.$EmpTbl->id.'/'.$EmpTbl->hash_key ?>" class="text-dark">Perfil premium</a></li>
         </ul>
      </div>
   </div>
</div>
<!-- pages-links end -->
<section class="doctor_full_main_page">
   <div class="row quotes-sec">
      <div class="container">
         <div class="quotes-head text-center">
            <h3>Escribir articulo</h3>
         </div>
      </div>
   </div>
   <div class="container">
      <div class="row">
         <div class="col-12">
            <form action="/updateArticle" method="post" class="addNewArticle" enctype="multipart/form-data">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <input type="hidden" name="article_id" value="{{ $article->id }}">
               <div class="row for-contact-label my-2">
                  <div class="col-lg-2 text-right">
                     <label for="title">título</label>
                  </div>
                  <div class="col-lg-10">
                     <input type="text" class="w-100 form-control" name="title" oninvalid="this.setCustomValidity('Por favor rellene este campo')" value="{{ $article->title }}" required>
                  </div>
               </div>
               <div class="row for-contact-label my-2">
                  <div class="col-lg-2 text-right">
                     <label for="short_description">Breve descripción</label>
                  </div>
                  <div class="col-lg-10">
                     <input type="text" class="w-100 form-control" name="short_description" oninvalid="this.setCustomValidity('Por favor rellene este campo')" value="{{ $article->short_description }}" required>
                  </div>
               </div>
               <div class="row for-contact-label my-2">
                  <div class="col-lg-2 text-right">
                     <label for="detail">detalle</label>
                  </div>
                  <div class="col-lg-10">
                     <textarea class="form-control summernote_detail" name="detail" value="{!! $article->detail !!}"></textarea>
                  </div>
               </div>
               <div class="row for-contact-label my-2">
                  <div class="col-lg-2 text-right">
                     <label for="detail">imagen</label>
                  </div>
                  <div class="col-lg-10">
                     <input type="file" accept=".jpg,.jpeg,.png.,.gif" class="w-100" name="image">
                     <small>Leave Blank if you don't want to change</small>
                  </div>
               </div>
               <div class="row for-contact-label my-2">
                  <div class="col-lg-2">
                     &nbsp;
                  </div>
                  <div class="col-lg-10">
                     <button type="submit" class="btn btn-primary">publicar</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</section>
@stop