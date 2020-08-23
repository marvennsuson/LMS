<div class="content">
    <form  id="form_register_student">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4 input-group">

                  <div class="input-group-prepend">
                          <label class="input-group-text bg-success" for="input_search_subject_code">Subject Code</label>
                    </div>
                            <input type="text" class="form-control " name="input_search_subject_code" id="input_search_subject_code">
                            <div class="input-group-append">
                                <button type="button" id = "search_subject_code" class="btn bg-gradient-primary"><i class="fas fa-search"></i></button>
                            </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-4 input-group">
                    <div class="input-group-prepend">
                        <!-- <span class="input-group-text">Person</span>. -->
                              <label class="input-group-text bg-warning " for="input_search_block">Block-S Code</label>
                      </div>
                  <input type="text" class="form-control " name="input_search_block" id="input_search_block">
                  <div class="input-group-append">
                      <button type="button" class="btn bg-gradient-primary" id = "btn_search_block"><i class="fas fa-search"></i></button>
                  </div>


                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">

                </div>
            </div>
            <hr>
            <div class="row" id = "subject_code_searched">

            </div>
            <div class="row" id = "div_search_tip">
                <div class = "col-12 col-md-12 col-lg-12">
                    <div class = "text-center"> Search for subject by subject code or block code</div>
                    <hr>
                </div>
            </div>
            <div class ="row">
                <div class="justify-content-center mx-auto ">
                    <div class="input-group mb-3">
                            <div class="input-group-prepend">
                        <label for="input_student_level_search" class="input-group-text">Student Search:</label>
                      </div>
                        <input type="text" class="form-control"  name="input_student_level_search" id="input_student_level_search">
                        <span class="input-group-append">
                            <button type="button" class="btn bg-gradient-primary" id = "btn_student_level_search"><i class="fas fa-search"></i></button>
                        </span>

                    </div>
                      <p style="font-size:12px;">by student type college/high school/elem or by level grade 1-12/ college 1-4</p>
                    <hr>
                </div>
            </div>

            <div class="row" id = "div_student_searched">

            </div>

            <div class="row" id = "div_search_student_tip">
                <div class = "col-12 col-md-12 col-lg-12">
                    <div class = "text-center"> Search for student</div>
                    <hr>
                </div>
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

    $('#search_subject_code').click(function(){
        var searchSubjectCode = $("#input_search_subject_code").val();

        if (searchSubjectCode) {
            $('#overlay_add_student > .overlay').css('visibility', 'visible');
            $.ajax({
                url: "<?=site_url('directory_student/search_subject_code')?>",
                data: {
                    subjectCode: searchSubjectCode
                },
                type: "post",
                success: function (data) {
                    $('#overlay_add_student > .overlay').css('visibility', 'hidden');
                    $('#div_search_tip').remove();
                    // $("#student_edit").modal('show');
                    $("#subject_code_searched").html(data);
                }
            })
        }else{
            $('#overlay_add_student > .overlay').css('visibility', 'hidden');
            return false;
        }

        // return false;
    });

    $('#btn_search_block').click(function(){
        var searchBlockCode = $("#input_search_block").val();
        // console.log(searchBlockCode);
        if (searchBlockCode) {
            $('#overlay_add_student > .overlay').css('visibility', 'visible');
            $.ajax({
                url: "<?=site_url('directory_student/search_block_code')?>",
                data: {
                    blockCode: searchBlockCode
                },
                type: "post",
                success: function (data) {
                    $('#overlay_add_student > .overlay').css('visibility', 'hidden');
                    $('#div_search_tip').remove();
                    // $("#student_edit").modal('show');
                    $("#subject_code_searched").html(data);
                }
            })
        }else{
            $('#overlay_add_student > .overlay').css('visibility', 'hidden');
            return false;
        }

        return false;
    });



    $('#btn_student_level_search').click(function(){
        var searchStudentLevel = $("#input_student_level_search").val();
        // console.log(searchStudentLevel);
        $('#overlay_add_student > .overlay').css('visibility', 'visible');
        if (searchStudentLevel) {

            $.ajax({
                url: "<?=site_url('directory_student/search_registration_student')?>",
                data: {
                    studentLevel: searchStudentLevel
                },
                type: "post",
                success: function (data) {
                    $('#overlay_add_student > .overlay').css('visibility', 'hidden');
                    $('#div_search_student_tip').remove();
                    // $("#student_edit").modal('show');
                    $("#div_student_searched").html(data);
                }
            })
        }else{
            $('#overlay_add_student > .overlay').css('visibility', 'hidden');
            return false;
        }
    });
</script>
