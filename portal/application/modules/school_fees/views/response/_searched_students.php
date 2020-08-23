<?php
    if ($searched_student) {
        ?>
        <div class="card">
            <div class="card-header student">
                <h3 class="card-title">Student Searched</h3>
            </div>
            <div class="card-body table-responsive p-0" id="div_searched_student_table">
                <table class="table table-striped table-hover table-head-fixed text-nowrap"
                                                    id="search_student_table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($searched_student as $student) {
                            ?>
                            <tr>
                                <td><?php echo $student['firstname'].' '. $student['middlename'].' '.$student['lastname']; ?></td>
                                <td><button type="button" class="btn btn-success btn-sm select_student" id="btn_select_student" data-classid="student-<?php echo $student['student_number']?>"> Select</button></td>
                            </tr>

                            <?php
                        }
                        
                        ?>
                    
                    </tbody>
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
    $(document).on('click',"button.select_student", function(){
        $('#overlay_add_school_fees > .overlay').css('visibility', 'visible');
        var studentId = $(this).data('classid');
        studentId = studentId.replace("student-", "");
        console.log(studentId);
        if (studentId) {
            $.ajax({
                url: "<?=site_url('school_fees/selected_student')?>",
                data: {
                    id: studentId
                },
                type: "post",
                success: function (data) {
                    $('#overlay_add_school_fees > .overlay').css('visibility', 'hidden');
                    $("#div_searched_student_table").remove();
                    $("#search_tip").remove();
                    $(".card-header.student").remove();
                    $("#div_student_search_response").html(data);
                }
            })
        }
        else{
            $('#overlay_add_school_fees > .overlay').css('visibility', 'hidden');
            return false;
        }

    });
</script>

