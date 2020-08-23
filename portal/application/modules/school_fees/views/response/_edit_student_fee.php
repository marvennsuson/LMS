<?php
    if ($school_fees) {
        ?>
        <form id = "form_edit_student_fee">
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
                                <td><?php echo $school_fees['firstname'].' '. $school_fees['middlename'].' '.$school_fees['lastname']; ?></td>
                            </tr>
                        </tbody>
                        <input type="hidden" name="input_student_id" id="input_student_id" value="<?php echo $school_fees['student_id']; ?>">
                    </table>
                    <hr>
                </div>
                <div class = "row">
                    <div class="col-lg-12">
                        <label for="file">Bill PDF file</label>
                        <input type="file" name="userfile" id="userfile">
                        <label for="current_file">Current File</label>
                        <input type="text" readonly= "readonly" name="current_file" id = "current_file" value = "<?php echo $school_fees['file']; ?>">
                    </div>
                    <hr>
                </div>

                <div class = "row">
                    <div class="col-lg-12">
                        <label for="text_description">Description</label>
                        <textarea class="form-control" style="resize:none" name="text_description" id="text_description" cols="30" rows="5"><?php echo $school_fees['description'];?></textarea>
                        <hr>
                    </div>
                    <hr>
                </div>
                <input type="hidden" name ="input_stud_fee_id" id = "input_stud_fee_id" value = "<?php echo $school_fees['id']; ?>">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
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
    $('#form_edit_student_fee').submit(function(e){
        e.preventDefault();
        $('#overlay_add_school_fees > .overlay').css('visibility', 'visible');
        
        var addSchoolFee = new FormData($(this)[0]);
        $.ajax({
            url: "<?=site_url('school_fees/update_school_fees')?>",
            data: addSchoolFee,
            dataType: "json",
            type: "post",
            async: false,
            success: function(data)
            {
                if(data.response == "false") {
                    $('#overlay_add_school_fees > .overlay').css('visibility', 'hidden');
                    Swal.fire({
                        html: data.message,
                        type: 'error',
                    })
                } else {
                    // $("#reg_select_classcode").val('');
                    $('#overlay_add_school_fees > .overlay').css('visibility', 'hidden');
                    Swal.fire({
                        title: 'Bill Updated!',
                        type: 'success',
                    }).then((result) => {
                        location.reload();
                    })
                }
            },
            contentType: false,
            cache: false,
            processData: false,
        });
    });
</script>

