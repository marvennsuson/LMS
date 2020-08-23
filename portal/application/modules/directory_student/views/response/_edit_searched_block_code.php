<?php
if (!empty($searched_block_code)) {
    ?>
    <div class= "col-12">
      <div class="card card-success card-outline">
        <div class="card-header edit_register_header">

                <h4 class="card-title">Choose Block</h4>
            </div>
            <div class="card-body table-responsive p-0" id="div_edit_search_block_table">
                <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm" id="search_block_table">
                        <thead>
                            <tr>
                                <th>Block Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($searched_block_code as $sbjc) {
                                    ?>
                                    <tr>
                                        <td><?php echo $sbjc['blockclassid']; ?></td>
                                        <td><button type = "button" class="btn btn-success btn-sm select_edit_register_block btn-flat" id="btn-select" data-classid = "block-<?php echo $sbjc['blockclassid']; ?>">Select</button></td>
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
    $(document).on('click', "button.select_edit_register_block", function () {
        $('#overlay_add_student > .overlay').css('visibility', 'visible');
        var subjectId = $(this).data('classid');
        subjectId = subjectId.replace("block-", "");
        
        if (subjectId) {
            $.ajax({
                url: "<?=site_url('directory_student/edit_selected_block_code')?>",
                data: {
                    id: subjectId
                },
                type: "post",
                success: function (data) {
                    $('#overlay_add_student > .overlay').css('visibility', 'hidden');
                    $("#div_edit_search_block_table").remove();
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
