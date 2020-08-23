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
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex p-0">
                                    <h3 class="card-title p-3"><i class="fas fa-list-ol"></i> Test Result</h3>
                                    <ul class="nav nav-pills ml-auto p-2">
                                        <li class="nav-item"><a class="nav-link active" href="#quarter1" data-toggle="tab">1st Quarter</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#quarter2" data-toggle="tab">2nd Quarter</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#quarter3" data-toggle="tab">3rd Quarter</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#quarter4" data-toggle="tab">4th Quarter</a></li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="quarter1">
                                            <?= $this->load->view('test_result/quarter1/test_index_q1');?>
                                        </div>

                                        <div class="tab-pane" id="quarter2">
                                            <?= $this->load->view('test_result/quarter2/test_index_q2');?>
                                        </div>

                                        <div class="tab-pane" id="quarter3">
                                            <?= $this->load->view('test_result/quarter3/test_index_q3');?>
                                        </div>
                                        <div class="tab-pane" id="quarter4">
                                            <?= $this->load->view('test_result/quarter4/test_index_q4');?>
                                        </div>
                                    </div>
                                </div>
                                <div class="overlay" style="visibility: hidden;">
                                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
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
            </script>
