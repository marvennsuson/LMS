<?php
    if ($selected_student) {
        ?>
        <div class="card">
            <div class="card-header student">
                <h3 class="card-title">Student Information</h3>
            </div>
            <div class="card-body table-responsive p-0" id="div_searched_student_table">
                <table class="table table-striped table-hover table-head-fixed text-nowrap"
                                                    id="search_student_table">
                    <thead>
                        <tr>
                            <th>Name</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $selected_student['firstname'].' '. $selected_student['middlename'].' '.$selected_student['lastname']; ?></td>
                        </tr>
                    </tbody>
                    <input type="hidden" name="input_student_id" id="input_student_id" value="<?php echo $selected_student['student_number']; ?>">
                </table>
            </div>
        </div>
        <?php
    }else{
        ?>
        <div class="card-body">
            <div class="alert alert-warning alert-dismissible">
                <h4><i class="fa fa-exclamation-triangle"></i> Alert!</h4>
                No Existing Student
            </div>
        </div>
        <?php


    }
?>

<script>
    $('#btn_select_student').click(function(){
        $('#overlay_add_student > .overlay').css('visibility', 'visible');
        var studentId = $(this).data('classid');
        studentId = studentId.replace("student-", "");
        
        if (studentId) {
            $.ajax({
                url: "<?=site_url('school_fees/selected_student')?>",
                data: {
                    id: studentId
                },
                type: "post",
                success: function (data) {
                    $('#overlay_add_student > .overlay').css('visibility', 'hidden');
                    $("#div_searched_student_table").remove();
                    $(".card-header.student").remove();
                    $("#div_student_search_response").html(data);
                }
            })
        }
        else{
            $('#overlay_add_student > .overlay').css('visibility', 'hidden');
            return false;
        }

    });
</script>

