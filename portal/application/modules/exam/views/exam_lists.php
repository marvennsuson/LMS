<?php if($exam_lists):?>
    <table class="table table-sm">
        <thead>
        <tr>
            <th>Type</th>
            <th>Test Title</th>
            <th>Date</th>
            <th>Total Points</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($exam_lists as $ele):?>
                <tr>
                    <td><?= $ele['type']?></td>
                    <td><?= $ele['exam_title']?></td>
                    <td><?= $ele['expiration_date']?></td>
                    <td><?= $ele['total_points']?></td>
                    <td>
                        <!-- <a href="<?=base_url('exam/student_browse_exam/'.$ele['joined_header_body_id'])?>" id="btn_take_exam<?php echo $ele['joined_header_body_id']?>" onclick="return !window.open(this.href, 'NVAC Online Quiz', 'width=1000,height=800')" target="_blank"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Take Test</button></a> -->
                        
                        <?php if($ele['type'] == 'quiz'):?>
                            <?php for($i=1; $i<=15; $i++):?>
                                <?php if($test_status['qz'.$i] != NULL && 'qz'.$i == $ele['exam_title']):?>
                                    <span class="badge badge-info">DONE</span>
                                    <?php break;?>
                                <?php else:?>
                                    <?php if($test_status['qz'.$i] == NULL):?>
                                        <a id="btn_take_test<?php echo $ele['joined_header_body_id']?>"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Take Test</button></a>
                                        <?php break;?>
                                    <?php endif;?>
                                <?php endif;?>
                            <?php endfor;?>
                        <?php endif;?>

                        <?php if($ele['type'] == 'exam'):?>
                            <?php for($i=1; $i<=10; $i++):?>
                                <?php if($test_status['exm'.$i] != NULL && 'exm'.$i == $ele['exam_title']):?>
                                    <span class="badge badge-info">DONE</span>
                                    <?php break;?>
                                <?php else:?>
                                    <?php if($test_status['exm'.$i] == NULL):?>
                                        <a id="btn_take_test<?php echo $ele['joined_header_body_id']?>"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Take Test</button></a>
                                        <?php break;?>
                                    <?php endif;?>
                                <?php endif;?>
                            <?php endfor;?>
                        <?php endif;?>

                        <?php if($ele['type'] == 'final exam'):?>
                            <?php for($i=1; $i<=5; $i++):?>
                                <?php if($test_status['fexm'.$i] != NULL && 'fexm'.$i == $ele['exam_title']):?>
                                    <span class="badge badge-info">DONE</span>
                                    <?php break;?>
                                <?php else:?>
                                    <?php if($test_status['fexm'.$i] == NULL):?>
                                        <a id="btn_take_test<?php echo $ele['joined_header_body_id']?>"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Take Test</button></a>
                                        <?php break;?>
                                    <?php endif;?>
                                <?php endif;?>
                            <?php endfor;?>
                        <?php endif;?>

                    </td>
                </tr>
                <script>
                    $('#btn_take_test<?php echo $ele['joined_header_body_id']?>').on('click', function(e){
                        e.preventDefault();
                        $('.overlay').css('visibility', 'visible');
                        Swal.fire({
                            title: '<?= $ele['instruction']?>',
                            text: 'Are you sure you want to take the test ?',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Yes, take the test!'
                        }).then((result) => {
                            if (result.value == true) {
                                window.open("<?=base_url('exam/student_browse_exam/'.$ele['joined_header_body_id'])?>", 'NVAC Online Quiz', 'width=1000,height=800');
                            }
                            $('.overlay').css('visibility', 'hidden');
                        })
                    });
                </script>
            <?php endforeach;?>
        </tbody>
    </table>
<?php else:?>
    <div class="alert alert-warning alert-dismissible">
        <h4><i class="fa fa-exclamation-triangle"></i> Alert!</h4>
        No online test available.
    </div>
<?php endif;?>