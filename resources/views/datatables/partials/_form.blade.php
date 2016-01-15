<!-- /resources/views/projects/partials/_form.blade.php -->


<div class="tt">

	<div class="form-group ">
		{!! Form::text('id', null,['size' => '36x5','autofocus'=>'autofocus','hidden','form-control']) !!}
	</div>

	<div class="form-group ">
		{!! Form::label('name', 'Name:') !!}<br>
		{!! Form::text('name', null, $attributes = ['class' => 'form-control input-sm', 'id' => 'name', '' ,'placeholder' => '']) !!}
	</div>
	<div class="form-group " >
		{!! Form::label('username', 'Username:') !!}<br>
		{!! Form::text('username' ,null ,$attributes = ['class' => 'form-control input-sm', 'id' => 'username', '' ,'placeholder' => '']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('email', 'Email:') !!}<br>
		{!! Form::text('email',null, $attributes = ['class' => 'form-control input-sm', 'id' => 'email', '' ,'placeholder' => '']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('suburb', 'Suburb:') !!}<br>
		
		<select class="form-control " id="suburb" name="suburb" >
		
			@if (count($suburbs) > 0)
		    	@foreach($suburbs as $suburb)
		    	<option value="{{$suburb->database}}">{{$suburb->database}}</option>
		    	@endforeach
			@else
		    	<option value="{{$mp->suburb}}">{{$mp->suburb}}</option>
			@endif
		</select>

	</div>

	<div class="form-group">
		{!! Form::label('admin', 'Admin: 0=no 1=Yes') !!}<br>
		{!! Form::text('admin',null, $attributes = ['class' => 'form-control input-sm', 'id' => 'admin', '' ,'placeholder' => '']) !!}
	</div>


	<br><br>
	<div class="form-group">
		{!! Form::submit('Save User', ['class'=>'btn btn-warning btn-ms']) !!}


		<a class="btn btn-warning btn-ms" href="{{ url('destroy',$mp->id) }}">Delete User</a>
      

	</div>
</div>
