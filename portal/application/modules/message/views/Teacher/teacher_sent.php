
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

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-envelope"></i> Sent
                        <span class="badge bg-warning float-right"><?= $countmessagesent ?></span>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?= site_url('message/Messages/SentRemoveMessageview'); ?>" class="nav-link">
                <i class="far fa-trash-alt"></i> Sent Remove
              <span class="badge bg-danger float-right"><?= $countRemoveSent ?></span>
              </a>
            </li>
          </ul>
        </div>
        <!-- /.card-body -->
      </div>

    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">Sent Message</h3>

          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <div class="mailbox-controls">
            <!-- Check all button -->
              <input type="checkbox" class="mr-3" id="checkAllSent" >All</input>
            <div class="btn-group float-right clearfix mb-4">
        <button id="del_button" type="button" class="btn btn-default btn-sm"><i class="far fa-trash-alt"></i></button>
            </div>

          </div>
          <div class="table-responsive mailbox-messages">
            <table id="senttable" class="table table-hover table-striped">
              <thead>
                <tr>
                  <th></th>
                          <th></th>
                                  <th></th>
                                          <th></th>
                </tr>
              </thead>
              <tbody>
                <?php if($messagesentlist->num_rows() > 0): ?>
                <?php foreach($messagesentlist->result() as $messagesentlist_row): ?>
              <tr>
                <td>
                    <input type="checkbox" class="bulk_del" id="bulk_del" name="bulk_delete[]" value="<?= $messagesentlist_row->message_id ?>">
                </td>
                <!-- <td class="mailbox-star"><a href="#"><i class="fas fa-star text-warning"></i></a></td> -->
                <td class="mailbox-name"> <?= $messagesentlist_row->email ?></td>
                <td class="mailbox-subject"><?= $messagesentlist_row->title ?>
                </td>
                <!-- <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td> -->
                <td class="mailbox-date"><?=date('M d, Y : h:i  ', strtotime($messagesentlist_row->created_at)); ?></td>
              </tr>
            <?php endforeach; ?>
            <?php endif; ?>
              </tbody>
            </table>
            <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->
        </div>

      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

            <script type="text/javascript" >

            $(document).ready(function(){
              $('#senttable').DataTable();

               $('#checkAllSent').click(function () {
                $(':checkbox.bulk_del').prop('checked', this.checked);
             });

            $('#del_button').click(function(){


            var checkbox = $('.bulk_del:checked');

            if(checkbox.length > 0 ){

            var checkbox_value = [];
            $(checkbox).each(function(){
            checkbox_value.push($(this).val());
            });


            $.ajax({
              url:"<?= site_url('message/Messages/RemoveTeacher_Message'); ?>",
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
