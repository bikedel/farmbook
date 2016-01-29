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

	<h2> {{ $street }}</h2>
	
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

@foreach($streets as $street)

	<div class="row">
		<div class=" col-md-6 responsive">
			
			<table class="table table-bordered ">

			<tbody>
				<tr>
					<td  width="30%">Erf No</td>
					<td width="60%" id='tnumErfNo'>{{  $streets[0]->numErf }}  </td>
				</tr>
				<tr>
					<td>Suburb</td>
					<td>{{  $street->strSuburb }}  </td>
				</tr>

				<tr>
					<td>Street No</td>
					<td id='tstrStreetNo'>{{  $street->strStreetNo }}  </td>
				</tr>
				<tr>
					<th>Street Name</th>
					<td id='tstrStreetName'>{{  $street->strStreetName }} </td>
				</tr>
				<tr>
					<th>Complex No</th>
					<td id='tstrComplexNo'>{{  $street->strComplexNo }}  </td>
				</tr>
				<tr>
					<th>Complex Name</th>
					<td id='tstrComplexName'>{{  $street->strComplexName }}  </td>
				</tr>

				<tr>
					<td>Sqr Meters</td>
					<td>{{  $street->strSqMeters }}  </td>
				</tr>
				<tr>
					<td>Reg Date</td>
					<td>{{  $street->dtmRegDate }}  </td>
				</tr>

				<tr>
					<td>Sale Price</td>
					<td>{{  $street->strAmount }}  </td>
				</tr>
				<tr>
					<th>Bond Amount</th>
					<td>{{  $street->strBondAmount }} </td>
				</tr>
				<tr>
					<th>Identity</th>
					<td>{{  $street->strIdentity }}  </td>
				</tr>
				<tr>
					<th>ID Number</th>
					<td>{{  $street->strIDNumber }}  </td>
				</tr>
				<tr>
					<th>Owners</th>
					<td id='tstrOwners'>{{  $street->strOwners }}  </td>
				</tr>
				<tr>
					<th> Surname</th>
					<td> {{  $street->strSurname}} </td>
				</tr>
				<tr>
					<th> First Name</th>
					<td> {{  $street->strFirstName}} </td>
				</tr>
				<tr>
					<th>Home Phone </th>
					<td> {{  $street->strHomePhoneNo}} </td>
				</tr>
				<tr>
					<th> Work Phone</th>
					<td> {{  $street->strWorkPhoneNo}} </td>
				</tr>
				<tr>
					<th> Cell Phone</th>
					<td> {{  $street->strCellPhoneNo}} </td>
				</tr>
				<tr>
					<th> Email</th>
					<td> {{  $street->EMAIL}} </td>
				</tr>
				<tr>
					<th> Key</th>
					<td> {{  $street->strKey}} </td>
				</tr>

			</tbody>
		</table>
	</div>



	<div class="col-md-6 responsive" >

		<div class="form-group">
			
			<textarea readonly class="form-control readonly" rows="15" id="comment">{{  $streets[0]->memNotes}}</textarea>
		</div>
		<button type="button" class="btn btn-default " data-toggle="modal" data-target="#myModal">Update Details</button>
	</div>
</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		{!! $streets->appends(Request::except('page'))->render() !!}
	</div>


</div>



