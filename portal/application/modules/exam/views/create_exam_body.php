
                        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous"> -->
                        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

                        <!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script> -->
                        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
                        <link rel="stylesheet" href="<?=base_url('public/formbuilder/css/form_builder.min.css');?>">
                        <script src="<?= base_url('public/formbuilder/js/form_builder.js');?>"></script>
                        <style>
                            .control-label{
                                max-width: 100%;
                            }
                            .form_builder_field{
                                width: 650px;
                            }
                        </style>
        

                        <div class="form_builder">
                            <form class="form-horizontal" id="save_exam_form">
                                <div class="row">
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="input_exam_body_title">Test Body Title:</label>
                                            <input type="text" name="input_exam_body_title" id="input_exam_body_title" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="input_exam_body_points">Points:</label>
                                            <input type="text" name="input_exam_body_points" id="input_exam_body_points" class="form-control">
                                        </div>
                                    </div>
                                    <!-- <div class="col-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="select_exam_body_random">Random:</label>
                                            <select class="form-control" name="select_exam_body_random" id="select_exam_body_random">
                                                <option selected disabled></option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                    </div> -->
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <nav class="nav-sidebar">
                                            <ul class="nav">
                                                <li class="form_bal_radio"> <a href="javascript:;">Radio Button <i class="fa fa-plus-circle pull-right"></i></a> </li>
                                                <li class="form_bal_checkbox"> <a href="javascript:;">Checkbox <i class="fa fa-plus-circle pull-right"></i></a> </li>
                                                <!-- <li class="form_bal_textfield"> <a href="javascript:;">Text Field <i class="fa fa-plus-circle pull-right"></i></a> </li>
                                                <li class="form_bal_textarea"> <a href="javascript:;">Text Area <i class="fa fa-plus-circle pull-right"></i></a> </li> -->
                                            </ul>
                                        </nav>
                                    </div>
                                    <div class="col-md-5 bal_builder">

                                        <div class="form_builder_area mb-5 pb-5 pt-1" id="form_builder_area" style="position: relative !important; min-height: 20vh; background-color: #bbbbbb;">
                                            <p id="label_drophere" class="display-4 text-center text-muted align-content-center">Drop here</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 px-5">
                                        <div class="col-md-12">
                                            <!-- <div class="preview" style="max-width: 100%;"></div> -->
                                            <div style="display: none" class="form-group plain_html">
                                                <textarea rows="10" class="form-control" name="created_exam_form" id="created_exam_form" readonly></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button id="btn_save_form" type="submit" style="cursor: pointer; display: none" class="btn btn-success mt-2 pull-right">Save Form</button>
                                <!-- <button id="btn_create_form" style="cursor: pointer;display: none" class="btn btn-info export_html mt-2 mr-4 pull-right">Export HTML</button> -->
                            </form>
                        </div>
      
                        <script>
                            $( "#form_builder_area" ).mouseup(function(){
                                $('#label_drophere').hide();
                            });
                            
                            $("#btn_create_form").click(function(e){
                                e.preventDefault();
                                $("#btn_create_form").addClass('disabled');
                                $("#btn_save_form").removeClass('disabled');
                                $("#btn_save_form").css('display', 'block');
                            });

                            $("#save_exam_form").submit(function(e){
                                e.preventDefault();
                                $('.overlay').css('visibility', 'visible');
                                var formCreateExam = new FormData($(this)[0]);
                                $.ajax({
                                    url: "<?=site_url('exam/create_exam_body')?>",
                                    data: formCreateExam,
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
                                                title: 'Test Body Created!',
                                                type: 'success',
                                            }).then((result) => {
                                                location.reload();
                                            })
                                        }
                                        $('.overlay').css('visibility', 'hidden');
                                    },
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                });
                            })
                        </script>