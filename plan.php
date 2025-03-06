<?php 
session_start();
include_once('header.php');
include_once('menu.php');
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-2"><p class="fs-2">Plans</p></div>
        <div class="col"></div>
    </div>
    <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">Search</span>
        <input type="text" id="txt-search" class="form-control" placeholder="Type something" aria-label="Search" aria-describedby="addon-wrapping">
        <button type="button" id="addnew" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#planModal">Add New</button>
    </div>
    <div class="row mt-5">
        <div class="col">
        <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Days</th>
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

<div class="modal fade" id="planModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form >
        <input type="text" class="form-control" name="plan-id" id="plan-id" value="0" readonly hidden>
          <div class="mb-3">
            <label for="plan-title" class="col-form-label">Title:</label>
            <input type="text" class="form-control" name="plan-title" id="plan-title" placeholder="Enter title here" required>
            <div class="invalid-feedback">
              Required.
            </div>
          </div>
          <div class="mb-3">
            <label for="plan-desc" class="col-form-label">Description:</label>
            <textarea type="text" class="form-control" name="plan-desc" id="plan-desc" placeholder="Enter description here" required></textarea>
            <div class="invalid-feedback">
              Required.
            </div>
          </div>
          <div class="mb-3">
            <label for=plan-days" class="col-form-label">Days:</label>
            <input type="number" class="form-control" name="plan-days" id="plan-days" placeholder="Enter days here" required>
            <div class="invalid-feedback">
              Required.
            </div>
          </div>
        </form>  
      </div>
      <div class="modal-footer">
        <p class="float-start" id="msg"></p>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save">Save</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function () {
  var start = 0;
  var limit = 10;
  var page = 1;
  $("#save").click(function () {
    $('form').addClass("was-validated");
    var title = $('#plan-title').val();
    var days = $('#plan-days').val();
    var form = $('form').serialize();
    if (title == ''){
        alert('title is required');
      return;
    }else if (days == '0' || days == ''){
        alert('days is required');
      return;
    }
    this.innerHTML = '<div class="spinner-border spinner-border-sm" role="status">'+
                '<span class="visually-hidden">Loading...</span>'+
                '</div>';
                $('#save').prop('disabled', true);
    $.ajax({
      method:"POST",
      url:"./services/addplan.php",
      data:form,
      cache:false,
      dataType: "json",
      success:function(data){
        console.log(data);
        if (data.msg == 'add'){
            $('#plan-title').val('');
            $('#plan-desc').val('');
            $('#plan-days').val('');
            $('form').removeClass("was-validated");
            $('#save').html('Save');
            $('#save').prop('disabled', false);
            fetchplans(start, limit);
        }else if(data.msg == 'update'){
          $('#planModal').modal('hide');
          $('#save').html('Save');
          $('#save').prop('disabled', false);
          fetchplans(start, limit);
        }else if(data.msg == 'exists'){
            alert('exists data');
        }else{
            console.log(data);
        }
      },error: function(xhr, status, error) {
        console.log(xhr.responseText);
        }
    });
  });
  fetchplans(start, limit);
  function fetchplans(start, limit){
    var title = $('#txt-search').val();
    var t = '';
    $.ajax({
      method:"POST",
      url:"./services/fetchplans.php",
      data:{title: title,start: start, limit: limit},
      cache:false,
      dataType: "json",
      success:function(data){
        // console.log(data);
        // if (data['data'].length > 0){
          var i = 1;
          data['data'].forEach((element)=>
          {
            let action = element['plan_status'] == 0 ? '' : '<button type="button" class="btn btn-primary btn-block btn-sm" id="edit" data-bs-toggle="modal" data-bs-target="#planModal">Edit</button>  <button type="button" class="btn btn-danger btn-block btn-sm" id="delete">Delete</button>';
            t+=
            '<tr>'+
            '<td>'+ i++ +'</td>'+
            '<td hidden>'+ element['plan_id']+'</td>'+
            '<td>'+ element['plan_title']+'</td>'+
            '<td>'+ element['plan_desc']+'</td>'+
            '<td>'+ element['plan_days']+'</td>'+
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
      fetchplans(start, limit);
      $('#previous').prop('disabled', false);
  });
  $('#previous').click(function(){
    
    if (start > 0){
      page-=1;
      start = start - limit;
      fetchplans(start, limit);
    }
    if (start <= 0){
      $('#next').prop('disabled', false);
      $('#previous').prop('disabled', true);
    }
  });
  $('body').on('keyup','#txt-search',function(){
    fetchplans(start, limit);
  });
  $('body').on('click','#edit',function(){
    var tr=$(this).parents('tr');
    $('#plan-id').val(tr.find('td:eq(1)').text());
    $('#plan-title').val(tr.find('td:eq(2)').text());
    $('#plan-desc').val(tr.find('td:eq(3)').text());
    $('#plan-days').val(tr.find('td:eq(4)').text());
    $('#exampleModalLabel').text('Edit');
  });
  $('body').on('click','#addnew',function(){
    $('#plan-id').val(0);
    $('#plan-title').val('');
    $('#plan-desc').val('');
    $('#plan-days').val('');
    $('form').removeClass("was-validated");
    $('#exampleModalLabel').text('Add New');
  });
  $('body').on('click','#delete',function(){
    var tr = $(this).parents('tr');
    var id = tr.find('td:eq(1)').text();
		var app = confirm("Are you want delete?");
    if (app == true) {
      $.ajax({
        method:"POST",
        url:"./services/deleteplan.php",
        data:{id:id},
        cache:false,
        dataType: "text",
        success:function(data){
          
          if (data == 'success'){
            fetchplans(start, limit);
          }else if(data == false){
            alert("Delete failed because data is used.");
          }else{
            console.log(data);
          }
        },error: function(xhr, status, error) {
        console.log(xhr.responseText);
        }
      });
    }
  });
});
</script>
<?php 
include_once('footer.php');
?>