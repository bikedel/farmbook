@extends('layouts.master')

@section('content')


<h2>{{$user}}</h2>
<div class="list-group">

    @foreach ($suburbs as $suburb)
     <a href="#" class="list-group-item ">{{ $suburb->database }}</a>
    @endforeach

</div>


			{!! Form::open([ 'url' => 'Add_suburb_user', 'method' => 'post']) !!}
			
			<div id="suburb" class="form-group ">
			<p>Add Suburb</p>
				<select class="form-control " id="suburb_id" name="suburb_id" onchange=GetSelectedTextValue(this)>
					@foreach($suburbs as $suburb)
					<option value="{{$suburb->database}}">{{$suburb->database}}</option>
					@endforeach
				</select>
			
				

			</div>
<br>

			{!! Form::submit('Go',  array('class'=>'btn btn-info ')) !!}


@stop

