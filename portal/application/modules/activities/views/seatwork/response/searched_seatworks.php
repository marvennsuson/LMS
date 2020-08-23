                        <link rel="stylesheet" href="<?= base_url('public/plugins/summernote/summernote-bs4.css');?>">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Seatwork</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <?php if($seatwork_details[0]):?>
                            <form id="form_edit_seatwork">
                                <div class="modal-body" id="edit_body_modal">
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <label for="input_seatwork_title">Seatwork Title: </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Seatwork</span>
                                                </div>
                                                <input type="number" class="form-control" name="input_seatwork_title" id="input_seatwork_title" value="<?php echo str_replace('seatwork ', '', $seatwork_details[0]['seatwork_title']);?>">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2 col-lg-2">
                                            <div class="form-group">
                                                <label for="input_activity_score">Total Points:</label>
                                                <input type="text" class="form-control" id="input_activity_score" name="input_activity_score" value="<?php echo $seatwork_details[0]['score'];?>">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label for="select_term">Term: </small></label>
                                                <select class="form-control" name="select_term" id="select_term">
                                                    <option selected disabled></option>
                                                    <option <?php if($seatwork_details[0]['term'] == '1st quarter') {echo 'selected';} ?> value="1st quarter">1st Quarter</option>
                                                    <option <?php if($seatwork_details[0]['term'] == '2nd quarter') {echo 'selected';} ?> value="2nd quarter">2nd Quarter</option>
                                                    <option <?php if($seatwork_details[0]['term'] == '3rd quarter') {echo 'selected';} ?> value="3rd quarter">3rd Quarter</option>
                                                    <option <?php if($seatwork_details[0]['term'] == '4th quarter') {echo 'selected';} ?> value="4th quarter">4th Quarter</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label for="input_deadline">Deadline:</label>
                                                <input type="date" class="form-control" id="input_deadline" name="input_deadline" value="<?=date('Y-m-d', strtotime($seatwork_details[0]['deadline']));?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="input_seatwork_title">Content:</label>
                                                <textarea class="textarea" id="textarea_seatwork" name="textarea_seatwork" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $seatwork_details[0]['editor_content'];?></textarea>    
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer justify-content-between">
                                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-edit"></i> Update Seatwork </button>
                                </div>

                                <input type="hidden" name="hidden_seatwork_id" value="<?php echo $seatwork_details[0]['seatwork_id'];?>">
                                <input type="hidden" name="hidden_subject_id_sw" id="hidden_subject_id_sw" value="<?php echo $seatwork_details[0]['subject_id'];?>">
                                <input type="hidden" name="hidden_student_id_sw" id="hidden_student_id_sw" value="<?php echo $seatwork_details[0]['student_id'];?>">

                                <div id="modal-open">
                                    <div class="overlay" style="visibility: hidden;">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>
                            </form>
                        <?php else:?>
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                                No seatwork available for editing.
                            </div>
                        <?php endif;?>
                        
                        <script  src="<?= base_url('public/plugins/summernote/summernote-bs4.min.js');?>"></script>
                        <script>
                            $(function(){
                                $('.textarea').summernote({
                                    minHeight: 200,
                                })
                            })
                            $("#form_edit_seatwork").submit(function(e){
                                e.preventDefault();
                                $('#modal-open > .overlay').css('visibility', 'visible');
                                var formEditSeatwork = new FormData($(this)[0]);
                                $.ajax({
                                    url: "<?=site_url('activities/insert_edit_seatwork')?>",
                                    data: formEditSeatwork,
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
                                                title: 'Edit Seatwork Successful!',
                                                type: 'success',
                                                confirmButtonText: 'Ok'
                                            }).then(
                                                (result) => {
                                                    if(result.value){
                                                        location.reload();
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