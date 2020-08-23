                                            <?php if($searched_student):?>
                                                <thead>
                                                    <tr>
                                                        <th>Student ID</th>
                                                        <th>Name</th>
                                                        <th>Gender</th>
                                                        <th>School Lvl</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php foreach($searched_student as $ss):?>
                                                        <tr>
                                                            <td><?=$ss['id'];?></td>
                                                            <td><?=$ss['firstname'];?> <?=$ss['middlename'];?> <?=$ss['lastname'];?></td>
                                                            <td><?=$ss['sex'];?></td>
                                                            <td><?=$ss['student_type'];?></td>
                                                            <td>
                                                                <a href="" id="btn_edit<?php echo $ss['id']?>"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#student_edit"><i class="fa fa-edit"></i> Edit</button></a>
                                                                <a href="" id="btn_read<?php echo $ss['id']?>"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#student_read"><i class="fa fa-eye"></i> View</button></a>
                                                                <a href="" id="btn_delete<?php echo $ss['id']?>"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#student_delete"><i class="fa fa-trash"></i> Delete</button></a>
                                                            </td>
                                                        </tr>

                                                        <script>
                                                            $(document).ready(function(){
                                                                $('#btn_read<?php echo $ss['id']?>').on('click', function(){
                                                                    $.ajax({
                                                                        url: "<?=site_url('directory_student/read_student')?>",
                                                                        data:{ id : '<?=$ss['id'];?>' },
                                                                        type: "post",
                                                                        success: function(data)
                                                                        {
                                                                            $("#student").modal('show');
                                                                            $("#student_details").html(data);
                                                                        }
                                                                    })
                                                                    return false;
                                                                });
                                                            })

                                                            $(document).ready(function(){
                                                                $('#btn_edit<?php echo $ss['id']?>').on('click', function(){
                                                                    $.ajax({
                                                                        url: "<?=site_url('directory_student/edit_student')?>",
                                                                        data:{ id : '<?=$ss['id'];?>' },
                                                                        type: "post",
                                                                        success: function(data)
                                                                        {
                                                                            $("#student_edit").modal('show');
                                                                            $("#student_edit_response").html(data);
                                                                        }
                                                                    })
                                                                    return false;
                                                                });
                                                            })

                                                            $(document).ready(function(){
                                                                $('#btn_delete<?php echo $ss['id']?>').on('click', function(e){
                                                                    e.preventDefault();
                                                                    Swal.fire({
                                                                        title: 'Are you sure you want to delete student <br> <?= strtoupper($ss['fname'])?> <?= strtoupper($ss['mname'])?> <?= strtoupper($ss['lname'])?> ?',
                                                                        text: "You won't be able to revert this!",
                                                                        type: 'warning',
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: '#d33',
                                                                        cancelButtonColor: '#3085d6',
                                                                        confirmButtonText: 'Yes, delete it!'
                                                                    }).then((result) => {
                                                                        if (result.value == true) {
                                                                            $.ajax({
                                                                                url: "<?=site_url('directory_student/delete_student')?>",
                                                                                data:{ id : '<?=$ss['id'];?>' },
                                                                                type: "post",
                                                                                success: function(data)
                                                                                {
                                                                                    Swal.fire(
                                                                                        'Deleted!',
                                                                                        'Student <?= strtoupper($ss['fname'])?> <?= strtoupper($ss['mname'])?> <?= strtoupper($ss['lname'])?> has been deleted.',
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
                                                            No Existing Student
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif;?>
