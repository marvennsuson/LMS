            <title><?= $title;?></title>
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark"><?= $module;?></h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                                    <li class="breadcrumb-item active"><?= $module;?></li>
                                    <li class="breadcrumb-item active"><a href="<?= current_url();?>"><?=$function;?></a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title"><?=$function;?></h3>
                                    </div>

                                    <div class="card-body">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="input_search" id="input_search">
                                            <span class="input-group-append">
                                                <button type="button" class="btn bg-gradient-primary"><i class="fas fa-search"></i></button>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="overlay" style="visibility: hidden;">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                    
                                    <div class="card-body table-responsive p-0" id="div_searched_table" style="display: none;">
                                        <table class="table table-striped table-hover table-head-fixed text-nowrap" id="searched_table">
                                            
                                        </table>
                                    </div>

                                    <div class="card-body table-responsive p-0 w-100" id="div_admission_table">
                                        <table class="table  table-hover table-head-fixed text-nowrap w-100" max-height="400px" min-height="400px" id="admission_table">
                                            <?php if($admission_lists):?>  
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th></th>
                                                        <th>Student Type</th>
                                                        <th>Name</th>
                                                        <th>Admission Date</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php foreach($admission_lists as $al):?>
                                                        <tr>
                                                            <td><?=$al['admission_id'];?></td>
                                                            <td> <input type="checkbox" > </td>
                                                            <td><?=ucwords($al['student_type']);?></td>
                                                            <td><?=strtoupper($al['lastname']);?>, <?=strtoupper($al['firstname']);?> <?=strtoupper($al['middlename']);?></td>
                                                            <td><?=date('M d, Y', strtotime($al['created_at']));?></td>
                                                            <td>
                                                                <span class="badge <?php echo ($al['enrollment_process'] == 'registered') ? 'badge-success' : 'badge-warning' ?>">
                                                                    <?=ucwords($al['enrollment_process']);?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <?php if($al['enrollment_process'] != 'registered'):?>
                                                                    <a href="" id="btn_registration<?php echo $al['admission_id']?>"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#registration_view"><i style="font-size:14px;" class="fa fa-folder-plus"></i> Registration</button></a>
                                                                <?php endif;?>
                                                                <a href="" id="btn_read<?php echo $al['admission_id']?>"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#admission_view"><i style="font-size:14px;" class="fa fa-eye"></i> View</button></a>
                                                                <a href="" id="btn_delete<?php echo $al['admission_id']?>"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#admission_delete"><i style="font-size:14px;" class="fa fa-trash"></i> Delete</button></a>
                                                            </td>
                                                        </tr>

                                                        <script>
                                                            $(document).ready(function(){
                                                                $('#btn_registration<?php echo $al['admission_id']?>').on('click', function(){
                                                                    $('.overlay').css('visibility', 'visible');
                                                                    $.ajax({
                                                                        url: "<?=site_url('admissions/read_registration')?>",
                                                                        data:{ admission_id : '<?=$al['admission_id'];?>' },
                                                                        type: "post",
                                                                        success: function(data)
                                                                        {
                                                                            $('.overlay').css('visibility', 'hidden');
                                                                            $("#registration_view").modal('show');
                                                                            $("#registration_details").html(data);
                                                                        }
                                                                    })
                                                                    return false;
                                                                });
                                                            })

                                                            $(document).ready(function(){
                                                                $('#btn_read<?php echo $al['admission_id']?>').on('click', function(){
                                                                    $('.overlay').css('visibility', 'visible');
                                                                    $.ajax({
                                                                        url: "<?=site_url('admissions/read_admission')?>",
                                                                        data:{ admission_id : '<?=$al['admission_id'];?>' },
                                                                        type: "post",
                                                                        success: function(data)
                                                                        {
                                                                            $('.overlay').css('visibility', 'hidden');
                                                                            $("#admission_view").modal('show');
                                                                            $("#admission_details").html(data);
                                                                        }
                                                                    })
                                                                    return false;
                                                                });
                                                            })

                                                            $(document).ready(function(){
                                                                $('#btn_delete<?php echo $al['admission_id']?>').on('click', function(e){
                                                                    $('.overlay').css('visibility', 'visible');
                                                                    e.preventDefault();
                                                                    Swal.fire({
                                                                        title: 'Are you sure you want to delete <br> <?= strtoupper($al['firstname'])?> <?= strtoupper($al['middlename'])?> <?= strtoupper($al['lastname'])?> ?',
                                                                        text: "You won't be able to revert this!",
                                                                        type: 'warning',
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: '#d33',
                                                                        cancelButtonColor: '#3085d6',
                                                                        confirmButtonText: 'Yes, delete it!'
                                                                    }).then((result) => {
                                                                        if (result.value == true) {
                                                                            $.ajax({
                                                                                url: "<?=site_url('admissions/delete_admission')?>",
                                                                                data:{ admission_id : '<?=$al['admission_id'];?>' },
                                                                                type: "post",
                                                                                success: function(data)
                                                                                {
                                                                                    Swal.fire(
                                                                                        'Deleted!',
                                                                                        'Addmission by <?= strtoupper($al['firstname'])?> <?= strtoupper($al['middlename'])?> <?= strtoupper($al['lastname'])?> has been deleted.',
                                                                                        'info'
                                                                                    ).then((result) => {
                                                                                        location.reload();
                                                                                    })
                                                                                }
                                                                            })
                                                                        }
                                                                        $('.overlay').css('visibility', 'hidden');
                                                                    })
                                                                });
                                                            })
                                                        </script>
                                                    <?php endforeach;?>
                                                </tbody>

                                            <?php else:?>
                                                <div class="box-body">
                                                    <div class="card-body">
                                                        <div class="alert alert-warning alert-dismissible">
                                                            <h4><i class="fa fa-exclamation-triangle"></i> Alert!</h4>
                                                            No admission Available.
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif;?>
                                        </table>
                                    </div>

                                    <div class="modal fade" id="registration_view">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Registration</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body" id="registration_details" style="background: #fbfbfb;">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="admission_view">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Admission Details</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body" id="admission_details" style="background: #fbfbfb;">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer clearfix">
                                        <?= $links; ?>
                                    </div>

                                </div>

                            </div>

                            <div class="col-lg-4">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <script>
                $('.card-footer a').addClass('page-link');

                $('#input_search').keyup(function(){
                    if($('#input_search').val() == '' ){
                        $('#div_admission_table').css('display', 'block');
                        $('#div_searched_table').css('display', 'none');
                    } else {
                        $('#div_admission_table').css('display', 'none');
                        $('#div_searched_table').css('display', 'block');
                        $.ajax({
                            url: "<?=site_url('admission/search_admissionn')?>",
                            data: {searchItem : $('#input_search').val()},
                            type: "post",
                            success: function(data){
                                if(data.response == "false") {
                                } else {
                                    $("#searched_table").html(data);
                                }
                            },
                        })
                        return false;
                    }
                })
            </script>