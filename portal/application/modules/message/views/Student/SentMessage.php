<div class="container-fluid">
<small class="h4 p-5">My Sent Message</small>
<div class="float-right clearfix">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#SentItem">
Manage Remove Sent Items
</button></div>
<hr>
<div class="row">
<div class="col-5 col-sm-3">
<div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
<a class="nav-link active" id="vert-tabs-sent-tab" data-toggle="pill" href="#vert-tabs-sent" role="tab" aria-controls="vert-tabs-sent" aria-selected="true">Message Sent<span class="badge bg-warning float-right"><?= $CountSentMessage ?></span></a>
<a class="nav-link" id="vert-tabs-deletedsent-tab" data-toggle="pill" href="#vert-tabs-deletedsent" role="tab" aria-controls="vert-tabs-deletedsent" aria-selected="false">Removed Message<span class="badge bg-danger float-right"><?= $CountSentRemove ?></span></a>

</div>

</div>
<div class="col-7 col-sm-9">
<div class="tab-content" id="vert-tabs-tabContent">
<div class="tab-pane text-left fade show active" id="vert-tabs-sent" role="tabpanel" aria-labelledby="vert-tabs-sent-tab">
<div class="">
<?php if($MessageSentList->num_rows() > 0): ?>
<?php foreach($MessageSentList->result() as $MessageSentList_row): ?>
<div class="card">
<div class="card-header bg-dark d-flex align-items-center">
<h3 class="card-title"><?= $MessageSentList_row->title ?></h3>
<div class=" ml-auto">
<strong><?=  date('M d, Y : h:i  ', strtotime($MessageSentList_row->created_at)); ?></strong>
</div>
</div>
<div class="card-body">
<p>
<?= $MessageSentList_row->description ?>
</p>
</div>
<div class="card-footer d-flex align-items-center">
<strong>   <?= $MessageSentList_row->email ?> </strong>
<div class=" ml-auto">
<!-- <button type="submit" class="btn btn-success" name="button"> <i style="font-size:14px" class="far fa-paper-plane"></i>&nbsp;&nbsp;Reply now</button> -->
</div>
</div>
</div>
<?php endforeach; ?>
<?php
else:
echo "<center> <strong> No List of Data </strong> </center>";
endif; ?>
</div>
</div>
<div class="tab-pane fade" id="vert-tabs-deletedsent" role="tabpanel" aria-labelledby="vert-tabs-deletedsent-tab">
<div class="">
<?php if($MessageSentRemoveList->num_rows() > 0): ?>
<?php foreach($MessageSentRemoveList->result() as $MessageSentRemoveList_row): ?>
<div class="card">
<div class="card-header bg-danger d-flex align-items-center">
<h3 class="card-title"><?= $MessageSentRemoveList_row->title ?></h3>
<div class=" ml-auto">
<strong><?=  date('M d, Y : h:i  ', strtotime($MessageSentRemoveList_row->created_at)); ?></strong>
</div>
</div>
<div class="card-body">
<p>
<?= $MessageSentRemoveList_row->description ?>
</p>
</div>
<div class="card-footer d-flex align-items-center">
<strong>   <?= $MessageSentRemoveList_row->email ?> </strong>
<div class=" ml-auto">
<a  href="<?= site_url('message/Messages/PermanDeleteMessageSent/').$MessageSentRemoveList_row->message_id;?>" class="btn btn-danger btn-flat" ><i style=" color: #fff ; font-size:14px"  class="far fa-trash-alt"></i>&nbsp;&nbsp;Permanently Deleted</a>
</div>
</div>
</div>
<?php endforeach; ?>
<?php
else:
echo "<center> <strong> No List of Data </strong> </center>";

endif; ?>
</div>
</div>

</div>
</div>
</div>

</div>





<!-- The Modal -->
<div class="modal fade" id="SentItem">
<div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable modal-xl">
<div class="modal-content">

<div class="modal-header">
<h4 class="modal-title">Manage Sent Remove Items</h4>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<div class="modal-body">
<table class="table table-borderless">
<thead>
<tr>
<th ><input type="checkbox" id="checkAllSent" >All</input></th>
<th>
<div class=" float-right clearfix ml-auto">
<a id="del_btn" class="del_btn btn btn-danger btn-flat text-white" ><i style=" color: #fff ; font-size:14px"  class="far fa-trash-alt"></i>&nbsp;&nbsp;Delete now</a>
</div>
</th>
</tr>
</thead>
<tbody>
<?php if($MessageSentList->num_rows() > 0): ?>
<?php foreach($MessageSentList->result() as $MessageSentList_row): ?>
<tr id="per_post">
<td style="text-align:center;" class="text-center"> <input type="checkbox" class="bulk_del" id="bulk_del" name="bulk_delete[]" value="<?= $MessageSentList_row->message_id ?>"> </td>
<td>
<div class="">

<div class="card">
<div class="card-header bg-dark d-flex align-items-center">
<h3 class="card-title"><?= $MessageSentList_row->title ?></h3>
<div class=" ml-auto">
<strong><?= date('M d, Y : h:i  ', strtotime($MessageSentList_row->created_at)); ?></strong>
</div>
</div>
<div class="card-body">
<p>
<?= $MessageSentList_row->description ?>
</p>
</div>
<div class="card-footer d-flex align-items-center">
<strong>   <?= $MessageSentList_row->email ?> </strong>

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
<script type="text/javascript">
  $(document).ready(function(){
    $('#checkAllSent').click(function () {
     $(':checkbox.bulk_del').prop('checked', this.checked);
  });

  });

  $('#del_btn').click(function(){


  var checkbox = $('.bulk_del:checked');

  if(checkbox.length > 0 ){

  var checkbox_value = [];
  $(checkbox).each(function(){
  checkbox_value.push($(this).val());
  });


  $.ajax({
    url:"<?= site_url('message/Messages/StudentDeleteSent'); ?>",
    method:"POST",
    data:{checkbox_value:checkbox_value},
    success:function(data){

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
  }else{
    alert();
  }
    },


  });


  }else{
    alert('Please Select Atleast on record to delete');
  }


  });
</script>
