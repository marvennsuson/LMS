            <link rel="stylesheet" href="<?= base_url('public/plugins/summernote/summernote-bs4.css');?>">
            <style>
                .note-editor{
                    z-index: 0 !important;
                }
            </style>
            <?php if($opened_homework[0]):?>
                <form id="form_submit_homework">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= $opened_homework[0]['homework_title'];?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body" id="edit_body_modal">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <p><strong>Total points:</strong> <?= $opened_homework[0]['score'];?></p>
                            </div>
                        </div>


                        <textarea class="textarea" id="textarea_homework" name="textarea_homework" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $opened_homework[0]['editor_content'];?></textarea>
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="userfile">Attach File:</label>
                                    <input type="file" name="userfile" id="userfile" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="hidden_homework_id" id="hidden_homework_id" value="<?php echo $opened_homework[0]['homework_id'];?>">
                    <input type="hidden" name="hidden_teacher_id" id="hidden_teacher_id" value="<?php echo $opened_homework[0]['teacher_id'];?>">
                    <input type="hidden" name="hidden_subject_id" id="hidden_subject_id" value="<?php echo $opened_homework[0]['subject_id'];?>">
                    <input type="hidden" name="hidden_student_id" id="hidden_student_id" value="<?php echo $opened_homework[0]['student_id'];?>">
                    <input type="hidden" name="hidden_term" id="hidden_term" value="<?php echo $opened_homework[0]['term'];?>">
                    <input type="hidden" name="hidden_homework_title" id="hidden_homework_title" value="<?php echo $opened_homework[0]['homework_title'];?>">

                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-success float-right"><i class="fas fa-send"></i> Submit Homework</button>
                    </div>

                    <div id="modal-open">
                        <div class="overlay" style="visibility: hidden;">
                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                        </div>
                    </div>
                </form>
            <?php else:?>
                <div class="box-body">
                    <div class="card-body">
                        <div class="alert alert-warning alert-dismissible">
                            <h4><i class="fa fa-exclamation-triangle"></i> Alert!</h4>
                            No Homework Available.
                        </div>
                    </div>
                </div>
            <?php endif;?>


            <script  src="<?= base_url('public/plugins/summernote/summernote-bs4.min.js');?>"></script>
            <script>
                $(function(){
                    $('.textarea').summernote({
                        minHeight: 200,
                    })
                })

                $("#form_submit_homework").submit(function(e){
                    e.preventDefault();
                    $('.overlay').css('visibility', 'visible');
                    var formSubmitHomework = new FormData($(this)[0]);
                    $.ajax({
                        url: "<?=site_url('activities/submit_homework')?>",
                        data: formSubmitHomework,
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
                                    title: 'Homework answer sent!',
                                    type: 'success',
                                })
                                // location.reload();
                            }
                            $('.overlay').css('visibility', 'hidden');
                        },
                        contentType: false,
                        cache: false,
                        processData: false,
                    });
                });
            </script>
