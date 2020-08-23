            <title><?= $module_title.' | '.$module_function ;?></title>

            <link rel="stylesheet" href="<?= base_url('public/plugins/summernote/summernote-bs4.css');?>">

            <div class="content-wrapper">

                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark"><?= $module_title;?></h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                                    <li class="breadcrumb-item active"><?= $module_title;?></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card card-pink">
                                    <div class="card-header">
                                        <h3 class="card-title"><?= $module_function;?></h3>
                                    </div>
                                    <form role="form" id="form_add_job">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="input_job_title">Job Title</label>
                                                <input type="text" class="form-control" id="input_job_title" name="input_job_title" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label for="input_job_category">Job Category</label>
                                                <input type="text" class="form-control" id="input_job_category" name="input_job_category" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label for="input_company">Company</label>
                                                <input type="text" class="form-control" id="input_company" name="input_company" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label for="input_salary">Salary</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="input_salary" name="input_salary">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="input_location">Location</label>
                                                <input type="text" class="form-control" id="input_location" name="input_location" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label for="textarea_job_description">Job Description</label>
                                                <textarea class="textarea" id="textarea_job_description" name="textarea_job_description" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="textarea_job_qualification">Job Qualification</label>
                                                <textarea class="textarea" id="textarea_job_qualification" name="textarea_job_qualification" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="textarea_skills_required">Skills Required</label>
                                                <textarea class="textarea" id="textarea_skills_required" name="textarea_skills_required" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="textarea_job_details">Job Details</label>
                                                <textarea class="textarea" id="textarea_job_details" name="textarea_job_details" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                            </div>
                                            
                                        </div>

                                        <div class="card-footer">
                                            <button type="reset" class="btn btn-secondary" id="btn_clear"><i class="fa fa-eraser"></i> Clear</button>
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-folder-plus"></i> Add Job</button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                            <div class="col-lg-6">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="<?= base_url('public/plugins/summernote/summernote-bs4.min.js');?>"></script>

            <script>
                $('#input_salary').on('input', function() {
                    $('#input_salary').val(
                        numeral(
                            $('#input_salary').val()
                        ).format('0,0')
                    );
                });

                $('#btn_clear').on('click',function(){
                    $('#textarea_job_description').summernote('reset');
                    $('#textarea_job_qualification').summernote('reset');
                    $('#textarea_skills_required').summernote('reset');
                    $('#textarea_job_details').summernote('reset');
                })

                $(function () {
                    $('.textarea').summernote({
                        minHeight: 150
                    })
                })

                $("#form_add_job").submit(function(e){
                    e.preventDefault();
                    
                    var formAddJob = new FormData($(this)[0]);
                    $("#form_add_job_response").css('display','none');
                    $.ajax({
                        url: "<?=site_url('utilities/add_job')?>",
                        data: formAddJob,
                        dataType: "json",
                        type: "post",
                        async: false,
                        success: function(data){

                            if(data.response == "false") {
                                Swal.fire({
                                    html: data.message,
                                    type: 'error',
                                })
                                // $("#form_add_job_response").removeClass('alert alert-success').addClass('alert alert-danger').html(data.message).slideDown('fast');
                            } else {
                                // $("#form_add_job_response").removeClass('alert alert-danger').addClass('alert alert-success').html(data.message).slideDown('fast');
                                $("#input_job_title").val('');
                                $("#input_company").val('');
                                $("#input_location").val('');
                                $("#input_category").val('');
                                $("#input_salary").val('');
                                $('#textarea_job_description').summernote('reset');
                                $('#textarea_job_qualification').summernote('reset');
                                $('#textarea_skills_required').summernote('reset');
                                $('#textarea_job_details').summernote('reset');

                                Swal.fire({
                                    title: 'Job Posted!',
                                    type: 'success',
                                })
                            }
                        },
                        contentType: false,
                        cache: false,
                        processData: false,
                    });
                });
            </script>
