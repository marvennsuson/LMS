<title><?= $title;?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Login Credentials Board</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>

                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title col-xs-12 ">Create Credentials Login</h3>
              <div class="justify-content-end d-flex">
                    <div class="mr-4 col-xs-12">
                          <button type="submit" id="creation" class="btn btn-flat btn-warning" >Create Creadential Login</button>
                    </div>
                      <div class="col-xs-12">
                        <div class="form-check">
                          <label class="form-check-label">
                          <input type="checkbox" id="checkAllItems" class="form-check-input " >All
                          </label>
                          </div>
                      </div>

              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="teacher_table" class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>Teacher Code</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Gender</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    <?php if($teacherlist->num_rows() > 0): ?>
                    <?php foreach($teacherlist->result() as $teacherlist_row): ?>
                      <tr>
                        <td><?= htmlentities(ucfirst($teacherlist_row->staffcode));  ?></td>
                        <td><?= htmlentities(ucfirst($teacherlist_row->name));  ?></td>
                        <td><?= htmlentities(ucfirst($teacherlist_row->email));  ?></td>
                        <td><?= htmlentities(ucfirst($teacherlist_row->mobile));  ?></td>
                        <td><?= htmlentities(ucfirst($teacherlist_row->gender));  ?></td>
                        <th>
                            <div class="form-check">
                                  <label class="form-check-label">
                                  <input type="checkbox" id="checkItem" class="form-check-input checkItem" name="studNumber[]" value="<?= $teacherlist_row->staffcode ?>" >&nbsp;
                                  </label>
                                  </div></th>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Teacher Code</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Gender</th>
                    <th></th>
                  </tr>
                </tfoot>
              </table>

            </div>
            <!-- /.card-body -->
          </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function () {
  $("#teacher_table").DataTable({
     "info": false,
  });
});


$(document).ready(function(){
  $('#checkAllItems').click(function () {
      $(':checkbox.checkItem').prop('checked', this.checked);
   });
});


$('#creation').click(function(){


var checkbox = $('.checkItem:checked');

if(checkbox.length > 0 ){

var checkbox_value = [];
$(checkbox).each(function(){
checkbox_value.push($(this).val());
});


$.ajax({
  url:"<?= base_url('registration/Teacher_controller/Configuringdata'); ?>",
  method:"POST",
  data:{checkbox_value:checkbox_value},
  success:function(data){
   if(data.response != "false"){
     const Toast = Swal.mixin({
   toast: true,
   position: 'top-end',
   showConfirmButton: false,
   timer: 3000,
   timerProgressBar: true,
   onOpen: (toast) => {
     toast.addEventListener('mouseenter', Swal.stopTimer)
     toast.addEventListener('mouseleave', Swal.resumeTimer)
   }
  })

  Toast.fire({
   icon: 'success',
   title: 'Creating Login Creadentials'
  }).then((result) => {
          if (result.dismiss === Swal.DismissReason.timer) {
            Swal.fire({
                title: 'Succesfully Created!',
                type: 'success',
                showConfirmButton: false,
                timer: 2000
            }).then((result) =>{
              if(result.dismiss === Swal.DismissReason.timer){
                    window.location.href='<?= current_url(); ?>';
              }

            });
          }
      });

   }else{
     alert();
   }
  },


});



}else{
  alert('Please Select Atleast on record to delete');
}


});
</script>
