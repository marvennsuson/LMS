        <title><?= $title;?></title>
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">Online Test</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                                    <li class="breadcrumb-item active">Test</li>
                                    <li class="breadcrumb-item active"><a href="<?= current_url();?>">Online Test</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-5 col-sm-2">
                                        <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                            <?php foreach($classes as $c):?>
                                                <a class="nav-link" id="<?= $c['subjectcode']?>-tab" data-toggle="pill" href="#<?= $c['subjectcode']?>" role="tab" aria-controls="<?= $c['subjectcode']?>" aria-selected="true"><i class="fas fa-book mr-1"></i> <?= $c['subject_name']?> <p class="text-muted"><?= $c['name']?></p></a>
                                            <?php endforeach;?>
                                        </div>
                                    </div>
                                    <div class="col-7 col-sm-10">
                                        <div class="tab-content" id="vert-tabs-tabContent">
                                            <?php foreach($classes as $c):?>
                                                <div class="tab-pane fade" id="<?= $c['subjectcode']?>" role="tabpanel" aria-labelledby="<?= $c['subjectcode']?>-tab">
                                                    <div class="card card-primary card-tabs">
                                                        <div class="card-header">
                                                            <h5 class="card-title"><?= $c['subject_name']?></h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12 col-md-6 col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="select_term<?= $c['subjectcode']?>">Term:</label>
                                                                        <select class="form-control" name="select_term<?= $c['subjectcode']?>" id="select_term<?= $c['subjectcode']?>">
                                                                            <option selected disabled></option>
                                                                            <option value="1st quarter">1st Quarter</option>
                                                                            <option value="2nd quarter">2nd Quarter</option>
                                                                            <option value="3rd quarter">3rd Quarter</option>
                                                                            <option value="4th quarter">4th Quarter</option>
                                                                        </select>
                                                                    </div>
                                                                    <script>
                                                                        $('#select_term<?= $c['subjectcode']?>').change(function(){
                                                                            $('#div_type<?= $c['subjectcode']?>').css('display', 'block');
                                                                            $('#select_type<?= $c['subjectcode']?>').prop('selectedIndex',0);
                                                                        })
                                                                    </script>
                                                                </div>
                                                                <div class="col-12 col-md-6 col-lg-6" id="div_type<?= $c['subjectcode']?>" style="display: none">
                                                                    <div class="form-group">
                                                                        <label for="select_type<?= $c['subjectcode']?>">Type:</label>
                                                                        <select class="form-control" name="select_type<?= $c['subjectcode']?>" id="select_type<?= $c['subjectcode']?>">
                                                                            <option selected disabled></option>
                                                                            <option value="quiz">Quiz</option>
                                                                            <option value="exam">Exam</option>
                                                                            <option value="final exam">Final Exam</option>
                                                                        </select>
                                                                    </div>
                                                                    <script>
                                                                        $('#select_type<?= $c['subjectcode']?>').change(function(){
                                                                            $('.overlay').css('visibility', 'visible');
                                                                            $.ajax({
                                                                                url: "<?=site_url('exam/browse_exam_by_subject')?>",
                                                                                data: {selectTerm : $('#select_term<?= $c['subjectcode']?>').val(), selectType : $('#select_type<?= $c['subjectcode']?>').val(), subjectcode : '<?= $c['subjectcode']?>' },
                                                                                type: "post",
                                                                                success: function(data){
                                                                                    if(data.response == "false") {

                                                                                    } else {
                                                                                        $('.overlay').css('visibility', 'hidden');
                                                                                        // $("#div_class_info").css('display', 'block');
                                                                                        $("#browsed_exam_body<?= $c['subjectcode']?>").html(data);
                                                                                    }
                                                                                },
                                                                            })
                                                                            return false;
                                                                        })
                                                                    </script>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-12 col-md-12 col-lg-12">
                                                                    <div id="browsed_exam_body<?= $c['subjectcode']?>">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="overlay" style="visibility: hidden;">
                                                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach;?>
                              
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function(){
                    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                        localStorage.setItem('activeTab', $(e.target).attr('href'));
                    });
                    var activeTab = localStorage.getItem('activeTab');
                    if(activeTab){
                        $('#my_account_tabs a[href="' + activeTab + '"]').tab('show');
                    }
                });
                
                // $.ajaxSetup({ cache: false });
                //     setInterval(function() {
                //     $("#online_tests").load(location.href + " #online_tests");
                // }, 2000);

            </script>