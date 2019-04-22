@extends('la.layouts.app')

@section('htmlheader_title')
	Vista de entradas
@endsection

@section('main-content')
<div class="row tickets_view_full_admin">
   <div class="col-12">
      <div class="container">
         <div class="row mt-4">
          <div class="col-12">
            <h3>{{ $ticket->ticket_title }}</h3>
          </div>
         </div>
         <div class="row">
          <div class="col-12">
            <p class="sub-head"><span class="icon mr-3"><i class="fa fa-calendar" aria-hidden="true"></i></span>{{ $ticket->date }}</p>
          </div>
         </div>
         <div class="row w-100 d-block text-right button-div-admin">
          <div class="col-12">
            @if($ticket->ticket_status == 'Close')
            <a href="/close_ticket/{{ $ticket->id }}/open"><button class="close_button text-white btn btn-success"><i class="fa fa-check mr-1" aria-hidden="true"></i>Boleto abierto</button></a>
            @else
             <a href="/close_ticket/{{ $ticket->id }}/close"><button class="close_button btn btn-danger"><i class="fa fa-close mr-1" aria-hidden="true"></i>Cerrar Ticket</button></a>
             @endif
            <a href="/admin/tickets"><button class="close_button text-white btn btn-default"><i class="fa fa-angle-left mr-2" aria-hidden="true"></i> Todas las entradas</button></a>
          </div>
         </div>
         <div class="row mt-4">
          <div class="col-12">
            <div class="reply-sec">
              @if($data)
               @foreach($data as $ticket_reply)
               <div class="icon-sec type-reply">
                  <i class="fa fa-user user_icon" aria-hidden="true"></i>
                  <p class="para-1"><b class="chat-admin">{{ $ticket_reply->users->first_name }} </b> ({{ $ticket_reply->reply_date}})</p>
                  <p class="chat-chat">{{ $ticket_reply->message}}</p>
               </div>
                @endforeach
              @endif
            </div>
          </div>
        </div>
        <div class="row mb-5">
          <div class="col-12">
           @if($ticket->ticket_status == 'Open')
            <div class="reply-type-area">
               <form id="contact-form" class="form-horizontal" method="POST" action="/add_reply">
                  {{ csrf_field() }}
                  <label class="ml-1">Escribe tu respuesta</label>
                  <textarea class="chat-textarea form-control" rows="5" cols="5" name="message" required></textarea>
                  <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                  <input type="hidden" name="reply_date" value="{{ date('Y-m-d h:i:s') }}">
                  <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                  <button class="btn btn-success reply-btn" type="submit">Respuesta</button>
               </form>
            </div>

           @endif
          </div>
        </div>
      </div>
   </div>
</div>
@endsection
