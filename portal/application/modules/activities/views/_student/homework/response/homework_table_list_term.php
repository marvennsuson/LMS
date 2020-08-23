            <table class="table table-striped table-hover table-head-fixed text-nowrap">
                <?php if($classes_by_term):?>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Deadline</th>
                            <th>Total Points</th>
                            <!-- <th>Student Score</th>
                            <th>Submitted On</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($classes_by_term as $ct):?>
                            <tr>
                                <td><?=$ct['homework_title'];?></td>
                                <td><?=date('M d, Y', strtotime($ct['deadline']));?></td>
                                <td><?=$ct['score'];?></td>
                                <!-- <td>value here after submit</td>
                                <td>value here after submit</td> -->
                                <td>
                                    <?php if($ct['status'] == '0'):?>
                                        <span class="badge badge-success">Done</span>
                                    <?php else:?>
                                        <a href="" id="btn_done<?php echo $ct['homework_id']?>"><button type="button" class="btn btn-info btn-sm" data-toggle="modal"><i style="font-size: 14px; color:white;" class="fa fa-eye"></i> Open</button></a>
                                    <?php endif;?>
                                </td>
                            </tr>

                            <script>
                                $(document).ready(function(){
                                    $('#btn_done<?php echo $ct['homework_id']?>').on('click', function(){
                                        $('.overlay').css('visibility', 'visible');
                                        $.ajax({
                                            url: "<?=site_url('activities/open_homework')?>",
                                            data:{ homework_id : '<?=$ct['homework_id'];?>' },
                                            type: "post",
                                            success: function(data)
                                            {
                                                $('.overlay').css('visibility', 'hidden');
                                                $("#modal_open_homework").modal('show');
                                                $("#modal_open_homework_inner").html(data);
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
                                No Homework Available.
                            </div>
                        </div>
                    </div>
                <?php endif;?>
            </table>


            <div class="modal fade" id="modal_open_homework">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" id="modal_open_homework_inner">

                    </div>
                </div>
            </div>
