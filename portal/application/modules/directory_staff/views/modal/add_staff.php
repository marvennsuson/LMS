<div class="content">
    <form id="form_add_staff">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="input_fname">First Name</label>
                        <input type="text" class="form-control" name="input_fname" id="input_fname">
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="input_mname">Middle Name</label>
                        <input type="text" class="form-control" name="input_mname" id="input_mname">
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="input_lname">Last Name</label>
                        <input type="text" class="form-control" name="input_lname" id="input_lname">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="input_staff_id">Teacher ID</label>
                        <input type="text" class="form-control" name="input_staff_id" id="input_staff_id">
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="select_gender">Gender</label>
                        <select class="form-control" name="select_gender" id="select_gender">
                            <option selected disabled></option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="input_bday">Bday</label>
                        <input type="date" class="form-control" name="input_bday" id="input_bday">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="input_email">Active Email</label>
                        <input type="email" class="form-control" name="input_email" id="input_email">
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="input_phone">Phone</label>
                        <input type="text" class="form-control" name="input_phone" id="input_phone">
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="select_role">Role</label>
                        <select class="form-control" name="select_role" id="select_role">
                            <option selected disabled></option>
                            <?php foreach($role_lists as $rl):?>
                                <?php if($rl['role_display_name'] == 'Student' || $rl['role_display_name'] == 'Parent'):?>
                                <?php else:?>
                                    <option value="<?= $rl['role_id']?>"><?= $rl['role_display_name']?></option>
                                <?php endif;?>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8 col-md-8 col-lg-8">
                    <div class="form-group">
                        <label for="input_address">Address</label>
                        <input type="text" class="form-control" name="input_address" id="input_address">
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="userfile">Photo</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="form-control" id="userfile" name="userfile">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="input_teaching_loads">Teaching Loads</label>
                        <input type="text" class="form-control" name="input_teaching_loads" id="input_teaching_loads">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>


<script>
    $('#form_add_staff').submit(function(e){
        e.preventDefault();
        $('#overlay_add_staff > .overlay').css('visibility', 'visible');
        var addStaff = new FormData($(this)[0]);
        $.ajax({
            url: "<?=site_url('directory_staff/add_staff')?>",
            data: addStaff,
            dataType: "json",
            type: "post",
            async: false,
            success: function(data)
            {
                if(data.response == "false") {
                    $('#overlay_add_staff > .overlay').css('visibility', 'hidden');
                    Swal.fire({
                        html: data.message,
                        type: 'error',
                    })
                } else {
                    $("#reg_select_classcode").val('');
                    $('#overlay_add_staff > .overlay').css('visibility', 'hidden');
                    Swal.fire({
                        title: 'Staff Added!',
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