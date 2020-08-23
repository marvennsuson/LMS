
<title><?= $title;?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Virtual Lesson Board</h1>
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
          <div class="col-xs-12 col-sm-12 col-md-12 mb-4">
        <div class="card card-outline card-warning">
          <div class="card-header">
            <h3 class="card-title">Virtual lesson</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>

          </div>
          <!-- /.card-header -->
          <div class="card-body" style="display: block;">
                  <form id="composeLesson" action="<?= site_url('activities/Virtuallesson_controller/ComposingLesson'); ?>" method="post">
                  <div class="row mb-4">
                    <div class=" col-xs-12 col-sm-12 col-md-6">

                            <div class="form-group col-md-12">
                                <div class="col-xs-3 col-2">
                                    <label for="lessonnum" class="mr-2 col-form-label-md">Lesson#:&nbsp;</label>
                                </div>
                                <input type="text" class="form-control form-control-md" autocomplete="off" name="lessonnum" id="lessonnum" placeholder="Lesson #"  value="<?= set_value('lessonnum')?>">
                            </div>
                            <div class="form-group col-md-12">
                                  <div class="col-xs-3 col-2">
                                      <label for="lessontopic" class="mr-2 col-form-label-md">Topic:&nbsp;</label>
                                  </div>
                                <input type="text" class="form-control form-control-md" autocomplete="off" name="lessontopic" id="lessontopic" placeholder="Lesson Topic" value="<?= set_value('lessontopic') ?>">
                            </div>
                            <div class="form-group col-md-12">
                                <div class="col-xs-3 col-2">
                                  <label for="lessoninstruction" class="mr-2 col-form-label-md">Instrution:&nbsp;</label>
                                </div>
                                <input type="text" class="form-control form-control-md" autocomplete="off" name="lessoninstruction" id="lessoninstruction" placeholder="Lesson Instrution"  value="<?= set_value('lessoninstruction')?>">
                            </div>

                            <div class="form-group col-md-12">
                              <div class="input-group mb-3 input-group-sm">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="embeddata">https://www.youtube.com/embed/</span>
                                    </div>
                                      <input type="text" class="form-control form-control-sm" autocomplete="off" name="ytlink" id="ytlink" placeholder="Youtube Link"  value="<?= set_value('ytlink')?>">
                                  </div>
                                <!-- <div class="col-xs-2 col-2">
                                  <label for="ytlink" class="mr-2 col-form-label-md">Youtube Link:&nbsp;</label>
                                </div>
                                <input type="text" class="form-control form-control-md" autocomplete="off" name="ytlink" id="ytlink" placeholder="Youtube Link"  value="</?= set_value('ytlink')?>"> -->
                            </div>
                            <div class="row mb-5">
                              <div class="form-group">
                                  <div class="col-xs-2 col-2 ml-3">
                                    <label  class="mr-2 col-form-label-md">Class:&nbsp;</label>
                                  </div>
                              </div>



                              <?php if($subjectlist->num_rows() > 0): ?>
                              <?php foreach($subjectlist->result() as $subjectlist_row): ?>
                                <div class="col-xs-12  col-sm-3 col-md-3 ">
                                      <div class="form-check">
                                      <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input checkboxitems" id="checkboxitems" name="subjectname[]"  value="<?= $subjectlist_row->subjectcode ?>"><?= $subjectlist_row->subject_name?>
                                      </label>
                                      </div>
                                </div>
                              <?php endforeach; ?>
                            <?php endif; ?>
                            </div>
                    </div>
                        <div class=" col-xs-12 col-sm-12  col-md-6">
                          <div class="embed-responsive embed-responsive-16by9">
                          <iframe id="videoframe" class="embed-responsive-item" src="" allowfullscreen></iframe>
                        </div>

                        </div>
                  </div>
                  <div class="justify-content-end d-flex text-white">
                      <button type="submit" class="btn btn-flat btn-warning text-white">Submit lesson</button>
                  </div>
                      </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

      <div class="row">
        <div class="col-xs-12 com-sm-3 col-md-12 col-lg-12">
          <div class="card card-outline card-success">
            <div class="card-header">
              <h3 class="card-title">Virtual Lesson Lesson List</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="justify-content-end d-flex mb-4">
                <div class="ml-auto justify-content-end d-flex ">
                      <button type="button" class="btn btn-flat btn-danger mr-3" id="delete_btn">Delete</button>

                </div>
                <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="checkalltable">all
              </label>
              </div>
              </div>
                <table id="table_id" class="table table-sm ">
                    <thead>
                      <tr>
                        <th>Subject Name</th>
                        <th>Lesson #</th>
                          <th>Lesson Topic</th>
                            <th>Lesson Instruct</th>
                              <th>Youtube Link</th>
                                <th>date Created</th>
                                <th>action</th>
                                <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if($VideoLinklist->num_rows() > 0): ?>
                      <?php foreach($VideoLinklist->result() as $VideoLinklist_row): ?>
                        <tr>
                          <td><?=  $VideoLinklist_row->subject_name ?></td>
                          <td><?=  $VideoLinklist_row->lesson_number ?></td>
                          <td><?=  $VideoLinklist_row->lesson_topic ?></td>
                          <td><?=  $VideoLinklist_row->lesson_instruct ?></td>
                          <td> <a href="<?=  $VideoLinklist_row->youtube_link ?>"><?=  $VideoLinklist_row->youtube_link ?></a> </td>
                          <td><?=  $VideoLinklist_row->created_at ?></td>
                          <td>
                              <!-- <a class="btn btn-success btn-sm btn-flat edit tablinks " id="btn_edit" data-value="</?= $VideoLinklist_row->id ?>"><i style="font-size: 14px;color:#fff;" class="fa fa-edit"></i></a> -->
                            <button type="button" class="btn btn-success btn-sm btn-flat edit" id="btn_edit" data-classid="" title="Edit" value="<?= $VideoLinklist_row->id ?>" ><i style="font-size: 14px;color:#fff;" class="fa fa-edit"></i></button>
                            <!-- <button type="button" class="btn btn-danger btn-sm btn-flat delete" id="btn_delete" data-classid="" title="Delete" ><i style="font-size: 14px;color:#fff;" class="fa fa-trash"></i></button> -->
                          </td>
                          <td> <input type="checkbox" id="CheckId" name="CheckItem[]" class="CheckId" value="<?= $VideoLinklist_row->id ?>"></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
        </div>
    </div>
