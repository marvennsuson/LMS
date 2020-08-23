<title><?= $title;?></title>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">School Fee's Board</h1>
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
                  <div class="card-title">
                      School Fee's
                  </div>
              </div>
              <div class="card-body">
                <table id="table_school_fees" class="table table-sm table-hover ">
                    <thead>
                        <th>Student Name</th>
                        <th>Bill</th>
                        <th>Description</th>
                        <th>Action </th>
                    </thead>
                    <tbody>
                      <?php
                        if ($student_fees) {
                          foreach ($student_fees as $sf) {
                            ?>
                            <tr>
                              <td><?php echo $sf['firstname'] . ' '. $sf['middlename'] . ' ' .$sf['lastname']; ?></td>
                              <td><?php echo $sf['file']; ?></td>
                              <td><?php echo $sf['description']; ?></td>
                              <td><button id = "btn_read_bill" name = "btn_read_bill" data-classid = "<?php echo $sf['file']; ?>" class = "btn btn-sm btn-success">Read</button></td>
                            </tr>
                            <?php
                          }
                        }else{


                        }
                      ?>
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">


  $('#btn_read_bill').click(function () {
  
    var file = $(this).data('classid');
    // console.log(file);
    window.open('<?=site_url('parent/schoolfee_controller/read_pdf')?>?file='+file);
    
  });
</script>
