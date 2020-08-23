            <link rel="stylesheet" href="<?= base_url('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css');?>">
            <title><?= $title;?></title>
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark"><?= $module;?></h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                                    <li class="breadcrumb-item active"><?= $module;?></li>
                                    <li class="breadcrumb-item active"><a href="<?= current_url();?>"><?=$function;?></a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-4 order-2 order-md-1">
                                <div class="form-group">
                                    <label for="reg_select_student_type">Student Type</label>
                                    <select class="form-control" name="reg_select_student_type" id="reg_select_student_type">
                                        <option selected disabled></option>
                                        <option value="elementary">Elementary</option>
                                        <option value="junior high">Junior High</option>
                                        <option value="senior high">Senior High</option>
                                        <option value="college">College</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-6 col-md-6 col-lg-4 order-2 order-md-1">
                                <div class="form-group">
                                    <label for="reg_select_student_level">Student Level</label>
                                    <select class="form-control" name="reg_select_student_level" id="reg_select_student_level">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                        <i class="ion ion-clipboard mr-1"></i>
                                            Bulk Registration
                                        </h3>
                                    </div>
                                    <form id="form_bulk_search">
                                        <div class="card-body">
                                            
                                            <div class="todo-list" id="todo-list">
                                                
                                            </div>
                                        </div>

                                        <!-- <div class="card-footer clearfix">
                                            <button type="button" class="btn btn-info float-right"><i class="fas fa-plus"></i> Save</button>
                                        </div> -->
                                    </form>
                                    <div class="overlay" style="visibility: hidden;">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <script>
                $('#form_bulk_search').submit(function(e){
                    e.preventDefault();
                    var registerStudent = new FormData($(this)[0]);
                    $.ajax({
                        url: "<?=site_url('admissions/bulk_registration_insert')?>",
                        data: registerStudent,
                        dataType: "json",
                        type: "post",
                        async: false,
                        success: function(data)
                        {
                            if(data.response == "false") {
                                Swal.fire({
                                    html: data.message,
                                    type: 'error',
                                })
                            } else {
                                $("#reg_select_classcode").val('');
                                
                                Swal.fire({
                                    title: 'Student Registered!',
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
            </script> -->
            
            <script>
                $('#reg_select_student_type').change(function(){
                    $('#search_by_level_response').css('display', 'none');
                    if($('#reg_select_student_type').val() == 'elementary'){
                        $('#reg_select_student_level').html('<option selected disabled></option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option>');
                    } else if($('#reg_select_student_type').val() == 'junior high') {
                        $('#reg_select_student_level').html('<option selected disabled><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>');
                    } else if($('#reg_select_student_type').val() == 'senior high') {
                        $('#reg_select_student_level').html('<option selected disabled><option value="11">11</option><option value="12">12</option>');
                    } else if($('#reg_select_student_type').val() == 'college') {
                        $('#reg_select_student_level').html('<option selected disabled><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>');
                    } else {
                        // $.ajax({
                        //     url: "<?=site_url('admissions/search_student_type_bulk_registration')?>",
                        //     data: {classcode : $('#reg_select_student_type').val()},
                        //     type: "post",
                        //     success: function(data){
                        //         if(data.response == "false") {
                        //         } else {
                        //             $("#div_class_info").css('display', 'block');
                        //             $("#div_class_info_inner").html(data);
                        //         }
                        //     },
                        // })
                        // return false;
                    }
                })

                $('#reg_select_student_level').change(function(){
                    $('#search_by_level_response').css('display', 'none');
                    $('.overlay').css('visibility', 'visible');
                    $.ajax({
                        url: "<?=site_url('admissions/search_student_by_level')?>",
                        data: {studentlevel : $('#reg_select_student_level').val()},
                        type: "post",
                        success: function(data){
                            if(data.response == "false") {

                            } else {
                                $('.overlay').css('visibility', 'hidden');
                                $("#div_class_info").css('display', 'block');
                                $("#todo-list").html(data);
                            }
                        },
                    })
                    return false;
                })

                $('.card-footer a').addClass('page-link');
                $('#input_search').keyup(function(){
                    if($('#input_search').val() == '' ){
                        $('#div_admission_table').css('display', 'block');
                        $('#div_searched_table').css('display', 'none');
                    } else {
                        $('#div_admission_table').css('display', 'none');
                        $('#div_searched_table').css('display', 'block');
                        $.ajax({
                            url: "<?=site_url('admission/search_admissionn')?>",
                            data: {searchItem : $('#input_search').val()},
                            type: "post",
                            success: function(data){
                                if(data.response == "false") {
                                } else {
                                    $("#searched_table").html(data);
                                }
                            },
                        })
                        return false;
                    }
                })
            </script>