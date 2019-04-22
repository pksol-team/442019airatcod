@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- pages-links -->
<section class="bg-grey">
   <div class="row">
      <div class="post-lead-feedback-wrap mt-5">
         <div class="post-lead-feedback happy">
            
            <h3><i class="fa fa-smile-o post-lead-icon" aria-hidden="true"></i> <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">¡Gracias por su opinión!</font></font></h3>
            <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Su evaluación ayudará a millones de pacientes a encontrar al mejor profesional de la salud.</font></font></p>
            <div class="more-reviews">
               <div class="more-reviews-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                  ¡Comenta ahora sobre alguien más!</font></font>
               </div>
               <a class="btn-more-reviews" href="/all_professional"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
               Califica a otro profesional</font></font></a>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- pages-links end -->
@stop