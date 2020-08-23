<?php
// print_r($subject_code);
if (!empty($subject_code)) {
    ?>
    <div class= "col-12">
        <div class="card">
            <div class="card-header register">
                <h5 class="card-title">Block Subjects Information</h5>
            </div>
            <div class="card-body table-responsive p-0" id="div_selected_subject_table">
                <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm" id="search_subject_table">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Subject Name</th>
                                <th>Subject Description</th>
                                <th>Section</th>
                                <th>Schedule</th>
                                <th>Teacher</th>
                                <th>Block</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $subjIds = array();

                                foreach ($subject_code as $sbj) {
                                    $subjIds[] = $sbj['id'];
                                    ?>
                                    <tr>
                                        <td><?php echo $sbj['subjectcode'];?></td>
                                        <td><?php echo $sbj['subjectname'];?></td>
                                        <td><?php echo $sbj['subjectdesc'];?></td>
                                        <td><?php echo $sbj['section'];?></td>
                                        <td><?php echo $sbj['schedule'];?></td>
                                        <td><?php echo $sbj['teacherid'];?></td>
                                        <td><?php echo $sbj['blockclassid']; ?></td>
                                    </tr>
                                    <?php
                                }
                            ?>

                        </tbody>
                </table>


            </div>
        </div>
    </div>
    <input type="hidden" name = "input_subject_id" id ="input_subject_id" value = "<?php echo implode(',',$subjIds)?>">
    <?php
}else{
    ?>
    <div class="box-body">
        <div class="card-body">
            <div class="alert alert-warning alert-dismissible">
                <h4><i class="fa fa-exclamation-triangle"></i> Alert!</h4>
                No Existing Subject
            </div>
        </div>
    </div>
    <?php
}
?>
    <hr>
