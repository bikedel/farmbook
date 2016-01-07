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
		{!! Form::label('admin', 'Admin:') !!}<br>
		{!! Form::text('admin',null, $attributes = ['class' => 'form-control input-sm', 'id' => 'admin', '' ,'placeholder' => '']) !!}
	</div>


<br><br>
	<div class="form-group">
		{!! Form::submit($submit_text, ['class'=>'btn btn-warning btn-xs']) !!}


		<a class="btn btn-warning btn-xs" href="{{ url('destroy',$mp->id) }}">Delete User</a>
	</div>
</div>
