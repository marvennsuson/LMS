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
                            <th>Quiz 1</th>
                            <th>Quiz 2</th>
                            <th>Quiz 3</th>
                            <th>Quiz 4</th>
                            <th>Quiz 5</th>
                            <th>Quiz 6</th>
                            <th>Quiz 7</th>
                            <th>Quiz 8</th>
                            <th>Quiz 9</th>
                            <th>Quiz 10</th>
                            <th>Quiz 11</th>
                            <th>Quiz 12</th>
                            <th>Quiz 13</th>
                            <th>Quiz 14</th>
                            <th>Quiz 15</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($students as $stud):?>
                            <tr>
                                <td><?=$stud['qz1'];?></td>
                                <td><?=$stud['qz2'];?></td>
                                <td><?=$stud['qz3'];?></td>
                                <td><?=$stud['qz4'];?></td>
                                <td><?=$stud['qz5'];?></td>
                                <td><?=$stud['qz6'];?></td>
                                <td><?=$stud['qz7'];?></td>
                                <td><?=$stud['qz8'];?></td>
                                <td><?=$stud['qz9'];?></td>
                                <td><?=$stud['qz10'];?></td>
                                <td><?=$stud['qz11'];?></td>
                                <td><?=$stud['qz12'];?></td>
                                <td><?=$stud['qz13'];?></td>
                                <td><?=$stud['qz14'];?></td>
                                <td><?=$stud['qz15'];?></td>
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
                                    <?php echo array_sum(array($stud['qz1'], $stud['qz2'], $stud['qz3'], $stud['qz4'], $stud['qz5'], $stud['qz6'], $stud['qz7'], $stud['qz8'], $stud['qz9'], $stud['qz9'], $stud['qz11'], $stud['qz12'], $stud['qz13'], $stud['qz14'], $stud['qz15'], ))?>
                                </span>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" class="custom-control-input" id="switch_publish_quiz1" <?php echo $stud['is_publish'] == '1' ? 'checked' : '';?>>
                                    <label class="custom-control-label" for="switch_publish_quiz1" id="switch_publish_label_quiz1"><?php echo $stud['is_publish'] == '1' ? 'Published' : 'Unpublished';?></label>
                                    </div>
                                </div>
                            </td>
                            <script>
                                var switchStatus_quiz = false;
                                $("#switch_publish_quiz1").on('change', function() {
                                    if ($(this).is(':checked')) {
                                        switchStatus_quiz = 1;
                                        $.ajax({
                                            url: "<?=site_url('activities/toggle_publish_quiz')?>",
                                            data: {is_published : switchStatus_quiz, quiz_result_id : <?php echo $stud['quiz_result_id']?>},
                                            dataType: 'json',
                                            type: "post",
                                            success: function(data){
                                                if(data.response == "false") {

                                                } else {
                                                    $("#switch_publish_label_quiz1").html('Published');
                                                    Swal.fire({
                                                        title: 'Quiz is Published',
                                                        type: 'success',
                                                        confirmButtonText: 'Ok'
                                                    })
                                                }
                                            },
                                        })
                                    } else {
                                        switchStatus_quiz = 0;
                                        $.ajax({
                                            url: "<?=site_url('activities/toggle_publish_quiz')?>",
                                            data: {is_published : switchStatus_quiz, quiz_result_id : <?php echo $stud['quiz_result_id']?>},
                                            dataType: 'json',
                                            type: "post",
                                            success: function(data){
                                                if(data.response == "false") {

                                                } else {
                                                    $("#switch_publish_label_quiz1").html('Unpublished');
                                                    Swal.fire({
                                                        title: 'Quiz is Unpublished',
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