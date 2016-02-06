@extends('layouts.master')

@section('content')



<div class="container-fluid">

	<h2></h2>
	
	<div class="row">
		<h1>Import CSV</h1>
			<hr>
	</div>


	@if ( Session::has('flash_message') )

	<div class="row alert {{ Session::get('flash_type') }} ">
		<button type="button" class="form-group btn btn-info close" data-dismiss="alert" aria-hidden="true">&times;</button>
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
{!! Form::open([ 'url' => 'import', 'method' => 'post', 'files' => 'true']) !!}





<div class="form-group">

  

{!! Form::file('csv_import', ['class' => 'csv_import form-control input-sm']) !!}

<div class="form-group">
  <br>
    {!! Form::submit('Go',  array('class'=>'btn btn-info ')) !!}
</div>
{!! Form::close() !!}
</div>

</div>

	@stop


<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script >



$(document).on("ready page:load", function() {
	setTimeout(function() { $(".alert").fadeOut(); }, 8000);

});





</script>

