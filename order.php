<?php 
session_start();
include_once('header.php');
include_once('menu.php');
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-2"><p class="fs-2">Orders History</p></div>
        <div class="col"></div>
    </div>
    <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">Search</span>
        <input type="text" id="txt-search" class="form-control" placeholder="Type something" aria-label="Search" aria-describedby="addon-wrapping">
        <!-- <button type="button" id="addnew" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#roleModal">Add New</button> -->
    </div>
    <div class="row mt-5">
        <div class="col">
        <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">User</th>
            <th scope="col">Date</th>
            <th scope="col">Invoice Id</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Remark</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody id="tb">
        </tbody>
        </table>
        </div>
    </div>
    <div class="row">
      <div class="col">
      <button type="button" class="btn btn-secondary btn-sm" id="previous" disabled><</button> <button type="button" class="btn btn-secondary btn-sm" id="next">></button>
      </div>
    </div>
</div>

<script>
$(document).ready(function () {
  var start = 0;
  var limit = 10;
  var page = 1;
  fetchorders(start, limit);
  function fetchorders(start, limit){
    var text = $('#txt-search').val();
    var t = '';
    $.ajax({
      method:"POST",
      url:"./services/fetchorders.php",
      data:{text: text,start: start, limit: limit},
      cache:false,
      dataType: "json",
      success:function(data){
        // console.log(data);
        // if (data['data'].length > 0){
          var i = 1;
          data['data'].forEach((element)=>
          {
            let status = element['order_status'] == 0 ? 'deleted' : 'active';
            let action = element['order_status'] == 0 ? '' : '<button type="button" class="btn btn-danger btn-block btn-sm" id="delete">Delete</button>';
            t+=
            '<tr>'+
            '<td>'+ i++ +'</td>'+
            '<td hidden>'+ element['order_id']+'</td>'+
            '<td><a href="orderdetail?id='+element['invoice_id']+'" target="_blank">'+ element['user_email']+'<a></td>'+
            '<td>'+ element['order_date']+'</td>'+
            '<td>'+ element['invoice_id']+'</td>'+
            '<td>$ '+ element['invoice_total']+'</td>'+
            '<td>'+ element['invoice_transac']+'</td>'+
            '<td>'+ status +'</td>'+
            '<td>'+ action +'</td>'+
            '<tr>';
          });
          document.getElementById("tb").innerHTML = t;
          
        // }
        // console.log(page);
        if(page >= Math.ceil(data['total'] / 10)){
          $('#next').prop('disabled', true);
        }
      },error: function(xhr, status, error) {
        console.log(xhr.responseText);
        }
    });
  }
  $('#next').click(function(){
      page+=1;
      start = limit + start;
      fetchorders(start, limit);
      $('#previous').prop('disabled', false);
  });
  $('#previous').click(function(){
    
    if (start > 0){
      page-=1;
      start = start - limit;
      fetchorders(start, limit);
    }
    if (start <= 0){
      $('#next').prop('disabled', false);
      $('#previous').prop('disabled', true);
    }
  });
  $('body').on('keyup','#txt-search',function(){
    fetchorders(start, limit);
  });
//   $('body').on('click','#delete',function(){
//     var tr = $(this).parents('tr');
//     var id = tr.find('td:eq(1)').text();
// 		var app = confirm("Are you want delete?");
//     if (app == true) {
//       $.ajax({
//         method:"POST",
//         url:"./services/deleterole.php",
//         data:{id:id},
//         cache:false,
//         dataType: "text",
//         success:function(data){
          
//           if (data == 'success'){
//             fetchorders(start, limit);
//           }else if (data == false){
//             alert("Delete failed because data was being used.");
//           }else{
//             console.log(data);
//           }
//         },error: function(xhr, status, error) {
//         console.log(xhr.responseText);
//         }
//       });
//     }
//   });
});
</script>
<?php 
include_once('footer.php');
?>