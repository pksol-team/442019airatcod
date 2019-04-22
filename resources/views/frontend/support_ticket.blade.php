@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<section class="mt-3">
   <div class="row">
      <div class="container">
         <div class="professional">
            <div class="professional-main-head pt-2 pb-2 pl-2 border">
               <h3 class="d-inline-block">Todas las entradas</h3>
                <a href="/frequently" class="float-right mr-3"><button class="text-white btn btn-dark"><i class="fa fa-angle-left mr-2" aria-hidden="true"></i> F.A.Q</button></a>
                <a class="d-inline-block float-right mr-5" href="/new_ticket"><button class="btn btn-success add_ticket">Añadir ticket</button></a>
            </div>
         </div>
      </div>
   </div>
</section>
<div class="row">
  <div class="col-12">
  <div class="container">
     <div>
        <div>
           <table class="table table-bordered">
              <thead class="bg-green">
                 <tr class="thead">
                    <th class="text-white">Título</th>
                    <th class="text-white">Hora</th>
                    <th class="text-white">Pregunta</th>
                    <th class="text-white">Estado</th>
                 </tr>
              </thead>
              <tbody>
                <?php if ($tickets): ?>
                  <?php foreach ($tickets as $key => $ticket): ?>
                     <tr>
                        <td>{{ $ticket->ticket_title }}<br><a href="/tickets/title/{{ $ticket->id }}">Mostrar más</a></td>
                        <td>{{ $ticket->date }}</td>
                        <td>{{ $ticket->ticket_description }}</td>

                        @if($ticket->ticket_status == 'Close')
                        <td><span class="close_"><a href="/close_ticket/{{ $ticket->id }}/open"><button class="text-white btn btn-success btn-sm">Boleto abierto</button></a></span></td>
                        @else
                        <td><span class="open_"><a href="/close_ticket/{{ $ticket->id }}/close"><button class="btn btn-sm btn-danger">Cerrar Ticket</button></a></span></td>
                        @endif
                     </tr>
                  <?php endforeach ?>
                <?php else: ?>
                  <tr><td colspan="12">¡Ningún record fue encontrado!</td></tr>
                <?php endif ?>
              </tbody>
           </table>
        </div>
     </div>
       </div><!-- /.container -->
</div><!-- /.col-12 -->
</div>
@endsection()