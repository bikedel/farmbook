
@extends('layouts.master')

@section('content')




<div class="row" id="search">
<div class="col-xs-2">



        <a href="#" id="reset" class="btn btn-info ">
          <span class="glyphicon glyphicon-refresh"></span> Refresh Data
        </a>


</div>

  <div class="col-xs-2">
    <input id="s_numErf" type="text" name="firstname" class="form-control input-sm" placeholder="Search Erf">
  </div>
  <div class="col-xs-2">
    <input id="s_strStreetName" type="text" name="firstname" class="form-control input-sm" placeholder="Search Street Name">
  </div>
  <div class="col-xs-2">
    <input id="s_strComplexName" type="text" name="firstname" class="form-control input-sm" placeholder="Search Complex Name">
  </div>
  <div class="col-xs-2">
    <input id="s_owner" type="text" name="firstname" class="form-control input-sm" placeholder="Search Owner">
  </div>
  <div class="col-xs-2">
    <input id="s_id" type="text" name="firstname" class="form-control input-sm " placeholder="Search Id">
  </div>





</div>
<div class="row">

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

     <th>Reg Date</th>
     <th>Amount</th>

     <th>Owners</th>
 
     <th>Identity</th>

     <th>notes</th>
     <th>fname</th>
     <th>strSurname</th>

     <th>strHomePhoneNo</th>
     <th>strWorkPhoneNo</th>
     <th>strCellPhoneNo</th>
     <th>EMAIL</th>

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



<div class='row'>
  <div class="col-xs-6">
    <input id="prev" type="button" class="btn btn-info hidden " value="Prev " >
    <input id="mrec" type="button" class="btn btn-warning hidden " value="">
    <input id="next" type="button" class="btn btn-info hidden" value="Next ">
  </div>
</div>



{!! Form::open([ 'url' => 'notes', 'method' => 'get']) !!}


<div class='row'>
  <div class="form-group col-xs-4">

    {!! Form::text('numErf', $value = null , $attributes = ['class' => 'form-control', 'id' => 'numErf', 'readonly' => 'true' ,'hidden' => 'true']) !!}
  </div>
  <div class="form-group col-xs-4">

    {!! Form::text('strIdentity', $value = null , $attributes = ['class' => 'form-control', 'id' => 'strIdentity', 'readonly' => 'true' ,'hidden' => 'true']) !!}
  </div>

</div>

<div class='row'>
  <div class="form-group col-xs-4">
    {!! Form::label('Surname', 'Surname:') !!}<br>
    {!! Form::text('strSurname', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strSurname', 'readonly' => 'true' ,'placeholder' => '' ]) !!}
  </div>
  <div class="form-group col-xs-4">
    {!! Form::label('name', 'First Name:') !!}<br>
    {!! Form::text('strFirstName', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strFirstName', 'readonly' => 'true' ,'placeholder' => '']) !!}
  </div>
  <div class="form-group col-xs-4">
    {!! Form::label('name', 'Reg Date:') !!}<br>
    {!! Form::text('dtmRegDate', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'dtmRegDate', 'readonly' => 'true' ,'placeholder' => '']) !!}
  </div>
</div>

<div class='row  '>
  <div class="form-group col-xs-4">
    {!! Form::label('name', 'Home Phone:') !!}<br>
    {!! Form::text('strHomePhoneNo', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strHomePhoneNo', '' ,'placeholder' => '']) !!}
  </div>
  <div class="form-group col-xs-4">
    {!! Form::label('name', 'Work Phone:') !!}<br>
    {!! Form::text('strWorkPhoneNo', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strWorkPhoneNo', '' ,'placeholder' => '']) !!}
  </div>
  <div class="form-group col-xs-4">
    {!! Form::label('name', 'Sale Price:') !!}<br>
    {!! Form::text('strAmount', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strAmount', 'readonly' => 'true' ,'placeholder' => '']) !!}
  </div>
</div>

<div class='row'>
  <div class="form-group col-xs-4">
    {!! Form::label('name', 'Cell Phone:') !!}<br>
    {!! Form::text('strCellPhoneNo', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strCellPhoneNo', '' ,'placeholder' => '']) !!}
  </div>
  <div class="form-group col-xs-4">
    {!! Form::label('name', 'Email:') !!}<br>
    {!! Form::text('EMAIL', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'EMAIL', '' ,'placeholder' => '']) !!}
  </div>
  <div class="form-group col-xs-4">
    {!! Form::label('name', 'Sq Meters:') !!}<br>
    {!! Form::text('strSqMeters', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'strSqMeters', 'readonly' => 'true' ,'placeholder' => '']) !!}
  </div>
</div>

<div class='row'>
  <div class="form-group col-xs-12">
    {!! Form::label('name', 'Notes:') !!}<br>
    {!! Form::textarea('comment', $value = null , $attributes = ['class' => 'form-control input-sm', 'id' => 'comment', 'rows' => '5','placeholder' => '']) !!}
  </div>

</div>


<div class='row'>
  <div class="update form-group  col-xs-12 pull-right">
    {!! Form::submit('Update',  array('class'=>'btn btn-info')) !!}
  </div>
</div>




{!! Form::close() !!}



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
    scrollX: true,
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
    scrollY: 195,
    iDisplayLength: 10,
    lengthMenu: [[ 5, 10, 25, 50, -1], [ 5, 10, 25, 50, "All"]],
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



  { data: 'numErf', name: 'numErf' },

  { data: 'strStreetNo', name: 'strStreetNo' },
  { data: 'strStreetName', name: 'strStreetName' },

  { data: 'strComplexNo', name: 'strComplexNo' },
  { data: 'strComplexName', name: 'strComplexName' },

  { data: 'dtmRegDate', name: 'dtmRegDate' },
  { data: 'strAmount', name: 'strAmount' },

  { data: 'strOwners', name: 'strOwners' },  

  { data: 'strIdentity', name: 'strIdentity' },    

  { data: 'memNotes', name: 'memNotes' , visible: false , sortable: false , targers: [9] },   

  { data: 'strFirstName', name: 'strFirstName' },   
  { data: 'strSurname', name: 'strSurname' },   


  { data: 'strHomePhoneNo', name: 'strHomePhoneNo' },  
  { data: 'strWorkPhoneNo', name: 'strWorkPhoneNo' },  
  { data: 'strCellPhoneNo', name: 'strCellPhoneNo' },  
  { data: 'EMAIL', name: 'EMAIL' },    

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
   console.log( 'DataTables has finished its initialisation.' );
   document.getElementById("reset").style.visibility = "visible";
   rowindex = checkCookie()

        // table.rows().deselect();
       // this.api().row(rowindex, { page: 'current' }).select();
       if (rowindex)
       {
        $rowIndex = rowindex;
        document.getElementById('mrec').value = Number(rowindex )+1 ;
        display_row(rowindex);
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
  table.columns(7).search( this.value ).draw();
  document.getElementById("reset").style.visibility = "visible";

} );

$('#s_id').on( 'keyup', function () {
  table.columns(8).search( this.value ).draw();
  document.getElementById("reset").style.visibility = "visible";

} );


// hidden columns  

table.column( 0).visible( false );
table.column( 6).visible( false );
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

        console.log('len '+info.length);
        console.log('end '+info.end);


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
        $rowIndex = indexes;
        console.log(indexes);
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

 console.log("page "+info.page)
 console.log("len "+info.length)
 console.log("index "+$rowIndex)
 console.log("index "+info.start)

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





});
</script>
@endpush
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/keytable/2.1.0/js/dataTables.keyTable.min.js"></script>

<script src="js/freehold_search.js"></script>

















