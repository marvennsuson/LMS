<title><?= $title;?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Account Board</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>

                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-3">

                  <!-- Profile Image -->
                  <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                      <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                             src="<?= base_url('public/userlogo2.jpg');?>"
                             alt="User profile picture">
                      </div>

                      <h3 class="profile-username text-center">Nina Mcintire</h3>

                      <p class="text-muted text-center">Guardian</p>

                      <!-- <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <b>Followers</b> <a class="float-right">1,322</a>
                        </li>
                        <li class="list-group-item">
                          <b>Following</b> <a class="float-right">543</a>
                        </li>
                        <li class="list-group-item">
                          <b>Friends</b> <a class="float-right">13,287</a>
                        </li>
                      </ul> -->
<!--
                      <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->

                  <!-- About Me Box -->
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <strong><i class="fas fa-hard-hat mr-1"></i>Work</strong>
                      <p class="text-muted">
                          Construction Worker at JBLC Company
                      </p>

                      <hr>

                      <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>

                      <p class="text-muted">Malibu, California</p>

                      <hr>

                      <strong><i class="fas fa-phone-alt mr-1"></i>Mobile Number</strong>

                      <p class="text-muted">
                          09061429601
                      </p>

                      <hr>

                      <strong><i class="fas fa-envelope-open-text mr-1"></i>Email</strong>

                      <p class="text-muted">Myemail@example.com</p>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                  <div class="card">
                    <div class="card-header p-2">
                      <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>

                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                      </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                      <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                          <!-- Post -->
                          <div class="post">
                            <div class="user-block">
                              <img class="img-circle img-bordered-sm" src="<?= base_url('public/userlogo2.jpg');?>" alt="user image">
                              <span class="username">
                                <a href="#">Jonathan Burke Jr.</a>
                                <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                              </span>
                              <span class="description">Shared publicly - 7:30 PM today</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                      Proin eget tortor risus. Nulla porttitor accumsan tincidunt. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Donec rutrum congue leo eget malesuada.
                            </p>

                            <p>
                              <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                              <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                              <span class="float-right">
                                <a href="#" class="link-black text-sm">
                                  <i class="far fa-comments mr-1"></i> Comments (5)
                                </a>
                              </span>
                            </p>

                            <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                          </div>
                          <!-- /.post -->

                          <!-- Post -->
                          <div class="post clearfix">
                            <div class="user-block">
                              <img class="img-circle img-bordered-sm" src="<?= base_url('public/userlogo2.jpg');?>" alt="User Image">
                              <span class="username">
                                <a href="#">Sarah Ross</a>
                                <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                              </span>
                              <span class="description">Sent you a message - 3 days ago</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                        Proin eget tortor risus. Nulla porttitor accumsan tincidunt. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Donec rutrum congue leo eget malesuada.
                            </p>

                            <form class="form-horizontal">
                              <div class="input-group input-group-sm mb-0">
                                <input class="form-control form-control-sm" placeholder="Response">
                                <div class="input-group-append">
                                  <button type="submit" class="btn btn-danger">Send</button>
                                </div>
                              </div>
                            </form>
                          </div>
                          <!-- /.post -->

                          <!-- Post -->

                          <!-- /.post -->
                        </div>


                        <div class="tab-pane" id="settings">
                          <form class="form-horizontal">
                            <div class="form-group row">
                              <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                              <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputName" placeholder="Name">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                              <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="number" class="col-sm-2 col-form-label">Mobile Number</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="number" placeholder="Mobile">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="passs" class="col-sm-2 col-form-label">Password</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="passs" placeholder="Password">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="aadd" class="col-sm-2 col-form-label">Address</label>
                              <div class="col-sm-10">
                                <textarea id="aadd" name="name" class="form-control" rows="8" cols="80" placeholder="address"></textarea>
                              </div>
                            </div>

                            <div class="form-group row">
                              <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-danger btn-flat">Update Profile</button>
                              </div>
                            </div>
                          </form>
                        </div>
                        <!-- /.tab-pane -->
                      </div>
                      <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                  </div>
                  <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </section>
        </div>
    </div>
</div>
