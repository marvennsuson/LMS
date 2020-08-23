            <link rel="stylesheet" href="<?= base_url('public/plugins/summernote/summernote-bs4.css');?>">
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
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="card">
                                    <div class="card-header d-flex p-0">
                                        <h3 class="card-title p-3"><i class="fas fa-pencil-alt"></i> Homeworks</h3>
                                        <ul class="nav nav-pills ml-auto p-2">
                                            <li class="nav-item"><a class="nav-link active" href="#compose" data-toggle="tab">Compose</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#sent_homework" data-toggle="tab">Sent Homework</a></li>
                                            <!-- <li class="nav-item"><a class="nav-link" href="#received_homework" data-toggle="tab">Received Homework</a></li> -->
                                        </ul>
                                    </div>

                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="compose">
                                                <?= $this->load->view('homework/compose');?>
                                            </div>

                                            <div class="tab-pane" id="sent_homework">
                                                <?= $this->load->view('homework/sent_homework');?>
                                            </div>

                                            <!-- <div class="tab-pane" id="received_homework">
                                                <?//= $this->load->view('homework/received_homework');?>
                                            </div> -->
                                        </div>
                                    </div>

                                    <div class="overlay" style="visibility: hidden;">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="card">
                                    <div class="card-header d-flex p-0">
                                        <h3 class="card-title p-3"><i class="fas fa-pencil-alt"></i> Submitted homework</h3>

                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="select_term_hw_submitted">Term</label>
                                                    <select class="form-control" name="select_term_hw_submitted" id="select_term_hw_submitted">
                                                        <option selected disabled>Choose Here</option>
                                                            <option value="1st quarter">1st Quarter</option>
                                                            <option value="2nd quarter">2nd Quarter</option>
                                                            <option value="3rd quarter">3rd Quarter</option>
                                                            <option value="4th quarter">4th Quarter</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="select_class">Class:</label>
                                                    <select class="form-control" name="select_class" id="select_class">
                                                        <option selected disabled>Choose Subject</option>
                                                        <?php foreach($classes as $c):?>
                                                            <option value="<?= $c['subjectcode']?>"><?= $c['subject_name']?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row table-responsive" id="div_homework_info" style="display: none;">
                                            <div id="div_homework_info_inner">

                                            </div>
                                        </div>
                                    </div>

                                    <div id="overlay2" class="overlay" style="visibility: hidden;">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $('#reg_select_student_level').change(function(){
                    $('#search_by_level_response').css('display', 'none');
                    $('#overlay2').css('visibility', 'visible');
                    $.ajax({
                        url: "<?=site_url('admissions/search_student_by_level')?>",
                        data: {studentlevel : $('#reg_select_student_level').val()},
                        type: "post",
                        success: function(data){
                            if(data.response == "false") {

                            } else {
                                $('#overlay2').css('visibility', 'hidden');
                                $("#div_class_info").css('display', 'block');
                                $("#todo-list").html(data);
                            }
                        },
                    })
                    return false;
                })
            </script>

            <script>
                var selectClass1;
                var selectTerm1;
                $('#select_class').change(function(){
                    // $('#search_by_level_response').css('display', 'none');
                    selectClass1 = true;
                    selectTerm1 = true;
                    $('#overlay2').css('visibility', 'visible');
                    $.ajax({
                        url: "<?=site_url('activities/browse_submitted_homeworks_class')?>",
                        data: {selectClass : $('#select_class').val(), selectTerm : $('#select_term_hw_submitted').val()},
                        type: "post",
                        success: function(data){
                            if(data.response == "false") {

                            } else {
                                $('#overlay2').css('visibility', 'hidden');
                                $("#div_homework_info").css('display', 'block');
                                $("#div_homework_info_inner").html(data);
                            }
                        },
                    })
                    return false;
                })

                $('#select_term_hw_submitted').change(function(){
                    // $('#search_by_level_response').css('display', 'none');
                    selectTerm1 = true;
                    selectClass1 = false;
                    $('#select_class').prop('selectedIndex',0);
                    $('#select_class').val('');
                    $('#overlay2').css('visibility', 'visible');
                    $.ajax({
                        url: "<?=site_url('activities/browse_submitted_homeworks_term')?>",
                        data: {selectTerm : $('#select_term_hw_submitted').val()},
                        type: "post",
                        success: function(data){
                            if(data.response == "false") {

                            } else {
                                $('#overlay2').css('visibility', 'hidden');
                                $("#div_homework_info").css('display', 'block');
                                $("#div_homework_info_inner").html(data);
                            }
                        },
                    })
                    return false;
                })
            </script>
