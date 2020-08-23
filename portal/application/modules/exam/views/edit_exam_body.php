                        
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Test Body</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <?php if($browse_exam_body[0]):?>
                            <form id="form_edit_exam_body">
                                <div class="modal-body" id="edit_body_modal">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="input_exam_body_title">Exam Test Title:</label>
                                                <input type="text" class="form-control" id="input_exam_body_title" name="input_exam_body_title" value="<?php echo $browse_exam_body[0]['exam_body_title'];?>">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="input_exam_points">Total Points:</label>
                                                <input type="text" class="form-control" id="input_exam_points" name="input_exam_points" value="<?php echo $browse_exam_body[0]['total_points'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="select_exam_random">Random: <small>(Current: <?php echo $browse_exam_body[0]['is_random'];?>)</small></label>
                                                <select class="form-control" name="select_exam_random" id="select_exam_random">
                                                    <option selected disabled></option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="row">
                                        <div class="col-12 col-md-12 col-lg-12">
                                            <div class="bg-light px-3 py-3">
                                                <h3 class="my-2">Test form</h3>
                                                <button type="button" class="btn btn-success my-3" id="enable_editing"><i class="fas fa-edit"></i> Enable Editing</button>
                                                <button type="button" class="btn btn-danger my-3" id="finish_editing"><i class="fas fa-save"></i> Disable Editing</button>
                                                
                                                <div id="exam_form_in_html">
                                                    <?php echo $browse_exam_body[0]['exam_created_form'];?>
                                                </div>
                                            </div>
                                            <div id="edit_exam_form_in_html" style="display: none !important;">
                                            </div>
                                            <textarea name="textarea_exam_form_in_html" id="textarea_exam_form_in_html" class="form-control" rows="10" style="width: 100%; display: none !important;"></textarea>
                                                
                                        </div>

                                        <script>
                                            // $('#edit_exam_form_in_html').keyup(function(){
                                            //     $('#exam_form_in_html').html($('#edit_exam_form_in_html').val());
                                            // });

                                            $('#exam_form_in_html').keyup(function(){
                                                $('#edit_exam_form_in_html').text($('#exam_form_in_html').html());
                                                var edited = $('#edit_exam_form_in_html').text();
                                                $('#textarea_exam_form_in_html').val(edited);
                                            });

                                            $(document).ready(function(){
                                                $('#exam_form_in_html > .form-group').addClass('px-4 py-4').css('background-color', '#fff1c6 !important');
                                                // $('#exam_form_in_html > .form-group').prepend('<hr>');
                                                $('.control-label').addClass('text-muted');
                                                $('.form-check-label').addClass('text-muted');
                                                $('#finish_editing').hide();
                                            });

                                            $('#enable_editing').click(function(){
                                                // var count = $('#exam_form_in_html').children('.form-group').length; 
                                                // var i;
                                                // for(i=0; i<count; i++)
                                                // {
                                                //     // alert($('.control-label').eq(i).text())
                                                //     // $('.control-label').replaceWith('<input value="">')
                                                //     // $('#edit_exam_form_in_html').append($('.control-label').eq(i).text());
                                                //     $('.control-label').eq(i).prop('contentEditable', true);
                                                //     $('.control-label').removeClass('text-muted');
                                                // }
                                                $('#edit_exam_form_in_html').text($('#exam_form_in_html').html());
                                                var edited = $('#edit_exam_form_in_html').text();
                                                $('#textarea_exam_form_in_html').val(edited);
                                                $('#finish_editing').show();
                                                $('#enable_editing').hide();
                                                $('.control-label').prop('contentEditable', true);
                                                $('.form-check-label').prop('contentEditable', true);
                                                $('.control-label').removeClass('text-muted');
                                                $('.form-check-label').removeClass('text-muted');
                                            });

                                            $('#finish_editing').click(function(){
                                                $('#finish_editing').hide();
                                                $('#enable_editing').show();

                                                $('#edit_exam_form_in_html').text().replaceAll('contenteditable="true"','');
                                                $('#textarea_exam_form_in_html').text().replaceAll('contenteditable="true"','');

                                                $('.control-label').removeAttr('contentEditable', true);
                                                $('.form-check-label').removeAttr('contentEditable', true);
                                                $('.control-label').addClass('text-muted');
                                                $('.form-check-label').addClass('text-muted');
                                            });

                                        </script>
                                    </div>
                                </div>

                                <div class="modal-footer justify-content-between">
                                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-edit"></i> Update Test Body </button>
                                </div>

                                <input type="hidden" name="input_exam_body_id" value="<?php echo $browse_exam_body[0]['exam_body_id'];?>">

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
                                No exam body available for editing.
                            </div>
                        <?php endif;?>
                        
                        <script>
                            $("#form_edit_exam_body").submit(function(e){
                                e.preventDefault();
                                $('#modal-open > .overlay').css('visibility', 'visible');
                                var formEditExamBody = new FormData($(this)[0]);
                                $.ajax({
                                    url: "<?=site_url('exam/edit_exam_body')?>",
                                    data: formEditExamBody,
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
                                                title: 'Edit Test Body Successful!',
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