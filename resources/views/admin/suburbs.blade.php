@extends('layouts.master')

@section('content')
<h1>Farmbooks Admin</h1>
<div class='row'>
    <div class="col-xs-4">

        <input id="s_name" type="text" name="firstname" class="form-control hidden" placeholder="Search Name">
    </div>

</div>

<br>
<table class="table table-striped table-bordered" id="users-table" >
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Database</th>
            <th>Type</th>
        </tr>
    </thead>
</table>

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

<br>

<button type="button" class="btn btn-default " id="addBtn" >Add </button>
<button type="button" class="btn btn-default " id="updateBtn" >Update </button>
<button type="button" class="btn btn-default " id="deleteBtn" >Delete </button>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="formHeader" class="modal-title">Update Details</h4>
            </div>

            <div class="modal-body">

                <div class="row">

                    <form class="form-horizontal" id="adminform" role="form" method="POST" action="{{ url('/adminDatabasesNew') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"><br>
                            </div>
                            <label class="col-md-4 control-label">Database</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="database" name="database" value="{{ old('database') }}"><br>
                            </div>
                            <label class="col-md-4 control-label">Type</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="type" name="type" value="{{ old('type') }}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="formaction" name="formaction" hidden value="">
                            </div>
                        </div>  
                    </div>
                    <div class="modal-footer">
        
                        <button type="button" class="btn btn-default " id="actionBtn" >Save </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

                </div>

            </div>
        </div>

    </div>


    @stop

    @push('scripts')
    <script>
    $(function() {
        var events = $('#events');
        var table = $('#users-table').DataTable({
            dom: 'Bfrtip',
            dom: 'Blfrtip',
            sDom: '<"top"pi>rt<"bottom"><"clear">',
            processing: true,
            serverSide: true,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            select: true,
            scrollX: true,
            bFilter:false,
            responsive: true,
            bAutoWidth: true,
            bStateSave: true,
            fnStateSave: function (oSettings, oData) {
                alert("saving state");
                localStorage.setItem('DataTables_' + window.location.pathname, JSON.stringify(oData));
            },
            fnStateLoad: function (oSettings) {
                var data = localStorage.getItem('DataTables_' + window.location.pathname);
                return JSON.parse(data);
            },
            ajax: '{!! route('admin.data') !!}',
            columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'database', name: 'database' },
            { data: 'type', name: 'type' },
            ],
            buttons: [        ],
        

    });


table
.on( 'select', function ( e, dt, type, indexes ) {
    var rowData = table.rows( indexes ).data().toArray();

    $row = indexes;
        //alert("hello paulie "+JSON.stringify( rowData ));

    } )
.on( 'deselect', function ( e, dt, type, indexes ) {
    var rowData = table.rows( indexes ).data().toArray();
       // events.prepend( '<div><b>'+type+' <i>de</i>selection</b> - '+JSON.stringify( rowData )+'</div>' );

   } );


$('#s_name').on( 'keyup', function () {
    table.columns(2).search( this.value ).draw();
} );


});

$("#updateBtn").click(function(event){
 document.getElementById('formHeader').innerHTML = "Update Farmbook";  
 document.getElementById('actionBtn').innerHTML = "Update";  


 var table = new $.fn.dataTable.Api( '#users-table' );

 var name = table.row( $row ).data().name ;
 var database = table.row( $row ).data().database ;
 var type = table.row( $row ).data().type ;

 document.getElementById('name').value = name ;
 document.getElementById('database').value = database ;
 document.getElementById('type').value = type ;
 $("#myModal").modal('show');
});


$("#addBtn").click(function(event){
   document.getElementById('formHeader').innerHTML = "Add Farmbook";
 document.getElementById('actionBtn').innerHTML = "Add";  


   document.getElementById('name').value = "" ;
   document.getElementById('database').value = "" ;
   document.getElementById('type').value = "" ;

   $("#myModal").modal('show');
});


$("#deleteBtn").click(function(event){
 document.getElementById('actionBtn').innerHTML = "Delete";  
   var table = new $.fn.dataTable.Api( '#users-table' );

   var name = table.row( $row ).data().name ;
   var database = table.row( $row ).data().database ;
   var type = table.row( $row ).data().type ;

   document.getElementById('name').value = name ;
   document.getElementById('database').value = database ;
   document.getElementById('type').value = type ;

   document.getElementById('formHeader').innerHTML = "Delete Farmbook"; 

   $("#myModal").modal('show');
});


$("#actionBtn").click(function(event){

    document.getElementById('formaction').value =  document.getElementById('actionBtn').innerText
    $("#adminform").submit();

    //  document.location.href="{{ url('/adminDatabasesNew') }}"

});


</script>
@endpush