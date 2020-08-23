<title><?= $title;?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Grade Reports Board</h1>
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
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">DataTable with minimal features & hover style</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Student Number</th>
                  <th>Name</th>
                  <th>Subjects</th>
                  <th>Percentage</th>
                  <th>Result</th>
                  <th>Grade</th>
                  <th>Rank</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>2020-00136</td>
                    <td>Juan Dela Cruz</td>
                    <td>English</td>
                    <td>65.5</td>
                    <td>FAILED</td>
                    <td>C-</td>
                    <td></td>
                    </tr>

                    <tr>
                    <td>2020-00136</td>
                    <td>Juan Dela Cruz</td>
                    <td>Math</td>
                    <td>75.5</td>
                    <td>PASSED</td>
                    <td>C+</td>
                    <td></td>
                    </tr>

                    <tr>
                    <td>2020-00136</td>
                    <td>Juan Dela Cruz</td>
                    <td>Science</td>
                    <td>85.5</td>
                    <td>PASSED</td>
                    <td>B+</td>
                    <td></td>
                    </tr>

                    <tr>
                    <td>2020-00136</td>
                    <td>Juan Dela Cruz</td>
                    <td>MAPEH</td>
                    <td>80.0</td>
                    <td>PASSED</td>
                    <td>B</td>
                    <td></td>
                    </tr>

                    <tr>
                    <td>2020-00136</td>
                    <td>Juan Dela Cruz</td>
                    <td>FILIPINO</td>
                    <td>90.5</td>
                    <td>PASSED</td>
                    <td>A-</td>
                    <td></td>
                    </tr>

                </tbody>

              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function () {
  $("#example2").DataTable();
  // $('#example2').DataTable({
  //   "paging": true,
  //   "lengthChange": false,
  //   "searching": false,
  //   "ordering": true,
  //   "info": true,
  //   "autoWidth": false,
  // });
});
</script>
