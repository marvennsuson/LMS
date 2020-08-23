
<title><?= $title;?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Profile DashBoard</h1>
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

          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-3">
                    <?php if($GetInfo->num_rows() > 0): ?>
                    <?php foreach($GetInfo->result() as $GetInfo_row ): ?>
                    <div class="card card-primary card-outline">
                      <div class="card-body box-profile">
                        <div class="text-center">
                          <img class="profile-user-img img-fluid img-circle"
                               src="<?= base_url('public/userlogo2.jpg');?>"
                               alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?= htmlentities(ucfirst($GetInfo_row->name)); ?></h3>

                        <p class="text-muted text-center"><?= htmlentities(ucfirst($GetInfo_row->role_display_name)); ?></p>


                      </div>
                      <!-- /.card-body -->
                    </div>
                  <?php endforeach; ?>
                  <?php endif; ?>


                  <!-- About Me Box -->
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <?php if($GetInfo->num_rows() > 0): ?>
                      <?php foreach($GetInfo->result() as $GetInfo_row ): ?>
                        <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                          <p class="text-muted"><?= $GetInfo_row->email  ?></p>
                        <hr>

                        <strong>Gender</strong>
                        <p class="text-muted"><?= $GetInfo_row->gender  ?></p>
                        <hr>

                        <strong><i class="fas fa-calendar mr-1"></i>Birthdate</strong>
                        <p class="text-muted"><?= $GetInfo_row->birthday  ?></p>
                        <hr>
                        <strong><i class="fas fa-book mr-1"></i> Education</strong>

                        <p class="text-muted">
                        B.S. in Computer Science from the University of Tennessee at Knoxville
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>

                        <p class="text-muted"><?= $GetInfo_row->address  ?></p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                        <p class="text-muted">
                        <span class="tag tag-danger">UI Design</span>
                        <span class="tag tag-success">Coding</span>
                        <span class="tag tag-info">Javascript</span>
                        <span class="tag tag-warning">PHP</span>
                        <span class="tag tag-primary">Node.js</span>
                        </p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                    <?php endforeach; ?>
                    <?php endif; ?>
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
                        <li class="nav-item"><a class="nav-link " href="#class" data-toggle="tab">My Class</a></li>
                        <li class="nav-item"><a class="nav-link" href="#changepass" data-toggle="tab">Change Password</a></li>
                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Profile Update</a></li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline FeedBack</a></li>
                      </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                      <div class="tab-content">
                        <div class=" tab-pane" id="class">
                            <?= $this->load->view('Tabview/Class');?>
                        </div>
                          <div class="tab-pane " id="changepass">
                            <?= $this->load->view('Tabview/changepassword');?>
                          </div>
                        <div class="tab-pane" id="settings">
                            <?= $this->load->view('Tabview/Settings');?>
                        </div>
                        <div class="tab-pane" id="timeline">
                            <?= $this->load->view('Tabview/Timeline');?>
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
<script type="text/javascript">
$(document).ready(function(){
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
});

var activeTab = localStorage.getItem('activeTab');
if(activeTab){
    $('.nav-pills a[href="' + activeTab + '"]').tab('show');
}
});

$('#changepasswordtecher').submit(function(e){
  e.preventDefault();
   var fa = $(this);

    $.ajax({
      url: fa.attr('action'),
      type: 'post' ,
      // dataType: 'json',
      data: fa.serialize(),

      success: function (data) {
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })

        Toast.fire({
          icon: 'success',
          title: 'Updating Record'
        }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    window.location.href='<?= current_url(); ?>';
                }
            });

           },
           error: function (data) {
      alert('Something was Wrong');
           },

   });

});


$('#ProfileUpdate').submit(function(e){

e.preventDefault();
 var fa = $(this);

  $.ajax({
    url: fa.attr('action'),
    type: 'post' ,
    data: fa.serialize(),
    dataType: 'json',
    success: function(dataType) {

    }

 });
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })

          Toast.fire({
            icon: 'success',
            title: 'Updating Record'
          }).then((result) => {
                  if (result.dismiss === Swal.DismissReason.timer) {
                      window.location.href='<?//= current_url(); ?>';
                  }
              });

});
</script>
