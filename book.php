<?php 
session_start();
include_once('header.php');
include_once('menu.php');
require_once('./providers/books.php');
$book = new Books();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-2"><p class="fs-2">Books</p></div>
        <div class="col"></div>
    </div>
    <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">Search</span>
        <input type="text" id="txt-search" class="form-control" placeholder="Type title, category or type" aria-label="Search" aria-describedby="addon-wrapping">
        <button type="button" id="addnew" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookModal">Add New</button>
    </div>
    <div class="row mt-5">
        <div class="col">
        <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Thumbnail</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Genre</th>
            <th scope="col">Feature</th>
            <th scope="col">Category</th>
            <th scope="col">Type</th>
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

<div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="book">
            <input type="text" class="form-control" name="book-id" id="book-id" value="0" readonly hidden>
          <div class="mb-3">
            <label for="cate-title" class="col-form-label">Title:</label>
            <input type="text" class="form-control" name="book-title" id="book-title" placeholder="Enter title here" required>
            <div class="invalid-feedback">
              required.
            </div>
          </div>
          <div class="mb-3">
                <label for="cate-desc" class="col-form-label">Description:</label>
                <textarea type="text" class="form-control" name="book-desc" id="book-desc" placeholder="Enter description here" required></textarea>
                <div class="invalid-feedback">
                required.
                </div>
          </div>
          <div class="row">
            <div class="col-sm-12" style="height: 150px;">
                <div class="row">
                <div class="col-6 col-sm-6 ml-auto">
                    <label for="book-thumbnail" class="col-form-label">Thumbnail:</label>
                    <div class="row">
                      <div class="col">
                        <img width="100px" height="100px" class="position-absolute" id="thumbnail">
                        <input type="file" style="width:100px;height:100px;opacity:0" class="position-absolute" id="book-thumbnail" name="book-thumbnail" accept=".jpg,.png,.jpeg">
                        
                      </div>
                      <div class="col"><input type="text" name="txt-thumbnail" id="txt-thumbnail" readonly hidden></div>
                        
                    </div>
                </div>
                <div class="col-6 col-sm-6 ml-auto">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="book-feature" name="book-feature">
                    <label class="form-check-label">Feature</label>
                    </div>
                </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-6 col-sm-6 ml-auto">
                        <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="book-price" placeholder="0.0" name="book-price" required>
                        <label for="book-price">Unit Price</label>
                        <div class="invalid-feedback">
                        required.
                        </div></div>
                    </div>
                    <div class="col-6 col-sm-6 ml-auto" >
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="book-genre" placeholder="Enter genre" name="book-genre" required>
                        <label for="book-genre">Genre</label>
                        <div class="invalid-feedback">
                        required.
                        </div></div>
                    </div>
                </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-6 col-sm-6 ml-auto">
                        <label for="cate-id" class="col-form-label">Category:</label>
                        <select class="form-select" name="cate-id" id="cate-id">
                        <!-- <option value="0">Choose...</option> -->
                            <?php echo $book->fetchcategories(); ?>
                        </select>
                    </div>
                    <div class="col-6 col-sm-6 ml-auto" >
                        <label for="type-id" class="col-form-label">Type:</label>
                        <select class="form-select" name="type-id" id="type-id">
                        <!-- <option value="0">Choose...</option> -->
                            <?php echo $book->fetchtype(); ?>
                        </select>
                    </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="input-group">
                  <div class="custom-file">
                    <label class="custom-file-label" for="book-file">Book file</label>
                      <div class="d-flex flex-row">
                        <input type="text" name="txt-file" id="txt-file" readonly class="form-control position-absolute" class="" placeholder="Browse Image" style="cursor: pointer;">
                        <input type="file" class="col form-control custom-file-input" class="position-absolute opacity-0" id="book-file" name="book-file" aria-describedby="inputGroupFileAddon04" accept=".pdf">       
                    
                      </div>
                  </div>
                </div>
            </div>
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

