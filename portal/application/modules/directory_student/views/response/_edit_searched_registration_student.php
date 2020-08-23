<?php
if (!empty($students)) {
    ?>
    <div class= "col-12">
      <div class="card card-warning card-outline">
        <div class="card-header">
                <h4 class="card-title">Choose a student to register in this subject</h4>
            </div>
            <div class="card-body table-responsive p-0" id="div_search_student_table">
                <div class="row">
                <?php
                    foreach ($students as $std) {
                        ?>
                        <div class="col-3 col-md-3 col-lg-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="chk_edit_students[]" id="chk_edit_students" value="<?php echo $std['student_number']; ?>">
                                <label class="" for="chk_edit_students[]"><?php echo $std['firstname'] . " " . $std['middlename'] . " " . $std['lastname']?></label>
                            </div>
                        </div>

                        <?php
                    }
                ?>
                </div>
        
            </div>
            <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-sm text-right" disabled="disabled" id = "btn_edit_register_student" name = "btn_edit_register_student">Register these Students</button>
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
                No Existing Student
            </div>
        </div>
    </div>

    <hr>
    <?php
}
?>

<script>
$(document).on('click',"input#chk_edit_students",function ()
{
    // var isChecked = $("#chk_subject_delete").is(":checked");
    var countChecked = $("#chk_edit_students:checked").length;
    if (countChecked > 0){
        $('#btn_edit_register_student').removeAttr('disabled')
    }else{
        $('#btn_edit_register_student').attr('disabled','true')
    }

});

$('#btn_edit_register_student').click(function(e){
    var selectedIds = [];
    $.each($("input[name='chk_edit_students[]']:checked"), function(){
        selectedIds.push($(this).val());
    });
    var subjectId = $("#edit_input_subject_id").val();
    selectedIds = selectedIds.join(',');

    var searchData = $("#searchtype").val();
    searchData = searchData.split(',');
    var searchType = searchData[0];    
    var searchCode = searchData[1];
    
    $.ajax({
        url: "<?=site_url('directory_student/update_register_student')?>",
        data: {
            subjectCodes: subjectId,
            studentIds: selectedIds
        },
        type: "post",
        // dataType: "json",
        // async: false,
        success: function(data)
        {
            if(data.response == "false") {
                $('#overlay_add_student > .overlay').css('visibility', 'hidden');
                Swal.fire({
                    html: data.message,
                    type: 'error',
                })
            } else {   
                if (searchType == "subject") {
                    $.ajax({
                        url: "<?=site_url('directory_student/edit_selected_subject_code')?>",
                        data: {
                            id: searchCode
                        },
                        type: "post",
                        success: function (data) {
                            $('#overlay_add_student > .overlay').css('visibility', 'hidden');
                            $("#div_edit_search_subject_table").remove();
                            $(".card-header.edit_register_header").remove();
                            $("#register_student_edit_response").html(data);
                        }
                    })
                }else{
                    $.ajax({
                        url: "<?=site_url('directory_student/edit_selected_block_code')?>",
                        data: {
                            id: searchCode
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
                // $("#reg_select_classcode").val('');
                // $('#overlay_add_student > .overlay').css('visibility', 'hidden');
                // Swal.fire({
                //     title: 'Student Added!',
                //     type: 'success',
                // }).then((result) => {
                //     location.reload();
                // })
            }
        }
    });
});



</script>
