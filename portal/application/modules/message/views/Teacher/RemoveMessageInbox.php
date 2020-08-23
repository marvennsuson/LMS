<title><?= $title;?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Message Board</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                        <li class="breadcrumb-item active">Message Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
          <div class="card">
                <div class="card-header bg-dark d-flex align-items-center">
                    <h3 class="card-title">My Inbox Deleted Message</h3>

                </div>
                  <form  id="PermanentDeleteInbox" action="<?= site_url('message/Messages/PermanentDelMessage'); ?>" method="post">
                    <?php if($DelMessageRecieve->num_rows() > 0): ?>
                    <?php foreach($DelMessageRecieve->result() as $DelMessageRecieve_row): ?>
                    <div class="card-body">
                      <div class="card">
                            <div class="card-header bg-dark d-flex align-items-center">
                                <h3 class="card-title"><?=  $DelMessageRecieve_row->title  ?></h3>
                                <div class=" ml-auto">
                                      <strong> <?=  date('M d, Y : h:i ', strtotime($DelMessageRecieve_row->created_at)); ?></strong>
                                </div>
                            </div>
                              <div class="card-body">
                              <p>
                 <?=  $DelMessageRecieve_row->description  ?>
                              </p>
                            </div>
                              <div class="card-footer d-flex align-items-center">
                                <strong> By:  <?=  $DelMessageRecieve_row->email  ?></strong>
                                <div class=" ml-auto">

                                    <button type="submit" class="btn btn-danger" id="PermanentDel" name="PermanentDel" value="<?=  $DelMessageRecieve_row->message_id  ?>" > <i style="font-size:14px; color:white;"  class="fas fa-trash-alt"></i></button>
                                </div>
                              </div>
                      </div>

                  </div>
                  <div id="overlay5" class="overlay" style="visibility: hidden;">
                          <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                      </div>
                <?php endforeach; ?>
                  <?php endif; ?>
                  </form>

          </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$('#PermanentDeleteInbox').submit(function(e){

e.preventDefault();
 var fa = $(this);
var PermanentDel = $("#PermanentDel").val();

  $.ajax({
    url: fa.attr('action'),
    type: 'post' ,
    data: {PermanentDel: PermanentDel},
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
            title: 'Deleting Data'
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
    }

 });


});

</script>
