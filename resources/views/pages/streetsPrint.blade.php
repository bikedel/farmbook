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


table {
    table-layout:fixed;
    font-size: 60%;
    padding:0;
}

.t{
    
    font-size: 60%;
    padding:0;
}
table th {
    padding:0;
    overflow: hidden;
    text-overflow: ellipsis;
}

table td {
    padding:0;
    overflow: hidden;
    text-overflow: ellipsis;
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


       <a href="javascript:window.print()" class='btn btn-danger'>Print</a>

<br><br>

		<table class="table table-bordered " style="table-layout: fixed; width: 600px">
			<th width='80px'> Street Name </th>
			<th width='30px'> No </th>
			<th width='50px'> Erf </th>
			<th width='100px'> Owner </th>
			<th width='50px'> Id </th>
			<th width='50px'> H Phone </th>
			<th width='50px'> W Phone </th>
			<th width='50px'> C Phone </th>
		</table>

		@foreach($streets as $street)	
		<table class="table table-bordered " style="table-layout: fixed; width: 600px">
			<tbody>
				<tr>
						<td width='80'> {{ $street->strStreetName }}  </td>
						<td width='30'> {{ $street->strStreetNo }} </td>
						<td width='50'> {{ $street->numErf }} </td>
						<td width='100'> {{ $street->strOwners }} </td>
						<td width='50'> {{ substr($street->strIdentity ,0,6)}} </td>			
						<td width='50'> {{ $street->strHomePhoneNo }} </td>		
						<td width='50'> {{ $street->strWorkPhoneNo }} </td>		
						<td width='50'> {{ $street->strCellPhoneNo }} </td>	
				</tr>
			</tbody>
		</table>

		<div class="col-md-12 t" >
			<p>{{ $street->memNotes }}</p>

		</div>

		
		@endforeach







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

