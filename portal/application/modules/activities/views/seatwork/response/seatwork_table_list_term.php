            <table class="table table-striped table-hover table-head-fixed text-nowrap">
                <?php if($classes_by_term):?>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Total Points</th>
                            <th>Student Score</th>
                            <th>Submitted On</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($classes_by_term as $ct):?>
                            <tr>
                                <td><?=$ct['seatwork_title'];?></td>
                                <td><?=$ct['score'];?></td>
                                <td><?=$ct['student_score'];?></td>
                                <td><?=date('M d, Y : h:i A ', strtotime($ct['created_at'])); ?></td>
                                <td>
                                    <?php if($ct['student_score'] != '0'):?>
                                        <span class="badge badge-success">Checked</span>
                                    <?php else:?>
                                        <a href="" id="btn_done<?php echo $ct['sw_reply_id']?>"><button type="button" class="btn btn-warning btn-sm" data-toggle="modal"><i class="fa fa-check"></i> Check</button></a>
                                    <?php endif;?>
                                </td>
                            </tr>

                            <script>
                                $(document).ready(function(){
                                    $('#btn_done<?php echo $ct['sw_reply_id']?>').on('click', function(){
                                        $('.overlay').css('visibility', 'visible');
                                        $.ajax({
                                            url: "<?=site_url('activities/open_seatwork_teacher')?>",
                                            data:{ sw_reply_id : '<?=$ct['sw_reply_id'];?>' },
                                            type: "post",
                                            success: function(data)
                                            {
                                                $('.overlay').css('visibility', 'hidden');
                                                $("#modal_open_seatwork").modal('show');
                                                $("#modal_open_seatwork_inner").html(data);
                                            }
                                        })
                                        return false;
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
                                No Seatwork Available.
                            </div>
                        </div>
                    </div>
                <?php endif;?>
            </table>


            <div class="modal fade" id="modal_open_seatwork">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" id="modal_open_seatwork_inner">

                    </div>
                </div>
            </div>
