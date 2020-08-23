            <title><?= $title;?></title>
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">E-Books</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                                    <li class="breadcrumb-item active">E-Learning</li>
                                    <li class="breadcrumb-item active"><a href="<?= current_url();?>">E-Books</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="sidebar" style="height: 30em">
                                    <nav class="mt-2">
                                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                            <!-- Filipino 1-->
                                            <li class="nav-item has-treeview">
                                                <a href="#" class="nav-link">
                                                    <i class="nav-icon fas fa-file-alt"></i>
                                                    <p>Filipino 1</p>
                                                </a>
                                            </li>
                                            <!-- Filipino 2-->
                                            <li class="nav-item has-treeview">
                                                <a href="#" class="nav-link">
                                                    <i class="nav-icon fas fa-file-alt"></i>
                                                    <p>Filipino 2</p>
                                                </a>
                                            </li>
                                            <!-- English 1-->
                                            <li class="nav-item has-treeview">
                                                <a href="#" class="nav-link">
                                                    <i class="nav-icon fas fa-file-alt"></i>
                                                    <p>English 1</p>
                                                </a>
                                            </li>
                                            <!-- English 2-->
                                            <li class="nav-item has-treeview">
                                                <a href="#" class="nav-link">
                                                    <i class="nav-icon fas fa-file-alt"></i>
                                                    <p>English 2</p>
                                                </a>
                                            </li>
                                            <!-- Math 1-->
                                            <li class="nav-item has-treeview">
                                                <a href="#" class="nav-link">
                                                    <i class="nav-icon fas fa-file-alt"></i>
                                                    <p>Math 1</p>
                                                </a>
                                            </li>
                                            <!-- Math 2-->
                                            <li class="nav-item has-treeview">
                                                <a href="#" class="nav-link">
                                                    <i class="nav-icon fas fa-file-alt"></i>
                                                    <p>Math 2</p>
                                                </a>
                                            </li>
                                            <!-- TLE 1-->
                                            <li class="nav-item has-treeview">
                                                <a href="#" class="nav-link">
                                                    <i class="nav-icon fas fa-file-alt"></i>
                                                    <p>TLE 1</p>
                                                </a>
                                            </li>
                                            <!-- TLE 2-->
                                            <li class="nav-item has-treeview">
                                                <a href="#" class="nav-link">
                                                    <i class="nav-icon fas fa-file-alt"></i>
                                                    <p>TLE 2</p>
                                                </a>
                                            </li>
                                            <!-- Science 1-->
                                            <li class="nav-item has-treeview">
                                                <a href="#" class="nav-link">
                                                    <i class="nav-icon fas fa-file-alt"></i>
                                                    <p>Science 1</p>
                                                </a>
                                            </li>
                                            <!-- Science 2-->
                                            <li class="nav-item has-treeview">
                                                <a href="#" class="nav-link">
                                                    <i class="nav-icon fas fa-file-alt"></i>
                                                    <p>Science 2</p>
                                                </a>
                                            </li>
                                            <!-- Arts 1-->
                                            <li class="nav-item has-treeview">
                                                <a href="#" class="nav-link">
                                                    <i class="nav-icon fas fa-file-alt"></i>
                                                    <p>Arts 1</p>
                                                </a>
                                            </li>
                                            <!-- Arts 2-->
                                            <li class="nav-item has-treeview">
                                                <a href="#" class="nav-link">
                                                    <i class="nav-icon fas fa-file-alt"></i>
                                                    <p>Arts 2</p>
                                                </a>
                                            </li>

                                        </ul>
                                    </nav>
                                </div>
                            </div>

                            <div class="col-lg-9">
                                <div class="card card-dark">
                                    <div class="card-header">
                                        <h3 class="card-title">Modules</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                        <table class="table table-sm table-striped">
                                            <thead>
                                                <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Title</th>
                                                <th>Filename</th>
                                                <th>Availability</th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>Reading Module</td>
                                                    <td><a href="#">reading.pdf</a></td>
                                                    <td>Paid</td>
                                                    <td><a href="#"><a href="#"><a href="#"><span class="badge bg-success">Download</span></a></td>
                                                </tr>

                                                <tr>
                                                    <td>2.</td>
                                                    <td>Writing Module</td>
                                                    <td><a href="#">writing.docx</a></td>
                                                    <td>Free</td>
                                                    <td><a href="#"><a href="#"><span class="badge bg-success">Download</span></a></td>
                                                </tr>

                                                <tr>
                                                    <td>3.</td>
                                                    <td>History Module</td>
                                                    <td><a href="#">history.png</a></td>
                                                    <td>Paid</td>
                                                    <td><a href="#"><a href="#"><span class="badge bg-success">Download</span></a></td>
                                                </tr>

                                                <tr>
                                                    <td>4.</td>
                                                    <td>Other modules</td>
                                                    <td><a href="#">video-tutorial.mp4</a></td>
                                                    <td>Free</td>
                                                    <td><a href="#"><a href="#"><span class="badge bg-success">Download</span></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>


                            <?php if($this->session->role_id == 2): ?>
                              <div class="container mt-5 ">
              	<div class="row justify-content-center">
              		<div class="row ">
                          <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                <strong> Modules 1</strong>
                              <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                                 data-image="<?= base_url('/public/images/folder.png');?>"
                                 data-target="#image-gallery">
                                  <img class="img-thumbnail"
                                       src="<?= base_url('/public/images/folder.png');?>"
                                       alt="Another alt text">
                              </a>
                          </div>
                          <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                <strong> Modules 2</strong>
                              <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                                 data-image="<?= base_url('/public/images/folder.png');?>"
                                 data-target="#image-gallery2">
                                  <img class="img-thumbnail"
                                     src="<?= base_url('/public/images/folder.png');?>"
                                       alt="Another alt text">
                              </a>
                          </div>

                          <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                <strong> Modules 3</strong>
                              <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                                 data-image="h<?= base_url('/public/images/folder.png');?>"
                                 data-target="#image-gallery3">
                                  <img class="img-thumbnail"
                                         src="<?= base_url('/public/images/folder.png');?>"
                                       alt="Another alt text">
                              </a>
                          </div>
                      </div>


                      <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-xl">
                              <div class="modal-content">
                                  <div class="modal-header">
                                    <div class="mr-auto">
                                            <div class="row">
                                                    <div class="col-sm-4">
                                                      <div class="form-group">
                                                        <select id="school_lvl" name="school_lvl"  class="custom-select  custom-select-md mb-1">
                                                            <option name="school_lvl" selected>Select by School Level</option>
                                                                <?php if ($school_lvl->num_rows() > 0): ?>
                                                                        <?php foreach ($school_lvl->result() as  $sch_value): ?>
                                                                              <option name="school_lvl" value="<?= $sch_value->school_lvl_id; ?>"><?= $sch_value->School_lvl_name; ?></option>
                                                                        <?php endforeach; ?>
                                                                <?php endif; ?>
                                                          </select>
                                                      </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                          <select  name="year_lvl" id="year_lvl" class="custom-select  custom-select-md mb-1">
                                                            <option value="">Select by Year Level</option>
                                                          </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                          <select name="bysection" id="bysection" class="custom-select  custom-select-md mb-1">
                                                              <option value="">By Section</option>
                                                          </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                          <select name="subjcode" id="subjcode" class="custom-select  custom-select-md mb-1">
                                                              <option value="">by Subject Code</option>
                                                          </select>
                                                        </div>
                                                    </div>


                                            </div>
                                    </div>
                                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                                <table class="table table-sm table-borderedless">
                                                      <thead>
                                                        <tr>
                                                          <th>#</th>
                                                          <th>Title</th>
                                                          <th>Language</th>
                                                          <th>Resource Type</th>
                                                          <th  >Action</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                      <?php if ($row->num_rows() > 0): ?>
                                                        <?php foreach ($row->result() as  $value): ?>
                                                              <tr>
                                                                <td>  <?= $value->ebook_id?>  </td>
                                                                  <td>  <?= $value->filename?>  </td>
                                                                  <td>  Null  </td>
                                                                    <td> Null  </td>
                                                                      <td> <a href="#"> <i class="fas fa-eye" title="View Now"></i></a>  | <a href="#"><i class="fas fa-cloud-download-alt" title="Download Now"></i></a> | <label for=""> <input class=" mr-2 ml-2" type="checkbox"  title=" Assign To"name="" value=""> </label> </td>
                                                            </tr>
                                                      <?php endforeach; ?>
                                                    <?php endif; ?>
                                                      </tbody>
                                                </table>
                                  </div>
                                  <div class="modal-footer">


                                      <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                                      </button>
                                  </div>
                              </div>
                          </div>
                      </div>
              	</div>
              </div>
                      <?php endif; ?>
                    </div>
                </div>
            </div>


