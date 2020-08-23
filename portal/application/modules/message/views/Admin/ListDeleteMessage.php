<title><?= $title;?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> Inbox Message Board</h1>
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
          <section class="content">
            <div class="row">
              <div class="col-md-3">
                <!-- <a  class="btn btn-primary btn-block mb-3 text-white" >Compose</a> -->

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
                        <a href="<?=  site_url('message/Messages/Admin_messageIndex'); ?>" class="nav-link">
                          <i class="fas fa-inbox"></i> Inbox items
                          <span class="badge bg-success float-right"><?= $CountMessageNull ?></span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= site_url('message/Messages/AdminSentMessage');?>" class="nav-link">
                          <i class="far fa-envelope"></i> Sent Item
                                  <span class="badge bg-warning float-right"><?= $CountMessageSent ?></span>
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
                    <h3 class="card-title">Delete Message Inbox</h3>

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

                      <?php if($GetDeleteInbox->num_rows() > 0 ): ?>
                      <?php foreach($GetDeleteInbox->result() as $GetDeleteInbox_row): ?>
                        <tr>
                          <td>
                              <input type="checkbox" class="checkitem icheck-primary" value="<?= $GetDeleteInbox_row->message_id ?>" id="checkitem"/>
                          </td>
                          <td class="mailbox-star"><a href="#"><i class="fas fa-star-o text-warning"></i></a></td>
                          <td class="mailbox-name"><a href="<?= site_url('message/Messages/ReadMoreMessage/').$GetDeleteInbox_row->message_id ; ?>"><?=  $GetDeleteInbox_row->email ?></a></td>
                          <td class="mailbox-subject" style="display:block;text-overflow: ellipsis;width:600px;overflow: hidden; white-space: nowrap;">
                               <?=  $GetDeleteInbox_row->title ?>
                          </td>
                          <!-- <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td> -->
                          <td class="mailbox-date"><?= date('M d, Y : h:i  ', strtotime( $GetDeleteInbox_row->created_at)); ?></td>
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
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </section>
        </div>
    </div>
</div>
<script src="<?= base_url('public/plugins/summernote/summernote-bs4.min.js');?>"></script>
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
   url:"<?= site_url('message/Messages/DeleteMessageInbox'); ?>",
   method:"POST",
   data:{checkbox_value:checkbox_value},
   success:function(data){

if(data.response != "false"){
  // $('#inboxpost').fadeOut(1500);
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
 title: 'Deleting record'
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
   },


 });



 }else{
   alert('Please Select Atleast on record to delete');
 }


 });
</script>
