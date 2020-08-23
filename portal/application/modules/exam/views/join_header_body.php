            <title><?= $title;?></title>
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">Join Test Header and Test Body</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                                    <li class="breadcrumb-item active">Test</li>
                                    <li class="breadcrumb-item active"><a href="<?= current_url();?>">Join Test Header and Test Body</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Create Test</h3>
                                    </div>

                                    <div class="card-body table-responsive" style="height: 500px;">
                                        <form id="form_join_exam_header_body">
                                            <div class="row">
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="select_exam_header">Test Header:</label>
                                                        <select class="form-control" name="select_exam_header" id="select_exam_header">
                                                            <option selected disabled></option>
                                                            <?php foreach($all_exam_header as $axh):?>
                                                                <option value="<?= $axh['exam_header_id'];?>"><?= $axh['exam_title'];?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="select_exam_body">Test Body:</label>
                                                        <select class="form-control" name="select_exam_body" id="select_exam_body">
                                                            <option selected disabled></option>
                                                            <?php foreach($all_exam_body as $axb):?>
                                                                <option value="<?= $axb['exam_body_id'];?>"><?= $axb['exam_body_title'];?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12 col-md-12 col-lg-12">
                                                    <div class="form-group">
                                                    <button tpye="submit" class="btn btn-primary btn-block"><i class="fas fa-link"></i>  Join Test Header and Test Body</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <div class="row">
                                            <table class="table table-head-fixed text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Date Created</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if($exam_lists):?>
                                                        <?php foreach($exam_lists as $el):?>
                                                            <tr>
                                                                <td><?= $el['exam_title'];?></td>
                                                                <td><?= $el['date_created'];?></td>
                                                                <td>
                                                                    <a href="" id="btn_assign<?php echo $el['joined_header_body_id']?>"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#assign_body_modal"><i class="fas fa-list"></i> Assign</button></a>
                                                                    <a href="" id="btn_config<?php echo $el['joined_header_body_id']?>"><button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#config_body_modal"><i class="fa fa-cog"></i> Config</button></a>
                                                                    <a href="" id="btn_edit<?php echo $el['joined_header_body_id']?>"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_body_modal"><i class="fa fa-edit"></i> Edit</button></a>
                                                                    <a href="" id="btn_delete<?php echo $el['joined_header_body_id']?>"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exam_body_delete"><i class="fa fa-trash"></i> Delete</button></a>
                                                                </td>
                                                            </tr>
                                                            
                                                            <script>
                                                                $(document).ready(function(){
                                                                    $('#btn_assign<?php echo $el['joined_header_body_id']?>').on('click', function(){
                                                                        $('.overlay').css('visibility', 'visible');
                                                                        $.ajax({
                                                                            url: "<?=site_url('exam/browse_classes_by_teacher')?>",
                                                                            data:{ examID : '<?=$el['joined_header_body_id'];?>'},
                                                                            type: "post",
                                                                            success: function(data)
                                                                            {
                                                                                $('.overlay').css('visibility', 'hidden');
                                                                                $("#assign_body_modal").modal('show');
                                                                                $("#assign_joined_exam_modal").html(data);
                                                                            }
                                                                        })
                                                                        return false;
                                                                    });
                                                                })

                                                                $(document).ready(function(){
                                                                    $('#btn_config<?php echo $el['joined_header_body_id']?>').on('click', function(e){
                                                                        e.preventDefault();
                                                                        $('#hidden_input_exam_id').val(<?php echo $el['joined_header_body_id']?>);
                                                                        $("#config_body_modal").modal('show');
                                                                    });
                                                                })

                                                                $(document).ready(function(){
                                                                    $('#btn_edit<?php echo $el['joined_header_body_id']?>').on('click', function(){
                                                                        $('.overlay').css('visibility', 'visible');
                                                                        $.ajax({
                                                                            url: "<?=site_url('exam/browse_exam')?>",
                                                                            data:{ examID : '<?=$el['joined_header_body_id'];?>' },
                                                                            type: "post",
                                                                            success: function(data)
                                                                            {
                                                                                $('.overlay').css('visibility', 'hidden');
                                                                                $("#edit_exam_modal").modal('show');
                                                                                $("#edit_exam_body_modal").html(data);
                                                                            }
                                                                        })
                                                                        return false;
                                                                    });
                                                                })

                                                                $(document).ready(function(){
                                                                    $('#btn_delete<?php echo $el['joined_header_body_id']?>').on('click', function(e){
                                                                        e.preventDefault();
                                                                        $('.overlay').css('visibility', 'visible');
                                                                        Swal.fire({
                                                                            title: 'Are you sure you want to delete Test ?',
                                                                            text: "You won't be able to revert this!",
                                                                            type: 'warning',
                                                                            showCancelButton: true,
                                                                            confirmButtonColor: '#d33',
                                                                            cancelButtonColor: '#3085d6',
                                                                            confirmButtonText: 'Yes, delete it!'
                                                                        }).then((result) => {
                                                                            if (result.value == true) {
                                                                                $.ajax({
                                                                                    url: "<?=site_url('exam/delete_exam')?>",
                                                                                    data:{ examID : '<?=$el['joined_header_body_id'];?>' },
                                                                                    type: "post",
                                                                                    success: function(data)
                                                                                    {
                                                                                        Swal.fire(
                                                                                            'Deleted!',
                                                                                            'Test has been deleted.',
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
                                                    <?php else:?>
                                                        
                                                    <?php endif;?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                    <div class="overlay" style="visibility: hidden;">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>

                                    <div class="modal fade" id="edit_exam_modal">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content" id="edit_exam_body_modal">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="assign_body_modal">
                                        <div class="modal-dialog">
                                            <div class="modal-content" id="assign_joined_exam_modal">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="config_body_modal">
                                        <div class="modal-dialog">
                                            <div class="modal-content" id="config_joined_exam_modal">
                                                <?= $this->load->view('config_exam_modal')?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card" id="exam_preview">
                                    <div class="card-header">
                                        <h3 class="card-title">Test Preview</h3>
                                    </div>

                                    <div class="card-body">
                                        <div id="browsed_exam_header">

                                        </div>
                                        <div id="browsed_exam_body">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $("#form_join_exam_header_body").submit(function(e){
                    e.preventDefault();
                    $('.overlay').css('visibility', 'visible');
                    var formCreateExam = new FormData($(this)[0]);
                    $.ajax({
                        url: "<?=site_url('exam/create_exam')?>",
                        data: formCreateExam,
                        dataType: "json",
                        type: "post",
                        async: false,
                        success: function(data){
                            if(data.response == "false") {
                                Swal.fire({
                                    html: data.message,
                                    type: 'error',
                                })
                            } else {
                                Swal.fire({
                                    title: 'Test Created!',
                                    type: 'success',
                                }).then((result) => {
                                    location.reload();
                                })
                            }
                            $('.overlay').css('visibility', 'hidden');
                        },
                        contentType: false,
                        cache: false,
                        processData: false,
                    });
                })

                $('#select_exam_header').change(function(){
                    $('.overlay').css('visibility', 'visible');
                    $.ajax({
                        url: "<?=site_url('exam/browse_exam_header_to_join')?>",
                        data: {examheaderId : $('#select_exam_header').val()},
                        type: "post",
                        success: function(data){
                            if(data.response == "false") {

                            } else {
                                $('.overlay').css('visibility', 'hidden');
                                // $("#div_class_info").css('display', 'block');
                                $("#browsed_exam_header").html(data);
                            }
                        },
                    })
                    return false;
                })

                $('#select_exam_body').change(function(){
                    $('.overlay').css('visibility', 'visible');
                    $.ajax({
                        url: "<?=site_url('exam/browse_exam_body_to_join')?>",
                        data: {exambodyId : $('#select_exam_body').val()},
                        type: "post",
                        success: function(data){
                            if(data.response == "false") {

                            } else {
                                $('.overlay').css('visibility', 'hidden');
                                // $("#div_class_info").css('display', 'block');
                                $("#browsed_exam_body").html(data);
                            }
                        },
                    })
                    return false;
                })
            </script>