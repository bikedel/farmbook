@extends('layouts.master')

@section('content')
<br>
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
            <th></th>
            <th>Name</th>
            <th>UserName</th>
            <th>Email</th>



        </tr>
    </thead>
</table>

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
        ajax: '{!! route('datatables.data') !!}',
        columns: [




        { data: 'id', name: 'id' },
                 { data: "id", sortable: false, searchable: false, render: function(data, type, full, meta){
              
           
            var myshow_url = '<a href="../hello/'+data+'"    class="btn btn-info" data-method="show" data-reveal-id="myModal'+data+'" data-name="'+name+'">Show</a>';
            return myshow_url;
        }
        },
        { data: 'name', name: 'name' },
         { data: 'username', name: 'username' },
        { data: 'email', name: 'email' },




 
  
    

    ],
    buttons: [
       /* {
            text: 'Select all',
            action: function () {
                table.rows().select();
            }
        },
        {
            text: 'Select none',
            action: function () {
                table.rows().deselect();
            }
        },
        {
            text: 'Get selected data',
            action: function () {
                var count = table.rows( { selected: true } ).count();

                if (count) {

                    var rowData = table.rows( { selected: true } ).data().toArray();

                    alert("hello paulie "+JSON.stringify( rowData ));



                } else { alert(" hello - nothing selected");}
            }
        },
        {
            text: 'edit',
            action: function () {
                //alert("edit mode");
                 var rowData = table.rows( { selected: true } ).data().toArray();
                alert("hello paulie "+JSON.stringify( rowData ));
            }
        },*/

        ],
        

    });


table
.on( 'select', function ( e, dt, type, indexes ) {
    var rowData = table.rows( indexes ).data().toArray();


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
</script>
@endpush