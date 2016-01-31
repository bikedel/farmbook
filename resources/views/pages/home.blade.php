@extends('layouts.master')

@section('content')


<div class="container">
	<div class="row">
		<br>
		<div class="list-group col-xs-12">
			
			
			{!! Form::open([ 'url' => 'street', 'method' => 'get']) !!}
			
			<div id="suburb" class="form-group ">


				<br>

				<div class='row'>
					<div id="erf" class="form-group col-md-6 responsive">
						<div class="radio">
							<label><input id="erf_r" type="radio" name="optradio" value="2">Erf Number</label>
						</div>

						<select class="form-control input-sm" id="erf" name="erf" onchange=GetSelectedTextValue(this)>
							@foreach($erfs as $erf)
							<option value="{{$erf->numErf}}">{{$erf->numErf}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class='row'>

					<div id="street" class="form-group col-md-6 responsive">
						<div class="radio">
							<label><input id="street_r" type="radio" name="optradio" value="1" checked>Street Name</label>
						</div>

						<select class="form-control input-sm" id="street_id" name="street_id" onchange=GetSelectedTextValue(this)>
							@foreach($streets as $street)
							<option value="{{$street->strStreetName}}">{{$street->strStreetName}}</option>
							@endforeach
						</select>
					</div>

				</div>
				<div class='row'>

					<div id="complexs" class="form-group col-md-6 responsive">
						<div class="radio">
							<label><input id="complex_r" type="radio" name="optradio" value="5">Complex</label>
						</div>

						<select class="form-control input-sm" id="complex" name="complex" onchange=GetSelectedTextValue(this)>
							@foreach($complexs as $complex)
							<option value="{{$complex->strComplexName}}">{{$complex->strComplexName}}</option>
							@endforeach
						</select>
					</div>
					
				</div>
				<div class='row'>
					<div id="ids" class="form-group col-md-6 responsive">
						<div class="radio">
							<label><input id="surname_r" type="radio" name="optradio" value="4">Surname</label>
						</div>

						<select class="form-control input-sm" id="surname" name="surname" onchange=GetSelectedTextValue(this)>
							@foreach($surnames as $surname)
							<option value="{{$surname->strSurname}}">{{$surname->strSurname}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class='row'>
					<div id="ids" class="form-group col-md-6 responsive">
						<div class="radio">
							<label><input id="id_r" type="radio" name="optradio" value="3">Id Number</label>
						</div>

						<select class="form-control input-sm" id="id" name="id" onchange=GetSelectedTextValue(this)>
							@foreach($ids as $id)
							<option value="{{$id->strIDNumber}}">{{$id->strIDNumber}}</option>
							@endforeach
						</select>
					</div>

				</div>
			</div>
			<div class="col-md-12">

				<br>
				<br>
				<input type="submit" name="action" value="View" class="btn btn-default">
				<input type="submit" name="action" value="Print" class="btn btn-default">
			</div>


			
		</div>

	</div>

</div>

<div class="col-xs-4">
	<input id="reset" type="button" class="btn btn-info btn-sm hidden" value="aJax call " data-link="{{ url('/myAjaxCallURI') }}" data-token="{{ csrf_token() }}">
</div>


@stop
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script>

$(document).ready(function() {



	document.getElementById("street_id").addEventListener("change", myFunction1);
	document.getElementById("erf").addEventListener("change", myFunction2);
	document.getElementById("id").addEventListener("change", myFunction3);
	document.getElementById("surname").addEventListener("change", myFunction4);
	document.getElementById("complex").addEventListener("change", myFunction5);

	function myFunction1() {
		var x = document.getElementById("street_r");
		x.checked = true;

	}
	function myFunction2() {
		var x = document.getElementById("erf_r");
		x.checked = true;
	}
	function myFunction3() {
		var x = document.getElementById("id_r");
		x.checked = true;
	}
	function myFunction4() {
		var x = document.getElementById("surname_r");
		x.checked = true;
	}
	function myFunction5() {
		var x = document.getElementById("complex_r");
		x.checked = true;
	}


});


function GetSelectedTextValue(ddlFruits) {
	var selectedText = ddlFruits.options[ddlFruits.selectedIndex].innerHTML;
	var selectedValue = ddlFruits.value;
       // alert("Selected Text: " + selectedText + " Value: " + selectedValue);
   }
   function GetStreet() {
   	var that = document.getElementById("street_id");
   	var selectedText = that.options[that.selectedIndex].innerHTML;
   	var selectedValue = that.value;
   	alert("Selected Text: " + selectedText + " Value: " + selectedValue);
   	var url = '{{ url('street/',':id') }}';
   	url = url.replace(':id', '21');
   	window.location.href = url;
   }

   </script>