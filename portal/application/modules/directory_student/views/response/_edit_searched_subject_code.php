<?php
if (!empty($searched_subject_code)) {
    ?>
    <div class= "col-12">
      <div class="card card-success card-outline">
        <div class="card-header edit_register_header">

                <h4 class="card-title">Choose Subject</h4>
            </div>
            <div class="card-body table-responsive p-0" id="div_edit_search_subject_table">
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($searched_subject_code as $sbjc) {
                                    ?>
                                    <tr>
                                        <td><?php echo $sbjc['subjectcode'];?></td>
                                        <td><?php echo $sbjc['subjectname'];?></td>
                                        <td><?php echo $sbjc['subjectdesc'];?></td>
                                        <td><?php echo $sbjc['section'];?></td>
                                        <td><?php echo $sbjc['schedule'];?></td>
                                        <td><?php echo $sbjc['teacherid'];?></td>
                                        <td><?php echo $sbjc['blockclassid']; ?></td>
                                        <td><button type = "button" class="btn btn-success btn-sm select_edit_register btn-flat" id="btn-select" data-classid = "subject-<?php echo $sbjc['subjectcode']; ?>">Select</button></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php
}else{
    ?>
    <div class="box-body w-100">
        <div class="card-body">
            <div class="alert alert-warning alert-dismissible">
                <h4><i class="fa fa-exclamation-triangle"></i> Alert!</h4>
                No Existing Subject
            </div>
        </div>
    </div>

    <hr>
    <?php
}
?>


<script>
    $(document).on('click', "button.select_edit_register", function () {
        $('#overlay_add_student > .overlay').css('visibility', 'visible');
        var subjectId = $(this).data('classid');
        subjectId = subjectId.replace("subject-", "");
        
        if (subjectId) {
            $.ajax({
                url: "<?=site_url('directory_student/edit_selected_subject_code')?>",
                data: {
                    id: subjectId
                },
                type: "post",
                success: function (data) {
                    $('#overlay_add_student > .overlay').css('visibility', 'hidden');
                    $("#div_edit_search_subject_table").remove();
                    $(".card-header.edit_register_header").remove();
                    $("#register_student_edit_response").html(data);
                }
            })
        }
        else{
            $('#overlay_add_student > .overlay').css('visibility', 'hidden');
            return false;
        }
    });
</script>
