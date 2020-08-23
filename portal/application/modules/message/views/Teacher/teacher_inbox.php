
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-3">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Folders</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item active">
              <a href="#" class="nav-link" >
                <i class="fas fa-inbox"></i> Inbox
                <span class="badge bg-primary float-right"> <?= $countmessageRecieve ?> </span>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?= site_url('message/Messages/ReceiveRemoveInboxview'); ?>" class="nav-link">
              <i style="color:gray; font-size: 16px" class="fa fa-trash-alt"></i> Remove Inbox
                          <span class="badge bg-danger float-right"> <?= $CountRemoveRecieve ?></span>
              </a>
            </li>
          </ul>
        </div>
        <!-- /.card-body -->
      </div>

      <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">Inbox</h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <div class="mailbox-controls">
            <!-- Check all button -->
            <input type="checkbox" class="mr-3" id="CheckAllInbox">All
            </input>
            <div class="btn-group float-right clearfix mb-4">
              <button id="DeletedbtnInbox" type="button" class="btn btn-default btn-sm"><i class="far fa-trash-alt"></i></button>

            </div>

            <!-- /.float-right -->
          </div>
          <div class="table-responsive mailbox-messages">
            <table id="datatable" class="table table-hover ">
                <thead>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>

                  </tr>
                </thead>
              <tbody>
                <?php if($messageRecieve->num_rows() > 0): ?>
                <?php foreach($messageRecieve->result() as $messageRecieve_row): ?>
              <tr>
                <td>

                    <input type="checkbox" value="<?=  $messageRecieve_row->message_id  ?>"  id="post_id1" class="post_id1" type="checkbox" name="post_id1[]">

                </td>
                <td class="mailbox-star"><a href="#"><i class="fas fa-star-o text-warning"></i></a></td>
                <td class="mailbox-name"><a href="<?= site_url('message/Messages/ReadMoreMessage/').$messageRecieve_row->message_id; ?>">  <?=  $messageRecieve_row->email  ?></a></td>
                <td class="mailbox-subject"><?=  $messageRecieve_row->title  ?></td>
                <td class="mailbox-date"><?=date('M d, Y : h:i  ', strtotime($messageRecieve_row->created_at)); ?></td>

              </tr>

                                <?php endforeach; ?>
                                  <?php endif; ?>
              </tbody>
            </table>
            <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->
        </div>
        <!-- /.card-body -->

      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>




<script type="text/javascript">
$(document).ready(function(){

    $('#datatable').DataTable();
  $('#CheckAllInbox').click(function () {
      $(':checkbox.post_id1').prop('checked', this.checked);
   });

   $('#DeletedbtnInbox').click(function(){


   var checkbox = $('.post_id1:checked');

   if(checkbox.length > 0 ){

   var checkbox_value = [];
   $(checkbox).each(function(){
   checkbox_value.push($(this).val());
   });


   $.ajax({
     url:"<?= site_url('message/Messages/DeleteRecieve_message'); ?>",
     method:"POST",
     data:{checkbox_value:checkbox_value},
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
             title: 'Removing Data'
           }).then((result) => {

                   if (result.dismiss === Swal.DismissReason.timer) {

                     Swal.fire({
                         title: 'Succesfully Remove!',
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



   }else{
     alert('Please Select Atleast on record to delete');
   }


   });


});
</script>