<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">

		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Update Details</h4>
			</div>

			<div class="modal-body">

				<div class="row">

					

					{!! Form::model($street, ['method' => 'post', 'url' => ['street']]) !!}


					<div class="col-sm-3 hidden">
						{!! Form::label('name', 'Erf  ')  !!}
						{!! Form::text('numErf',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'numErf', 'readonly' => 'true', 'hidden']) !!}<br>

						{!! Form::label('name', 'Street No  ')  !!}
						{!! Form::text('strStreetNo',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'strStreetNo' , 'readonly' => 'true']) !!}<br>

						{!! Form::label('name', 'Street Name  ')  !!}
						{!! Form::text('strStreetName',null ,$attributes = ['class' => 'form-control input-sm ', 'id' => 'strStreetName', 'readonly' => 'true']) !!}<br>

						{!! Form::label('name', 'Complex No  ')  !!}
						{!! Form::text('strComplexNo',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'strComplexNo' , 'readonly' => 'true']) !!}<br>

						{!! Form::label('name', 'Complex Name  ')  !!}
						{!! Form::text('strComplexName',null ,$attributes = ['class' => 'form-control input-sm ', 'id' => 'strComplexName', 'readonly' => 'true']) !!}<br>
						{!! Form::label('name', 'First Name') !!}
						{!! Form::text('strFirstName', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strFirstName', 'readonly' => 'true' ,'placeholder' => '']) !!}<br>

						{!! Form::label('Surname', 'Surname') !!}
						{!! Form::text('strSurname', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strSurname', 'readonly' => 'true' ,'placeholder' => '' ]) !!}<br>


						{!! Form::label('name', 'Owner  ')  !!}
						{!! Form::text('strOwners',null ,$attributes = ['class' => 'form-control input-sm owner', 'id' => 'strOwners', 'readonly' => 'true']) !!}<br>


						{!! Form::label('name', 'Identity  ')  !!}
						{!! Form::text('strIdentity',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'strIdentity' , 'readonly' => 'true']) !!}<br>

						{!! Form::label('name', 'Bond Holder  ')  !!}
						{!! Form::text('strBondHolder',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'strBondHolder' , 'readonly' => 'true']) !!}<br>



						{!! Form::label('name', 'Reg Date') !!}
						{!! Form::text('dtmRegDate', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'dtmRegDate', 'readonly' => 'true' ,'placeholder' => '']) !!}<br>



						{!! Form::label('name', 'Sale Price') !!}
						{!! Form::text('strAmount',  null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strAmount', 'readonly' => 'true' ,'placeholder' => '']) !!}<br>


						{!! Form::label('name', 'Sq Meters') !!}
						{!! Form::text('strSqMeters', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strSqMeters', 'readonly' => 'true' ,'placeholder' => '']) !!}<br>

					</div>



					<div class="col-sm-12">
						{!! Form::label('name', 'Erf Number  ')  !!}
						{!! Form::text('numErf', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'numErf', 'readonly' => 'true' ]) !!}<br>
					</div>



					<div class="col-sm-6">



						{!! Form::label('name', 'Owner  ')  !!}
						{!! Form::text('strOwners',null ,$attributes = ['class' => 'form-control input-sm owner', 'id' => 'strOwners', 'readonly' => 'true']) !!}<br>
					</div>
					<div class="col-sm-6">

						{!! Form::label('name', 'Id  ')  !!}
						{!! Form::text('strIdentity',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'strIdentity' , 'readonly' => 'true']) !!}<br>
					</div>

					<div class="form-group col-sm-6">

						{!! Form::label('name', 'Reg Date') !!}<br>
						{!! Form::text('dtmRegDate', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'dtmRegDate', 'readonly' => 'true' ,'placeholder' => '']) !!}


					</div>
					<div class="form-group col-sm-6">


						{!! Form::label('name', 'Sale Price') !!}<br>
						{!! Form::text('strAmount', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strAmount', 'readonly' => 'true' ,'placeholder' => '']) !!}


					</div>
					<div class="form-group col-sm-6">


						{!! Form::label('name', 'Bond Amount') !!}<br>
						{!! Form::text('strBondAmount', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strBondAmount', 'readonly' => 'true' ,'placeholder' => '']) !!}


					</div>
					<div class="form-group col-sm-6">

						{!! Form::label('name', 'Sq Meters') !!}<br>
						{!! Form::text('strSqMeters', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strSqMeters', 'readonly' => 'true' ,'placeholder' => '']) !!}

					</div>


					<div class="col-sm-6">

						{!! Form::label('name', 'Home Phone') !!}
						{!! Form::text('strHomePhoneNo', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strHomePhoneNo', '' ,'placeholder' => '']) !!}<br>
					</div>
					<div class="col-sm-6">

						{!! Form::label('name', 'Work Phone') !!}
						{!! Form::text('strWorkPhoneNo', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strWorkPhoneNo', '' ,'placeholder' => '']) !!}<br>
					</div>
					<div class="col-sm-6">


						{!! Form::label('name', 'Cell Phone') !!}
						{!! Form::text('strCellPhoneNo', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strCellPhoneNo', '' ,'placeholder' => '']) !!}<br>
					</div>
					<div class="col-sm-6">

						{!! Form::label('name', 'Email') !!}
						{!! Form::text('EMAIL', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'EMAIL', '' ,'placeholder' => '']) !!}
					</div>
					<div class="col-sm-6">


						{!! Form::text('strKey', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strKey', '' ,'placeholder' => '', 'hidden']) !!}
					</div>

					<div class="col-sm-12">


						{!! Form::textarea('memNotes',null ,$attributes = ['class' => 'form-control input-sm', 'rows' => '5','id' => 'memNotes', 'readonly' => 'true','hidden']) !!}<br>

						{!! Form::label('name', 'Notes  ')  !!}
						{!! Form::textarea('memNotesNew',null ,$attributes = ['class' => 'form-control input-sm', 'rows' => '5','id' => 'memNotesNew']) !!}<br>

					</div>	

				</div>	
				@endforeach
			</div>
			<div class="modal-footer">


				{!! Form::submit('Save',  array('class'=>'btn btn-danger ')) !!}
				{!! Form::close() !!}


				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>

		</div>

	</div>
</div>

</div>



@stop
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script>

$(document).on("ready page:load", function() {
	setTimeout(function() { $(".alert").fadeOut(); }, 8000);

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

