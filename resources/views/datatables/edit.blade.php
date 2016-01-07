<!-- /resources/views/projects/edit.blade.php -->
@extends('layouts.master')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12" style="min-width: 350px">
			<div class="panel panel-default fullwidth">
				<div class="panel-heading">Edit - User </div>

				<div class="panel-body">




					{!! Form::model($mp, ['method' => 'PATCH', 'route' => ['update.update', $mp->id]]) !!}
					@include('datatables/partials/_form', ['submit_text' => 'Edit User','submit_text2' => 'Delete User'])
					{!! Form::close() !!}




				</div>
				<div class='panel-footer'>
					<div id="divError" class='panel-warning  '>
						<p>
							<a class="btn btn-primary btn-xs" href="{{ route('datatables')}}">back</a>
						</p>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>
@endsection

