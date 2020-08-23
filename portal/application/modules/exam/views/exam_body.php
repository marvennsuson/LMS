            <style>
                body{
                    padding-top: 0 !important;
                    padding-bottom: 0 !important;
                }
            </style>
            <title><?= $title;?></title>
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">Test Body</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                    <li class="breadcrumb-item active"><a href="<?= current_url();?>">Test Body</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <?= $this->load->view('exam_body_menu');?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            