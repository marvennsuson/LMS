                        <div class="modal-header">
                            <h4 class="modal-title">Edit Exam</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                        <form id="form_edit_exam">
                            <div class="modal-body" id="edit_exam_header_modal">
                                
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="select_exam_header">Test Header: (Current: <small><?= $browse_exam['exam_title']?></small> )</label>
                                            <select class="form-control" name="select_exam_header" id="select_exam_header">
                                                <option selected disabled></option>
                                                <?php foreach($all_exam_header as $axh):?>
                                                    <option <?php if($browse_exam['exam_title'] == $axh['exam_title']) {echo 'selected';} ?> value="<?= $axh['exam_header_id'];?>"><?= $axh['exam_title'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="select_exam_body">Test Body: (Current: <small><?= $browse_exam['exam_body_title']?></small>)</label>
                                            <select class="form-control" name="select_exam_body" id="select_exam_body">
                                                <option selected disabled></option>
                                                <?php foreach($all_exam_body as $axb):?>
                                                    <option <?php if($browse_exam['exam_body_title'] == $axb['exam_body_title']) {echo 'selected';} ?> value="<?= $axb['exam_body_id'];?>"><?= $axb['exam_body_title'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="hidden_joined_header_body_id" id="hidden_joined_header_body_id" value="<?= $browse_exam['joined_header_body_id']?>">
                            </div>
                            
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-success float-right"><i class="fas fa-edit"></i> Update Test </button>
                            </div>
                            
                            <div id="modal-open">
                                <div class="overlay" style="visibility: hidden;">
                                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                </div>
                            </div>
                        </form>
                        
                        <script>
                            $("#form_edit_exam").submit(function(e){
                                e.preventDefault();
                                $('#modal-open > .overlay').css('visibility', 'visible');
                                var formEditExam = new FormData($(this)[0]);
                                $.ajax({
                                    url: "<?=site_url('exam/edit_exam')?>",
                                    data: formEditExam,
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
                                                title: 'Edit Test Successful!',
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