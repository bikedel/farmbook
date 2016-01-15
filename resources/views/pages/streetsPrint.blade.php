@extends('layouts.master')

@section('content')


<style>

#owners {

	margin-top:30px;
	margin-left:0;
	float:left;
}
ul  {

	
	margin-left: 120px;
	float:left;
}

</style>

<div class="container-fluid">
	<h2> {{ $streets[0]->strSuburb }} - {{ $street }}  </h2>
	
	<div class="row">
		<div class="col-xs-12">
			{!! $streets->appends(Request::except('page'))->render() !!}
		</div>
		<hr>
	</div>
	

	@if ( Session::has('flash_message') )

	<div class="alert {{ Session::get('flash_type') }} ">
		<button type="button" class="form-group btn close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<p>{{ Session::get('flash_message') }}</p>
	</div>

	@endif


	@if($errors->count())
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<ul>
			@foreach($errors->all() as $message)
			<li> {{$message}}</li>
			@endforeach
		</ul>
	</div>
	@endif

	<div class="row">

		@foreach($streets as $street)
		<p>Erf:   {{$street->numErf      }}  Address:       {{$street->strStreetNo}}        {{$street->strStreetName}}      {{$street->strSuburb}}   </p>   
		<p>	Owner : {{$street->strOwners}}  

	<p>	Home Phone : {{$street->strHomePhoneNo}} </p>
	<p>	Work Phone : {{$street->strWorkPhoneNo}} </p>
		<p>		Cell Phone : {{$street->strCellPhoneNo}} </p>
			<p>		Email : {{$street->EMAIL}} </p>
		<p>		Notes :{{$street->memNotes}} </p>
		<hr>
		@endforeach

	</div>


</div>

	@stop
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script>

	$(document).on("ready page:load", function() {
		setTimeout(function() { $(".alert").fadeOut(); }, 4000);

	});


	function priceFormat(price) {
		alert(price);

		price = price.replace(/[^0-9]/g, '');

		price = Number(price).toLocaleString('en') ;

		return "R "+price

	}


	function mychange(street){
		alert("dgjfbdgkbdskjgbfkgjfdg");
	}

	</script>

