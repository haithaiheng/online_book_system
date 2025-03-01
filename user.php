<?php 
session_start();
include_once('header.php');
include_once('menu.php');
require_once('./providers/users.php');
$user = new Users();  
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-2"><p class="fs-2">Users</p></div>
        <div class="col"></div>
    </div>
    <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">Search</span>
        <input type="text" id="txt-search" class="form-control" placeholder="Type something" aria-label="Search" aria-describedby="addon-wrapping">
        <button type="button" id="addnew" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">Add New</button>
    </div>
    <div class="row mt-5">
        <div class="col">
        <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">CreateAt</th>
            <th scope="col">Action</th>
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

<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Role</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
        <input type="text" class="form-control" name="user-id" id="user-id" value="0" readonly>
          <div class="mb-3">
            <label for="user-no" class="col-form-label">User No:</label>
            <input type="text" class="form-control" name="user-no" id="user-no" readonly>
            <div class="invalid-feedback">
              Required.
            </div>
          </div>
          <div class="mb-3">
            <label for="user-email" class="col-form-label">Email:</label>
            <input type="text" class="form-control" name="user-email" id="user-email" placeholder="Enter email here" required>
            <div class="invalid-feedback">
              Required.
            </div>
          </div>
          <div class="mb-3" id="pwd">
            <label for="recipient-name" class="col-form-label">Password:</label>
            <input type="password" class="form-control" name="user-pwd" id="user-pwd" placeholder="Enter password here" required>
            <div class="invalid-feedback">
              Required.
            </div>
          </div>
          <div class="mb-3">
          <label class="col-form-label" for="role-id">Choose Role</label>
          <select class="form-select" name="role-id" id="role-id">
            <?php echo $user->fetchallrole(); ?>
          </select>
        </div>
        </form>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save">Save</button>
      </div>
    </div>
  </div>
</div>
<?php 
include_once('footer.php');
?>
<script>
$(document).ready(function () {
  var start = 0;
  var limit = 10;
  var page = 1;
  document.getElementById('user-no').value = uuidv4();
  $("#save").click(function () {
    $('form').addClass("was-validated");
    var form = $('form').serialize();
    var email = $('#user-email').val();
    var password = $('#user-pwd').val();
    if (email == ''){
      return;
    }else if (password == '' && $('#exampleModalLabel').text() != 'Edit' ){
      return;
    }else if (!validate_email(email)){
      alert('email invalid');
      return;
    }
    $.ajax({
      method:"POST",
      url:"./services/adduser.php",
      data:form,
      cache:false,
      dataType: "json",
      success:function(data){
        console.log(data);
        if (data.msg == 'add'){
          $('#user-no').val(uuidv4());
          $('#user-email').val('');
          $('#user-pwd').val('');
          $('#role-id').val(1);
          fetchusers(start, limit);
          $('form').removeClass("was-validated");
        }else if(data.msg == 'update'){
          fetchusers(start, limit);
          $('#userModal').modal('hide');
        }
      },error: function(xhr, status, error) {
        console.log(xhr.responseText);
        }
    });
  });
  fetchusers(start, limit);
  function fetchusers(start, limit){
    var search = $('#txt-search').val();
    var t = '';
    $.ajax({
      method:"POST",
      url:"./services/fetchuser.php",
      data:{search: search,start: start, limit: limit},
      cache:false,
      dataType: "json",
      success:function(data){
        // console.log(data);
        // if (data['data'].length > 0){
          var i = 1;
          data['data'].forEach((element)=>
          {
            // let status = element['user_status'] == 0 ? 'deleted' : 'active';
            let action = element['user_status'] == 0 ? '' : '<button type="button" class="btn btn-primary btn-block btn-sm" id="edit" data-bs-toggle="modal" data-bs-target="#userModal">Edit</button>  <button type="button" class="btn btn-danger btn-block btn-sm" id="delete">Delete</button> <button type="button" class="btn btn-warning btn-block btn-sm" id="reset">Reset PWD</button>';
            t+=
            '<tr>'+
            '<td>'+ i++ +'</td>'+
            '<td hidden>'+ element['user_id']+'</td>'+
            '<td hidden>'+ element['user_no']+'</td>'+
            '<td>'+ element['user_email']+'</td>'+
            '<td hidden>'+ element['role_id']+'</td>'+
            '<td>'+ element['role_title'] +'</td>'+
            '<td>'+ element['user_createat']+'</td>'+
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
      fetchusers(start, limit);
      $('#previous').prop('disabled', false);
  });
  $('#previous').click(function(){
    
    if (start > 0){
      page-=1;
      start = start - limit;
      fetchusers(start, limit);
    }
    if (start <= 0){
      $('#next').prop('disabled', false);
      $('#previous').prop('disabled', true);
    }
  });
  $('body').on('keyup','#txt-search',function(){
    fetchusers(start, limit);
  });
  $('body').on('click','#edit',function(){
    var tr=$(this).parents('tr');
    $('#user-id').val(tr.find('td:eq(1)').text());
    $('#user-no').val(tr.find('td:eq(2)').text());
    $('#user-email').val(tr.find('td:eq(3)').text());
    $('#role-id').val(tr.find('td:eq(4)').text());
    $('#exampleModalLabel').text('Edit');
  });
  $('body').on('click','#addnew',function(){
    $('#role-id').val(1);
    $('#user-no').val(uuidv4());
    $('#user-email').val('');
    $('#user-pwd').val('');
    $('#exampleModalLabel').text('Add New');
  });
  $('body').on('click','#delete',function(){
    var tr = $(this).parents('tr');
    var id = tr.find('td:eq(1)').text();
		var app = confirm("Are you want delete?");
    if (app == true) {
      $.ajax({
        method:"POST",
        url:"./services/deleteuser.php",
        data:{prompt: 'delete',id:id},
        cache:false,
        dataType: "text",
        success:function(data){
          if (data == 'success'){
            fetchusers(start, limit);
          }else{
            console.log(data);
          }
        },error: function(xhr, status, error) {
        console.log(xhr.responseText);
        }
      });
    }
  });
  $('body').on('click','#reset',function(){
    var tr = $(this).parents('tr');
    var id = tr.find('td:eq(1)').text();
		var app = confirm("Are you want reset password?");
    if (app == true) {
      $.ajax({
        method:"POST",
        url:"./services/deleteuser.php",
        data:{prompt: 'reset',id:id},
        cache:false,
        dataType: "text",
        success:function(data){
          if (data == 'success'){
            fetchusers(start, limit);
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