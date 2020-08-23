
<style>


.collapsible-link::before {
content: '';
width: 14px;
height: 2px;
background: #333;
position: absolute;
top: calc(50% - 1px);
right: 1rem;
display: block;
transition: all 0.3s;
}

/* Vertical line */
.collapsible-link::after {
content: '';
width: 2px;
height: 14px;
background: #333;
position: absolute;
top: calc(50% - 7px);
right: calc(1rem + 6px);
display: block;
transition: all 0.3s;
}

.collapsible-link[aria-expanded='true']::after {
transform: rotate(90deg) translateX(-1px);
}

.collapsible-link[aria-expanded='true']::before {
transform: rotate(180deg);
}


/
</style>
<title><?= $title;?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Class Manage-Student Board</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                        <li class="breadcrumb-item active">Class Manage Student Dashboard</li>

                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
<div class="row">
  <div class="col-md-12">
      <form  id="register_button" action="" method="post">

        <div class="card">
            <div class="card-header bg-dark">
              <div class="card-title">
              Droping  Student
              </div>
              <div class="row">
                <div class="ml-auto justify-content-end d-flex">

                      <div class="form-check-inline mr-5">
                        <label class="form-check-label">
                            By Subject
                      <select id="bySubcode"  name="bySubcode" class="form-control-sm">
                        <option selected disabled> Select By Subject</option>
                        <?php if($GetClass->num_rows() > 0): ?>
                        <?php foreach($GetClass->result() as $GetClass_row): ?>
                            <option value="<?= $GetClass_row->subjectcode ?>"><?= $GetClass_row->subject_name ?></option>
                        <?php endforeach; ?>
                      <?php endif; ?>
                      </select>
                      </label>
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
                      <th>Fullname</th>
                      <th>Subject Code</th>
                      <th>Subject Name</th>
                      <th>Section</th>
                      <th>Schedule</th>
                      <th>School Level</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="StudList">
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                  </tbody>

              </table>
            </div>
            <div class="card-footer">
                <div class="ml-auto justify-content-end d-flex ">
                      <button type="button" class="btn btn-flat btn-danger mr-3" id="delete_btn">Drop A Student</button>

                </div>
            </div>
        </div>
          </form>
  </div>
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


   $('#delete_btn').click(function(){


   var checkbox = $('.CheckId:checked');

   if(checkbox.length > 0 ){

   var checkbox_value = [];
   $(checkbox).each(function(){
   checkbox_value.push($(this).val());
   });


   $.ajax({
     url:"<?= site_url('ManageStudent/CLassStudent/DropStudentStubject'); ?>",
     method:"POST",
     data:{checkbox_value:checkbox_value},
     success:function(data){
   //
   // $('#inboxpost').fadeOut(1500);

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
      title: 'Drop Student Subject'
     }).then((result) => {
             if (result.dismiss === Swal.DismissReason.timer) {
               Swal.fire({
                   title: 'Succesfully Drop!',
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

      }
     },


   });



   }else{
     alert('Please Select Atleast on record to delete');
   }


   });


   // $('#byClass').on('change',function(){
   //     var Subcode = $(this).val();
   //     $('#overlay2').css('visibility', 'visible');
   //     if(Subcode){
   //         $.ajax({
   //             type:'POST',
   //             url:'<//?php echo base_url('ManageStudent/CLassStudent/GetSubject'); ?>',
   //             data:'SubcodeID=' + Subcode,
   //             success:function(data){
   //                 $('#overlay1').css('visibility', 'hidden');
   //                     $('#bySubcode').html('<option >By Subject</option>');
   //                 var dataObj = jQuery.parseJSON(data);
   //                 if(dataObj){
   //                         $(dataObj).each(function(){
   //                             $('#bySubcode').append('<option value="'+ this.subjectcode +'" >'+ this.subjectname +'</option>');
   //                         });
   //
   //                 }else{
   //                             $('#bySubcode').html('<option value="">Subject Not Available</option>');
   //                 }
   //               },
   //
   //         });
   //     }else{
   //     }
   // });
   $('#bySubcode').on('change',function(){
       var bySubcode = $(this).val();

       if(bySubcode){
           $.ajax({
               type:'POST',
               url:'<?php echo base_url('ManageStudent/CLassStudent/GetStudentlist'); ?>',
               data:'bySubcode='+bySubcode,
               success:function(data){
                   $('#overlay4').css('visibility', 'hidden');
                      $('#StudList').html('');

                   var dataObj = jQuery.parseJSON(data);
                   if(dataObj){
                       $(dataObj).each(function(){
                         $('#StudList').append('<tr><td>'+ this.lastname +' , '+ this.firstname +''+ this.middlename +'</td> <td> '+ this.subjectcode +'</td> <td> ' + this.subject_name + ' </td> <td> '+ this.section + '</td> <td> '+ this.schedule + '</td> <td> '+ this.student_type + '</td> <td> <input type="checkbox" id="CheckId" class="CheckId" name="CheckId[]" value="'+this.id+'"></td></tr>');
                       });
                   }else{
                    $('#StudList').html('<tr><td><center>No Available Data</td></tr>');
                   }

               }

           });
       }else{
       }
   });


</script>
