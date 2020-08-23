<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<title><?= $title;?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Inbox Message Board</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                        <li class="breadcrumb-item active">Admin Message Board</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
          <!-- Main content -->
          <section class="content">
            <div class="row">
              <div class="col-md-3">
                <a  class="btn btn-primary btn-block mb-3 text-white" data-toggle="modal" data-target="#ComposeMessage">Compose</a>

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
                        <a href="#" class="nav-link">
                          <i class="fas fa-inbox"></i> Inbox
                          <span class="badge bg-primary float-right">12</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= site_url('message/Messages/AdminSentMessage');?>" class="nav-link">
                          <i class="far fa-envelope"></i> Sent
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="<?= site_url('message/Messages/ListDeleteMessageInbox');  ?>" class="nav-link">
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
                    <h3 class="card-title">Inbox</h3>

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

                      <?php if($GetMessageRecieve->num_rows() > 0 ): ?>
                      <?php foreach($GetMessageRecieve->result() as $GetMessageRecieve_row): ?>
                        <tr>
                          <td>
                              <input type="checkbox" class="checkitem icheck-primary" value="<?= $GetMessageRecieve_row->message_id ?>" id="checkitem"/>
                          </td>
                          <td class="mailbox-star"><a href="#"><i class="fas fa-star-o text-warning"></i></a></td>
                          <td class="mailbox-name"><a href="<?= site_url('message/Messages/ReadMoreMessage/').$GetMessageRecieve_row->message_id ; ?>"><?=  $GetMessageRecieve_row->email ?></a></td>
                          <td class="mailbox-subject" style="display:block;text-overflow: ellipsis;width:600px;overflow: hidden; white-space: nowrap;">
                               <?=  $GetMessageRecieve_row->description ?>
                          </td>
                          <!-- <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td> -->
                          <td class="mailbox-date"><?=  $GetMessageRecieve_row->created_at ?></td>
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

          <div class="modal" id="ComposeMessage">
            <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered">
              <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                  <h1 class="modal-title">Compose Messsage</h1>
                  <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                        <form id="CreateMessageAdmin"  action="<?= site_url('message/Messages/SendMessageAdmin')?>" method="post">
                      <div class="row">
                        <div class="col-8">
                          <div class="w-100">



                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">Compose New Message</h3>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body">
                                <div class="form-group">
                                  <span style="color:red"><?= form_error('titleDescrition'); ?></span>
                                  <input class="form-control" placeholder="Title:" name="titleDescrition" value="<?= set_value('titleDescrition'); ?>">
                                </div>
                                <!-- <div class="form-group">
                                  <input class="form-control" placeholder="Subject:" >
                                </div> -->
                                <div class="form-group">
                                    <span style="color:red"><?= form_error('messageDescription'); ?></span>
                                    <textarea id="compose-textarea" class="form-control" style="height: 300px" name="messageDescription">
                                      <?= set_value('messageDescription'); ?>
                                    </textarea>
                                </div>
                                <!-- <div class="form-group">
                                  <div class="btn btn-default btn-file">
                                    <i class="fas fa-paperclip"></i> Attachment
                                    <input type="file" name="attachment">
                                  </div>
                                  <p class="help-block">Max. 32MB</p>
                                </div> -->
                              </div>
                              <!-- /.card-body -->
                              <div class="card-footer">
                                <div class="float-right">
                                  <!-- <button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Draft</button> -->
                                  <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                                </div>
                                <!-- <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button> -->
                              </div>
                              <!-- /.card-footer -->
                            </div>

                            <!-- /.card -->
                          </div>
                        </div>
                        <div class="col-4">
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
                                          <?php foreach($UserRole->result() as $UserRole_row ): ?>
                                              <option value="<?= $UserRole_row->role_id ?>"><?= $UserRole_row->role_display_name ?></option>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
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
                          </form>
                </div>


              </div>
            </div>
          </div>
        </div>
    </div>

  <!-- The Modal -->

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
   url:"<?= site_url('message/Messages/DeleteRecieve_message'); ?>",
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


 $('#roleCategory').on('change',function(){
     var roleCategory = $(this).val();
     $('#overlay2').css('visibility', 'visible');
     if(roleCategory){
         $.ajax({
             type:'POST',
             url:'<?php echo base_url('message/Messages/GetRoleUser'); ?>',
             data:'roleCategoryID=' + roleCategory,
             success:function(data){
                 $('#overlay2').css('visibility', 'hidden');
                 $('#Roleusercateg').html('');
                 var dataObj = jQuery.parseJSON(data);
                 if(dataObj){
                     $(dataObj).each(function(){
                         $('#Roleusercateg').append('<a class="list-group-item list-group-item-action"> <input type="checkbox" name="reciever_id[]" class="float-right clearfix"  value="'+ this.user_id +'" ></input>'+ this.email+'</a>');
                     });
                 }else{
                     $('#Roleusercateg').html('<a href="#" class="list-group-item list-group-item-action">EMPTY</a>');
                 }
             }

         });
     }else{
     }
 });

 $('#CreateMessageAdmin').submit(function(e){

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
             title: 'Sending Data'
           }).then((result) => {
                   if (result.dismiss === Swal.DismissReason.timer) {
                       window.location.href='<?= current_url(); ?>';
                   }
               });

 });




   $( function() {
     function split( val ) {
       return val.split( /,\s*/ );
     }
     function extractLast( term ) {
       return split( term ).pop();
     }
       // $( "#sendto" ).on( "keydown", function( event ) {
       //
       //   // if ( event.keyCode === $.ui.keyCode.TAB &&
       //   //     $( this ).autocomplete( "instance" ).menu.active ) {
       //   //   event.preventDefault();
       //   // }
       // })
     $( "#sendto" ).autocomplete({

         minLength: 0,
         source: function( request, response ) {
         var searchText = extractLast(request.term);
           $.ajax({
            url:"<?php echo base_url(); ?>message/Messages/fetchStudent",
            method:"POST",
            data:{query:searchText},
            dataType:"json",
            success:function(data)
            {
              // response( $.ui.autocomplete.filter(data, extractLast( request.term ) ) );
             // result($.map(data, function(item){
             //  return item;
             // }));
             response(data);
            }
           })


         },
         focus: function() {
           // prevent value inserted on focus
           return false;
         },
         select: function( event, ui ) {
           var terms = split( this.value );
           // remove the current input
           terms.pop();
           // add the selected item
           terms.push( ui.item.value );
           // add placeholder to get the comma-and-space at the end
           terms.push( "" );
           this.value = terms.join( "," );
           return false;
         }
       });
   } );
</script>
