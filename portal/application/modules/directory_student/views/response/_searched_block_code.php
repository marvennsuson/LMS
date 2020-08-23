<?php
if (!empty($searched_subject_code)) {
    ?>
    <div class= "col-12">

      <div class="card card-warning card-outline">
        <div class="card-header">
                <h4 class="card-title">Blocks</h4>
            </div>
            <div class="card-body table-responsive p-0" id="div_search_subject_table">
                <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm" id="search_subject_table">
                        <thead>
                            <tr>
                                <th>Block Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($searched_subject_code as $sbjc) {
                                    ?>
                                    <tr>
                                        <td><?php echo $sbjc['blockclassid'];?></td>
                                        <td><button type = "button" class="btn btn-success btn-sm btn-flat select_block" id="btn-select" data-classid = "block-<?php echo $sbjc['blockclassid']; ?>">Select</button></td>
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
                No Existing Block
            </div>
        </div>
    </div>

    <hr>
    <?php
}
?>


<script>
    $(document).on('click', "button.select_block", function () {
        $('#overlay_add_student > .overlay').css('visibility', 'visible');
        var blockId = $(this).data('classid');
        blockId = blockId.replace("block-", "");

        if (blockId) {
            // console.log(blockId)
            $.ajax({
                url: "<?=site_url('directory_student/selected_block_code')?>",
                data: {
                    id: blockId
                },
                type: "post",
                success: function (data) {
                    $('#overlay_add_student > .overlay').css('visibility', 'hidden');
                    $("#div_search_subject_table").remove();
                    $(".card-header.register").remove();
                    $("#subject_code_searched").html(data);
                }
            })
        }
        else{
            $('#overlay_add_student > .overlay').css('visibility', 'hidden');
            return false;
        }
    });
</script>
