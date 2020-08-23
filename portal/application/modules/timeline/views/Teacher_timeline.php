
<title><?= $title;?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Teacher Timeline Board</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                        <li class="breadcrumb-item active">Timeline</li>
                        <!-- <li class="breadcrumb-item active"><a href="">Notification Board</a></li> -->
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-9">
            <div class="card p-3">
              <div class="card w-100">
                  <div class="card-header bg-secondary">
                        <div class="card-title">
                              Timeline Dashboard
                        </div>
                      <div class="float-right clearfix">
                        <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#myModal">
                        <i style="font-size:14px; color:yellow;" class="fas fa-plus-circle"></i> Create New
                            </button>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
            <?php if($getallpost->num_rows() > 0): ?>
        <div class="row">
            <div class="card p-3 w-100">
              <div class="card col-md-9  p-3" style="min-width: auto;  width: 1500px">
                <div class="row">
                  <div class="col-md-12 ">
                        <div class="timeline" style="min-width: auto;">
                            <?php foreach($getallpost->result() as $getallpost_row): ?>
                        <div class="time-label">
                          <span class="bg-warning "> <?php if(!empty( $getallpost_row->subject_name)) {echo  $getallpost_row->subject_name;  }else{ echo $getallpost_row->role_display_name; } ?></span>
                        </div>
                        <div>
                          <i class="fas fa-comments bg-yellow"></i>
                          <div class="timeline-item" style="min-width: auto;">
                            <span class="time"><i style="color:violet; font-size: 15px;" class="fas fa-clock mr-2"></i><?= date('M d, Y : h:i  ', strtotime( $getallpost_row->created_at)); ?></span>
                            <h3 class="timeline-header"><span class="badge badge-pill badge-warning"><?= $getallpost_row->role_display_name?></span>  &nbsp;<a href="#"><?= $getallpost_row->name ?></a>  &nbsp;> &nbsp; <strong><?= $getallpost_row->title ?></strong> </h3>

                            <div class="timeline-body">
                              <span style="display:block;text-overflow: ellipsis;height:  100px;width: auto;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 5; /* number of lines to show */-webkit-box-orient: vertical;">
                      <?= $getallpost_row->description ?>
                    </span>
                            </div>
                            <div class="timeline-footer">
                              <a class="btn btn-info btn-flat btn-sm" href="<?= site_url('timeline/Timeline/GetSpecificPost/').$getallpost_row->timeline_id;?>">Read more</a>
                              <!-- <a class="btn btn-danger btn-sm">Delete</a> -->
                            </div>
                          </div>
                        </div>
                      <?php endforeach; ?>

                        </div>
                  </div>
                </div>
                <div class=" text-center">
                  <?= $pagination1; ?>
                </div>
              </div>
            </div>


        </div>
        <?php
      else:
        echo "<center> <strong> No data Available</strong> </center>";
       endif; ?>

  <!-- The Modal -->
  <div class="modal fade " id="myModal">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" >
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Timeline Information</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
                    <div class="container-fluid" >
                          <form  id="mydata" action="<?= site_url('timeline/Timeline/timelinebroadcastData');?>" method="post">
                                    <div class="row">
                                          <div class="col-8">
                                            <div class="form-group">
                                                        <label for="fortitle">Title</label><span style="color:red;">*</span>
                                                        <input id="fortitle" class="form-control w-75" type="text" name="timelinetitle" value="<?= set_value('timelinetitle');?>" placeholder="Title">
                                                                            <span> <?= form_error('timelinetitle');?></span>
                                            </div>
                                            <div class="form-group">
                                                  <label for="fortextarea">Description Info</label><span style="color:red;">*</span>
                                                  <textarea id="fortextarea" class="form-control w-100" name="timelinedesc" rows="8" cols="80" placeholder="Description Here !!!"><?= set_value('timelinedesc');?></textarea>
                                                    <span> <?= form_error('timelinedesc');?></span>
                                            </div>
                                          </div>
                                          <div class="col-4 p-3">
                                                    <div class="">
                                                              <div class="form-group">
                                                                <label>By Subject</label>
                                                                <div class="select2-purple">
                                                                  <select class="select2" id="select2" name="subjectid" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                                      <option selected disabled>Select By Subject</option>
                                                                      <?php if($subjectcode->num_rows() > 0 ): ?>
                                                                          <?php foreach($subjectcode->result() as $sub_row): ?>
                                                                            <option value="<?= $sub_row->subjectcode; ?>" <?= (set_value('subjectid'))  ? 'selected' : '' ?>> <?= $sub_row->subject_name; ?></option>
                                                                          <?php endforeach; ?>
                                                                      <?php else:
                                                                            echo "null";
                                                                      endif; ?>
                                                                  </select>
                                                                </div>
                                                                <span> <?= form_error('subjectid');?></span>
                                                              </div>

                                                            <div class="form-group clearfix">
                                                              <div class="card">
                                                                    <div class="card-title bg-dark">
                                                                     <strong class="h-6 ml-4"> Other Options </strong>
                                                                    </div>
                                                                    <div class="card-body p-4">
                                                                      <div class="icheck-primary d-inline">
                                                                        <input type="checkbox" id="checkboxPrimary1" >
                                                                        <label for="checkboxPrimary1">
                                                                        All Teacher
                                                                        </label>
                                                                      </div>
                                                                      <div id=""  style="overflow-y:scroll; overflow-x:hidden; height:400px;">
                                                                        <?php if($GetTeacher->num_rows() > 0): ?>
                                                                        <?php foreach($GetTeacher->result() as $GetTeacher_row): ?>

                                                                          <div class="form-check">
                                                                            <label class="form-check-label">
                                                                              <input type="checkbox" id="All_techer" class="bulk_check" name="All_techer[]" value="<?= $GetTeacher_row->user_id ?>"> <?= $GetTeacher_row->email  ?>
                                                                            </label>
                                                                          </div>

                                                                      <?php endforeach; ?>
                                                                    <?php endif; ?>

                                                                      </div>
                                                                    </div>

                                                              </div>


                                                            </div>

                                                    </div>
                                          </div>
                                    </div>
                                          <div class="form-group float-right clearfix">
                                                <button  type="submit" class="btn bnt-md btn-flat btn-success"  name="button">Post now</button>
                                          </div>
                          </form>
                    </div>
        </div>

      </div>
    </div>
  </div>
        <!-- </div> -->
    </div>
