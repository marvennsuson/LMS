
<title><?= $title;?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Message Board</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                        <li class="breadcrumb-item active">Message</li>
                        <!-- <li class="breadcrumb-item active"><a href="">Notification Board</a></li> -->
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">


<div class="row">
<div class="col-lg-12">
<div class="row ">
<div class="col-lg-12">
<div class="mb-3">
<ul class="nav nav-pills p-2" id="myTab" role="tablist">
<li class="nav-item"><a class="nav-link" id="Compose-tab" data-toggle="tab" href="#Compose" role="tab" aria-controls="Compose" aria-selected="true">Compose</a></li>
<li class="nav-item"><a class="nav-link" id="Inbox-tab" data-toggle="tab" href="#Inbox" role="tab" aria-controls="Inbox" aria-selected="false">Inbox</a></li>
<li class="nav-item"><a class="nav-link" id="sentmessage-tab" data-toggle="tab" href="#sentmessage" role="tab" aria-controls="sentmessage" aria-selected="false">Sent Message</a></li>
</ul>
</div>
<div class="tab-content mb-4 card p-4">
<div class="tab-pane fade show active" id="Compose" role="tabpanel" aria-labelledby="Compose-tab">
<?= $this->load->view('Student/ComposeMessage');?>
</div>
<div class="tab-pane fade" id="Inbox" role="tabpanel" aria-labelledby="Inbox-tab">
<?= $this->load->view('Student/InboxMessage');?>
</div>
<div class="tab-pane fade" id="sentmessage" role="tabpanel" aria-labelledby="sentmessage-tab">
<?= $this->load->view('Student/SentMessage');?>
</div>
</div>
</div>
</div>
</div>
</div>



                <!-- The Modal -->
                <div class="modal fade" id="myModal">
                  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Manage Inbox Remove Items</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                              <table class="table table-borderless">
                                    <thead>
                                      <tr>
                                          <th><input type="checkbox" id="checkAllinbox" >All</input></th>
                                          <th>     <div class=" float-right clearfix ml-auto">
                                                  <a id="del_btn1"  class="btn btn-danger btn-flat text-white" ><i style=" color: #fff ; font-size:14px"  class="far fa-trash-alt"></i>&nbsp;&nbsp;Delete now</a>
                                              </div> </th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php if($messageRecievelist->num_rows() > 0): ?>
                                      <?php foreach($messageRecievelist->result() as $messageRecievelist_row): ?>
                                      <tr id="per_post1">
                                                  <td style="text-align:center;" class="text-center"> <input type="checkbox" class="bulk_del1" id="bulk_del1" name="bulk_delete1[]" value="<?= $messageRecievelist_row->message_id ?>"> </td>
                                              <td>
                                                <div class="">
                                                          <div class="card">
                                                                <div class="card-header bg-dark d-flex align-items-center">
                                                                    <h3 class="card-title"><?= $messageRecievelist_row->title ?></h3>
                                                                    <div class=" ml-auto">
                                                                          <strong><?= $messageRecievelist_row->created_at ?></strong>
                                                                    </div>
                                                                </div>
                                                                  <div class="card-body">
                                                                  <p>
                                                                        <?= $messageRecievelist_row->description ?>
                                                                  </p>
                                                                </div>
                                                                  <div class="card-footer d-flex align-items-center">
                                                                    <strong>   <?= $messageRecievelist_row->email ?> </strong>

                                                                  </div>
                                                          </div>

                                                </div>
                                              </td>
                                      </tr>
                                    <?php endforeach; ?>
                                    <?php
                                  else:
                                      echo "<center> <strong> No List </strong> </center>";
                                  endif; ?>
                                    </tbody>
                              </table>
                      </div>

                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>

                    </div>
                  </div>
                </div>





        </div>
    </div>
</div>

<script >



$(document).ready(function(){

  $('#checkAllinbox').click(function () {
      $(':checkbox.bulk_del1').prop('checked', this.checked);
   });






$('#del_btn1').click(function(){


var checkbox = $('.bulk_del1:checked');

if(checkbox.length > 0 ){

var checkbox_value = [];
$(checkbox).each(function(){
checkbox_value.push($(this).val());
});


$.ajax({
  url:"<?= site_url('message/Messages/StudentDeleteInbox'); ?>",
  method:"POST",
  data:{checkbox_value:checkbox_value},
  success:function(data){
// $('#per_post1').fadeOut(1500);
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



  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      localStorage.setItem('activeTab', $(e.target).attr('href'));
  });

  var activeTab = localStorage.getItem('activeTab');
  if(activeTab){
      $('.nav-pills a[href="' + activeTab + '"]').tab('show');
  }
  });
</script>
