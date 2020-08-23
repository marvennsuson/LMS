<?php if($staff_details):?>
    <?php foreach( $staff_details as $sd):?>
        <form id="edit_staff">
            <div class="card-body">
                <div class="form-group">
                    <label for="input_fname">Full Name</label>
                    <input type="text" class="form-control" id="input_fullname" name="input_fullname" value="<?php echo $sd['name']?>">
                </div>
                <div class="form-group">
                    <label for="select_gender">Gender</label>
                    <select class="form-control" name="select_gender" id="select_gender">
                        <option selected disabled></option>
                        <option value="Male"  <?php echo $selected = $sd['gender'] == 'Male' || $sd['gender'] == 'male'? 'selected':''; ?>>Male</option>
                        <option value="Female" <?php echo $selected = $sd['gender'] == 'Female' || $sd['gender'] == 'female'? 'selected':''; ?>>Female</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="input_email">Email</label>
                    <input type="email" class="form-control" id="input_email" name="input_email" value="<?php echo $sd['email']?>">
                </div>
                
                <div class="form-group">
                    <label for="input_address">Address</label>
                    <input type="text" class="form-control" id="input_address" name="input_address" value="<?php echo $sd['address']?>">
                </div>
                <div class="form-group">
                    <label for="select_role">Role <?php echo $sd['role_id']; ?></label> 
                    <select class="form-control" name="select_role" id="select_role">
                        <option selected disabled></option>
                        <option value="1" <?php  echo $selected1 = $sd['role_id'] == '1' ? 'selected':''; ?>>Super Administrator</option>
                        <option value="2" <?php  echo $selected1 = $sd['role_id'] == '2' ? 'selected':''; ?>>Administrator</option>
                        <option value="3" <?php  echo $selected1 = $sd['role_id'] == '3' ? 'selected':''; ?>>Teacher</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="input_bday">Birthday</label>
                    <input type="date" class="form-control" id="input_bday" name="input_bday" value="<?php echo $sd['birthday']?>">
                </div>
                <div class="form-group">
                    <label for="input_phone">Phone</label>
                    <input type="text" class="form-control" id="input_phone" name="input_phone" value="<?php echo $sd['mobile']?>">
                </div>
                <div class="form-group">
                    <label for="input_teaching_load">Teaching Loads</label>
                    <input type="text" class="form-control" id="input_teaching_load" name="input_teaching_load" value="<?php echo $sd['teaching_load']?>">
                </div>

                <div class="form-group">
                    <label for="input_teaching_load">Photo</label>
                    <input type="text" class="form-control" id="input_teaching_load" name="input_teaching_load" value="<?php echo $sd['teaching_load']?>">
                </div>
            </div>

            <input type="hidden" name="hidden_id" value="<?php echo $sd['teacher_id']?>">
            <div class="mx-4 mb-4">
                <button type="submit" class="btn btn-success">Update Staff</button>
            </div>
        </form>
    <?php endforeach;?>
<?php else:?>
    <h1>No Existing Staff.</h1>
<?php endif;?>


<script>
    $("#edit_staff").submit(function(e){
        e.preventDefault();
        $('.overlay').css('visibility', 'visible');
        var formEditStaff = new FormData($(this)[0]);
        $.ajax({
            url: "<?=site_url('directory_staff/insert_edit_staff')?>",
            data: formEditStaff,
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
                        title: 'Edit Staff Successful!',
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