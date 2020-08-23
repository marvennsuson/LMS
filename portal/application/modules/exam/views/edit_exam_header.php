                        <style>
                        /* Chrome, Safari, Edge, Opera */
                        input::-webkit-outer-spin-button,
                        input::-webkit-inner-spin-button {
                        -webkit-appearance: none;
                        margin: 0;
                        }

                        /* Firefox */
                        input[type=number] {
                        -moz-appearance: textfield;
                        }
                        </style>
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Test Header</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                        <?php if($browse_exam_header[0]):?>
                            <form id="form_edit_exam_header">
                                <div class="modal-body" id="edit_exam_header_modal">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="select_exam_term">Term: </label>
                                                <select class="form-control" name="select_exam_term" id="select_exam_term">
                                                    <option selected disabled></option>
                                                    <option <?php if($browse_exam_header[0]['term'] == '1st quarter') {echo 'selected';} ?> value="1st quarter">1st Quarter</option>
                                                    <option <?php if($browse_exam_header[0]['term'] == '2nd quarter') {echo 'selected';} ?> value="2nd quarter">2nd Quarter</option>
                                                    <option <?php if($browse_exam_header[0]['term'] == '3rd quarter') {echo 'selected';} ?> value="3rd quarter">3rd Quarter</option>
                                                    <option <?php if($browse_exam_header[0]['term'] == '4th quarter') {echo 'selected';} ?> value="4th quarter">4th Quarter</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="select_exam_type1">Type: </label>
                                                <select class="form-control" name="select_exam_type1" id="select_exam_type1">
                                                    <option selected disabled></option>
                                                    <option <?php if($browse_exam_header[0]['type'] == 'quiz') {echo 'selected';} ?> value="quiz">Quiz</option>
                                                    <option <?php if($browse_exam_header[0]['type'] == 'exam') {echo 'selected';} ?> value="exam">Exam</option>
                                                    <option <?php if($browse_exam_header[0]['type'] == 'final exam') {echo 'selected';} ?> value="final exam">Final Exam</option>
                                                </select>
                                            </div>
                                            <script>
                                                $(document).ready(function(){
                                                    if($('#select_exam_type1').val() == 'quiz'){
                                                        $('#input_exam_title1').html('<option selected disabled></option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz1') {echo 'selected';} ?> value="qz1">Quiz 1</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz2') {echo 'selected';} ?> value="qz2">Quiz 2</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz3') {echo 'selected';} ?> value="qz3">Quiz 3</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz4') {echo 'selected';} ?> value="qz4">Quiz 4</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz5') {echo 'selected';} ?> value="qz5">Quiz 5</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz6') {echo 'selected';} ?> value="qz6">Quiz 6</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz7') {echo 'selected';} ?> value="qz7">Quiz 7</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz8') {echo 'selected';} ?> value="qz8">Quiz 8</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz9') {echo 'selected';} ?> value="qz9">Quiz 9</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz10') {echo 'selected';} ?> value="qz10">Quiz 10</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz11') {echo 'selected';} ?> value="qz11">Quiz 11</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz12') {echo 'selected';} ?> value="qz12">Quiz 12</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz13') {echo 'selected';} ?> value="qz13">Quiz 13</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz14') {echo 'selected';} ?> value="qz14">Quiz 14</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz15') {echo 'selected';} ?> value="qz15">Quiz 15</option>');
                                                    } if($('#select_exam_type1').val() == 'exam'){
                                                        $('#input_exam_title1').html('<option selected disabled></option><option <?php if($browse_exam_header[0]['exam_title'] == 'exm1') {echo 'selected';} ?> value="exm1">Exam 1</option><option <?php if($browse_exam_header[0]['exam_title'] == 'exm2') {echo 'selected';} ?> value="exm2">Exam 2</option><option <?php if($browse_exam_header[0]['exam_title'] == 'exm3') {echo 'selected';} ?> value="exm3">Exam 3</option><option <?php if($browse_exam_header[0]['exam_title'] == 'exm4') {echo 'selected';} ?> value="exm4">Exam 4</option><option <?php if($browse_exam_header[0]['exam_title'] == 'exm5') {echo 'selected';} ?> value="exm5">Exam 5</option><option <?php if($browse_exam_header[0]['exam_title'] == 'exm6') {echo 'selected';} ?> value="exm6">Exam 6</option><option <?php if($browse_exam_header[0]['exam_title'] == 'exm7') {echo 'selected';} ?> value="exm7">Exam 7</option><option <?php if($browse_exam_header[0]['exam_title'] == 'exm8') {echo 'selected';} ?> value="exm8">Exam 8</option><option <?php if($browse_exam_header[0]['exam_title'] == 'exm9') {echo 'selected';} ?> value="exm9">Exam 9</option><option <?php if($browse_exam_header[0]['exam_title'] == 'exm10') {echo 'selected';} ?> value="exm10">Exam 10</option>');
                                                    } if($('#select_exam_type1').val() == 'final exam'){
                                                        $('#input_exam_title1').html('<option selected disabled></option><option <?php if($browse_exam_header[0]['exam_title'] == 'fexm1') {echo 'selected';} ?> value="fexm1">Final Exam 1</option><option <?php if($browse_exam_header[0]['exam_title'] == 'fexm2') {echo 'selected';} ?> value="fexm2">Final Exam 2</option><option <?php if($browse_exam_header[0]['exam_title'] == 'fexm3') {echo 'selected';} ?> value="fexm3">Final Exam 3</option><option <?php if($browse_exam_header[0]['exam_title'] == 'fexm4') {echo 'selected';} ?> value="fexm4">Final Exam 4</option><option <?php if($browse_exam_header[0]['exam_title'] == 'fexm5') {echo 'selected';} ?> value="fexm5">Final Exam 5</option>');
                                                    }
                                                })
                                                $('#select_exam_type1').change(function(){
                                                    if($('#select_exam_type1').val() == 'quiz'){
                                                        $('#input_exam_title1').html('<option selected disabled></option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz1') {echo 'selected';} ?> value="qz1">Quiz 1</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz2') {echo 'selected';} ?> value="qz2">Quiz 2</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz3') {echo 'selected';} ?> value="qz3">Quiz 3</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz4') {echo 'selected';} ?> value="qz4">Quiz 4</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz5') {echo 'selected';} ?> value="qz5">Quiz 5</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz6') {echo 'selected';} ?> value="qz6">Quiz 6</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz7') {echo 'selected';} ?> value="qz7">Quiz 7</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz8') {echo 'selected';} ?> value="qz8">Quiz 8</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz9') {echo 'selected';} ?> value="qz9">Quiz 9</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz10') {echo 'selected';} ?> value="qz10">Quiz 10</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz11') {echo 'selected';} ?> value="qz11">Quiz 11</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz12') {echo 'selected';} ?> value="qz12">Quiz 12</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz13') {echo 'selected';} ?> value="qz13">Quiz 13</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz14') {echo 'selected';} ?> value="qz14">Quiz 14</option><option <?php if($browse_exam_header[0]['exam_title'] == 'qz15') {echo 'selected';} ?> value="qz15">Quiz 15</option>');
                                                    } if($('#select_exam_type1').val() == 'exam'){
                                                        $('#input_exam_title1').html('<option selected disabled></option><option <?php if($browse_exam_header[0]['exam_title'] == 'exm1') {echo 'selected';} ?> value="exm1">Exam 1</option><option <?php if($browse_exam_header[0]['exam_title'] == 'exm2') {echo 'selected';} ?> value="exm2">Exam 2</option><option <?php if($browse_exam_header[0]['exam_title'] == 'exm3') {echo 'selected';} ?> value="exm3">Exam 3</option><option <?php if($browse_exam_header[0]['exam_title'] == 'exm4') {echo 'selected';} ?> value="exm4">Exam 4</option><option <?php if($browse_exam_header[0]['exam_title'] == 'exm5') {echo 'selected';} ?> value="exm5">Exam 5</option><option <?php if($browse_exam_header[0]['exam_title'] == 'exm6') {echo 'selected';} ?> value="exm6">Exam 6</option><option <?php if($browse_exam_header[0]['exam_title'] == 'exm7') {echo 'selected';} ?> value="exm7">Exam 7</option><option <?php if($browse_exam_header[0]['exam_title'] == 'exm8') {echo 'selected';} ?> value="exm8">Exam 8</option><option <?php if($browse_exam_header[0]['exam_title'] == 'exm9') {echo 'selected';} ?> value="exm9">Exam 9</option><option <?php if($browse_exam_header[0]['exam_title'] == 'exm10') {echo 'selected';} ?> value="exm10">Exam 10</option>');
                                                    } if($('#select_exam_type1').val() == 'final exam'){
                                                        $('#input_exam_title1').html('<option selected disabled></option><option <?php if($browse_exam_header[0]['exam_title'] == 'fexm1') {echo 'selected';} ?> value="fexm1">Final Exam 1</option><option <?php if($browse_exam_header[0]['exam_title'] == 'fexm2') {echo 'selected';} ?> value="fexm2">Final Exam 2</option><option <?php if($browse_exam_header[0]['exam_title'] == 'fexm3') {echo 'selected';} ?> value="fexm3">Final Exam 3</option><option <?php if($browse_exam_header[0]['exam_title'] == 'fexm4') {echo 'selected';} ?> value="fexm4">Final Exam 4</option><option <?php if($browse_exam_header[0]['exam_title'] == 'fexm5') {echo 'selected';} ?> value="fexm5">Final Exam 5</option>');
                                                    }
                                                })
                                            </script>

                                            

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="input_exam_title1">Test Title: </label>
                                                <select class="form-control" name="input_exam_title1" id="input_exam_title1">
                                                    <option selected disabled></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="input_exam_expiration">Expiration Date:</label>
                                                <input type="date" class="form-control" id="input_exam_expiration" name="input_exam_expiration" value="<?php echo $browse_exam_header[0]['expiration_date'];?>">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <!-- <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="select_exam_attempt">Test Attempt: <small>(Current: <?= $browse_exam_header[0]['exam_attempt'];?>)</small></label>
                                                <select class="form-control" name="select_exam_attempt" id="select_exam_attempt">
                                                    <option selected disabled></option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                </select>
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="input_exam_passingrate">Passing Rate:</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="input_exam_passingrate" name="input_exam_passingrate" value="<?php echo $browse_exam_header[0]['passing_rate'];?>">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="input_exam_timeduration">Time Duration:</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="input_exam_timeduration" name="input_exam_timeduration" value="<?php echo $browse_exam_header[0]['time_duration'];?>">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">minutes</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="textarea_exam_instruction">Instruction:</label>
                                                <textarea type="text" class="form-control" id="textarea_exam_instruction" name="textarea_exam_instruction" cols="5" rows="3"><?php echo $browse_exam_header[0]['instruction'];?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="modal-footer justify-content-between">
                                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-edit"></i> Update Test Header </button>
                                </div>

                                <input type="hidden" name="input_exam_header_id" value="<?php echo $browse_exam_header[0]['exam_header_id'];?>">
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
                                No test header available for editing.
                            </div>
                        <?php endif;?>
                        
                        <script>
                            $("#form_edit_exam_header").submit(function(e){
                                e.preventDefault();
                                $('#modal-open > .overlay').css('visibility', 'visible');
                                var formEditExamHeader = new FormData($(this)[0]);
                                $.ajax({
                                    url: "<?=site_url('exam/edit_exam_header')?>",
                                    data: formEditExamHeader,
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
                                                title: 'Edit Test Header Successful!',
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