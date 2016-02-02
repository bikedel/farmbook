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

label {
	float:right;


}

.lab {
	float:left;
	text-align: justify;

}



</style>

<div class="container-fluid">

	<h2>{{ $street }}            </h2>
	
	<div class="row">
		<div class="col-xs-8">
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


	@foreach($streets as $street)

	{!! Form::model($street, ['method' => 'post', 'url' => ['street']  ,'class' => 'form-horizontal form-group'     ]) !!}


	<div class="responsive">

		<div class="form-group row">
			<div class="lab col-sm-3">
				{!! Form::label('name', 'Erf  ')  !!}
			</div>
			<div class="col-sm-2">
				{!! Form::text('numErf',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'numErf', 'readonly' => 'true' ]) !!}
			</div>
			<div class="lab col-sm-3">
				{!! Form::label('name', 'strKey  ')  !!}
			</div>

			<div class="col-sm-3">
				{!! Form::text('strKey',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'strKey']) !!}
			</div>

		</div>
		<div class="form-group">
			<div class="lab col-sm-3">
				{!! Form::label('name', 'Street No  ')  !!}
			</div>
			<div class="col-sm-8">
				{!! Form::text('strStreetNo',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'strStreetNo' , 'readonly' => 'true', 'disabled' =>'true']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="lab col-sm-3">
				{!! Form::label('name', 'Street Name  ')  !!}
			</div>
			<div class="col-sm-8">
				{!! Form::text('strStreetName',null ,$attributes = ['class' => 'form-control input-sm ', 'id' => 'strStreetName', 'readonly' => 'true', 'disabled' =>'true']) !!}
			</div>
		</div>

		<div class="form-group">
			<div class="lab col-sm-3">
				{!! Form::label('name', 'Complex No  ')  !!}
			</div>
			<div class="col-sm-8">
				{!! Form::text('strComplexNo',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'strComplexNo' , 'readonly' => 'true', 'disabled' =>'true']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="lab col-sm-3">
				{!! Form::label('name', 'Complex Name  ')  !!}
			</div>
			<div class="col-sm-8">
				{!! Form::text('strComplexName',null ,$attributes = ['class' => 'form-control input-sm ', 'id' => 'strComplexName', 'readonly' => 'true', 'disabled' =>'true']) !!}

			</div>
		</div>



		<div class="form-group">
			<div class="lab col-sm-3">
				{!! Form::label('name', 'Sq Meters') !!}
			</div>
			<div class="col-sm-8">
				{!! Form::text('strSqMeters', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strSqMeters', 'readonly' => 'true' ,'placeholder' => '', 'disabled' =>'true']) !!}
			</div>
		</div>

		<div class="form-group">
			<div class="lab col-sm-3">
				{!! Form::label('name', 'Reg Date') !!}
			</div>
			<div class="col-sm-8">
				{!! Form::text('dtmRegDate', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'dtmRegDate', 'readonly' => 'true' ,'placeholder' => '', 'disabled' =>'true']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="lab col-sm-3">
				{!! Form::label('name', 'Sale Price') !!}
			</div>
			<div class="col-sm-8">
				{!! Form::text('strAmount', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strAmount', 'readonly' => 'true' ,'placeholder' => '', 'disabled' =>'true']) !!}
			</div>
		</div>

		<div class="form-group">
			<div class="lab col-sm-3">
				{!! Form::label('name', 'Bond Amount  ')  !!}
			</div>
			<div class="col-sm-8">
				{!! Form::text('strBondAmount',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'strBondHolder' , 'readonly' => 'true', 'disabled' =>'true']) !!}
			</div>

		</div>

		<div class="form-group">
			<div class="lab col-sm-3">
				{!! Form::label('name', 'Identity  ')  !!}
			</div>
			<div class="col-sm-8">
				{!! Form::text('strIdentity',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'strIdentity' , 'readonly' => 'true']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="lab col-sm-3">
				{!! Form::label('name', 'Owner  ')  !!}
			</div>
			<div class="col-sm-8">
				{!! Form::text('strOwners',null ,$attributes = ['class' => 'form-control input-sm owner', 'id' => 'strOwners', 'readonly' => 'true', 'disabled' =>'true']) !!}
			</div>
		</div>





		<div class="form-group">
			<div class="lab col-sm-3">
				{!! Form::label('name', 'First Name') !!}
			</div>
			<div class="col-sm-8">
				{!! Form::text('strFirstName', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strFirstName', 'readonly' => 'true' ,'placeholder' => '', 'disabled' =>'true']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="lab col-sm-3">
				{!! Form::label('Surname', 'Surname') !!}
			</div>
			<div class="col-sm-8">
				{!! Form::text('strSurname', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strSurname', 'readonly' => 'true' ,'placeholder' => '' , 'disabled' =>'true']) !!}
			</div>
		</div>



		<div class="form-group">
			<div class="lab col-sm-3">
				{!! Form::label('name', 'Home Phone') !!}
			</div>
			<div class="col-sm-8">
				{!! Form::text('strHomePhoneNo', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strHomePhoneNo', '' ,'placeholder' => '']) !!}
			</div>
		</div>






		<div class="form-group">
			<div class="lab col-sm-3">
				{!! Form::label('name', 'Work Phone') !!}
			</div>
			<div class="col-sm-8">
				{!! Form::text('strWorkPhoneNo', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strWorkPhoneNo', '' ,'placeholder' => '']) !!}
			</div>
		</div>


		<div class="form-group">
			<div class="lab col-sm-3">
				{!! Form::label('name', 'Cell Phone') !!}
			</div>
			<div class="col-sm-8">
				{!! Form::text('strCellPhoneNo', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strCellPhoneNo', '' ,'placeholder' => '']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="lab col-sm-3">
				{!! Form::label('name', 'Email') !!}
			</div>
			<div class="col-sm-8">
				{!! Form::text('EMAIL', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'EMAIL', '' ,'placeholder' => '']) !!}
			</div>
		</div>





		<div class="form-group">
			<div class="lab col-sm-3">
				{!! Form::label('name', 'Previous Notes  ')  !!}
			</div>
			<div class="col-sm-8">
				{!! Form::textarea('memNotes',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'memNotes', 'readonly' => 'true' ]) !!}
			</div>	
		</div>	

		<div class="form-group">
			<div class="lab col-sm-3">
				{!! Form::label('name', 'New Notes  ')  !!}
			</div>
			<div class="col-sm-8">
				{!! Form::textarea('memNotesNew',null ,$attributes = ['class' => 'form-control input-sm', 'rows' => '5','id' => 'memNotesNew']) !!}
			</div>	
		</div>	







		<div class="form-group">
			<div class="lab col-sm-3">

			</div>
			<div class="col-sm-8">
				{!! Form::submit('Update',  array('class'=>'btn btn-danger ')) !!}
				{!! Form::close() !!}
			</div>	
		</div>	


	</div>	

	<hr>
	<div class="row">
		<div class="col-xs-8">
			{!! $streets->appends(Request::except('page'))->render() !!}    	
		</div>



	</div>

	@endforeach





</div>




@stop


<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script >



$(document).on("ready page:load", function() {
	setTimeout(function() { $(".alert").fadeOut(); }, 8000);

});





</script>

