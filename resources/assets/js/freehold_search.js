

$(document).ready(function() {

   // $('#searchbar').toggle();



   var table = $('#freeholds').dataTable;

    // row counter
    $rowIndex = 0;
    document.getElementById('mrec').value =$rowIndex+1;
   // table.row(($rowIndex)).select();


   $('#freeholds').on('click', 'tr ', function(event) {

    var table = new $.fn.dataTable.Api( '#freeholds' );
    var data = table.rows(this).data();

      // Get row Index
      $rowIndex =  table.row(this).index() ;
      document.getElementById('mrec').value = $rowIndex +1 ;

     //var aPos = table.fnGetPosition( this );
     var id = table.row( this ).data().strIdentity ;
     var erf = table.row( this ).data().numErf ;
     var notes = table.row( this ).data().notes ;

     var regdate = table.row( this ).data().dtmRegDate ;
     var salesprice = table.row( this ).data().strAmount ;
     var sqmeters = table.row( this ).data().strSqMeters ;

     var strFirstName = table.row( this ).data().strFirstName ;
     var strSurname = table.row( this ).data().strSurname ;
     var strHomePhoneNo = table.row( this ).data().strHomePhoneNo ;
     var strWorkPhoneNo = table.row( this ).data().strWorkPhoneNo ;
     var strCellPhoneNo = table.row( this ).data().strCellPhoneNo ;
     var EMAIL = table.row( this ).data().EMAIL ;   
      //$(this).css('opacity', '.5');

      document.getElementById('strIdentity').value = id ;
      document.getElementById('numErf').value =  erf ;
      document.getElementById('comment').value =  notes ;

      document.getElementById('dtmRegDate').value = regdate ;
      document.getElementById('strAmount').value =0;// Number(salesprice).toLocaleString('en') ;
      document.getElementById('strSqMeters').value =  (sqmeters);

      document.getElementById('strFirstName').value =  strFirstName ;
      document.getElementById('strSurname').value =  strSurname ;
      document.getElementById('strHomePhoneNo').value =  phoneFormat(strHomePhoneNo) ;
      document.getElementById('strWorkPhoneNo').value =  phoneFormat(strWorkPhoneNo);
      document.getElementById('strCellPhoneNo').value =  phoneFormat(strCellPhoneNo) ; 
      document.getElementById('EMAIL').value =  EMAIL ;
  });


}); // end closure

//
//  clear flash messages
//
$(document).on("ready page:load", function() {
  setTimeout(function() { $(".alert").fadeOut(); }, 4000);

});


function clear_fields() {

  document.getElementById('strIdentity').value = "" ;
  document.getElementById('numErf').value =  "" ;  
  document.getElementById('comment').value =  "" ;
  document.getElementById('strFirstName').value =  "" ;
  document.getElementById('strSurname').value =  "" ;
  document.getElementById('strHomePhoneNo').value =  "" ;
  document.getElementById('strWorkPhoneNo').value =  "" ;
  document.getElementById('strCellPhoneNo').value =  "" ; 
  document.getElementById('EMAIL').value =  "" ;
  document.getElementById('dtmRegDate').value = "" ;
  document.getElementById('strAmount').value =  "" ;
  document.getElementById('strSqMeters').value =  "" ;
}


function display_row($row) {
   console.log("display row "+$row);
   var table = new $.fn.dataTable.Api( '#freeholds' );
   var data = table.rows($row).data();

   table.row(($row)).select();
   document.getElementById('mrec').value = Number($row) +1 ;

     //var aPos = table.fnGetPosition( this );
     setCookie("rowindex", $row, 30);


     var id = table.row( $row ).data().strIdentity ;
     var erf = table.row( $row ).data().numErf ;
     var notes = table.row( $row ).data().notes ;


     var regdate = table.row( $row  ).data().dtmRegDate ;
     var salesprice = table.row( $row  ).data().strAmount ;
     var sqmeters = table.row( $row  ).data().strSqMeters ;

     var strFirstName = table.row( $row ).data().strFirstName ;
     var strSurname = table.row( $row ).data().strSurname ;

     var strHomePhoneNo = table.row( $row ).data().strHomePhoneNo ;
     var strWorkPhoneNo = table.row( $row ).data().strWorkPhoneNo ;
     var strCellPhoneNo = table.row( $row ).data().strCellPhoneNo ;
     var EMAIL = table.row( $row ).data().EMAIL ;   
      //$(this).css('opacity', '.5');

      document.getElementById('strIdentity').value = id ;
      document.getElementById('numErf').value =  erf ;
      document.getElementById('comment').value =  notes ;

      document.getElementById('dtmRegDate').value = regdate ;
      document.getElementById('strAmount').value =  0;//Number(salesprice).toLocaleString('en') ;
      document.getElementById('strSqMeters').value =  sqmeters;
      document.getElementById('strFirstName').value =  strFirstName ;
      document.getElementById('strSurname').value =  strSurname ;

      document.getElementById('strHomePhoneNo').value =  phoneFormat(strHomePhoneNo) ;
      document.getElementById('strWorkPhoneNo').value =  phoneFormat(strWorkPhoneNo) ;
      document.getElementById('strCellPhoneNo').value =  phoneFormat(strCellPhoneNo) ; 
      document.getElementById('EMAIL').value =  EMAIL ;
  }



  function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname+"="+cvalue+"; "+expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie() {
    var user=getCookie("rowindex");
    if (user != "") {
        //alert("Row index =  " + user);
        return user;
    } else {
      // user = prompt("Please enter row index :","");
      user = 0;
      if (user != "" && user != null) {
         setCookie("rowindex", user, 30);
     }
 }
}


function phoneFormat(phone) {
    phone = phone.replace(/[^0-9]/g, '');
    phone = phone.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
    return phone;
}