                                            <?php if($searched_staff):?>  
                                                <thead>
                                                    <tr>
                                                        <th>Teacher ID</th>
                                                        <th>Name</th>
                                                        <th>Gender</th>
                                                        <th>Role</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php foreach($searched_staff as $ss):?>
                                                        <tr>
                                                            <td><?=$ss['teacher_id'];?></td>
                                                            <td><?=$ss['name'];?></td>
                                                            <td><?=$ss['gender'];?></td>
                                                            <td><?=$ss['role_display_name'];?></td>
                                                            <td>
                                                                <a href="" id="btn_edit<?php echo $ss['teacher_id']?>"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#staff_edit"><i class="fa fa-edit"></i> Edit</button></a>
                                                                <a href="" id="btn_read<?php echo $ss['teacher_id']?>"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#staff_read"><i class="fa fa-eye"></i> View</button></a>
                                                                <a href="" id="btn_delete<?php echo $ss['teacher_id']?>"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#staff_delete"><i class="fa fa-trash"></i> Delete</button></a>
                                                            </td>
                                                        </tr>

                                                        <script>
                                                            $(document).ready(function(){
                                                                $('#btn_read<?php echo $ss['teacher_id']?>').on('click', function(){
                                                                    $.ajax({
                                                                        url: "<?=site_url('directory_staff/read_staff')?>",
                                                                        data:{ id : '<?=$ss['teacher_id'];?>' },
                                                                        type: "post",
                                                                        success: function(data)
                                                                        {
                                                                            $("#staff").modal('show');
                                                                            $("#staff_details").html(data);
                                                                        }
                                                                    })
                                                                    return false;
                                                                });
                                                            })

                                                            $(document).ready(function(){
                                                                $('#btn_edit<?php echo $ss['teacher_id']?>').on('click', function(){
                                                                    $.ajax({
                                                                        url: "<?=site_url('directory_staff/edit_staff')?>",
                                                                        data:{ id : '<?=$ss['teacher_id'];?>' },
                                                                        type: "post",
                                                                        success: function(data)
                                                                        {
                                                                            $("#staff_edit").modal('show');
                                                                            $("#staff_edit_response").html(data);
                                                                        }
                                                                    })
                                                                    return false;
                                                                });
                                                            })

                                                            $(document).ready(function(){
                                                                $('#btn_delete<?php echo $ss['teacher_id']?>').on('click', function(e){
                                                                    e.preventDefault();
                                                                    Swal.fire({
                                                                        title: 'Are you sure you want to delete staff <br> <?= strtoupper($ss['name'])?> ?',
                                                                        text: "You won't be able to revert this!",
                                                                        type: 'warning',
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: '#d33',
                                                                        cancelButtonColor: '#3085d6',
                                                                        confirmButtonText: 'Yes, delete it!'
                                                                    }).then((result) => {
                                                                        if (result.value == true) {
                                                                            $.ajax({
                                                                                url: "<?=site_url('directory_staff/delete_staff')?>",
                                                                                data:{ id : '<?=$ss['teacher_id'];?>' },
                                                                                type: "post",
                                                                                success: function(data)
                                                                                {
                                                                                    Swal.fire(
                                                                                        'Deleted!',
                                                                                        'Staff <?= strtoupper($ss['name'])?>  has been deleted.',
                                                                                        'info'
                                                                                    ).then((result) => {
                                                                                        location.reload();
                                                                                    })
                                                                                }
                                                                            })
                                                                            
                                                                        }
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
                                                            No Existing Staff
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif;?>