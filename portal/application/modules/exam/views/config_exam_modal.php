                        
                        <div class="modal-header">
                            <h4 class="modal-title">Config Test</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                            <form id="form_config_exam">
                                <div class="modal-body" id="edit_exam_body_modal">
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="allow_retake" name="allow_retake" value="0">
                                                    <label for="allow_retake" class="custom-control-label">Allow re-take if fail</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="publish_result_to_student" name="publish_result_to_student" value="0">
                                                    <label for="publish_result_to_student" class="custom-control-label">Publish score result to student</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="make_exam_visible" name="make_exam_visible" value="0">
                                                    <label for="make_exam_visible" class="custom-control-label">Make this test visible</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <input type="hidden" id="hidden_input_exam_id" name="hidden_input_exam_id">
                                
                                <div class="modal-footer justify-content-between">
                                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-cog"></i> Config Test </button>
                                </div>

                                <div id="modal-open">
                                    <div class="overlay" style="visibility: hidden;">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>
                            </form>
                        
                        <script>
                            $("#form_config_exam").submit(function(e){
                                e.preventDefault();

                                if($('#allow_retake').is(":checked")){$('#allow_retake').val(1);}
                                if($('#publish_result_to_student').is(":checked")){$('#publish_result_to_student').val(1);}
                                if($('#make_exam_visible').is(":checked")){$('#make_exam_visible').val(1);}

                                $('#modal-open > .overlay').css('visibility', 'visible');
                                var formAssignExam = new FormData($(this)[0]);
                                $.ajax({
                                    url: "<?=site_url('exam/config_exam')?>",
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
                                                title: 'Test Successfully Configured!',
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