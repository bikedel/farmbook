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
	<h2>{{ $street }}</h2>
	
	<div class="row">
		<div class="col-xs-12">
			{!! $streets->appends(Request::except('page'))->render() !!}
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

	<div class="row">

		@foreach($streets as $street)

		{!! Form::model($street, ['method' => 'post', 'url' => ['street']]) !!}


		<div class="col-xs-3">
			{!! Form::label('name', 'Erf : ')  !!}
			{!! Form::text('numErf',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'numErf', 'readonly' => 'true']) !!}<br>

			{!! Form::label('name', 'Street No : ')  !!}
			{!! Form::text('strStreetNo',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'strStreetNo' , 'readonly' => 'true']) !!}<br>

			{!! Form::label('name', 'Street Name : ')  !!}
			{!! Form::text('strStreetName',null ,$attributes = ['class' => 'form-control input-sm ', 'id' => 'strStreetName', 'readonly' => 'true']) !!}<br>

			{!! Form::label('name', 'Complex No : ')  !!}
			{!! Form::text('strComplexNo',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'strComplexNo' , 'readonly' => 'true']) !!}<br>

			{!! Form::label('name', 'Complex Name : ')  !!}
			{!! Form::text('strComplexName',null ,$attributes = ['class' => 'form-control input-sm ', 'id' => 'strComplexName', 'readonly' => 'true']) !!}<br>


			{!! Form::label('name', 'Identity : ')  !!}
			{!! Form::text('strIdentity',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'strIdentity' , 'readonly' => 'true']) !!}<br>

			{!! Form::label('name', 'Owner : ')  !!}
			{!! Form::text('strOwners',null ,$attributes = ['class' => 'form-control input-sm owner', 'id' => 'strOwners', 'readonly' => 'true']) !!}<br>

			{!! Form::label('name', 'Bond Holder : ')  !!}
			{!! Form::text('strBondHolder',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'strBondHolder' , 'readonly' => 'true']) !!}<br>



			{!! Form::label('name', 'Reg Date:') !!}
			{!! Form::text('dtmRegDate', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'dtmRegDate', 'readonly' => 'true' ,'placeholder' => '']) !!}<br>



			{!! Form::label('name', 'Sale Price:') !!}
			{!! Form::text('strAmount',  null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strAmount', 'readonly' => 'true' ,'placeholder' => '']) !!}<br>


			{!! Form::label('name', 'Sq Meters:') !!}
			{!! Form::text('strSqMeters', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strSqMeters', 'readonly' => 'true' ,'placeholder' => '']) !!}<br>

		</div>
		<div class="col-xs-3">

			{!! Form::label('name', 'First Name:') !!}
			{!! Form::text('strFirstName', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strFirstName', 'readonly' => 'true' ,'placeholder' => '']) !!}<br>

			{!! Form::label('Surname', 'Surname:') !!}
			{!! Form::text('strSurname', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strSurname', 'readonly' => 'true' ,'placeholder' => '' ]) !!}<br>


			{!! Form::label('name', 'Home Phone:') !!}
			{!! Form::text('strHomePhoneNo', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strHomePhoneNo', '' ,'placeholder' => '']) !!}<br>

			{!! Form::label('name', 'Work Phone:') !!}
			{!! Form::text('strWorkPhoneNo', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strWorkPhoneNo', '' ,'placeholder' => '']) !!}<br>


			{!! Form::label('name', 'Cell Phone:') !!}
			{!! Form::text('strCellPhoneNo', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strCellPhoneNo', '' ,'placeholder' => '']) !!}<br>

			{!! Form::label('name', 'Email:') !!}
			{!! Form::text('EMAIL', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'EMAIL', '' ,'placeholder' => '']) !!}<br>


			{!! Form::label('name', 'strKey:') !!}
			{!! Form::text('strKey', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strKey', '' ,'placeholder' => '']) !!}<br>



		</div>
		<div class="col-xs-6">
			{!! Form::label('name', 'Notes : ')  !!}<br>
			{!! Form::textarea('memNotes',null ,$attributes = ['class' => 'form-control input-sm', 'rows' => '25','id' => 'memNotes']) !!}<br>
			


			{!! Form::submit('Update',  array('class'=>'btn btn-info ')) !!}
			{!! Form::close() !!}
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

