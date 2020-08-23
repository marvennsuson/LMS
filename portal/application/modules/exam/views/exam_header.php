            <title><?= $title;?></title>
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">Test Header</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                    <li class="breadcrumb-item active"><a href="<?= current_url();?>">Test Header</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Create Test Header</h3>

                                        <div class="card-tools">
                                            <div class="input-group input-group-sm" style="width: 150px;">
                                                <button id="btn_add_header" data-toggle="modal" data-target="#add_header_modal" type="submit" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Add Header</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body table-responsive p-0" style="height: 500px;">
                                        <table class="table table-head-fixed text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Date</th>
                                                    <th>Duration</th>
                                                    <!-- <th>Attempt</th>
                                                    <th>Rate</th> -->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($exam_header):?>
                                                    <?php foreach($exam_header as $eh):?>
                                                        <tr>
                                                            <td><?= $eh['exam_title'];?></td>
                                                            <td><?= $eh['expiration_date'];?></td>
                                                            <td><?= $eh['time_duration'];?></td>
                                                            <!-- <td><?= $eh['exam_attempt'];?></td>
                                                            <td><?= $eh['passing_rate'];?></td> -->
                                                            <td>
                                                                <a href="" id="btn_edit<?php echo $eh['exam_header_id']?>"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_header_modal"><i class="fa fa-edit"></i> Edit</button></a>
                                                                <a href="" id="btn_delete<?php echo $eh['exam_header_id']?>"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exam_header_delete"><i class="fa fa-trash"></i> Delete</button></a>
                                                            </td>
                                                        </tr>

                                                        <script>
                                                            $(document).ready(function(){
                                                                $('#select_exam_type').change(function(){
                                                                    $('#input_exam_title').find('[value="<?php echo $eh['exam_title']?>"]').remove();
                                                                })
                                                            })
                                                        </script>
                                                        
                                                        <script>
                                                            $(document).ready(function(){
                                                                $('#btn_edit<?php echo $eh['exam_header_id']?>').on('click', function(){
                                                                    $('.overlay').css('visibility', 'visible');
                                                                    $.ajax({
                                                                        url: "<?=site_url('exam/browse_exam_header')?>",
                                                                        data:{ examheaderId : '<?=$eh['exam_header_id'];?>' },
                                                                        type: "post",
                                                                        success: function(data)
                                                                        {
                                                                            $('.overlay').css('visibility', 'hidden');
                                                                            $("#edit_header_modal").modal('show');
                                                                            $("#edit_exam_header_modal").html(data);
                                                                        }
                                                                    })
                                                                    return false;
                                                                });
                                                            })

                                                            $(document).ready(function(){
                                                                $('#btn_delete<?php echo $eh['exam_header_id']?>').on('click', function(e){
                                                                    $('.overlay').css('visibility', 'visible');
                                                                    e.preventDefault();
                                                                    Swal.fire({
                                                                        title: 'Are you sure you want to delete Test header made by <br> <?= strtoupper($eh['created_by'])?> ?',
                                                                        text: "You won't be able to revert this!",
                                                                        type: 'warning',
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: '#d33',
                                                                        cancelButtonColor: '#3085d6',
                                                                        confirmButtonText: 'Yes, delete it!'
                                                                    }).then((result) => {
                                                                        if (result.value == true) {
                                                                            $.ajax({
                                                                                url: "<?=site_url('exam/delete_exam_header')?>",
                                                                                data:{ examheaderId : '<?=$eh['exam_header_id'];?>' },
                                                                                type: "post",
                                                                                success: function(data)
                                                                                {
                                                                                    Swal.fire(
                                                                                        'Deleted!',
                                                                                        'Test header by <?= strtoupper($eh['created_by'])?> has been deleted.',
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

                                        <div class="modal fade" id="add_header_modal">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <?= $this->load->view('create_exam_header');?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="edit_header_modal">
                                            <div class="modal-dialog">
                                                <div class="modal-content" id="edit_exam_header_modal">
                                                    <?= $this->load->view('edit_exam_header');?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="overlay" style="visibility: hidden;">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            