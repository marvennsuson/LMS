    <div class="row">
        <div class="col-4 col-md-4 col-lg-4 order-2 order-md-1">
            <h5><strong>Subject: </strong> <?= $classcode_info[0]['subject_name']?></h5>
        </div>
        <div class="col-4 col-md-4 col-lg-4 order-2 order-md-1">
            <h5><strong>Section: </strong> <?= $classcode_info[0]['section']?></h5>
        </div>
        <div class="col-4 col-md-4 col-lg-4 order-2 order-md-1">
            <h5><strong>Schedule: </strong> <?= $classcode_info[0]['schedule']?></h5>
        </div>
    </div>
    
    <div class="row">
        <div class="col-4 col-md-4 col-lg-4">
            <table class="table table-striped table-hover table-head-fixed text-nowrap" id="admission_table" style="overflow-x: scroll;">
                <?php if($students):?>  
                    <thead>
                        <tr>
                            <th style="padding: 24px;">Student</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($students as $stud):?>
                            <tr>
                                <td><?=strtoupper($stud['lastname']);?>, <?=strtoupper($stud['firstname']);?> <?=strtoupper($stud['middlename']);?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                <?php else:?>
                    <div class="box-body">
                        <div class="card-body">
                            <div class="alert alert-warning alert-dismissible">
                                <h4><i class="fa fa-exclamation-triangle"></i> Alert!</h4>
                                No admission Available.
                            </div>
                        </div>
                    </div>
                <?php endif;?>
            </table>
        </div>
        <div class="col-4 col-md-4 col-lg-4"  style="overflow-x: scroll;">
            <table class="table table-striped table-hover table-head-fixed" id="admission_table">
                <?php if($students):?>  
                    <thead>
                        <tr>
                            <th>Exam 1</th>
                            <th>Exam 2</th>
                            <th>Exam 3</th>
                            <th>Exam 4</th>
                            <th>Exam 5</th>
                            <th>Exam 6</th>
                            <th>Exam 7</th>
                            <th>Exam 8</th>
                            <th>Exam 9</th>
                            <th>Exam 10</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($students as $stud):?>
                            <tr>
                                <td><?=$stud['exm1'];?></td>
                                <td><?=$stud['exm2'];?></td>
                                <td><?=$stud['exm3'];?></td>
                                <td><?=$stud['exm4'];?></td>
                                <td><?=$stud['exm5'];?></td>
                                <td><?=$stud['exm6'];?></td>
                                <td><?=$stud['exm7'];?></td>
                                <td><?=$stud['exm8'];?></td>
                                <td><?=$stud['exm9'];?></td>
                                <td><?=$stud['exm10'];?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                <?php else:?>
                    <div class="box-body">
                        <div class="card-body">
                            <div class="alert alert-warning alert-dismissible">
                                <h4><i class="fa fa-exclamation-triangle"></i> Alert!</h4>
                                No admission Available.
                            </div>
                        </div>
                    </div>
                <?php endif;?>
            </table>
        </div>
        <div class="col-4 col-md-4 col-lg-4">
            <table class="table table-striped table-hover table-head-fixed text-nowrap" id="admission_table" style="overflow-x: scroll;">
                <?php if($students):?>  
                    <thead>
                        <tr>
                            <th style="padding: 24px;">Total</th>
                            <th style="padding: 24px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($students as $stud):?>
                            <td>
                                <span class="badge badge-primary ml-3">
                                    <?php echo array_sum(array($stud['exm1'], $stud['exm2'], $stud['exm3'], $stud['exm4'], $stud['exm5'], $stud['exm6'], $stud['exm7'], $stud['exm8'], $stud['exm9'], $stud['exm10'],))?>
                                </span>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" class="custom-control-input" id="switch_publish_exam3" <?php echo $stud['is_publish'] == '1' ? 'checked' : '';?>>
                                    <label class="custom-control-label" for="switch_publish_exam3" id="switch_publish_label_exam3"><?php echo $stud['is_publish'] == '1' ? 'Published' : 'Unpublished';?></label>
                                    </div>
                                </div>
                            </td>
                            <script>
                                var switchStatus_exam = false;
                                $("#switch_publish_exam3").on('change', function() {
                                    if ($(this).is(':checked')) {
                                        switchStatus_exam = 1;
                                        $.ajax({
                                            url: "<?=site_url('activities/toggle_publish_exam')?>",
                                            data: {is_published : switchStatus_exam, exam_result_id : <?php echo $stud['exam_result_id']?>},
                                            dataType: 'json',
                                            type: "post",
                                            success: function(data){
                                                if(data.response == "false") {

                                                } else {
                                                    $("#switch_publish_label_exam3").html('Published');
                                                    Swal.fire({
                                                        title: 'Exam is Published',
                                                        type: 'success',
                                                        confirmButtonText: 'Ok'
                                                    })
                                                }
                                            },
                                        })
                                    } else {
                                        switchStatus_exam = 0;
                                        $.ajax({
                                            url: "<?=site_url('activities/toggle_publish_exam')?>",
                                            data: {is_published : switchStatus_exam, exam_result_id : <?php echo $stud['exam_result_id']?>},
                                            dataType: 'json',
                                            type: "post",
                                            success: function(data){
                                                if(data.response == "false") {

                                                } else {
                                                    $("#switch_publish_label_exam3").html('Unpublished');
                                                    Swal.fire({
                                                        title: 'Exam is Unpublished',
                                                        type: 'success',
                                                        confirmButtonText: 'Ok'
                                                    })
                                                }
                                            },
                                        })
                                    }
                                });
                            </script>
                        <?php endforeach;?>
                    </tbody>
                <?php else:?>
                    <div class="box-body">
                        <div class="card-body">
                            <div class="alert alert-warning alert-dismissible">
                                <h4><i class="fa fa-exclamation-triangle"></i> Alert!</h4>
                                No admission Available.
                            </div>
                        </div>
                    </div>
                <?php endif;?>
            </table>
        </div>
    </div>