<?php if($student_details):?>
    <?php foreach( $student_details as $sd):?>
        <form id="edit_student">
            <div class="card-body">
                <div class="form-group">
                    <label for="input_firstname">First Name</label>
                    <input type="text" class="form-control" id="input_fname" name="input_firstname" value="<?php echo $sd['firstname']?>">
                </div>
                <div class="form-group">
                    <label for="input_middlename">Middle Name</label>
                    <input type="text" class="form-control" id="input_middlename" name="input_middlename" value="<?php echo $sd['middlename']?>">
                </div>
                <div class="form-group">
                    <label for="input_lastname">Last Name</label>
                    <input type="text" class="form-control" id="input_lastname" name="input_lastname" value="<?php echo $sd['lastname']?>">
                </div>
                <div class="form-group">
                    <label for="input_email">Email</label>
                    <input type="email" class="form-control" id="input_email" name="input_email" value="<?php echo $sd['email']?>">
                </div>
                <div class="form-group">
                    <label for="input_student_type">School Lvl</label>
                    <input type="text" class="form-control" id="input_student_type" name="input_student_type" value="<?php echo $sd['student_type']?>">
                </div>
                <div class="form-group">
                    <label for="input_address">Address</label>
                    <input type="text" class="form-control" id="input_address" name="input_address" value="<?php echo $sd['address']?>">
                </div>
                <div class="form-group">
                    <label for="select_sex">Gender</label>
                    <select class="form-control" name="select_sex" id="select_sex">
                        <option selected disabled></option>
                        <option value="male" <?php echo $selected = $sd['sex'] == 'male' ? 'selected':''; ?>>Male</option>
                        <option value="female" <?php echo $selected = $sd['sex'] == 'female' ? 'selected':''; ?>>Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="input_birthdate">Birthday</label>
                    <input type="date" class="form-control" id="input_birthdate" name="input_birthdate" value="<?php echo $sd['birthdate']?>">
                </div>
                <div class="form-group">
                    <label for="input_cellphone">Phone</label>
                    <input type="text" class="form-control" id="input_cellphone" name="input_cellphone" value="<?php echo $sd['cellphone']?>">
                </div>
                <div class="form-group">
                    <label for="input_guardian_name">Guardian</label>
                    <input type="text" class="form-control" id="input_guardian_name" name="input_guardian_name" value="<?php echo $sd['guardian_name']?>">
                </div>
                <div class="form-group">
                    <label for="input_guardian_email">Guardian Email</label>
                    <input type="email" class="form-control" id="input_guardian_email" name="input_guardian_email" value="<?php echo $sd['guardian_email']?>">
                </div>
                <div class="form-group">
                    <label for="input_guardian_mobile">Guardian Phone</label>
                    <input type="text" class="form-control" id="input_guardian_mobile" name="input_guardian_mobile" value="<?php echo $sd['guardian_mobile']?>">
                </div>
                <div class="form-group">
                    <label for="input_guardian_address">Guardian Address</label>
                    <input type="text" class="form-control" id="input_guardian_address" name="input_guardian_address" value="<?php echo $sd['guardian_address']?>">
                </div>
            </div>

            <input type="hidden" name="hidden_id" value="<?php echo $sd['id']?>">
            <div class="mx-4 mb-4">
                <button type="submit" class="btn btn-success">Update Student</button>
            </div>
        </form>
    <?php endforeach;?>
<?php else:?>
    <h1>No Existing Student.</h1>
<?php endif;?>


<script>
    $("#edit_student").submit(function(e){
        e.preventDefault();
        $('.overlay').css('visibility', 'visible');
        var formEditStudent = new FormData($(this)[0]);
        $.ajax({
            url: "<?=site_url('directory_student/insert_edit_student')?>",
            data: formEditStudent,
            dataType: "json",
            type: "post",
            async: false,
            success: function(data){
                if(data.response == "false") {
                    Swal.fire({
                        html: data.message,
                        type: 'error',
                    })
                } else {
                    Swal.fire({
                        title: 'Edit Student Successful!',
                        type: 'success',
                        confirmButtonText: 'Ok'
                    }).then(
                        (result) => {
                            if(result.value){
                                location.reload();
                            }
                        }
                    )
                }
                $('.overlay').css('visibility', 'hidden');
            },
            contentType: false,
            cache: false,
            processData: false,
        });
    });
</script>