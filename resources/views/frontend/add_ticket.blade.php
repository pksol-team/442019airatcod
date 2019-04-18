@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<section class="mt-3">
   <div class="row">
      <div class="container">
         <div class="professional">
            <div class="professional-main-head pt-2 pb-2 pl-2 border">
               <h3 class="d-inline-block">Add Ticket</h3>
                <a class="d-inline-block float-right mr-5" href="/my_tickets"><button class="btn btn-dark add_ticket">Back</button></a>
            </div>
         </div>
      </div>
   </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="container">
			<form class="form-horizontal" method="POST" action="/add_ticket_data">
	          	{{ csrf_field() }}
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">	                
                <input type="hidden" name="date" value="{{ date('Y-m-d h:i:s')}}">
	            <div class="mb-5">
	                <div class="">
	                    <label>You Name</label>
	                    <input class="form-control" type="text" name="name" required>
	                </div>
	            	<div class="">
	            	    <label>Title</label>
	            	    <input class="form-control" type="text" name="ticket_title" required>
	            	</div>
	                <div class="">
	                    <label>Description</label>								
	                    <textarea name="ticket_description" class="form-control" required></textarea>
	                </div>
	                <button type="submit" class="btn btn-success mt-4">Submit Ticket</button>
	            </div>
	        </form>
        </div>
	</div>
</div>
@endsection()