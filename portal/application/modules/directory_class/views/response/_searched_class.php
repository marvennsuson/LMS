                                            <?php if($searched_class):?>  
                                                <thead>
                                                    <tr>
                                                        <th>Subject Code</th>
                                                        <th>Subject Name</th>
                                                        <th>Schedule</th>
                                                        <th>Instructor</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php foreach($searched_class as $sc):?>
                                                        <tr>
                                                            <td><?=$sc['subjectcode'];?></td>
                                                            <td><?=$sc['subjectname'];?></td>
                                                            <td><?=$sc['schedule'];?></td>
                                                            <td><?=$sc['teacherid'];?></td>
                                                            <td>
                                                                <a href="" id="btn_edit<?php echo $sc['id']?>"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#class_edit"><i class="fa fa-edit"></i> Edit</button></a>
                                                                <a href="" id="btn_read<?php echo $sc['id']?>"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#class_read"><i class="fa fa-eye"></i> View</button></a>
                                                                <a href="" id="btn_delete<?php echo $sc['id']?>"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#class_delete"><i class="fa fa-trash"></i> Delete</button></a>
                                                            </td>
                                                        </tr>

                                                        <script>
                                                            $(document).ready(function(){
                                                                $('#btn_read<?php echo $sc['id']?>').on('click', function(){
                                                                    $.ajax({
                                                                        url: "<?=site_url('directory_class/read_class')?>",
                                                                        data:{ id : '<?=$sc['id'];?>' },
                                                                        type: "post",
                                                                        success: function(data)
                                                                        {
                                                                            $("#class").modal('show');
                                                                            $("#class_details").html(data);
                                                                        }
                                                                    })
                                                                    return false;
                                                                });
                                                            })

                                                            $(document).ready(function(){
                                                                $('#btn_edit<?php echo $sc['id']?>').on('click', function(){
                                                                    $.ajax({
                                                                        url: "<?=site_url('directory_class/edit_class')?>",
                                                                        data:{ id : '<?=$sc['id'];?>' },
                                                                        type: "post",
                                                                        success: function(data)
                                                                        {
                                                                            $("#class_edit").modal('show');
                                                                            $("#class_edit_response").html(data);
                                                                        }
                                                                    })
                                                                    return false;
                                                                });
                                                            })

                                                            $(document).ready(function(){
                                                                $('#btn_delete<?php echo $sc['id']?>').on('click', function(e){
                                                                    e.preventDefault();
                                                                    Swal.fire({
                                                                        title: 'Are you sure you want to delete class <br> <?= strtoupper($sc['subjectcode'])?> ?',
                                                                        text: "You won't be able to revert this!",
                                                                        type: 'warning',
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: '#d33',
                                                                        cancelButtonColor: '#3085d6',
                                                                        confirmButtonText: 'Yes, delete it!'
                                                                    }).then((result) => {
                                                                        if (result.value == true) {
                                                                            $.ajax({
                                                                                url: "<?=site_url('directory_class/delete_class')?>",
                                                                                data:{ id : '<?=$sc['id'];?>' },
                                                                                type: "post",
                                                                                success: function(data)
                                                                                {
                                                                                    Swal.fire(
                                                                                        'Deleted!',
                                                                                        'Class <?= strtoupper($sc['subjectcode'])?> has been deleted.',
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
                                                            No Existing Class
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif;?>