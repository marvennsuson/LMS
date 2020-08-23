<div class="content">
    <form id="form_add_student">
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
                        <label for="input_student_id">Student ID</label>
                        <input type="text" class="form-control" name="input_student_id" id="input_student_id">
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
                        <label for="select_school_level">School Level</label>
                        <select class="form-control" name="select_school_level" id="select_school_level">
                            <option selected disabled></option>
                            <option value="1">Grade 1</option>
                            <option value="2">Grade 2</option>
                            <option value="3">Grade 3</option>
                            <option value="4">Grade 4</option>
                            <option value="5">Grade 5</option>
                            <option value="6">Grade 6</option>
                            <option value="7">Grade 7</option>
                            <option value="8">Grade 8</option>
                            <option value="9">Grade 9</option>
                            <option value="10">Grade 10</option>
                            <option value="11">Junior High</option>
                            <option value="12">Senior High</option>
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
            <hr>
            <div class="row">
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="input_guardian">Guardian Name</label>
                        <input type="text" class="form-control" name="input_guardian" id="input_guardian">
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="input_gemail">Guardian Email</label>
                        <input type="text" class="form-control" name="input_gemail" id="input_gemail">
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="input_gphone">Guardian Phone</label>
                        <input type="text" class="form-control" name="input_gphone" id="input_gphone">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>


<script>
    $('#form_add_student').submit(function(e){
        e.preventDefault();
        $('#overlay_add_student > .overlay').css('visibility', 'visible');
        var addStudent = new FormData($(this)[0]);
        $.ajax({
            url: "<?=site_url('directory_student/add_student')?>",
            data: addStudent,
            dataType: "json",
            type: "post",
            async: false,
            success: function(data)
            {
                if(data.response == "false") {
                    $('#overlay_add_student > .overlay').css('visibility', 'hidden');
                    Swal.fire({
                        html: data.message,
                        type: 'error',
                    })
                } else {
                    $("#reg_select_classcode").val('');
                    $('#overlay_add_student > .overlay').css('visibility', 'hidden');
                    Swal.fire({
                        title: 'Student Added!',
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