<script type="text/javascript">
$(document).ready(function(){
    /* Populate data to state dropdown */
    $('#school_lvl').on('change',function(){
        var schID = $(this).val();

        if(schID){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url('elearning/Elearning/Getyearlvl'); ?>',
                data:'schID=' + schID,

                success:function(data){

                    $('#year_lvl').html('<option value="">Select by Year Level</option>');
                    var dataObj = jQuery.parseJSON(data);
                    if(dataObj){
                        $(dataObj).each(function(){
                            var option = $('<option />');
                            option.attr('value', this.year_lvl_id).text(this.year_lvl_name);
                            $('#year_lvl').append(option);
                        });
                    }else{
                        $('#year_lvl').html('<option value="">Year LvL Not Available</option>');
                    }
                }

            });
        }else{
            // $('#state').html('<option value="">Select country first</option>');
            // $('#city').html('<option value="">Select state first</option>');
        }
    });


    /* Populate data to city dropdown */
$('#year_lvl').on('change',function(){
    var yearlvlID = $(this).val();
    if(yearlvlID){
        $.ajax({
            type:'POST',
            url:'<?php echo base_url('elearning/Elearning/Getyearbysec'); ?>',
            data:'yearlvlID='+yearlvlID,
            success:function(data){
                $('#bysection').html('  <option value="">By Section</option>');
                var dataObj = jQuery.parseJSON(data);
                if(dataObj){
                    $(dataObj).each(function(){
                        var option = $('<option />');
                        option.attr('value', this.section_id).text(this.section_name);
                        $('#bysection').append(option);
                    });
                }else{
                    // $('#city').html('<option value="">City not available</option>');
                }
            }
        });
    }else{
        // $('#city').html('<option value="">Select state first</option>');
    }
});


$('#bysection').on('change',function(){
    var BysubjCode = $(this).val();
    if(BysubjCode){
        $.ajax({
            type:'POST',
            url:'<?php echo base_url('elearning/Elearning/GetbySubjcode'); ?>',
            data:'BysubjCode='+BysubjCode,
            success:function(data){
                $('#subjcode').html('<option value="">by Subject Code</option>');
                var dataObj = jQuery.parseJSON(data);
                if(dataObj){
                    $(dataObj).each(function(){
                        var option = $('<option />');
                        option.attr('value', this.subject_id).text(this.subject_name);
                        $('#subjcode').append(option);
                    });
                }else{
                    // $('#city').html('<option value="">City not available</option>');
                }
            }
        });
    }else{
        // $('#city').html('<option value="">Select state first</option>');
    }
});



});

</script>
