@extends('layouts.master')

@section('content')


<div class="container">
	<div class="row">
		<br><br>
		<div class="list-group col-xs-12">
			<h1>Welcome <span>{{ $user }}</span></h1>
			<h2>Select Suburb</h2>
			{!! Form::open([ 'url' => 'street', 'method' => 'get']) !!}
			<div id="suburb" class="form-group">
				<select class="form-control" id="suburb_id" name="suburb_id" onchange=GetSelectedTextValue(this)>
					@foreach($suburbs as $suburb)
					<option value="{{$suburb->id}}">{{$suburb->name}}</option>
					@endforeach
				</select>
				<br>

				<div id="street" class="form-group hidden">
					<select class="form-control" id="street_id" name="street_id" onchange=GetSelectedTextValue(this)>
						@foreach($streets as $street)
						<option value="{{$street->name}}">{{$street->name}}</option>
						@endforeach
					</select>
				</div>
			</div>


			{!! Form::submit('Go',  array('class'=>'btn btn-info ')) !!}



			
		</div>

	</div>

</div>

<div class="col-xs-4">
	<input id="reset" type="button" class="btn btn-info btn-sm" value="aJax call " data-link="{{ url('/myAjaxCallURI') }}" data-token="{{ csrf_token() }}">
</div>


@stop
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script>

$(document).ready(function() {

	$('#reset').click(function(){
		event.preventDefault();
		var that = document.getElementById("suburb_id");
		//var sub = that.options[that.selectedIndex].innerHTML;
		var sub = that.selectedIndex;
		var myurl = $(this).attr("data-link");
		console.log('calling...');
		$.ajax({
			url: myurl,
			type: 'post',
       // data: $('form').serialize(), // Remember that you need to have your csrf token included
       data: {'email':sub, '_token': $('input[name=_token]').val()},
       dataType: 'json',
       success: function( _response ){
            console.log(_response);// Handle your response..
            alert(_response);
        },
        error: function( _response ){
           console.log('fail'); // Handle error
       }
   });
	});

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