<title><?= $title;?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Admin Timelime Board</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                        <li class="breadcrumb-item active"><a href="<?= current_url();?>">Admin Timeline Board</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
          <div class="row ">
            <div class="col-md-9">
              <div class="card p-3">
                <div class="card w-100">
                    <div class="card-header bg-secondary">
                          <div class="card-title">
                                Timeline Dashboard
                          </div>
                        <div class="float-right clearfix">
                          <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#createTimeline">
                          <i style="font-size:14px; color:yellow;" class="fas fa-plus-circle"></i> Create New
                              </button>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
            <div class="row">
                <div class="col-sm-9 card p-3"  style="min-width: auto;  width: 1500px">
                    <div class="card p-3">
                      <div class="col-md-12">
                        <div class="timeline" style="min-width: auto;">

                            <?php foreach($getallpost->result() as $getallpost_row): ?>
                        <div class="time-label">
                          <span class="bg-info"> <?php if(!empty( $getallpost_row->subject_name)) {echo  $getallpost_row->subject_name;  }else{ echo $getallpost_row->role_display_name; } ?></span>
                        </div>
                        <div>
                          <i class="fas fa-envelope bg-info"></i>
                          <div class="timeline-item" style="min-width: auto;">
                            <span class="time"><i style="color:violet; font-size: 15px;" class="fas fa-clock mr-2"></i><?= date('M d, Y : h:i  ', strtotime(  $getallpost_row->created_at)); ?></span>
                            <h3 class="timeline-header"><span class="badge badge-pill badge-warning"><?= $getallpost_row->role_display_name?></span> <a href="#"><?= $getallpost_row->name ?></a>  &nbsp;> &nbsp; <?= $getallpost_row->title ?></h3>

                            <div class="timeline-body">
                              <span  style="display:block;text-overflow: ellipsis;height:  100px;width: auto;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 5; /* number of lines to show */-webkit-box-orient: vertical;">
                                            <?= $getallpost_row->description.'...' ?>
                              </span>

                            </div>
                            <div class="timeline-footer">
                              <a class="btn btn-info btn-sm btn-flat" href="<?= site_url('timeline/Timeline/GetSpecificPost/').$getallpost_row->timeline_id;?>">Read more</a>
                              <!-- <a class="btn btn-danger btn-sm">Delete</a> -->
                            </div>
                          </div>
                        </div>
                      <?php endforeach; ?>

                        <hr>
                        </div>

                      </div>
                    </div>
                    <div class=" text-center">
                      <?= $paginationadmin; ?>
                    </div>
                </div>

            </div>



  <!-- The Modal -->
  <div class="modal fade" id="createTimeline">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create Timeline</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
          <form  id="createAdminTimeline"  action="<?=  site_url('timeline/Timeline/PostTimelineAdmin'); ?>" method="post">

        <!-- Modal body -->
        <div class="modal-body">
            <div class="row">
                <div class="col-7">
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
                <div class="col-5">
                  <div class="card">
                        <div class="card-title bg-dark">
                         <strong class="h-6 ml-4"> Other Options </strong>
                        </div>
                        <div class="card-body p-4">
                          <div class="form-group">
                                <label for=""> Select By </label>
                                <select id="roleCategory" name="roleCategory" class="custom-select custom-select-sm">
                                  <option selected disabled> Select Category</option>
                                    <?php if($UserRole->num_rows() > 0): ?>
                                    <?php foreach($UserRole->result() as $UserRole_row): ?>
                                      <option value="<?= $UserRole_row->role_id ?>"><?= $UserRole_row->role_display_name ?></option>
                                    <?php endforeach; ?>
                                  <?php else:
                                     echo "null";
                                 endif; ?>


                                </select>
                          </div>
                          <div id="" style="overflow-y:scroll; overflow-x:hidden; height:400px;">
                            <div >
                                <div id="Roleusercateg"  class="list-group checkbox-list-group mr-3 list-group-flush" >

                                  </div>
                              </div>
                          </div>
                        </div>
                        <div id="overlay2" class="overlay" style="visibility: hidden;">
                          <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                      </div>

                  </div>
                </div>
            </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer text-white">
          <button type="submit" class="btn bg-yellow btn-flat btn-md text-white" >Create now</button>
        </div>
    </form>
      </div>
    </div>
  </div>
        </div>
    </div>

</div>
<script src="<?= base_url('public/plugins/summernote/summernote-bs4.min.js');?>"></script>
<script type="text/javascript">
// $("#createTimeline").modal({"backdrop": "static"});
$('#createAdminTimeline').submit(function(e){

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
                            title: 'Succesfully Submit',
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


$(function () {
  // Summernote
  $('#fortextarea').summernote({
     height: 300,
  });
})

$('#roleCategory').on('change',function(){
    var roleCategory = $(this).val();
    $('#overlay2').css('visibility', 'visible');
    if(roleCategory){
        $.ajax({
            type:'POST',
            url:'<?php echo base_url('timeline/Timeline/GetRoleUser'); ?>',
            data:'roleCategoryID=' + roleCategory,
            success:function(data){
                $('#overlay2').css('visibility', 'hidden');
                $('#Roleusercateg').html('');
                var dataObj = jQuery.parseJSON(data);
                if(dataObj){
                    $(dataObj).each(function(){
                        $('#Roleusercateg').append('<a class="list-group-item list-group-item-action"> <input type="checkbox" name="ByRole[]" class="float-right clearfix"  value="'+ this.user_id +'" ></input>'+ this.email+'</a>');
                    });
                }else{
                    $('#Roleusercateg').html('<a href="#" class="list-group-item list-group-item-action">EMPTY</a>');
                }
            }

        });
    }else{
    }
});
</script>
