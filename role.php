<?php 
session_start();
include_once('header.php');
include_once('menu.php');
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-2"><p class="fs-2">Role</p></div>
        <div class="col"></div>
    </div>
    <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">Search</span>
        <input type="text" id="txt-search" class="form-control" placeholder="Type something" aria-label="Search" aria-describedby="addon-wrapping">
        <button type="button" id="addnew" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#roleModal">Add New</button>
    </div>
    <div class="row mt-5">
        <div class="col">
        <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">CreateAt</th>
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

<div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Role</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form >
        <input type="text" class="form-control" name="role-id" id="role-id" value="0" readonly hidden>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Role Title:</label>
            <input type="text" class="form-control" name="role-title" id="role-title" placeholder="Enter title here" required>
            <div class="invalid-feedback">
              Please enter title.
            </div>
          </div>
        </form>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save-role">Save</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function () {
  var start = 0;
  var limit = 10;
  var page = 1;
  $("#save-role").click(function () {
    $('form').addClass("was-validated");
    var title = $('#role-title').val();
    var form = $('form').serialize();
    if (title == ''){
      return;
    }
    $.ajax({
      method:"POST",
      url:"./services/addrole.php",
      data:form,
      cache:false,
      dataType: "json",
      success:function(data){
        // console.log(data);
        if (data.msg == 'add'){
          
        }else if(data.msg == 'update'){
          $('#roleModal').modal('hide');
        }
        fetchallroles(start, limit);
        $('#role-title').val('');
        $('form').removeClass("was-validated");
      },error: function(xhr, status, error) {
        console.log(xhr.responseText);
        }
    });
  });
  fetchallroles(start, limit);
  function fetchallroles(start, limit){
    var title = $('#txt-search').val();
    var t = '';
    $.ajax({
      method:"POST",
      url:"./services/fetchrole.php",
      data:{title: title,start: start, limit: limit},
      cache:false,
      dataType: "json",
      success:function(data){
        // console.log(data);
        if (data['data'].length > 0){
          var i = 1;
          data['data'].forEach((element)=>
          {
            let status = element['role_status'] == 0 ? 'deleted' : 'active';
            let action = element['role_status'] == 0 ? '' : '<button type="button" class="btn btn-primary btn-block btn-sm" id="edit" data-bs-toggle="modal" data-bs-target="#roleModal">Edit</button>  <button type="button" class="btn btn-danger btn-block btn-sm" id="delete">Delete</button>';
            t+=
            '<tr>'+
            '<td>'+ i++ +'</td>'+
            '<td hidden>'+ element['role_id']+'</td>'+
            '<td>'+ element['role_title']+'</td>'+
            '<td>'+ status +'</td>'+
            '<td>'+ action +'</td>'+
            '<tr>';
          });
          document.getElementById("tb").innerHTML = t;
          
        }
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
      fetchallroles(start, limit);
      $('#previous').prop('disabled', false);
  });
  $('#previous').click(function(){
    
    if (start > 0){
      page-=1;
      start = start - limit;
      fetchallroles(start, limit);
    }
    if (start <= 0){
      $('#next').prop('disabled', false);
      $('#previous').prop('disabled', true);
    }
  });
  $('body').on('keyup','#txt-search',function(){
    fetchallroles(start, limit);
  });
  $('body').on('click','#edit',function(){
    var tr=$(this).parents('tr');
    $('#role-id').val(tr.find('td:eq(1)').text());
    $('#role-title').val(tr.find('td:eq(2)').text());
    $('#exampleModalLabel').text('Edit Role');
  });
  $('body').on('click','#addnew',function(){
    $('#role-id').val(0);
    $('#role-title').val('');
    $('#exampleModalLabel').text('Add New Role');
  });
  $('body').on('click','#delete',function(){
    var tr = $(this).parents('tr');
    var id = tr.find('td:eq(1)').text();
		var app = confirm("Are you want delete?");
    if (app == true) {
      $.ajax({
        method:"POST",
        url:"./services/deleterole.php",
        data:{id:id},
        cache:false,
        dataType: "text",
        success:function(data){
          
          if (data == 'success'){
            fetchallroles(start, limit);
          }else if (data == false){
            alert("Delete failed because data was being used.");
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