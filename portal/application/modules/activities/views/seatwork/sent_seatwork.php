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
                    <?= $this->load->view('seatwork/seatwork_sent/quarter1_sw_sent');?>
                </div>

                <div class="tab-pane" id="quarter2">
                    <?= $this->load->view('seatwork/seatwork_sent/quarter2_sw_sent');?>
                </div>

                <div class="tab-pane" id="quarter3">
                    <?= $this->load->view('seatwork/seatwork_sent/quarter3_sw_sent');?>
                </div>

                <div class="tab-pane" id="quarter4">
                    <?= $this->load->view('seatwork/seatwork_sent/quarter4_sw_sent');?>
                </div>
            </div>
        </div>
        <div id="overlaySentSW" class="overlay" style="visibility: hidden;">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });

    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('.nav-pills a[href="' + activeTab + '"]').tab('show');
    }
</script>
