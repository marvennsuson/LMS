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
                            <th>Student</th>
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
                            <th>F-EXAM 1</th>
                            <th>F-EXAM 2</th>
                            <th>F-EXAM 3</th>
                            <th>F-EXAM 4</th>
                            <th>F-EXAM 5</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($students as $stud):?>
                            <tr>
                                <td><?=$stud['fexm1'];?></td>
                                <td><?=$stud['fexm2'];?></td>
                                <td><?=$stud['fexm3'];?></td>
                                <td><?=$stud['fexm4'];?></td>
                                <td><?=$stud['fexm5'];?></td>
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
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($students as $stud):?>
                            <td>
                                <span class="badge badge-primary ml-3">
                                    <?php echo array_sum(array($stud['fexm1'], $stud['fexm2'], $stud['fexm3'], $stud['fexm4'], $stud['fexm5'],))?>
                                </span>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" class="custom-control-input" id="switch_publish_final_exam1" <?php echo $stud['is_publish'] == '1' ? 'checked' : '';?>>
                                    <label class="custom-control-label" for="switch_publish_final_exam1" id="switch_publish_label_final_exam1"><?php echo $stud['is_publish'] == '1' ? 'Published' : 'Unpublished';?></label>
                                    </div>
                                </div>
                            </td>
                            <script>
                                var switchStatus_finalexam = false;
                                $("#switch_publish_final_exam1").on('change', function() {
                                    if ($(this).is(':checked')) {
                                        switchStatus_finalexam = 1;
                                        $.ajax({
                                            url: "<?=site_url('activities/toggle_publish_final_exam')?>",
                                            data: {is_published : switchStatus_finalexam, final_result_id : <?php echo $stud['final_result_id']?>},
                                            dataType: 'json',
                                            type: "post",
                                            success: function(data){
                                                if(data.response == "false") {

                                                } else {
                                                    $("#switch_publish_label_final_exam1").html('Published');
                                                    Swal.fire({
                                                        title: 'Final Exam is Published',
                                                        type: 'success',
                                                        confirmButtonText: 'Ok'
                                                    })
                                                }
                                            },
                                        })
                                    } else {
                                        switchStatus_finalexam = 0;
                                        $.ajax({
                                            url: "<?=site_url('activities/toggle_publish_final_exam')?>",
                                            data: {is_published : switchStatus_finalexam, final_result_id : <?php echo $stud['final_result_id']?>},
                                            dataType: 'json',
                                            type: "post",
                                            success: function(data){
                                                if(data.response == "false") {

                                                } else {
                                                    $("#switch_publish_label_final_exam1").html('Unpublished');
                                                    Swal.fire({
                                                        title: 'Final Exam is Unpublished',
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