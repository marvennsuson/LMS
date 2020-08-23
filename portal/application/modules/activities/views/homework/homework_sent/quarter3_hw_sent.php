                    <div class="card-body table-responsive p-0" id="div_q3_hw_sent">

                      <div class="row mb-3">
                          <div class="ml-auto">
                            <div class="form-check-inline mr-5">
                              <label class="form-check-label">
                            By Subject
                            <select id="bySubcode3" class="form-control-sm"  name="bySubcode3">
                              <option selected disabled> Select By Subject</option>

                                    <?php foreach($classes as $BySubjectCode_row): ?>
                                      <option value="<?= $BySubjectCode_row["subjectcode"] ?>"><?= $BySubjectCode_row["subject_name"] ?></option>
                                    <?php endforeach; ?>

                            </select>
                            </label>

                      </div>
                        <input id="quarter3" type="hidden" name="quarter3" value="1st quarter">
                          </div>
                      </div>

                        <table class="table table-striped table-hover table-head-fixed text-nowrap" id="table_hw_sent_q3">
                            <?php if($homeworklists_q3):?>
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Subject Name</th>
                                        <th>Score</th>
                                          <th>Deadline</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody  id="table_body3">
                                  <div id="overlay3" class="overlay" style="visibility: hidden;">
                                      <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                  </div>
                                    <?php foreach($homeworklists_q3 as $slq3):?>
                                        <tr>
                                            <td><?=$slq3['homework_title'];?></td>
                                            <td><?=$slq3['subject_name'];?></td>
                                            <td><?=$slq3['score'];?></td>
                                            <td><?=date('M d, Y', strtotime($slq3['deadline']));?></td>
                                            <td>
                                                <a href="" id="btn_edit<?php echo $slq3['homework_id']?>"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#admission_view" title="Edit"><i class="fa fa-edit"></i></button></a>
                                                <a href="" id="btn_delete<?php echo $slq3['homework_id']?>"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#admission_delete" title="Delete"><i class="fa fa-trash"></i></button></a>
                                            </td>
                                        </tr>

                                        <script>

                                            $(document).ready(function(){
                                                $('#btn_edit<?php echo $slq3['homework_id']?>').on('click', function(){
                                                    $('#overlaySentHW').css('visibility', 'visible');
                                                    $.ajax({
                                                        url: "<?=site_url('activities/edit_homework')?>",
                                                        data:{ homework_id : '<?=$slq3['homework_id'];?>' },
                                                        type: "post",
                                                        success: function(data)
                                                        {
                                                            $('#overlaySentHW').css('visibility', 'hidden');
                                                            $("#modal_homework_q3").modal('show');
                                                            $("#modal_homework_q3_inner").html(data);
                                                        }
                                                    })
                                                    return false;
                                                });
                                            })

                                            $(document).ready(function(){
                                                $('#btn_delete<?php echo $slq3['homework_id']?>').on('click', function(e){
                                                    // $('#overlaySentHW').css('visibility', 'visible');
                                                    e.preventDefault();
                                                    Swal.fire({
                                                        title: 'Are you sure you want to delete <br> <?= strtoupper($slq3['homework_title'])?> ?',
                                                        text: "You won't be able to revert this!",
                                                        type: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#d33',
                                                        cancelButtonColor: '#3085d6',
                                                        confirmButtonText: 'Yes, delete it!'
                                                    }).then((result) => {
                                                        if (result.value == true) {
                                                            $.ajax({
                                                                url: "<?=site_url('activities/delete_homework')?>",
                                                                data:{ homework_id : '<?=$slq3['homework_id'];?>' },
                                                                type: "post",
                                                                success: function(data)
                                                                {
                                                                    Swal.fire(
                                                                        'Deleted!',
                                                                        'Homework <?= strtoupper($slq3['homework_title'])?> has been deleted.',
                                                                        'info'
                                                                    ).then((result) => {
                                                                        location.reload();
                                                                    })
                                                                }
                                                            })
                                                        }
                                                        $('#overlaySentHW').css('visibility', 'hidden');
                                                    })
                                                });
                                            })
                                        </script>
                                    <?php endforeach;?>
                                </tbody>

                            <?php else:?>
                                <div class="box-body">
                                    <div class="card-body">
                                        <div class="alert alert-warning alert-dismissible">
                                            <h4><i class="fa fa-exclamation-triangle"></i> Alert!</h4>
                                            No homework Available.
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>
                        </table>
                    </div>

                    <div class="modal fade" id="modal_homework_q3">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content" id="modal_homework_q3_inner">

                            </div>
                        </div>
                    </div>

                    <script>
                        $('#bySubcode3').change(function(){
                            $('#overlaySentHW').css('visibility', 'visible');
                            $("#table_hw_sent_q3").empty();
                            $.ajax({
                                url: "<?=site_url('activities/HomeWorkByQuarter')?>",
                                data: {Subcode : $('#bySubcode3').val(), quarter : '3rd quarter' },
                                type: "post",
                                success: function(data){
                                    if(data.response == "false") {

                                    } else {
                                        $('#overlaySentHW').css('visibility', 'hidden');
                                        // $("#table_hw_sent_q3").css('display', 'block');
                                        $("#div_q3_hw_sent").html(data);
                                    }
                                },
                            })
                            return false;
                        })
                    </script>

                    <!-- <script type="text/javascript">

                                                              $(document).ready(function(){
                                                                  $('#table_hw_sent_q3').DataTable();
                                                                });
                                                              $('#bySubcode3').on('change',function(){
                                                                  var Subcode = $('#bySubcode3').val();
                                                                  var quarter = $('#quarter3').innnerHTML = '3rd quarter';

                                                                  $('#overlay3').css('visibility', 'visible');
                                                                  if(Subcode && quarter){
                                                                      $.ajax({
                                                                          type:'POST',
                                                                          url:'<?php echo base_url('activities/Activities/HomeWorkByQuarter'); ?>',
                                                                         data: {Subcode : Subcode, quarter: quarter},
                                                                          success:function(data){
                                                                              if(data.response == "false"){
                                                                                Swal.fire({
                                                                                    html: data.message,
                                                                                    type: 'error',
                                                                                })
                                                                              }else{
                                                                                $('#overlay3').css('visibility', 'hidden');
                                                                                    $('#table_body3').html('');
                                                                                var dataObj = jQuery.parseJSON(data);
                                                                                if(dataObj){
                                                                                    $(dataObj).each(function(){
  $('#table_body3').append('<tr><td>'+ this.homework_title +'</td><td>'+ this.subject_name +'</td><td>'+ this.score +'</td><td>'+ this.deadline+'</td><td><a href="" id="btn_edit'+this.homework_id+'"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#admission_view" title="Edit"><i class="fa fa-edit"></i></button></a>&nbsp;<a href="" id="btn_delete'+this.homework_id+'"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#admission_delete" title="Delete"><i class="fa fa-trash"></i></button></a></td></tr>');
                                                                                });
                                                                                }else{
                                                                              $('#table_body3').html('<center>No data</center>');
                                                                                }
                                                                              }

                                                                            },

                                                                      });
                                                                  }else{
                                                                    alert('noitem');
                                                                  }
                                                              });
                    </script> -->
