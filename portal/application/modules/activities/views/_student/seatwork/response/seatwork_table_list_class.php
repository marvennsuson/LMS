            <table class="table table-striped table-hover table-head-fixed text-nowrap">
                <?php if($classes_by_class):?>
                    <thead>
                        <tr>
                            <th>Teacher</th>
                            <th>Title</th>
                            <th>Deadline</th>
                            <th>Total Points</th>
                            <th>Student Score</th>
                            <th>Submitted On</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($classes_by_class as $cl):?>
                            <tr>
                                <td><?=$cl['name'];?></td>
                                <td><?=$cl['seatwork_title'];?></td>
                                <td><?=date('M d, Y', strtotime($cl['deadline']));?></td>
                                <td><?=$cl['score'];?></td>
                                <td>value here after submit</td>
                                <td>value here after submit</td>
                                <td>
                                    <?php if($cl['status'] == '0'):?>
                                        <span class="badge badge-success">Done</span>
                                    <?php else:?>
                                        <a href="" id="btn_done<?php echo $cl['seatwork_id']?>"><button type="button" class="btn btn-info btn-sm" data-toggle="modal"><i style="font-size:14px;color:white;" class="fa fa-eye"></i> Open</button></a>
                                    <?php endif;?>
                                </td>
                            </tr>

                            <script>
                                $(document).ready(function(){
                                    $('#btn_done<?php echo $cl['seatwork_id']?>').on('click', function(){
                                        $('.overlay').css('visibility', 'visible');
                                        $.ajax({
                                            url: "<?=site_url('activities/open_seatwork')?>",
                                            data:{ seatwork_id : '<?=$cl['seatwork_id'];?>' },
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
