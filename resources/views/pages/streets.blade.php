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
	<h2>{{ $street }}</h2><hr>
	<div class="row">
		<div class="col-xs-12">
	{!! $streets->appends(Request::except('page'))->render() !!}
    </div>
</div>
	@foreach($streets as $street)

	{!! Form::model($street, ['method' => 'post', 'url' => ['street']]) !!}

	<div class="row">
		<div class="col-xs-4">
			{!! Form::label('name', 'Erf : ')  !!}<br>
			{!! Form::text('numErf',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'numErf', 'readonly' => 'true']) !!}<br>
		</div>
		<div class="col-xs-4">
			{!! Form::label('name', 'Identity : ')  !!}<br>
			{!! Form::text('strIdentity',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'strIdentity' , 'readonly' => 'true']) !!}<br>
		</div>

	</div>

	<div class="row">

		<div class="col-xs-8">
			{!! Form::label('name', 'Owner : ')  !!}<br>
			{!! Form::text('strOwners',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'strOwners', 'readonly' => 'true']) !!}<br>
		</div>
	</div>




<div class='row'>
  <div class="form-group col-xs-4">
    {!! Form::label('name', 'First Name:') !!}<br>
    {!! Form::text('strFirstName', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strFirstName', 'readonly' => 'true' ,'placeholder' => '']) !!}
  </div>
	
  <div class="form-group col-xs-4">
    {!! Form::label('Surname', 'Surname:') !!}<br>
    {!! Form::text('strSurname', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strSurname', 'readonly' => 'true' ,'placeholder' => '' ]) !!}
  </div>

  <div class="form-group col-xs-4">
    {!! Form::label('name', 'Reg Date:') !!}<br>
    {!! Form::text('dtmRegDate', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'dtmRegDate', 'readonly' => 'true' ,'placeholder' => '']) !!}
  </div>
</div>

<div class='row  '>
  <div class="form-group col-xs-4">
    {!! Form::label('name', 'Home Phone:') !!}<br>
    {!! Form::text('strHomePhoneNo', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strHomePhoneNo', '' ,'placeholder' => '']) !!}
  </div>
  <div class="form-group col-xs-4">
    {!! Form::label('name', 'Work Phone:') !!}<br>
    {!! Form::text('strWorkPhoneNo', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strWorkPhoneNo', '' ,'placeholder' => '']) !!}
  </div>
  <div class="form-group col-xs-4">
    {!! Form::label('name', 'Sale Price:') !!}<br>
    {!! Form::text('strAmount', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strAmount', 'readonly' => 'true' ,'placeholder' => '']) !!}
  </div>
</div>

<div class='row'>
  <div class="form-group col-xs-4">
    {!! Form::label('name', 'Cell Phone:') !!}<br>
    {!! Form::text('strCellPhoneNo', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strCellPhoneNo', '' ,'placeholder' => '']) !!}
  </div>
  <div class="form-group col-xs-4">
    {!! Form::label('name', 'Email:') !!}<br>
    {!! Form::text('EMAIL', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'EMAIL', '' ,'placeholder' => '']) !!}
  </div>
  <div class="form-group col-xs-4">
    {!! Form::label('name', 'Sq Meters:') !!}<br>
    {!! Form::text('strSqMeters', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strSqMeters', 'readonly' => 'true' ,'placeholder' => '']) !!}
  </div>
</div>


	<div class="row">
		<div class="col-xs-12">
			{!! Form::label('name', 'Notes : ')  !!}<br>
			{!! Form::textarea('memNotes',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'memNotes']) !!}<br>
		</div>		
	</div>
	
	{!! Form::submit('Update',  array('class'=>'btn btn-info ')) !!}
	{!! Form::close() !!}
	
	@endforeach



	

</div>




@stop