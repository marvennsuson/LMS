                                            <?php if($searched_student):?>  
                                                <ul class="todo-list" data-widget="todo-list">
                                                    <li>
                                                        <?php foreach($searched_student as $ss):?>
                                                            <div class="icheck-primary d-flex ml-2">
                                                                <input type="checkbox" value="<?=$ss['lastname']?>, <?=$ss['firstname']?> <?=$ss['middlename']?>" name="toBulkRegister[]" id="toBulkRegister<?=$ss['admission_id']?>">
                                                                <label for="toBulkRegister<?=$ss['admission_id']?>"></label>
                                                                <span class="ml-3"><strong><?=$ss['lastname']?>, <?=$ss['firstname']?> <?=$ss['middlename']?></strong> </span>
                                                            </div>
                                                            <input type="hidden" name="toBulkRegister_admission_id[]" id="toBulkRegister_admission_id<?=$ss['admission_id']?>" value="<?=$ss['admission_id']?>">
                                                            <input type="hidden" name="toBulkRegister_email[]" id="toBulkRegister_email<?=$ss['admission_id']?>" value="<?=$ss['email']?>">
                                                            <input type="hidden" name="hidden_student_id_indi[]" id="hidden_student_id_indi" value="<?=$ss['admission_id']?>">
                                                            <script>
                                                                var studentID = $('#hidden_student_id_indi').val();
                                                                $('#hidden_student_id').val(studentID);
                                                            </script>
                                                        <?php endforeach;?>
                                                    </li>
                                                </ul>
                                            <?php else:?>
                                                <div class="box-body">
                                                    <div class="card-body">
                                                        <div class="alert alert-warning alert-dismissible">
                                                            <h4><i class="fa fa-exclamation-triangle"></i> Alert!</h4>
                                                            No Existing Student
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif;?>

                                            <script>
                                                $("#form_create_homework").submit(function(e){
                                                    e.preventDefault();
                                                    // $('.overlay').css('visibility', 'visible');
                                                    var formSendSeatwork = new FormData($(this)[0]);
                                                    $.ajax({
                                                        url: "<?=site_url('activities/bulk_homework_send')?>",
                                                        data: formSendSeatwork,
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
                                                                $('#input_homework_title').val('');
                                                                $('#userfile').val('');
                                                                $('#select_options').prop('selectedIndex',0);
                                                                $('#select_term').prop('selectedIndex',0);
                                                                $('#input_activity_score').val('');
                                                                $('#input_deadline').val('');
                                                                $('#textarea_homework').summernote('reset');
                                                                $('#hidden_subject_id').val('');
                                                                $('#hidden_student_id').val('');    
                                                                Swal.fire({
                                                                    title: 'Seatwork sent!',
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
                                                            // $('.overlay').css('visibility', 'hidden');
                                                        },
                                                        contentType: false,
                                                        cache: false,
                                                        processData: false,
                                                    });
                                                });
                                            </script>