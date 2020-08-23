<div class="col-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header d-flex p-0">
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
                    <?= $this->load->view('homework/homework_sent/quarter1_hw_sent');?>
                </div>
                
                <div class="tab-pane" id="quarter2">
                    <?= $this->load->view('homework/homework_sent/quarter2_hw_sent');?>
                </div>
                
                <div class="tab-pane" id="quarter3">
                    <?= $this->load->view('homework/homework_sent/quarter3_hw_sent');?>
                </div>

                <div class="tab-pane" id="quarter4">
                    <?= $this->load->view('homework/homework_sent/quarter4_hw_sent');?>
                </div>
            </div>
        </div>
        <div id="overlaySentHW" class="overlay" style="visibility: hidden;">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
    </div>
</div>