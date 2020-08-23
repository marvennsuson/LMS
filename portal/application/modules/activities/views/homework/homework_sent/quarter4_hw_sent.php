                    <div class="card-body table-responsive p-0" id="div_q4_hw_sent">
                      <div class="row mb-3">
                          <div class="ml-auto">
                            <div class="form-check-inline mr-5">
                              <label class="form-check-label">
                            By Subject
                            <select id="bySubcode4" class="form-control-sm"  name="bySubcode4">
                              <option selected disabled> Select By Subject</option>

                                    <?php foreach($classes as $BySubjectCode_row): ?>
                                      <option value="<?= $BySubjectCode_row["subjectcode"] ?>"><?= $BySubjectCode_row["subject_name"] ?></option>
                                    <?php endforeach; ?>

                            </select>
                            </label>

                      </div>
                        <input id="quarter4" type="hidden" name="quarter4" value="1st quarter">
                          </div>
                      </div>

                        <table class="table table-striped table-hover table-head-fixed text-nowrap" id="table_hw_sent_q4">
                            <?php if($homeworklists_q4):?>
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Subject Name</th>
                                        <th>Score</th>
                                        <th>Deadline</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody  id="table_body4">
                                  <div id="overlay4" class="overlay" style="visibility: hidden;">
                                      <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                  </div>
                                    <?php foreach($homeworklists_q4 as $slq4):?>
                                        <tr>
                                            <td><?=$slq4['homework_title'];?></td>
                                              <td><?=$slq4['subject_name'];?></td>
                                            <td><?=$slq4['score'];?></td>
                                            <td><?=date('M d, Y', strtotime($slq4['deadline']));?></td>
                                            <td>
                                                <a href="" id="btn_edit<?php echo $slq4['homework_id']?>"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#admission_view" title="Edit"><i class="fa fa-edit"></i></button></a>
                                                <a href="" id="btn_delete<?php echo $slq4['homework_id']?>"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#admission_delete" title="Delete"><i class="fa fa-trash"></i></button></a>
                                            </td>
                                        </tr>

                                        <script>
                                            $(document).ready(function(){
                                                $('#btn_edit<?php echo $slq4['homework_id']?>').on('click', function(){
                                                    $('#overlaySentHW').css('visibility', 'visible');
                                                    $.ajax({
                                                        url: "<?=site_url('activities/edit_homework')?>",
                                                        data:{ homework_id : '<?=$slq4['homework_id'];?>' },
                                                        type: "post",
                                                        success: function(data)
                                                        {
                                                            $('#overlaySentHW').css('visibility', 'hidden');
                                                            $("#modal_homework_q4").modal('show');
                                                            $("#modal_homework_q4_inner").html(data);
                                                        }
                                                    })
                                                    return false;
                                                });
                                            })

                                            $(document).ready(function(){
                                                $('#btn_delete<?php echo $slq4['homework_id']?>').on('click', function(e){
                                                    // $('#overlaySentHW').css('visibility', 'visible');
                                                    e.preventDefault();
                                                    Swal.fire({
                                                        title: 'Are you sure you want to delete <br> <?= strtoupper($slq4['homework_title'])?> ?',
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
                                                                data:{ homework_id : '<?=$slq4['homework_id'];?>' },
                                                                type: "post",
                                                                success: function(data)
                                                                {
                                                                    Swal.fire(
                                                                        'Deleted!',
                                                                        'Homework <?= strtoupper($slq4['homework_title'])?> has been deleted.',
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

                    <div class="modal fade" id="modal_homework_q4">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content" id="modal_homework_q4_inner">

                            </div>
                        </div>
                    </div>

                    <script>
                        $('#bySubcode4').change(function(){
                            $('#overlaySentHW').css('visibility', 'visible');
                            $("#table_hw_sent_q4").empty();
                            $.ajax({
                                url: "<?=site_url('activities/HomeWorkByQuarter')?>",
                                data: {Subcode : $('#bySubcode4').val(), quarter : '4th quarter' },
                                type: "post",
                                success: function(data){
                                    if(data.response == "false") {

                                    } else {
                                        $('#overlaySentHW').css('visibility', 'hidden');
                                        // $("#table_hw_sent_q4").css('display', 'block');
                                        $("#div_q4_hw_sent").html(data);
                                    }
                                },
                            })
                            return false;
                        })
                    </script>


                    <!-- <script type="text/javascript">

                                                              $(document).ready(function(){
                                                                  $('#table_hw_sent_q4').DataTable();
                                                                });
                                                              $('#bySubcode4').on('change',function(){
                                                                  var Subcode = $('#bySubcode4').val();
                                                                  var quarter = $('#quarter4').innnerHTML = '4th quarter';

                                                                  $('#overlay4').css('visibility', 'visible');
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
                                                                                $('#overlay4').css('visibility', 'hidden');
                                                                                    $('#table_body4').html('');
                                                                                var dataObj = jQuery.parseJSON(data);
                                                                                if(dataObj){
                                                                                    $(dataObj).each(function(){
  $('#table_body4').append('<tr><td>'+ this.homework_title +'</td><td>'+ this.subject_name +'</td><td>'+ this.score +'</td><td>'+ this.deadline+'</td><td><a href="" id="btn_edit'+this.homework_id+'"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#admission_view" title="Edit"><i class="fa fa-edit"></i></button></a>&nbsp;<a href="" id="btn_delete'+this.homework_id+'"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#admission_delete" title="Delete"><i class="fa fa-trash"></i></button></a></td></tr>');
                                                                                });
                                                                                }else{
                                                                              $('#table_body4').html('<center>No data</center>');
                                                                                }
                                                                              }

                                                                            },

                                                                      });
                                                                  }else{
                                                                    alert('noitem');
                                                                  }
                                                              });
                    </script> -->
