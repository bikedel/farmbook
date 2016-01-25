
@extends('layouts.master')

@section('content')




<div class="row" id="search">
  <div class="col-md-2">
    <a href="#" id="reset" class="btn btn-default ">
      <span class="glyphicon glyphicon-refresh"></span> Refresh 
    </a>
  </div>

  <div class="col-md-2">
    <input id="s_numErf" type="text" name="firstname" class="form-control input-sm" placeholder="Search Erf">
  </div>
  <div class="col-md-2">
    <input id="s_strStreetName" type="text" name="firstname" class="form-control input-sm" placeholder="Search Street Name">
  </div>
  <div class="col-md-2">
    <input id="s_strComplexName" type="text" name="firstname" class="form-control input-sm" placeholder="Search Complex Name">
  </div>
  <div class="col-md-2">
    <input id="s_owner" type="text" name="firstname" class="form-control input-sm" placeholder="Search Owner">
  </div>
  <div class="col-md-2">
    <input id="s_id" type="text" name="firstname" class="form-control input-sm " placeholder="Search Id">
  </div>




</div>
<div class="row">
  <hr>
</div>
<br>


<table class="table table-striped table-bordered" id="freeholds" >
  <thead>
    <tr>
     <th>Erf</th>
     <th>Street No</th>
     <th>Street Name</th>
     <th>Complex No</th>
     <th>Complex Name</th>
     <th>Owners</th>
     <th>Identity</th>
     <th>Reg Date</th>
     <th>Amount</th>
     <th>Bond Amount</th>
     <th>notes</th>
     <th>fname</th>
     <th>strSurname</th>
     <th>strHomePhoneNo</th>
     <th>strWorkPhoneNo</th>
     <th>strCellPhoneNo</th>
     <th>EMAIL</th>
     <th>strKey</th>
   </tr>
 </thead>
</table>

<br><br>
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

<hr>
<div class='row'>
  <div class="col-xs-6">
    <input id="prev" type="button" class="btn btn-info hidden " value="Prev " >
    <input id="mrec" type="button" class="btn btn-warning hidden " value="">
    <input id="next" type="button" class="btn btn-info hidden" value="Next ">
  </div>
</div>




<button type="button" class="btn btn-default " data-toggle="modal" data-target="#myModal">Update Row</button>
<button type="button" class="btn btn-default " id ='viewStreet'>View Street</button>
<button type="button" class="btn btn-default " id ='viewComplex'>View Complex</button>


