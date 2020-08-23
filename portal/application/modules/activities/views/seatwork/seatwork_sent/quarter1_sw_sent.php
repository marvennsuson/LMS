                    <div class="card-body table-responsive p-0" id="div_q1_sw_sent">

                        <div class="row mb-3">
                            <div class="ml-auto">
                                <div class="form-check-inline mr-5">
                                    <label class="form-check-label">By Subject
                                        <select id="bySubcode1" class="form-control-sm"  name="bySubcode1">
                                            <option selected disabled> Select By Subject</option>

                                                <?php foreach($BySubjectCode as $BySubjectCode_row): ?>
                                                    <option value="<?= $BySubjectCode_row["subjectcode"] ?>"><?= $BySubjectCode_row["subject_name"] ?></option>
                                                <?php endforeach; ?>

                                        </select>
                                    </label>

                                </div>
                                <input id="quarter1" type="hidden" name="quarter1" value="1st quarter">
                            </div>
                        </div>


                        <table class="table table-striped table-hover table-head-fixed text-nowrap" id="table_sw_sent_q1">

                            <?php if($seatworklists_q1):?>
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Subject Name</th>
                                        <th>Score</th>
                                        <th>Deadline</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="table_body1">
                                  <div id="overlaySent1" class="overlaySent" style="visibility: hidden;">
                                      <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                  </div>
                                    <?php foreach($seatworklists_q1 as $slq1):?>
                                        <tr>
                                            <td><?=$slq1['seatwork_title'];?></td>
                                            <td><?=$slq1['subject_name'];?></td>
                                            <td><?=$slq1['score'];?></td>
                                            <td><?=date('M d, Y', strtotime($slq1['deadline']));?></td>
                                            <td>
                                                <a href="" id="btn_edit<?php echo $slq1['seatwork_id']?>"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#admission_view" title="Edit"><i class="fa fa-edit"></i> </button></a>
                                                <a href="" id="btn_delete<?php echo $slq1['seatwork_id']?>"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#admission_delete" title="Delete"><i class="fa fa-trash"></i></button></a>
                                            </td>
                                        </tr>

                                        <script>

                                            $(document).ready(function(){
                                                $('#btn_edit<?php echo $slq1['seatwork_id']?>').on('click', function(){
                                                    $('#overlaySentSW').css('visibility', 'visible');
                                                    $.ajax({
                                                        url: "<?=site_url('activities/edit_seatwork')?>",
                                                        data:{ seatwork_id : '<?=$slq1['seatwork_id'];?>' },
                                                        type: "post",
                                                        success: function(data)
                                                        {
                                                            $('#overlaySentSW').css('visibility', 'hidden');
                                                            $("#modal_seatwork_q1").modal('show');
                                                            $("#modal_seatwork_q1_inner").html(data);
                                                        }
                                                    })
                                                    return false;
                                                });
                                            })

                                            $(document).ready(function(){
                                                // $('#admission_table').DataTable();
                                                   // $('#table_id').DataTable();
                                                $('#btn_delete<?php echo $slq1['seatwork_id']?>').on('click', function(e){
                                                    // $('#overlaySentSW').css('visibility', 'visible');
                                                    e.preventDefault();
                                                    Swal.fire({
                                                        title: 'Are you sure you want to delete <br> <?= strtoupper($slq1['seatwork_title'])?> ?',
                                                        text: "You won't be able to revert this!",
                                                        type: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#d33',
                                                        cancelButtonColor: '#3085d6',
                                                        confirmButtonText: 'Yes, delete it!'
                                                    }).then((result) => {
                                                        if (result.value == true) {
                                                            $.ajax({
                                                                url: "<?=site_url('activities/delete_seatwork')?>",
                                                                data:{ seatwork_id : '<?=$slq1['seatwork_id'];?>' },
                                                                type: "post",
                                                                success: function(data)
                                                                {
                                                                    Swal.fire(
                                                                        'Deleted!',
                                                                        'Seatwork <?= strtoupper($slq1['seatwork_title'])?> has been deleted.',
                                                                        'info'
                                                                    ).then((result) => {
                                                                        location.reload();
                                                                    })
                                                                }
                                                            })
                                                        }
                                                        $('#overlaySentSW').css('visibility', 'hidden');
                                                    })
                                                });
                                            });
                                        </script>
                                      <?php endforeach;?>
                                  </tbody>

                            <?php else:?>
                                <div class="box-body">
                                    <div class="card-body">
                                        <div class="alert alert-warning alert-dismissible">
                                            <h4><i class="fa fa-exclamation-triangle"></i> Alert!</h4>
                                            No seatwork Available.
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>
                        </table>
                    </div>

                    <div class="modal fade" id="modal_seatwork_q1">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content" id="modal_seatwork_q1_inner">

                            </div>
                        </div>
                    </div>

                    <script>
                        $('#bySubcode1').change(function(){
                            $('#overlaySentSW').css('visibility', 'visible');
                            $("#table_sw_sent_q1").empty();
                            $.ajax({
                                url: "<?=site_url('activities/SeatworkByquarter')?>",
                                data: {Subcode : $('#bySubcode1').val(), quarter : '1st quarter' },
                                type: "post",
                                success: function(data){
                                    if(data.response == "false") {

                                    } else {
                                        $('#overlaySentSW').css('visibility', 'hidden');
                                        // $("#table_sw_sent_q1").css('display', 'block');
                                        $("#div_q1_sw_sent").html(data);
                                    }
                                },
                            })
                            return false;
                        })
                    </script>




                    <!-- <script type="text/javascript">
                        $(document).ready(function(){
                            $('#table_sw_sent_q1').DataTable();
                        });
                        $('#bySubcode1').on('change',function(){
                            var Subcode = $('#bySubcode1').val();
                            // var quarter = $('#quarter1').val();
                            var quarter = $('#quarter1').innnerHTML = '1st quarter';
                            $('#overlaySent').css('visibility', 'visible');
                            if(Subcode && quarter){
                                $.ajax({
                                    type:'POST',
                                    url:'<?php echo base_url('activities/Activities/SeatworkByquarter'); ?>',
                                    data: {Subcode : Subcode, quarter: quarter},
                                    success:function(data){
                                        if(data.response == "false"){
                                            Swal.fire({
                                                html: data.message,
                                                type: 'error',
                                            })
                                        } else {
                                            $('#overlaySent').css('visibility', 'hidden');
                                            $('#table_body1').html('');
                                            var dataObj = jQuery.parseJSON(data);

                                            if(dataObj){
                                                $(dataObj).each(function(){
                                                    $('#table_body1').append('<tr><td>'+ this.seatwork_title +'</td><td>'+ this.subject_name +'</td><td>'+ this.score +'</td><td>'+ this.deadline+'</td><td><a href="" id="btn_edit'+this.seatwork_id+'"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#admission_view" title="Edit"><i class="fa fa-edit"></i></button></a>&nbsp;<a href="" id="btn_delete'+this.seatwork_id+'"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#admission_delete" title="Delete"><i class="fa fa-trash"></i></button></a></td></tr>');
                                                });
                                            }else{
                                                $('#table_body1').html('<center>No data</center>');
                                            }
                                        }

                                    },

                                });
                            }else{
                                alert('noitem');
                            }
                        });
                    </script> -->
