                        
                        <div class="modal-header">
                            <h4 class="modal-title">Assign Test</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form id="form_assign_exam">
                            <div class="modal-body" id="edit_exam_body_modal">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="select_class">Class:</label>
                                            <select class="form-control" name="select_class" id="select_class">
                                                <option selected disabled></option>
                                                <?php foreach($all_classes_by_teacher as $acbt):?>
                                                    <option value="<?= $acbt['subjectcode'];?>"><?= $acbt['subject_name'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <input type="hidden" name="input_exam_id" value="<?php echo $exam_id;?>">
                            
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-success float-right"><i class="fas fa-edit"></i> Assign Test </button>
                            </div>

                            <div id="modal-open">
                                <div class="overlay" style="visibility: hidden;">
                                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                </div>
                            </div>
                        </form>
                        

                        <table class="table table-borderless text-nowrap">
                            <thead>
                                <tr>
                                    <th>Assigned</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($all_assigned_exam):?>
                                    <?php foreach($all_assigned_exam as $aae):?>
                                        <tr>
                                            <td><?php echo $aae['class']?></td>
                                            <td>
                                                <a href="" id="btn_delete_assigned<?php echo $aae['joined_header_body_assigned_id']?>"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exam_body_delete"><i class="fa fa-trash"></i> Delete</button></a>
                                            </td>
                                        </tr>
                                        
                                        <script>
                                            $('#btn_delete_assigned<?php echo $aae['joined_header_body_assigned_id']?>').on('click', function(e){
                                                e.preventDefault();
                                                $('.overlay').css('visibility', 'visible');
                                                Swal.fire({
                                                    title: 'Are you sure you want to delete assigned test ?',
                                                    text: "You won't be able to revert this!",
                                                    type: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#d33',
                                                    cancelButtonColor: '#3085d6',
                                                    confirmButtonText: 'Yes, delete it!'
                                                }).then((result) => {
                                                    if (result.value == true) {
                                                        $.ajax({
                                                            url: "<?=site_url('exam/delete_assigned_exam')?>",
                                                            data:{ assignedExamID : '<?=$aae['joined_header_body_assigned_id'];?>' },
                                                            type: "post",
                                                            success: function(data)
                                                            {
                                                                Swal.fire(
                                                                    'Deleted!',
                                                                    'Assigned Test has been deleted.',
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
                                        </script>
                                    <?php endforeach;?>
                                <?php else:?>
                                    
                                <?php endif;?>
                            </tbody>
                        </table>
                        
                        <script>
                            $("#form_assign_exam").submit(function(e){
                                e.preventDefault();
                                $('#modal-open > .overlay').css('visibility', 'visible');
                                var formAssignExam = new FormData($(this)[0]);
                                $.ajax({
                                    url: "<?=site_url('exam/assign_exam')?>",
                                    data: formAssignExam,
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
                                                title: 'Assigning Test Successful!',
                                                type: 'success',
                                                confirmButtonText: 'Ok'
                                            }).then(
                                                (result) => {
                                                    if(result.value){
                                                        // location.reload();
                                                        $('#select_class').prop('selectedIndex',0);
                                                    }
                                                }
                                            )
                                        }
                                        $('#modal-open > .overlay').css('visibility', 'hidden');
                                    },
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                });
                            });
                        </script>