<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 id="formHeader" class="modal-title">Update Details</h4>
      </div>

      <div class="modal-body">


        <div class='row'>

          {!! Form::open([ 'url' => 'notes', 'method' => 'get']) !!}




        </div>

        <div class="col-sm-12 hidden">
          {!! Form::label('name', 'First Name') !!}
          {!! Form::text('strFirstName', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strFirstName', 'readonly' => 'true' ,'placeholder' => '']) !!}<br>

          {!! Form::label('Surname', 'Surname') !!}
          {!! Form::text('strSurname', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strSurname', 'readonly' => 'true' ,'placeholder' => '' ]) !!}<br>

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

        {!! Form::label('name', 'Identity  ')  !!}
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


      <div class="form-group col-sm-6">
        {!! Form::label('name', 'Home Phone') !!}<br>
        {!! Form::text('strHomePhoneNo', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strHomePhoneNo', '' ,'placeholder' => '']) !!}
      </div>
      <div class="form-group col-sm-6">

        {!! Form::label('name', 'Work Phone') !!}<br>
        {!! Form::text('strWorkPhoneNo', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strWorkPhoneNo', '' ,'placeholder' => '']) !!}
      </div>
      <div class="form-group col-sm-6">

        {!! Form::label('name', 'Cell Phone') !!}<br>
        {!! Form::text('strCellPhoneNo', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strCellPhoneNo', '' ,'placeholder' => '']) !!}
      </div>
      <div class="form-group col-sm-6">

        {!! Form::label('name', 'Email') !!}<br>
        {!! Form::text('EMAIL', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'EMAIL', '' ,'placeholder' => '']) !!}

      </div>

      <div class="form-group col-sm-12">

        {!! Form::text('strKey', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strKey', 'readonly' => 'true' ,'placeholder' => '','hidden' => 'true']) !!}

      </div>



      <div class="form-group col-sm-12">
        {!! Form::label('name', 'Previous Notes') !!}<br>
        {!! Form::textarea('comment', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'comment', 'rows' => '5','readonly' => 'true' ,'placeholder' => '']) !!}
      </div>
      <div class="form-group col-sm-12">
        {!! Form::label('name', 'New Notes ')  !!}<br>
        {!! Form::textarea('memNotesNew',null ,$attributes = ['class' => 'form-control input-sm', 'rows' => '5','id' => 'memNotesNew']) !!}<br>
      </div>



      <div class='row'>
        <div class="update form-group  col-sm-12 pull-right">

        </div>
      </div>






      <div class="modal-footer">
       {!! Form::submit('Update',  array('class'=>'btn btn-danger')) !!}

       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
     </div>

   </div>

 </div>
</div>

</div>

@stop

@push('scripts')


<script>
$(document).ready(function() {



  var events = $('#events');
  var table = $('#freeholds').DataTable({
    dom: 'Bfrtip',
    dom: 'Bflrtip',
    sDom: '<"top">Brpt<"bottom"lir><"clear">',
    pagingType: 'full',
    processing: true,
    bProcessing:true,
    serverSide: false,
    select: true,
    scrollX: '100%',
    responsive: true,
    bAutoWidth: true,
    bInfo: true,
    bFilter: true,
    searching: true,
    bAutoWidth: true,
    bStateSave: true,
    lengthChange: true,
    paging:true,
    keys:true,
    scrollY: 390,
    iDisplayLength: 10,
    lengthMenu: [[ 5, 10, 25, 50, -1], [ 5, 10, 25, 50, "All"]],
    language: {
     "loadingRecords": "Please wait - loading..."
   },
   fnStateSave: function (oSettings, oData) {
    alert("saving state");
    localStorage.setItem('DataTables_' + window.location.pathname, JSON.stringify(oData));
  },
  fnStateLoad: function (oSettings) {
   alert("restoring state");
   var data = localStorage.getItem('DataTables_' + window.location.pathname);
   return JSON.parse(data);
 },

 ajax: { url: '{!! route('freeholds.data') !!}',
 type: 'GET'},
 columns: [



 { data: 'numErf', name: 'numErf' ,width: '100'},
 { data: 'strStreetNo', name: 'strStreetNo' ,width: '100'},
 { data: 'strStreetName', name: 'strStreetName' ,width: '100'},
 { data: 'strComplexNo', name: 'strComplexNo' ,width: '50'},
 { data: 'strComplexName', name: 'strComplexName' ,width: '150'},
 { data: 'strOwners', name: 'strOwners' ,width: '100'},  
 { data: 'strIdentity', name: 'strIdentity' ,width: '100'},   
 { data: 'dtmRegDate', name: 'dtmRegDate' ,width: '150'},
 { data: 'strAmount', name: 'strAmount' },
 { data: 'strBondAmount', name: 'strBondAmount' },
 { data: 'memNotes', name: 'memNotes' , width: '200' ,  targers: [9] },   
 { data: 'strFirstName', name: 'strFirstName' },   
 { data: 'strSurname', name: 'strSurname' },   
 { data: 'strHomePhoneNo', name: 'strHomePhoneNo' },  
 { data: 'strWorkPhoneNo', name: 'strWorkPhoneNo' },  
 { data: 'strCellPhoneNo', name: 'strCellPhoneNo' },  
 { data: 'EMAIL', name: 'EMAIL' },    
 { data: 'strKey', name: 'strKey' },    



 ],

 buttons: [
        //    {
        //       // extend: 'print',
        //        exportOptions: {
        //            columns: ':visible'
        //        }
        //    },
        'colvis'
        ],
        columnDefs: [ {
          targets: -1,
          visible: false
        } ],



        initComplete: function(settings, json) {
 //  console.log( 'DataTables has finished its initialisation.' );
 document.getElementById("reset").style.visibility = "visible";
 rowindex = checkCookie()

        // table.rows().deselect();
       // this.api().row(rowindex, { page: 'current' }).select();
       if (rowindex)
       {
        $rowIndex = rowindex;
        document.getElementById('mrec').value = Number(rowindex )+1 ;
       // display_row(rowindex);
       setTimeout(function() {  display_row( $rowIndex); }, 2000);
     }


   }


 });






//Searches

$('#s_numErf').on( 'keyup', function () {
  table.columns(0).search( this.value ).draw();
  document.getElementById("reset").style.visibility = "visible";
} );


// #myInput is a <input type="text"> element
$('#s_strStreetName').on( 'keyup', function () {
  table.columns(2).search( this.value ).draw();
  $rowIndex = 0;
  //document.getElementById('mrec').value = $rowIndex +1 ;
  table.row($rowIndex).select();
  setTimeout(function() {  display_row(0); }, 1500);
  document.getElementById("reset").style.visibility = "visible";

} );

$('#s_strComplexName').on( 'keyup', function () {
  table.columns(4).search( this.value ).draw();
  $rowIndex = 0;
  //document.getElementById('mrec').value = $rowIndex +1 ;
  table.row($rowIndex).select();
  setTimeout(function() {  display_row(0); }, 1500);
  document.getElementById("reset").style.visibility = "visible";

} );




$('#s_amount').on( 'keyup', function () {
  table.columns(5).search( this.value ).draw();
  document.getElementById("reset").style.visibility = "visible";

} );


$('#s_owner').on( 'keyup', function () {
  table.columns(5).search( this.value ).draw();
  document.getElementById("reset").style.visibility = "visible";

} );

$('#s_id').on( 'keyup', function () {
  table.columns(6).search( this.value ).draw();
  document.getElementById("reset").style.visibility = "visible";

} );


// hidden columns  

//console.log("hidding fileds");

//table.column( 0).visible( false );
//table.column( 6).visible( false );
table.column( 7).visible( false );
table.column( 9).visible( false );
table.column( 10).visible( false );
table.column( 11).visible( false );
table.column( 12).visible( false );
table.column( 13).visible( false );
table.column( 14).visible( false );
table.column( 15).visible( false );


// reset search
$('#reset').click(function(){
  document.getElementById('s_numErf').value = "";
  document.getElementById('s_strStreetName').value = "";
  document.getElementById('s_strComplexName').value = "";
  document.getElementById('s_owner').value = "";
  document.getElementById('s_id').value = "";

  table .search( '' )
  .columns().search( '' )
  .draw();
  clear_fields();
  $rowIndex = 0;
  table.rows().deselect();
  document.getElementById('mrec').value = $rowIndex +1 ;
  

  // select row
  //setTimeout(function() {  display_row(0); }, 3000);
  //setCookie("rowindex", 1, 30);

 // if (this.value == 'Search'){
 //  this.value = "Reset";
 //} else {
//
 // this.value = "Search";

//}
//$('#searchbar').toggle();
document.getElementById("reset").style.visibility = "visible";
//document.getElementById("freeholds").style.visibility = "hidden";
});


$('#next').click(function(){

        // table.rows().deselect();
       // table.row(':eq(0)', { page: 'current' }).select();
       // alert( 'Row index: '+ $rowIndex);
       var info = table.page.info();

        //table.page( 'next' ).draw( 'page' );
        var len = info.length;

        var page = info.page;

       // console.log('len '+info.length);
      //  console.log('end '+info.end);


        // check number of rows is enough to go mpre
        if ($rowIndex < (info.end-1)-(page*len)){

         table.row($rowIndex).deselect();
         $rowIndex++
         table.row(($rowIndex)).select();
        // table.row(($rowIndex)).select();
        
        display_row($rowIndex);
      }

    });



$('#prev').click(function(){

        // table.rows().deselect();
       // table.row(':eq(0)', { page: 'current' }).select();
       // alert( 'Row index: '+ $rowIndex);
       var info = table.page.info();
       var len = info.length;

       if ($rowIndex > 0){
         table.row($rowIndex).deselect();
         $rowIndex--
         table.row(($rowIndex)).select();

         document.getElementById('mrec').value = $rowIndex +1 ;
         display_row($rowIndex);
       }
     });

table
.on( 'select', function ( e, dt, type, indexes ) {
  var rowData = table.rows( indexes ).data().toArray();
  setCookie("rowindex", indexes, 30);
     //  alert(indexes);
        //alert("hello paulie "+JSON.stringify( rowData ));
        var info = table.page.info();
        var len = info.length;
        $row = indexes;
        $rowIndex = indexes;
      //  console.log(indexes);
      document.getElementById('mrec').value = indexes ;
    } )

.on( 'deselect', function ( e, dt, type, indexes ) {
  var rowData = table.rows( indexes ).data().toArray();
       // events.prepend( '<div><b>'+type+' <i>de</i>selection</b> - '+JSON.stringify( rowData )+'</div>' );
       clear_fields();
       setCookie("rowindex", 0, 30);
     } )
//
// change of page
//
.on( 'page.dt', function () {
  var info = table.page.info();

  clear_fields();
  table.rows().deselect();

  //$rowIndex--
  //table.row(($rowIndex)).select();
 // document.getElementById('mrec').value = $rowIndex +1 ;
 $rowIndex = (info.page*info.length)

 //console.log("page "+info.page)
 //console.log("len "+info.length)
// console.log("index "+$rowIndex)
 //console.log("index "+info.start)

  //display_row($rowIndex);
  //$rowIndex = 0;
  //document.getElementById('mrec').value = $rowIndex +1
  setTimeout(function() {  display_row( $rowIndex); }, 1000);

} )

.on( 'mouseenter', 'td', function () {
  //var colIdx = table.cell(this).index().column;

         //   $( table.cells().nodes() ).removeClass( 'highlight' );
        //    $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
      } );



$("#viewStreet").click(function(event){

 var table = new $.fn.dataTable.Api( '#freeholds' );
 var data = table.rows($row).data();

 var st = table.row( $row  ).data().strStreetName ;

// route to streetgrid plus street

$path = "{{ URL::to('streetgrid') }}"+"/"+st;

// navigate to route
document.location.href=$path;
});

$("#viewComplex").click(function(event){

 var table = new $.fn.dataTable.Api( '#freeholds' );
 var data = table.rows($row).data();

 var st = table.row( $row  ).data().strComplexName ;

// route to streetgrid plus street

$path = "{{ URL::to('complexgrid') }}"+"/"+st;

// navigate to route
document.location.href=$path;
});

});






</script>
@endpush
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/keytable/2.1.0/js/dataTables.keyTable.min.js"></script>

<script src="js/freehold_search.js"></script>

















