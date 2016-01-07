

  {!! Form::open([ 'url','notes']) !!}
     

<div class='row'>
  <div class="form-group col-xs-4">
    {!! Form::label('numErf', 'numErf:') !!}<br>
    {!! Form::text('name', $value = null , $attributes = ['class' => 'form-control', 'id' => 'numErf', 'disabled' ,'placeholder' => 'Email']) !!}
  </div>
</div>


<div class='row'>

  <div class="col-xs-4">
   <label for="comment">Surname:</label>
   <input  class="form-control" id="strSurname" disabled></input>
</div>

  <div class="col-xs-4">
   <label for="comment">First Name:</label>
   <input  class="form-control" id="strFirstName" disabled></input>
</div>
</div>

<div class='row'>
  <div class="col-xs-4">
   <label for="comment">Home Phone:</label>
   <input  class="form-control" id="strHomePhoneNo"></input>
</div>

  <div class="col-xs-4">
   <label for="comment">Work Phone:</label>
   <input  class="form-control" id="strWorkPhoneNo"></input>
</div>
</div>

<div class='row'>
  <div class="col-xs-4">
   <label for="comment">Cell Phone:</label>
   <input  class="form-control" id="strCellPhoneNo"></input>
</div>

  <div class="col-xs-4">
   <label for="comment">Email:</label>
   <input  class="form-control" id="EMAIL"></input>
</div>


</div>

<div class='row'>
  <div class="col-xs-8">
      <label for="comment">Notes:</label>
      <textarea class="form-control" rows="15" id="comment"></textarea>
  </div>
</div>


<div class='row'>
    <br>
  
</div>
<div class='row'>
    <div class="col-xs-2">
        <input id="next" type="button" class="btn btn-info" value="Save ">
     

<a class="btn btn-info " href="{{ url('notes/erf') }}">Delete User</a>

    </div>
 </div>


          {!! Form::close() !!}
