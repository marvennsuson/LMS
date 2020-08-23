<div class="content">
    <form  id="form_edit_register_student">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4 input-group">
                  <div class="input-group-prepend">
                          <label class="input-group-text bg-success" for="edit_input_search_subject_code">Subject Code</label>
                    </div>
                            <input type="text" class="form-control " name="edit_input_search_subject_code" id="edit_input_search_subject_code">
                            <div class="input-group-append">
                                <button type="button" id = "btn_edit_search_subject_code" class="btn bg-gradient-primary"><i class="fas fa-search"></i></button>
                            </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-4 input-group">
                    <div class="input-group-prepend">
                        <!-- <span class="input-group-text">Person</span>. -->
                              <label class="input-group-text bg-warning " for="edit_input_search_block">Block-S Code</label>
                      </div>
                  <input type="text" class="form-control " name="edit_input_search_block" id="edit_input_search_block">
                  <div class="input-group-append">
                      <button type="button" class="btn bg-gradient-primary" id = "btn_edit_search_block"><i class="fas fa-search"></i></button>
                  </div>


                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">

                </div>
            </div>
            <hr>
            <div class="row" id = "edit_subject_code_searched">

            </div>
            <div class="row" id="read_subject_information">
            <?php
                // print_r($subject_code);
                if (!empty($subject_details)) {
                    ?>
                    <div class= "col-12">
                        <div class="card">
                            <div class="card-header edit_register_header">
                                <h5 class="card-title">Block Subjects Information</h5>
                            </div>
                            <div class="card-body table-responsive p-0" id="div_selected_subject_table">
                                <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm" id="search_subject_table">
                                        <thead>
                                            <tr>
                                                <th>Subject Code</th>
                                                <th>Subject Name</th>
                                                <th>Subject Description</th>
                                                <th>Section</th>
                                                <th>Schedule</th>
                                                <th>Teacher</th>
                                                <th>Block</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $subjects = array();
                                            foreach ($subject_details as $sjbc) {
                                                $subjects[] = $sjbc['subjectcode'];
                                                $block = $sjbc['blockclassid'];
                                                ?>
                                                <tr>
                
                                                    <td><?php echo $sjbc['subjectcode'];?></td>
                                                    <td><?php echo $sjbc['subjectname'];?></td>
                                                    <td><?php echo $sjbc['subjectdesc'];?></td>
                                                    <td><?php echo $sjbc['section'];?></td>
                                                    <td><?php echo $sjbc['schedule'];?></td>
                                                    <td><?php echo $sjbc['teacherid'];?></td>
                                                    <td><?php echo $sjbc['blockclassid']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            
                                        </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="searchtype" id = "searchtype" value = "block,<?php echo $block;?>">
                    <input type="hidden" name = "edit_input_subject_id" id ="edit_input_subject_id" value = "<?php echo implode(',',$subjects);?>">
                    <?php
                }else{
                    ?>
                    <div class="box-body">
                        <div class="card-body">
                            <div class="alert alert-warning alert-dismissible">
                                <h4><i class="fa fa-exclamation-triangle"></i> Alert!</h4>
                                No Existing Subject
                            </div>
                        </div>
                    </div>
                    <?php
                }
            ?>
                    <hr>
            </div>
            <!-- <div class="row" id = "div_search_tip">
                <div class = "col-12 col-md-12 col-lg-12">
                    <div class = "text-center"> Search for subject by subject code or block code</div>
                    <hr>
                </div>
            </div> -->
            <div class ="row">
                <div class="justify-content-center mx-auto ">
                    <div class="input-group mb-3">
                            <div class="input-group-prepend">
                        <label for="input_edit_student_level_search" class="input-group-text">Student Search:</label>
                      </div>
                        <input type="text" class="form-control"  name="input_edit_student_level_search" id="input_edit_student_level_search">
                        <span class="input-group-append">
                            <button type="button" class="btn bg-gradient-primary" id = "btn_edit_student_level_search"><i class="fas fa-search"></i></button>
                        </span>

                    </div>
                      <p style="font-size:12px;">by student type college/high school/elem or by level grade 1-12/ college 1-4</p>
                    <hr>
                </div>
            </div>

            <div class="row" id = "div_edit_student_searched">

            </div>
            <div class="row" id = "div_search_registered_student_tip">
                <div class = "col-12 col-md-12 col-lg-12">
                    <div class = "text-center"> Search for student</div>
                    <hr>
                </div>
            </div>
            <div class="row" id= "div_read_registered_students">
            <?php
                // print_r($subject_code);
                if (!empty($student_registered)) {
                    ?>
                    <div class= "col-12">
                        <div class="card">
                            <div class="card-header edit_register_header">
                                <h5 class="card-title">Registered Student in this subject</h5>
                            </div>
                            <div class="card-body table-responsive p-0" id="div_registered_student_table">
                                <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm" id="search_subject_table">
                                        <thead>
                                            <tr>
                                                <th>Student Number</th>
                                                <th>Student Name</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $studentsRegistered = array();
                                            foreach ($student_registered as $sr) {
                                                $studentsRegistered[] = $sr['student_id'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $sr['student_id'];?></td>
                                                    <td><?php echo $sr['firstname'] .' '. $sr['middlename'].' '. $sr['lastname'];?></td>
                                                    <td><button type="button" class="btn btn-danger btn-sm delete_registered_student"  data-classid="rstudent-<?php echo $sr['student_id'];?>" data-toggle="modal" data-target="#register_student_delete"><i class="fa fa-trash"></i></button</td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        <input type="hidden" name = "edit_registered_student_id" id ="edit_registered_student_id" value = "<?php echo implode(',',$studentsRegistered);?>">
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <?php
                }else{
                    ?>
                    <div class="box-body">
                        <div class="card-body">
                            <div class="alert alert-warning alert-dismissible">
                                <h4><i class="fa fa-exclamation-triangle"></i> Alert!</h4>
                                No Existing Subject
                            </div>
                        </div>
                    </div>
                    <?php
                }
            ?>
                    <hr>
            </div>

            

          <div class="justify-content-end d-flex pull-right ">
              <button type="submit" class="btn btn-primary btn-sm btn-flat">Save</button>
          </div>
        </div>
    </form>
</div>


<script>
    $('#form_register_student').submit(function(e){
        e.preventDefault();
        $('#overlay_add_student > .overlay').css('visibility', 'visible');
        var subjectData = new FormData($(this)[0]);

        // console.log($(this)[0]);
        $.ajax({
            url: "<?=site_url('directory_student/register_student')?>",
            data: subjectData,
            dataType: "json",
            type: "post",
            async: false,
            success: function(data)
            {
                // console.log(data);
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

    $('#btn_edit_search_subject_code').click(function(){
        var searchSubjectCode = $("#edit_input_search_subject_code").val();
        // console.log(searchSubjectCode);
        $('#overlay_add_student > .overlay').css('visibility', 'visible');
        if (searchSubjectCode) {
            $.ajax({
                url: "<?=site_url('directory_student/edit_search_subject_code')?>",
                data: {
                    subjectCode: searchSubjectCode
                },
                type: "post",
                success: function (data) {
                    $('#overlay_add_student > .overlay').css('visibility', 'hidden');
                    $('#read_subject_information').remove();
                    $('#div_read_registered_students').remove();
                    // input_edit_student_level_search
                    $('#btn_edit_student_level_search').attr('disabled',"disabled");
                    $('#input_edit_student_level_search').attr('disabled',"disabled");
                    // $('#div_search_registered_student_tip').css('visibility', 'visible');
                    // $("#student_edit").modal('show');
                    $("#edit_subject_code_searched").html(data);
                }
            })
        }else{
            $('#overlay_add_student > .overlay').css('visibility', 'hidden');
            return false;
        }

        // return false;
    });

    $('#btn_edit_search_block').click(function(){
        var searchBlockCode = $("#edit_input_search_block").val();
        // console.log(searchBlockCode);
        if (searchBlockCode) {
            $('#overlay_add_student > .overlay').css('visibility', 'visible');
            $.ajax({
                url: "<?=site_url('directory_student/edit_search_block_code')?>",
                data: {
                    blockCode: searchBlockCode
                },
                type: "post",
                success: function (data) {
                    $('#overlay_add_student > .overlay').css('visibility', 'hidden');
                    
                    $('#read_subject_information').remove();
                    $('#div_read_registered_students').remove();
                    $('#btn_edit_student_level_search').attr('disabled',"disabled");
                    $('#input_edit_student_level_search').attr('disabled',"disabled");
                    
                    $("#edit_subject_code_searched").html(data);
                }
            })
        }else{
            $('#overlay_add_student > .overlay').css('visibility', 'hidden');
            return false;
        }

        return false;
    });


    $('#btn_edit_student_level_search').click(function(){
        var searchStudentLevel = $("#input_edit_student_level_search").val();
        var registeredStudent = $("#edit_registered_student_id").val();
        // console.log(registeredStudent);
        
        registeredStudent = ((registeredStudent === undefined) ? 'none' : registeredStudent);
        // console.log(registeredStudent);

        $('#overlay_add_student > .overlay').css('visibility', 'visible');
        if (searchStudentLevel) {

            $.ajax({
                url: "<?=site_url('directory_student/edit_search_registration_student')?>",
                data: {
                    studentLevel: searchStudentLevel,
                    regStud: registeredStudent
                },
                type: "post",
                success: function (data) {
                    $('#overlay_add_student > .overlay').css('visibility', 'hidden');
                    $('#div_search_registered_student_tip').remove();
                    // $("#student_edit").modal('show');
                    $("#div_edit_student_searched").html(data);
                }
            })
        }else{
            $('#overlay_add_student > .overlay').css('visibility', 'hidden');
            return false;
        }
    });

    $(document).on('click', "button.delete_registered_student", function () {
        // e.preventDefault();
        var searchData = $("#searchtype").val();
        searchData = searchData.split(',');
        var searchType = searchData[0];    
        var searchCode = searchData[1];
        
        Swal.fire({
            title: 'Are you sure you want to remove this Student from this subject <br>?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            var selected_id = $(this).data('classid');
            selected_id = selected_id.replace("rstudent-", "");

            if (result.value == true) {
                $.ajax({
                    url: "<?=site_url('directory_student/delete_block')?>",
                    data: {
                        id: selected_id,
                        code:searchCode
                    },
                    type: "post",
                    success: function (data) {
                        Swal.fire(
                            'Deleted!',
                            ' A Subject has been deleted.',
                            'success'
                        ).then((result) => {
                            if (searchType == 'subject') {
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
                                });
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
                                });
                            }
                        })
                    }
                })

            }
        })
    });
</script>
