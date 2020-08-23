<title><?= $title;?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Message Board</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                        <li class="breadcrumb-item active">Message Dashboard</li>
                        <!-- <li class="breadcrumb-item active"><a href="">Notification Board</a></li> -->
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
          <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <ul class="nav nav-pills p-2" id="myTab" role="tablist">
                                <li class="nav-item"><a class="nav-link" id="Compose-tab" data-toggle="tab" href="#Compose" role="tab" aria-controls="Compose" aria-selected="true">Compose</a></li>
                                <li class="nav-item"><a class="nav-link" id="Inbox-tab" data-toggle="tab" href="#Inbox" role="tab" aria-controls="Inbox" aria-selected="false">Inbox</a></li>
                                <li class="nav-item"><a class="nav-link" id="sentmessage-tab" data-toggle="tab" href="#sentmessage" role="tab" aria-controls="sentmessage" aria-selected="false">Sent Message</a></li>
                            </ul>
                        </div>


                                    <div class="tab-content mb-4 card p-4">
                                        <div class="tab-pane fade show  active" id="Compose" role="tabpanel" aria-labelledby="Compose-tab">
                                                <?= $this->load->view('Teacher/teacher_compose'); ?>
                                        </div>
                                        <div class="tab-pane fade" id="Inbox" role="tabpanel" aria-labelledby="Inbox-tab">
                                                  <?= $this->load->view('Teacher/teacher_inbox'); ?>
                                        </div>
                                        <div class="tab-pane fade" id="sentmessage" role="tabpanel" aria-labelledby="sentmessage-tab">
                                                <?= $this->load->view('Teacher/teacher_sent'); ?>
                                        </div>
                                    </div>
                    </div>



          </div>

        </div>
    </div>
</div>


<script type="text/javascript" >
$('#myTab  a').click(function(e) {
  e.preventDefault();
  $(this).tab('show');
});
$("ul.nav-tabs#myTab > li > a").on("shown.bs.tab", function(e) {
  var id = $(e.target).attr("href");
  localStorage.setItem('selectedTab', id)
});
var selectedTab = localStorage.getItem('selectedTab');
$('#myTab a[href="' + selectedTab + '"]').tab('show');


</script>
