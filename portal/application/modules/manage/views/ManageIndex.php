<title><?= $title;?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage-Student Board</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                        <li class="breadcrumb-item active">Manage Student Dashboard</li>

                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
              <div class="col-md-12">
                  <form  id="register_button" action="<?= site_url('manage/Managestudent/RegisterStudent'); ?>" method="post">

                    <div class="card">
                        <div class="card-header bg-dark">
                          <div class="card-title">
                          Assigning Student
                          </div>
                          <div class="row">

                            <div class="ml-auto justify-content-end d-flex">
                              <div class="form-row mr-4">
                             <select class="form-control form-control-sm" id="sel1" name="SubjectCodeID" >
                               <option selected disabled>Select Subject</option>
                             <?php if($getSubjectCode->num_rows() > 0): ?>
                             <?php foreach($getSubjectCode->result() as $getSubjectCode_row): ?>
                                   <option value="<?=$getSubjectCode_row->subjectcode; ?>"><?=  $getSubjectCode_row->subject_name;?></option>

                             <?php endforeach; ?>
                           <?php else: echo"No Data"; endif; ?>
                             </select>
                             </div>

                              <div class="form-check-inline">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" id="checkalltable">all
                            </label>
                            </div>

                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <table id="table_id" class="table table-sm">
                              <thead>
                                <tr>
                                  <th>Student ID</th>
                                  <th>Fullname</th>
                                  <th>Status</th>
                                  <th>Year Level</th>
                                  <th>Grade Level | Course</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if($GetStudent->num_rows() > 0): ?>
                                <?php foreach($GetStudent->result() as $GetStudent_row): ?>
                                  <tr>
                                      <td><?= htmlentities($GetStudent_row->student_number); ?></td>
                                      <td><?= htmlentities(ucfirst($GetStudent_row->lastname). ',' .ucfirst($GetStudent_row->firstname) . ' ' . ucwords($GetStudent_row->middlename) ); ?></td>
                                      <td><?= htmlentities($GetStudent_row->status); ?></td>
                                      <td>
                                        <?php
                                          if($GetStudent_row->grade != ""){
                                              echo $GetStudent_row->grade;
                                          }elseif($GetStudent_row->course != ""){
                                                echo $GetStudent_row->course;
                                          }elseif($GetStudent_row->strand != ""){
                                              echo $GetStudent_row->strand;
                                          }else{
                                            echo "No data";
                                          }

                                          ?>
                                      </td>
                                      <td>
                                        <?= htmlentities($GetStudent_row->student_type); ?>
                                    </td>
                                    <td> <input type="checkbox" id="CheckId" class="CheckId" name="CheckId[]" value="<?= $GetStudent_row->student_number?>"></td>
                                  </tr>
                              <?php endforeach; ?>
                            <?php else: echo"No data"; endif; ?>
                              </tbody>
                          </table>
                        </div>
                        <div class="card-footer">
                            <div class="ml-auto justify-content-end d-flex ">
                                <button type="submit" class="btn btn-flat btn_customize btn-warning text-white" >Registered Student</button>
                            </div>
                        </div>
                    </div>
                      </form>
              </div>
        </div>
    </div>
</div>
<script type="text/javascript">

$(document).ready(function(){
  $('#checkalltable').click(function () {
      $(':checkbox.CheckId').prop('checked', this.checked);
   });

      $('#table_id').DataTable();
});



$('#register_button').submit(function(e){

e.preventDefault();
 var fa = $(this);

  $.ajax({
    url: fa.attr('action'),
    type: 'post' ,
    data: fa.serialize(),
    dataType: 'json',
    success: function(response) {

    }

 });
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
            title: 'Proccessing Data'
          }).then((result) => {
                  if (result.dismiss === Swal.DismissReason.timer) {
                      window.location.href='<?= current_url(); ?>';
                  }
              });

});

</script>
