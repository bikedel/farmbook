@extends('layouts.master')

@section('content')
<h3>Freehold Table</h3>


<div class='row'>
<div class="col-xs-4">

<input id="s_numErf" type="text" name="firstname" class="form-control" placeholder="Search Erf">
</div>
 <div class="col-xs-4">

<input id="s_strStreetName" type="text" name="firstname" class="form-control" placeholder="Search Street">
</div>
 <div class="col-xs-4">

<input id="s_owner" type="text" name="firstname" class="form-control" placeholder="Search Owner">
</div>
</div>


<br>
<br>
<table class="table table-striped table-bordered" id="freeholds" >
    <thead>
        <tr>
       
           <th></th>
           <th>strSuburb</th>
           <th>numErf</th>
           <th>numPortion</th>
           <th>strStreetNo</th>
           <th>strStreetName</th>
           <th>strSqMeters</th>
           <th>strComplexNo</th>
           <th>strComplexName</th>
           <th>dtmRegDate</th>
           <th>strAmount</th>
           <th>strBondHolder</th>
           <th>strBondAmount</th>
           <th>strOwners</th>
           <th></th>
           <th>strIdentity</th>
           <th>strSellers</th>
           <th>strTitleDeed</th>


       </tr>
   </thead>
</table>

@stop

@push('scripts')


<script>
$(document).ready(function() {



    var events = $('#events');
    var table = $('#freeholds').DataTable({
        dom: 'Bfrtip',
        dom: 'Bflrtip',
        sDom: '<"top"pi>rt<"bottom"l><"clear">',
        processing: true,
        serverSide: true,
        select: true,
        scrollX: true,
        responsive: true,
        bAutoWidth: true,
        bInfo: true,
        bFilter: false,
        searching: true,
        bAutoWidth: false,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        ajax: '{!! route('freeholds.data') !!}',
        columns: [
   
        { data: 'numErf', sortable: false, searchable: false, render: function(data, type, full, meta){
            var myshow_url = '<a href="../public/notes/'+data+'" class="btn btn-info" data-method="show" data-reveal-id="myModal'+data+'" data-name="'+name+'">Notes</a>';
            return myshow_url; }
        },
        { data: 'strSuburb', name: 'strSuburb' },
        { data: 'numErf', name: 'numErf' },
        { data: 'numPortion', name: 'numPortion' },
        { data: 'strStreetNo', name: 'strStreetNo' },
        { data: 'strStreetName', name: 'strStreetName' },
        { data: 'strSqMeters', name: 'strSqMeters' },
        { data: 'strComplexNo', name: 'strComplexNo' },
        { data: 'strComplexName', name: 'strComplexName' },
        { data: 'dtmRegDate', name: 'dtmRegDate' },
        { data: 'strAmount', name: 'strAmount' },
        { data: 'strBondHolder', name: 'strBondHolder' },
        { data: 'strBondAmount', name: 'strBondAmount' },      
        { data: 'strOwners', name: 'strOwners' },  
        { data: 'ID', sortable: false, searchable: false, render: function(data, type, full, meta){
            var myshow_url = '<a href="../public/hello/'+data+'" class="btn btn-info" data-method="show" data-reveal-id="myModal'+data+'" data-name="'+name+'">Contact</a>';
            return myshow_url; }
        },  
        { data: 'strIdentity', name: 'strIdentity' },    
        { data: 'strSellers', name: 'strSellers' },    
        { data: 'strTitleDeed', name: 'strTitleDeed' }  , 

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


$('#s_numErf').on( 'keyup', function () {
    table.columns(2).search( this.value ).draw();
} );


// #myInput is a <input type="text"> element
$('#s_strStreetName').on( 'keyup', function () {
    table.columns(5).search( this.value ).draw();
} );

$('#s_owner').on( 'keyup', function () {
    table.columns(13).search( this.value ).draw();
} );



});
</script>
@endpush

