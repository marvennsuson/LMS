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
                        <div class="col-12 col-sm-8 col-md-8 col-lg-8">
                            <div class="card">
                                <div class="card-header d-flex p-0">
                                    <h3 class="card-title p-3"><i class="fas fa-pencil-alt"></i> Seatworks</h3>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="select_term">Term</label>
                                                <select class="form-control" name="select_term" id="select_term">
                                                    <option selected disabled></option>
                                                        <option value="1st quarter">1st Quarter</option>
                                                        <option value="2nd quarter">2nd Quarter</option>
                                                        <option value="3rd quarter">3rd Quarter</option>
                                                        <option value="4th quarter">4th Quarter</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="select_class">Class</label>
                                                <select class="form-control" name="select_class" id="select_class">
                                                    <option selected disabled></option>
                                                    <?php foreach($classes as $c):?>
                                                        <option value="<?= $c['subjectcode']?>"><?= $c['subject_name']?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row table-responsive" id="div_seatwork_info" style="display: none;">
                                        <div id="div_seatwork_info_inner">

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
                $('#select_class').change(function(){
                    // $('#search_by_level_response').css('display', 'none');
                    $('.overlay').css('visibility', 'visible');
                    $.ajax({
                        url: "<?=site_url('activities/browse_seatworks_stud_class')?>",
                        data: {selectClass : $('#select_class').val(), selectTerm : $('#select_term').val()},
                        type: "post",
                        success: function(data){
                            if(data.response == "false") {

                            } else {
                                $('.overlay').css('visibility', 'hidden');
                                $("#div_seatwork_info").css('display', 'block');
                                $("#div_seatwork_info_inner").html(data);
                            }
                        },
                    })
                    return false;
                })

                $('#select_term').change(function(){
                    // $('#search_by_level_response').css('display', 'none');
                    $('.overlay').css('visibility', 'visible');
                    $.ajax({
                        url: "<?=site_url('activities/browse_seatworks_stud_term')?>",
                        data: {selectTerm : $('#select_term').val()},
                        type: "post",
                        success: function(data){
                            if(data.response == "false") {

                            } else {
                                $('.overlay').css('visibility', 'hidden');
                                $("#div_seatwork_info").css('display', 'block');
                                $("#div_seatwork_info_inner").html(data);
                            }
                        },
                    })
                    return false;
                })
            </script>
