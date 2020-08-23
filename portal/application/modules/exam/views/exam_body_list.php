                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-head-fixed text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Date Created</th>
                                                        <th>Total Points</th>
                                                        <th>Random</th>
                                                        <th>Use</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if($exam_body):?>
                                                        <?php foreach($exam_body as $eh):?>
                                                            <tr>
                                                                <td><?= $eh['exam_body_title'];?></td>
                                                                <td><?= $eh['created_at'];?></td>
                                                                <td><?= $eh['total_points'];?></td>
                                                                <td><?= ucfirst($eh['is_random']);?></td>
                                                                <td><?= $eh['on_use'];?></td>
                                                                <td>
                                                                    <a href="" id="btn_edit<?php echo $eh['exam_body_id']?>"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_body_modal"><i class="fa fa-edit"></i> Edit</button></a>
                                                                    <a href="" id="btn_delete<?php echo $eh['exam_body_id']?>"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exam_body_delete"><i class="fa fa-trash"></i> Delete</button></a>
                                                                </td>
                                                            </tr>
                                                            
                                                            <script>
                                                                $(document).ready(function(){
                                                                    $('#btn_edit<?php echo $eh['exam_body_id']?>').on('click', function(){
                                                                        $('.overlay').css('visibility', 'visible');
                                                                        $.ajax({
                                                                            url: "<?=site_url('exam/browse_exam_body')?>",
                                                                            data:{ exambodyID : '<?=$eh['exam_body_id'];?>' },
                                                                            type: "post",
                                                                            success: function(data)
                                                                            {
                                                                                $('.overlay').css('visibility', 'hidden');
                                                                                $("#edit_body_modal").modal('show');
                                                                                $("#edit_exam_body_modal").html(data);
                                                                            }
                                                                        })
                                                                        return false;
                                                                    });
                                                                })

                                                                $(document).ready(function(){
                                                                    $('#btn_delete<?php echo $eh['exam_body_id']?>').on('click', function(e){
                                                                        e.preventDefault();
                                                                        $('.overlay').css('visibility', 'visible');
                                                                        Swal.fire({
                                                                            title: 'Are you sure you want to delete test body made by <br> <?=$this->session->firstname?> <?=$this->session->lastname?> ?',
                                                                            text: "You won't be able to revert this!",
                                                                            type: 'warning',
                                                                            showCancelButton: true,
                                                                            confirmButtonColor: '#d33',
                                                                            cancelButtonColor: '#3085d6',
                                                                            confirmButtonText: 'Yes, delete it!'
                                                                        }).then((result) => {
                                                                            if (result.value == true) {
                                                                                $.ajax({
                                                                                    url: "<?=site_url('exam/delete_exam_body')?>",
                                                                                    data:{ exambodyID : '<?=$eh['exam_body_id'];?>' },
                                                                                    type: "post",
                                                                                    success: function(data)
                                                                                    {
                                                                                        Swal.fire(
                                                                                            'Deleted!',
                                                                                            'Test body by <?=$this->session->firstname?> <?=$this->session->lastname?> has been deleted.',
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

                                            <div class="modal fade" id="edit_body_modal">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content" id="edit_exam_body_modal">
                                                        <?= $this->load->view('edit_exam_body');?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        