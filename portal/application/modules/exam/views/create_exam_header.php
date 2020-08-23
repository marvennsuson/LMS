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
                            <h4 class="modal-title">Add Test Header</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form id="form_create_exam_header">
                            <div class="modal-body" id="create_exam_header_modal">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="select_exam_term">Term:</label>
                                            <select class="form-control" name="select_exam_term" id="select_exam_term">
                                                <option selected disabled></option>
                                                <option value="1st quarter">1st Quarter</option>
                                                <option value="2nd quarter">2nd Quarter</option>
                                                <option value="3rd quarter">3rd Quarter</option>
                                                <option value="4th quarter">4th Quarter</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="select_exam_type">Type:</label>
                                            <select class="form-control" name="select_exam_type" id="select_exam_type">
                                                <option selected disabled></option>
                                                <option value="quiz">Quiz</option>
                                                <option value="exam">Exam</option>
                                                <option value="final exam">Final Exam</option>
                                            </select>
                                        </div>

                                        <script>
                                            $('#select_exam_type').change(function(){
                                                if($('#select_exam_type').val() == 'quiz'){
                                                    $('#input_exam_title').html('<option selected disabled></option><option value="qz1">Quiz 1</option><option value="qz2">Quiz 2</option><option value="qz3">Quiz 3</option><option value="qz4">Quiz 4</option><option value="qz5">Quiz 5</option><option value="qz6">Quiz 6</option><option value="qz7">Quiz 7</option><option value="qz8">Quiz 8</option><option value="qz9">Quiz 9</option><option value="qz10">Quiz 10</option><option value="qz11">Quiz 11</option><option value="qz12">Quiz 12</option><option value="qz13">Quiz 13</option><option value="qz14">Quiz 14</option><option value="qz15">Quiz 15</option>');
                                                } if($('#select_exam_type').val() == 'exam'){
                                                    $('#input_exam_title').html('<option selected disabled></option><option value="exm1">Exam 1</option><option value="exm2">Exam 2</option><option value="exm3">Exam 3</option><option value="exm4">Exam 4</option><option value="exm5">Exam 5</option><option value="exm6">Exam 6</option><option value="exm7">Exam 7</option><option value="exm8">Exam 8</option><option value="exm9">Exam 9</option><option value="exm10">Exam 10</option>');
                                                } if($('#select_exam_type').val() == 'final exam'){
                                                    $('#input_exam_title').html('<option selected disabled></option><option value="fexm1">Final Exam 1</option><option value="fexm2">Final Exam 2</option><option value="fexm3">Final Exam 3</option><option value="fexm4">Final Exam 4</option><option value="fexm5">Final Exam 5</option>');
                                                }
                                            })
                                        </script>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="input_exam_title">Test Title:</label>
                                            <select class="form-control" name="input_exam_title" id="input_exam_title">
                                                <option selected disabled></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="input_exam_expiration">Expiration Date:</label>
                                            <input type="date" class="form-control" id="input_exam_expiration" name="input_exam_expiration">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="select_exam_attempt">Test Attempt:</label>
                                            <select class="form-control" name="select_exam_attempt" id="select_exam_attempt">
                                                <option selected disabled></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="input_exam_passingrate">Passing Rate:</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="input_exam_passingrate" name="input_exam_passingrate">
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
                                                <input type="number" class="form-control" id="input_exam_timeduration" name="input_exam_timeduration">
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
                                            <textarea type="text" class="form-control" id="textarea_exam_instruction" name="textarea_exam_instruction" cols="5" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div id="modal-open">
                                    <div class="overlay" style="visibility: hidden;">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="reset" class="btn btn-primary"><i class="fas fa-eraser"></i> Clear</button>
                                <button type="submit" class="btn btn-success float-right"><i class="fas fa-plus"></i> Create Test Header </button>
                            </div>
                        </form>
                        
                        <script>
                            $("#form_create_exam_header").submit(function(e){
                                e.preventDefault();
                                $('#modal-open > .overlay').css('visibility', 'visible');
                                var formCreateExamHeader = new FormData($(this)[0]);
                                $.ajax({
                                    url: "<?=site_url('exam/create_exam_header')?>",
                                    data: formCreateExamHeader,
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
                                                title: 'Create Test Header Successful!',
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