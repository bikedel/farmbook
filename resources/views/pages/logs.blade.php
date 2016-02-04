@extends('layouts.master')

@section('content')



<div class="container-fluid">

	<h2></h2>
	
	<div class="row">
		<div class="col-xs-8">
		 	
		</div>



	</div>
	<hr>

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


	@foreach($logs as $log)

	   {{$log}}<br>
    @endforeach





@stop


<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script >




</script>