<script>
$(document).ready(function () {
  var start = 0;
  var limit = 10;
  var page = 1;
  $("body").on('click','#save',function () {
  //$('form').addClass("was-validated");
    var title = $('#book-title').val();
    var desc = $('#book-desc').val();
    var price = $('#book-price').val();
    var category = $('#cate-id').val();
    var type = $('#type-id').val();
    var frm = $('#book');
    var frm_data = new FormData(frm[0]);
    if (title == ''){
      alert('title is required');
      return;
    }else if (desc == ''){
      alert('description is required');
      return;
    }else if (price == ''){
      alert('price is required');
      return;
    }else if (category == 0){
      alert('category is required');
      return;
    }else if (type == 0){
      alert('type is required');
      return;
    }else if ($('#book-file').get(0).files.length === 0 && $('#book-id').val() == 0) {
        // console.log("No files selected.");
        alert('No files selected.');
        return;
    }else if ($('#book-thumbnail').get(0).files.length === 0 && $('#book-id').val() == 0) {
        // console.log("No files selected.");
        alert('No thumbnail selected.');
        return;
    }
    if ($('#book-id').val() == 0){
      const thumbnail = document.getElementById('book-thumbnail');
      const fsize = thumbnail.files.item(0).size;
      const file = Math.round((fsize / 1024));
      if (file > 1024){
          alert('Image thumbnail should be less than 1MB.');
          return;
      }
    }
    $.ajax({
      method:"POST",
      url:"./services/addbook.php",
      data:frm_data,
      enctype: 'multipart/form-data',
      contentType: false,
    //   cache: false,
      processData: false,
      dataType: "json",
      success:function(data){
        // console.log(data.msg);
        if (data.msg == 'add'){
            $('#book-title').val('');
            $('#book-desc').val('');
            $('#book-desc').val('');
            $('#book-price').val('');
            $('#book-genre').val('');
            $('#cate-id').val(1);
            $('#type-id').val(1);
            document.getElementById('book-file').value = null;
            thumbnail.value = null;
            $('#thumbnail').removeAttr('src');
            $('form').removeClass("was-validated");
            fetchbooks(start, limit);
        }else if(data.msg == 'update'){
          $('#bookModal').modal('hide');
          fetchbooks(start, limit);
        }else if(data.msg == 'exists'){
            alert('exists data');
        }else if (data.msg == 'file'){
          alert('file uploads failed');
        }else if (data.msg == 'thumbnail'){
          alert('thumbnail uploads failed');
        }else{
          console.log(data.msg);
        }
      },error: function(xhr, status, error) {
        console.log(xhr.responseText);
        }
    });
  });
  fetchbooks(start, limit);
  function fetchbooks(start, limit){
    var title = $('#txt-search').val();
    var t = '';
    $.ajax({
      method:"POST",
      url:"./services/fetchbooks.php",
      data:{title: title,start: start, limit: limit},
      cache:false,
      dataType: "json",
      success:function(data){
        // console.log(data);
        // if (data['data'].length > 0){
          var i = 1;
          data['data'].forEach((element)=>
          {
            let feature = element['book_feature'] == 0 ? 'no' : 'yes';
            let action = element['book_status'] == 0 ? '' : '<button type="button" class="btn btn-primary btn-block btn-sm" id="edit" data-bs-toggle="modal" data-bs-target="#bookModal">Edit</button>  <button type="button" class="btn btn-danger btn-block btn-sm" id="delete">Delete</button>';
            t+=
            '<tr>'+
            '<td>'+ i++ +'</td>'+
            '<td hidden>'+ element['book_id']+'</td>'+
            '<td><img src="./uploads/thumbnail/'+ element['book_thumbnail']+'" width="60px" height="80px"/></td>'+
            '<td class="text-wrap">'+ element['book_title']+'</td>'+
            '<td hidden>'+ element['book_desc']+'</td>'+
            '<td>'+ element['book_desc'].substring(0,10)+'...</td>'+
            '<td>$ '+ element['book_price']+'</td>'+
            '<td>'+ element['book_genre']+'</td>'+
            '<td>'+ feature+'</td>'+
            '<td>'+ element['cate_title']+'</td>'+
            '<td>'+ element['type_title']+'</td>'+
            '<td>'+ element['book_createat']+'</td>'+
            '<td hidden>'+ element['category_id']+'</td>'+
            '<td hidden>'+ element['type_id']+'</td>'+
            '<td hidden>'+ element['book_thumbnail']+'</td>'+
            '<td hidden>'+ element['book_file']+'</td>'+
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
      fetchbooks(start, limit);
      $('#previous').prop('disabled', false);
  });
  $('#previous').click(function(){
    
    if (start > 0){
      page-=1;
      start = start - limit;
      fetchbooks(start, limit);
    }
    if (start <= 0){
      $('#next').prop('disabled', false);
      $('#previous').prop('disabled', true);
    }
  });
  $('body').on('keyup','#txt-search',function(){
    fetchbooks(start, limit);
  });
  $('body').on('click','#edit',function(){
    var tr=$(this).parents('tr');
    $('#book-id').val(tr.find('td:eq(1)').text());
    $('#book-title').val(tr.find('td:eq(3)').text());
    $('#book-desc').val(tr.find('td:eq(4)').text());
    $('#book-genre').val(tr.find('td:eq(7)').text());
    $('#book-price').val(tr.find('td:eq(6)').text().substring(1));
    $('#cate-id').val(tr.find('td:eq(12)').text());
    $('#type-id').val(tr.find('td:eq(13)').text());
    $('#txt-thumbnail').val(tr.find('td:eq(14)').text());
    $('#txt-file').val(tr.find('td:eq(15)').text());
    temptext = tr.find('td:eq(15)').text();
    $('#thumbnail').attr('src', './uploads/thumbnail/'+tr.find('td:eq(14)').text());
    if (tr.find('td:eq(8)').text() == 'yes'){
      $('#book-feature').attr('checked', true);
    }else{
      $('#book-feature').removeAttr('checked');
    }
    $('#exampleModalLabel').text('Edit');
  });
  $('body').on('click','#addnew',function(){
    $('#book-id').val(0);
    $('#book-title').val('');
    $('#book-desc').val('');
    $('#book-desc').val('');
    $('#book-price').val('');
    $('#book-genre').val('');
    $('#txt-file').val('');
    $('#txt-thumbnail').val('');
    $('#cate-id').val(1);
    $('#type-id').val(1);
    document.getElementById('book-file').value = null;
    thumbnail.value = null;
    $('#thumbnail').removeAttr('src');
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
        url:"./services/deletebook.php",
        data:{id:id},
        cache:false,
        dataType: "text",
        success:function(data){
          if (data == 'success'){
            fetchbooks(start, limit);
          }else{
            console.log(data);
          }
        },error: function(xhr, status, error) {
        console.log(xhr.responseText);
        }
      });
    }
  });
    var temptext = '';
    $('#book-file').change(function(e) {
      const files = e.target.files;
      
      if (e.target.files.length >=1 ){
        $('#txt-file').val(files[0].name);
      }else{
        $('#txt-file').val(temptext);
      }
      // console.log(files);
      
    });
    $('body').on('click','#txt-file', function(){
      $('#book-file').click();
    });
    $("#book-thumbnail").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#thumbnail').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
});
</script>
<?php 
include_once('footer.php');
?>