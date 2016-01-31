@extends('layouts.master')

@section('content')


<div class="container">
	<div class="row">
		<br>
		<div class="list-group col-xs-12">
			
			
			{!! Form::open([ 'url' => 'suburb', 'method' => 'post']) !!}
			
			<div id="suburb" class="form-group ">
			<p>Select Farmbook</p>
				<select class="form-control input-sm" id="suburb_id" name="suburb_id" onchange=GetSelectedTextValue(this)>
					@foreach($suburbs as $suburb)
					<option value="{{$suburb->database}}">{{$suburb->database}}</option>
					@endforeach
				</select>
			


			</div>
<br>

			{!! Form::submit('Set Farmbook ',  array('class'=>'btn btn-default ')) !!}



			
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