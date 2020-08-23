                        
                        <div class="card card-primary card-outline card-outline-tabs">

                            <div class="card-header p-0 border-bottom-0">
                                <!-- <ul class="nav nav-tabs" id="exam_body_tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tab_exam_body_create" data-toggle="tab" href="#tab_exam_body_create" role="tab" aria-controls="tab_exam_body_create" aria-selected="true">Create Exam Body</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab_exam_body_list" data-toggle="tab" href="#tab_exam_body_list" role="tab" aria-controls="tab_exam_body_list" aria-selected="false">Exam Body Lists</a>
                                    </li>
                                </ul> -->
                                <ul class="nav nav-tabs" id="exam_body_tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tab_exam_body_create" role="tab" aria-controls="tab_exam_body_create" aria-selected="true">Create Exam Body</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab_exam_body_list" role="tab" aria-controls="tab_exam_body_list" aria-selected="false">Exam Body Lists</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <div class="tab-content">
                                    <div id="tab_exam_body_create" class="tab-pane fade show active">
                                        <?= $this->load->view('create_exam_body');?>  </div>
                                    <div id="tab_exam_body_list" class="tab-pane fade">
                                        <?= $this->load->view('exam_body_list');?>    
                                    </div>
                                </div>


                                <!-- <div class="tab-content" id="exam_body_tabContent">
                                    <div class="tab-pane fade show active" id="tab_exam_body_create" role="tabpanel" aria-labelledby="tab_exam_body_create">
                                          
                                    </div>
                                    <div class="tab-pane fade" id="tab_exam_body_list" role="tabpanel" aria-labelledby="tab_exam_body_list">
                                        
                                    </div>
                                </div> -->
                            </div>
                            <div class="overlay" style="visibility: hidden;">
                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                            </div>

                        </div>

                        <script>
                            $(document).ready(function(){
                                $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                                    localStorage.setItem('activeTab', $(e.target).attr('href'));
                                });
                                var activeTab = localStorage.getItem('activeTab');
                                if(activeTab){
                                    $('#exam_body_tabs a[href="' + activeTab + '"]').tab('show');
                                }
                            });
                        </script>

                        <!-- <script>
                            // $(document).ready(function(){
                                // $('li > #tab_exam_body_create').addClass('active')
                                // $('div > #tab_exam_body_create').addClass('show active');
                                var activeTab;
                                $('li > #tab_exam_body_create').click(function(){
                                    localStorage.setItem('activeTab',  $('div > #tab_exam_body_create'));
                                    activeTab = localStorage.getItem('activeTab');
                                    if(activeTab == $('div > #tab_exam_body_create')){
                                        $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
                                        $('li > #tab_exam_body_create').addClass('active')
                                        $('div > #tab_exam_body_create').addClass('show active');
                                        $('li > #tab_exam_body_list').removeClass('active');
                                        $('div > #tab_exam_body_list').removeClass('show active');
                                    }
                                    // $('li > #tab_exam_body_create').addClass('active')
                                    // $('div > #tab_exam_body_create').addClass('show active');

                                    // $('li > #tab_exam_body_list').removeClass('active');
                                    // $('div > #tab_exam_body_list').removeClass('show active');
                                })

                                $('li > #tab_exam_body_list').click(function(){
                                    localStorage.setItem('activeTab',  $('div > #tab_exam_body_create'));
                                    activeTab = localStorage.getItem('activeTab');
                                    if(activeTab == $('div > #tab_exam_body_list')){
                                        $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
                                        $('li > #tab_exam_body_list').addClass('active')
                                        $('div > #tab_exam_body_list').addClass('show active');
                                        $('li > #tab_exam_body_create').removeClass('active')
                                        $('div > #tab_exam_body_create').removeClass('show active');
                                    }
                                    // $('li > #tab_exam_body_list').addClass('active');
                                    // $('div > #tab_exam_body_list').addClass('show active');

                                    // $('li > #tab_exam_body_create').removeClass('active')
                                    // $('div > #tab_exam_body_create').removeClass('show active');
                                })
                            // })
                        </script> -->

                        
                                        
