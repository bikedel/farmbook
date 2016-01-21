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
		<div class=" table-responsive">
			
			<table class="table table-bordered ">
				<colgroup>
				<col span="1" style="background-color:">
				<col style="background-color:#272727">
			</colgroup>
			<tbody>
				<tr>
					<td width="30%">Erf No</td>
					<td>{{  $streets[0]->numErf }}  </td>
				</tr>
				<tr>
					<td>Suburb</td>
					<td>{{  $streets[0]->strSuburb }}  </td>
				</tr>

				<tr>
					<td>Street No</td>
					<td>{{  $streets[0]->strStreetNo }}  </td>
				</tr>
				<tr>
					<th>Street Name</th>
					<td>{{  $streets[0]->strStreetName }} </td>
				</tr>
				<tr>
					<th>Complex No</th>
					<td>{{  $streets[0]->strComplexNo }}  </td>
				</tr>
				<tr>
					<th>Complex Name</th>
					<td>{{  $streets[0]->strComplexName }}  </td>
				</tr>

				<tr>
					<td>Sqr Meters</td>
					<td>{{  $streets[0]->strSqMeters }}  </td>
				</tr>
				<tr>
					<td>Reg Date</td>
					<td>{{  $streets[0]->dtmRegDate }}  </td>
				</tr>

				<tr>
					<td>Sale Price</td>
					<td>{{  $streets[0]->strAmount }}  </td>
				</tr>
				<tr>
					<th>Bond Amount</th>
					<td>{{  $streets[0]->strBondAmount }} </td>
				</tr>


				<tr>
					<th>Owners</th>
					<td>{{  $streets[0]->strOwners }}  </td>
				</tr>
				<tr>
					<th>Identity</th>
					<td>{{  $streets[0]->strIdentity }}  </td>
				</tr>
				<tr>
					<th>ID Number</th>
					<td>{{  $streets[0]->strIDNumber }}  </td>
				</tr>
				<tr>
					<th> Surname</th>
					<td> {{  $streets[0]->strSurname}} </td>
				</tr>
				<tr>
					<th> First Name</th>
					<td> {{  $streets[0]->strFirstName}} </td>
				</tr>
				<tr>
					<th>Home Phone </th>
					<td> {{  $streets[0]->strHomePhoneNo}} </td>
				</tr>
				<tr>
					<th> Work Phone</th>
					<td> {{  $streets[0]->strWorkPhoneNo}} </td>
				</tr>
				<tr>
					<th> Cell Phone</th>
					<td> {{  $streets[0]->strCellPhoneNo}} </td>
				</tr>
				<tr>
					<th> Email</th>
					<td> {{  $streets[0]->EMAIL}} </td>
				</tr>


			</tbody>
		</table>

    <div class="form-group">
      <label for="comment">Notes:</label>
      <textarea readonly class="form-control readonly" rows="5" id="comment">{{  $streets[0]->memNotes}}</textarea>
    </div>

	</div>

</div>
<button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal">Update Details</button>



<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">

		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Update Details</h4>
			</div>

			<div class="modal-body">

				<div class="row">

					@foreach($streets as $street)

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


						{!! Form::label('name', 'Identity  ')  !!}
						{!! Form::text('strIdentity',null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'strIdentity' , 'readonly' => 'true']) !!}<br>

						{!! Form::label('name', 'Owner  ')  !!}
						{!! Form::text('strOwners',null ,$attributes = ['class' => 'form-control input-sm owner', 'id' => 'strOwners', 'readonly' => 'true']) !!}<br>

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

						{!! Form::label('name', 'First Name') !!}
						{!! Form::text('strFirstName', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strFirstName', 'readonly' => 'true' ,'placeholder' => '']) !!}<br>

						{!! Form::label('Surname', 'Surname') !!}
						{!! Form::text('strSurname', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strSurname', 'readonly' => 'true' ,'placeholder' => '' ]) !!}<br>


						{!! Form::label('name', 'Home Phone') !!}
						{!! Form::text('strHomePhoneNo', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strHomePhoneNo', '' ,'placeholder' => '']) !!}<br>

						{!! Form::label('name', 'Work Phone') !!}
						{!! Form::text('strWorkPhoneNo', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strWorkPhoneNo', '' ,'placeholder' => '']) !!}<br>


						{!! Form::label('name', 'Cell Phone') !!}
						{!! Form::text('strCellPhoneNo', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strCellPhoneNo', '' ,'placeholder' => '']) !!}<br>

						{!! Form::label('name', 'Email') !!}
						{!! Form::text('EMAIL', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'EMAIL', '' ,'placeholder' => '']) !!}<br>


						{!! Form::label('name', 'strKey') !!}
						{!! Form::text('strKey', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strKey', '' ,'placeholder' => '']) !!}<br>



					</div>
					<div class="col-sm-12">
						{!! Form::label('name', 'Previous Notes  ')  !!}<br>
						{!! Form::textarea('memNotes',null ,$attributes = ['class' => 'form-control input-sm', 'rows' => '5','id' => 'memNotes', 'readonly' => 'true']) !!}<br>

						{!! Form::label('name', 'New Notes  ')  !!}<br>
						{!! Form::textarea('memNotesNew',null ,$attributes = ['class' => 'form-control input-sm', 'rows' => '5','id' => 'memNotesNew']) !!}<br>


						
					</div>	
					@endforeach
				</div>
				<div class="modal-footer">
{!! Form::submit('Update',  array('class'=>'btn btn-info ')) !!}
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

