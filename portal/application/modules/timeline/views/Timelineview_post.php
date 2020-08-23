<style >
body {
font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif;
}
</style>
<title><?= $title;?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Timeline  Board</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                        <li class="breadcrumb-item active">Other Post</li>
                        <!-- <li class="breadcrumb-item active"><a href="<?= current_url();?>">Notification Board</a></li> -->
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">





<div class="row">
  <div class="col-sm-9">
    <?php if($GetSpecifiPost->num_rows() > 0): ?>
      <?php foreach($GetSpecifiPost->result() as $GetSpecifiPost_row):
        ?>
    <div class="card card-widget">
      <div class="card-header">
        <div class="user-block">
          <img class="img-circle" src="<?= base_url('public/userlogo2.jpg');?>" alt="User Image">
          <span class="username"><a href="#"><?= $GetSpecifiPost_row->name?></a></span>
          <span class="description">Shared publicly -    <?= date('M d, Y : h:i  ', strtotime($GetSpecifiPost_row->created_at)); ?></span>
        </div>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Mark as read">
            <i class="far fa-circle"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
          </button>
        </div>

      </div>

      <div class="card-body">

        <p class="h4 text-mute"> <strong><?= $GetSpecifiPost_row->title ?></strong> </p>

        <p><?= $GetSpecifiPost_row->description ?></p>


        <!-- <div class="attachment-block clearfix">
          <img class="attachment-img" src="<?//= base_url('public/userlogo2.jpg');?>" alt="Attachment Image">

          <div class="attachment-pushed">
            <h4 class="attachment-heading"><a href="http://www.lipsum.com/">Lorem ipsum text generator</a></h4>

            <div class="attachment-text">
              Description about the attachment can be placed here.
              Lorem Ipsum is simply dummy text of the printing and typesetting industry... <a href="#">more</a>
            </div>

          </div>

        </div> -->
<form class="comment-form" id="mydata"; method="POST" action="<?= base_url('timeline/Timeline/CreateComment');?>">
        <!-- <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
        <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
        <span class="float-right text-muted">45 likes - 2 comments</span> -->
      </div>
  <input type="hidden" name="timelineid" value="<?= $GetSpecifiPost_row->timeline_id ?>">
      <div class="card-footer card-comments">

              <?php if($commentshow->num_rows() > 0): ?>
                          <?php foreach($commentshow->result() as $commentshow_row):?>
        <div class="card-comment">

          <img class="img-circle img-sm" src="<?= base_url('public/userlogo2.jpg');?>" alt="User Image">

          <div class="comment-text">
            <span class="username">
                          <?= $commentshow_row->email ?>
        <div class="justify-content-end d-flex float-right" >

                <span class="badge badge-pill badge-info mr-2"> <?= $commentshow_row->role_display_name ?>  </span>
                          <span class="text-muted float-right"><?= date('M d, Y : h:i  ', strtotime($commentshow_row->created_at)); ?></span>
        </div>


            </span>
          <?= $commentshow_row->description ?>
          </div>

        </div>
      <?php endforeach; ?>

        </div>
      <?php
       endif; ?>
      </div>

      <div class="card-footer">

          <img class="img-fluid img-circle img-sm" src="<?= base_url('public/userlogo2.jpg');?>" alt="Alt Text">

          <div class="img-push">


<div class="input-group mb-3">
  <input type="text" name="user_comment" value="<?= set_value('user_comment');?>"  class="form-control form-control-md" placeholder="Press enter to post comment">
  <div class="input-group-append">
      <button type="submit" class="btn btn-md btn-success comment-btn btn-flat ">Comment</button>
  </div>
</div>



          </div>
        </form>
      </div>

    </div>

  <?php endforeach; ?>

    </div>
  <?php else: echo "No data Availble";
   endif; ?>

  </div>
</div>








        </div>
    </div>
</div>
<script type="text/javascript">
$('#mydata').submit(function(e){

e.preventDefault();
 var fa = $(this);

  $.ajax({
    url: fa.attr('action'),
    type: 'post' ,
    data: fa.serialize(),
    // dataType: 'json',
    success: function(data){
    if(data.response != "false"){
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
        },


 });


});

</script>
