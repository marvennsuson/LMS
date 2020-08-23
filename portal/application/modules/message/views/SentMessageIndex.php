<title><?= $title;?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Sent Message Board</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                        <li class="breadcrumb-item active">Sent Message Dashboard</li>

                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-3">
                  <a href="<?= site_url('message/Messages'); ?>" class="btn btn-primary btn-block mb-3">Back to Inbox</a>

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
                          <a href="<?= site_url('message/Messages'); ?>" class="nav-link">
                            <i class="fas fa-inbox"></i> Inbox
                            <span class="badge bg-primary float-right">12</span>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="<?= site_url('message/Messages/ListDeleteMessageSent'); ?>" class="nav-link">
                            <i class="far fa-trash-alt"></i> Trash
                          </a>
                        </li>
                      </ul>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->

                  <!-- /.card -->
                </div>
                <!-- /.col -->
              <div class="col-md-9">

                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h3 class="card-title">Sent Items</h3>

                    <!-- <div class="card-tools">
                      <div class="input-group input-group-sm">
                        <input type="text" class="form-control" placeholder="Search Mail">
                        <div class="input-group-append">
                          <div class="btn btn-primary">
                            <i class="fas fa-search"></i>
                          </div>
                        </div>
                      </div>
                    </div> -->
                    <!-- /.card-tools -->
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <div class="mailbox-controls mb-4">
                      <!-- Check all button -->
                      <input type="checkbox" id="bulk_select" class="btn btn-default btn-sm checkbox-toggle">
                    </input>
                      <div class="btn-group float-right clearfix mb-1" >
                        <button type="submit" id="deleted_btn" class="btn btn-default btn-sm"><i class="far fa-trash-alt"></i></button>

                      </div>
                      <!-- /.btn-group -->
                      <!-- <button type="button" class="btn btn-default btn-sm"><i class="fas fa-sync-alt"></i></button>
                      <div class="float-right">
                        1-50/200
                        <div class="btn-group">
                          <button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></button>
                          <button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></button>
                        </div>

                      </div> -->
                      <!-- /.float-right -->
                    </div>
                    <div class="table-responsive mailbox-messages p-2">
                      <table id="table_id" class="table table-hover  ">
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

                      <?php if($GetSentMessage->num_rows() > 0 ): ?>
                      <?php foreach($GetSentMessage->result() as $GetSentMessage_row): ?>
                        <tr>
                          <td>
                              <input type="checkbox" class="checkitem icheck-primary" value="<?= $GetSentMessage_row->message_id ?>" id="checkitem"/>
                          </td>
                          <td class="mailbox-star"><a href="#"><i class="fas fa-star-o text-warning"></i></a></td>
                          <td class="mailbox-name"><a href="<?= site_url('message/Messages/ReadMoreMessage/').$GetSentMessage_row->message_id ; ?>"><?=  $GetSentMessage_row->email ?></a></td>
                          <td class="mailbox-subject" style="display:block;text-overflow: ellipsis;width:600px;overflow: hidden; white-space: nowrap;">
                               <?=  $GetSentMessage_row->description ?>
                          </td>
                          <!-- <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td> -->
                          <td class="mailbox-date"><?=  $GetSentMessage_row->created_at ?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: echo "Null";
                   endif; ?>
                        </tbody>
                      </table>
                      <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                  </div>
                  <!-- /.card-body -->

                </div>


              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </section>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function () {
  // Summernote
  $('#compose-textarea').summernote({
     height: 300,
  });
})
$(document).ready(function(){
      $('#table_id').DataTable();
   $('#bulk_select').click(function () {
    $(':checkbox.checkitem').prop('checked', this.checked);
 });
 });


 $('#deleted_btn').click(function(){


 var checkbox = $('.checkitem:checked');

 if(checkbox.length > 0 ){

 var checkbox_value = [];
 $(checkbox).each(function(){
 checkbox_value.push($(this).val());
 });


 $.ajax({
   url:"<?= site_url('message/Messages/AdminDeleteSentMessage'); ?>",
   method:"POST",
   data:{checkbox_value:checkbox_value},
   success:function(){

 // $('#inboxpost').fadeOut(1500);
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
title: 'Removing record'
}).then((result) => {
      if (result.dismiss === Swal.DismissReason.timer) {
          window.location.href='<?= current_url(); ?>';
      }
  });

   },


 });



 }else{
   alert('Please Select Atleast on record to delete');
 }


 });
</script>
