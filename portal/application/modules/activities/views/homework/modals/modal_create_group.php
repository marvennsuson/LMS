                                <div class="modal-header">
                                    <h4 class="modal-title">Create Group</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body" id="edit_body_modal">
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-lg-12">
                                            <label for="input_search_create_group">Search Name:</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="input_search_create_group" id="input_search_create_group">
                                                <span class="input-group-append">
                                                    <button id="btn_add_to_group" type="button" class="btn bg-gradient-primary"><i class="fas fa-plus"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-lg-12" id="div_searched_table_create_group">
                                            <div id="searched_table_create_group">
                                                <div class="card-body table-responsive p-0" id="div_admission_table">
                                                    <table class="table table-striped table-hover table-head-fixed text-nowrap" id="admission_table">
                                                        <?php if($students_by):?>  
                                                            <thead>
                                                                <tr>
                                                                    <th>Name</th>
                                                                    <th>Grade</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <?php foreach($students_by as $sb):?>
                                                                    <tr>
                                                                        <td><?=$sb['lastname'];?>, <?=$sb['firstname'];?> <?=$sb['middlename'];?></td>
                                                                        <td>static</td>
                                                                        <td>
                                                                            <a href="" id="btn_delete<?php echo $sb['admission_id']?>"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#admission_delete"><i class="fa fa-trash"></i> Delete</button></a>
                                                                        </td>
                                                                    </tr>
                                                                    <script>
                                                                        $('#btn_delete<?php echo $sb['admission_id']?>').on('click', function(e){
                                                                            $('.overlay').css('visibility', 'visible');
                                                                            e.preventDefault();
                                                                            Swal.fire({
                                                                                title: 'Are you sure you want to delete homework by <br> <?= strtoupper($sb['firstname'])?> <?= strtoupper($sb['middlename'])?> <?= strtoupper($sb['lastname'])?> ?',
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
                                                                                        data:{ admission_id : '<?=$sb['admission_id'];?>' },
                                                                                        type: "post",
                                                                                        success: function(data)
                                                                                        {
                                                                                            Swal.fire(
                                                                                                'Deleted!',
                                                                                                'Homework by <?= strtoupper($sb['firstname'])?> <?= strtoupper($sb['middlename'])?> <?= strtoupper($sb['lastname'])?> has been deleted.',
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
                                                            </tbody>

                                                        <?php else:?>
                                                            <div class="box-body">
                                                                <div class="card-body">
                                                                    <div class="alert alert-warning alert-dismissible">
                                                                        <h4><i class="fa fa-exclamation-triangle"></i> Alert!</h4>
                                                                        No Existing Student.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif;?>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer justify-content-between">
                                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-send"></i> Send </button>
                                </div>

                                <div id="modal-open">
                                    <div class="overlay" style="visibility: hidden;">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>

                                <script>
                                    $('#btn_add_to_group')
                                </script>

                            

                                <!-- <script>
                                     $('#input_search_create_group').keyup(function(){
                                        if($('#input_search_create_group').val() == '' ){
                                            $('#div_searched_table_create_group').css('display', 'none');
                                        } else {
                                            $('#div_searched_table_create_group').css('display', 'block');
                                            $.ajax({
                                                url: "<?=site_url('activities/search_student_create_group')?>",
                                                data: {searchItem : $('#input_search_create_group').val()},
                                                type: "post",
                                                success: function(data){
                                                    if(data.response == "false") {
                                                    } else {
                                                        $("#searched_table_create_group").html(data);
                                                    }
                                                },
                                            })
                                            return false;
                                        }
                                        
                                    })
                                </script> -->