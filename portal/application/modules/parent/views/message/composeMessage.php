<title><?= $title;?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Notification Board</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                        <li class="breadcrumb-item active"><a href="<?= current_url();?>">Notification Board</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">



          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-3">
                  <a href="<?= site_url('parent/Message_controller');?>" class="btn btn-primary btn-block mb-3">Back to Inbox</a>

                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Folders</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body p-0">
                      <ul class="nav nav-pills flex-column">
                        <li class="nav-item active">
                          <a href="<?= site_url('parent/Message_controller');?>" class="nav-link">
                            <i class="fas fa-inbox"></i> Inbox
                            <span class="badge bg-success float-right">12</span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            <i class="far fa-envelope"></i> Sent
                              <span class="badge bg-warning float-right">12</span>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            <i class="far fa-trash-alt"></i> Trash
                              <span class="badge bg-danger float-right">12</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <!-- /.card-body -->
                  </div>

                  <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                  <div class="card card-primary card-outline">
                    <div class="card-header">
                      <h3 class="card-title">Compose New Message</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="form-group">
                        <input class="form-control" placeholder="To:">
                      </div>
                      <div class="form-group">
                        <input class="form-control" placeholder="Subject:">
                      </div>
                      <div class="form-group">
                          <textarea id="compose_textarea" class="form-control" style="height: 300px">

                          </textarea>
                      </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <div class="float-right">

                        <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                      </div>

                    </div>
                    <!-- /.card-footer -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </section>

        </div>
    </div>
</div>