</div>

  <div class="modal fade" id="EditModal">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" id="innermodal">

        </div>

      </div>
    </div>
  </div>

<script type="text/javascript">

$('.edit').click(function(){
  var  VideoID = $(this).val();
      // var VideoID  = $(this).data("value");

    $.ajax({
        url: "<?=site_url('activities/Virtuallesson_controller/GetspecificPlaylist')?>",
        data: { videoID : VideoID},
        type: "post",
        success: function(data){
            if(data.response == "false") {
            } else {
              $("#EditModal").modal("show");
                $("#innermodal").html(data);
            }
        },
    })
    return false;
});

$(document).ready(function(){
     $('#table_id').DataTable();
      $("#ytlink").keyup(function() {
            var textareaValue = $("#ytlink").val();
            var Spanval = document.getElementById("embeddata").innerText;

         $('#videoframe').attr('src', Spanval+textareaValue);
      });
 // $('#videoframe').attr('src', "https://www.youtube.com/embed/v64KOxKVLVg");

 $('#checkalltable').click(function () {
     $(':checkbox.CheckId').prop('checked', this.checked);
  });


});

$('#composeLesson').submit(function(e){

e.preventDefault();
 var fa = $(this);

  $.ajax({
    url: fa.attr('action'),
    type: 'post' ,
    data: fa.serialize(),
    // dataType: 'json',
    success: function(data) {
        if(data.response != "false"){
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            onOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })

          Toast.fire({
            icon: 'success',
            title: 'Submmiting Lesson Data'
          }).then((result) => {

                  if (result.dismiss === Swal.DismissReason.timer) {

                    Swal.fire({
                        title: 'Succesfully Submmited!',
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
    }

 });


});




$('#delete_btn').click(function(){


var checkbox = $('.CheckId:checked');

if(checkbox.length > 0 ){

var checkbox_value = [];
$(checkbox).each(function(){
checkbox_value.push($(this).val());
});



Swal.fire({
title: 'Are you sure you want to delete these Lesson <br>?',
text: "You won't be able to revert this!",
type: 'warning',
showCancelButton: true,
confirmButtonColor: '#d33',
cancelButtonColor: '#3085d6',
confirmButtonText: 'Yes, delete it!'
}).then((result) => {


if (result.value == true) {

  $.ajax({
    url:"<?= site_url('activities/Virtuallesson_controller/Removelesson'); ?>",
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
     title: 'Deleting Record'
    }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
              Swal.fire({
                  title: 'Succesfully Deleted!',
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

}
})





}else{
  alert('Please Select Atleast on record to delete');
}


});















</script>