</div>
<script>

function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
        <script src="<?= base_url('public/plugins/select2/js/select2.full.min.js');?>"></script>
        <script src="<?= base_url('public/plugins/summernote/summernote-bs4.min.js');?>"></script>
        <script>
          $(function () {
            // Summernote
            $('#fortextarea').summernote({
                  height: 500
            });
          })


          $(document).ready(function(){

            // $('#checkboxPrimary1').click(function () {
            //     $(':checkbox.bulk_check').prop('checked', this.checked);
            //  });


            $("#All_techer").change(function () {
                if ($("#All_techer").val() == 1 ) {
                    $("#select2").removeAttr("disabled");
                    $("#select2").focus();
                } else {
                    $("#select2").attr("disabled", "disabled");
                }


            });
            $("#checkboxPrimary1").change(function () {
                if ($("#checkboxPrimary1").val() == 1 ) {
                    $("#select2").removeAttr("disabled");
                    $("#select2").focus();
                } else {
                    $("#select2").attr("disabled", "disabled");
                }


            });
          })
          $(function () {
              $("#select2").change(function () {
                  if ($("#select2").val() == 1) {
                      $("#All_techer").removeAttr("disabled");
                      $("#All_techer").focus();
                      $("#checkboxPrimary1").removeAttr("disabled");
                      $("#checkboxPrimary1").focus();
                  } else {
                      $("#All_techer").attr("disabled", "disabled");
                    $("#checkboxPrimary1").attr("disabled", "disabled");
                     $(':checkbox.bulk_check').prop("disabled", !this.checked);

                  }


              });

          });
        //input form
        $(document).ready(function() {
          $('#checkboxPrimary1').click(function () {
              $(':checkbox.bulk_check').prop('checked', this.checked);
           });


        });


                $('#mydata').submit(function(e){

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
                          timer: 3000,
                          timerProgressBar: true,
                          onOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                          }
                        })

                        Toast.fire({
                          icon: 'success',
                          title: 'Submitting Data'
                        }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                  Swal.fire({
                                      title: 'Succesfully Post',
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



        </script>
