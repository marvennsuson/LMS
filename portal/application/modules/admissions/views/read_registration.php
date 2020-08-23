
        <section class="content">
            <div class="mb-3">
                <p style="margin-bottom: 0;"><strong>Name: <?= strtoupper($admission_details['lastname'])?>, <?= strtoupper($admission_details['firstname'])?> <?= strtoupper($admission_details['middlename'])?></strong> </p>
                <small><strong>Date: </strong> <?= date('M d, Y');?></small>
            </div>
            
            <div class="row">
                 <div class="col-4 col-md-4 col-lg-4 order-2 order-md-1">
                    <form id="form_reg_student">
                        <div class="form-group">
                            <input type="hidden" name="admission_id" id="admission_id" value="<?= $admission_details['admission_id']?>">
                            <label for="reg_select_classcode">Class Code</label>
                            <select class="form-control" name="reg_select_classcode" id="reg_select_classcode">
                                <option selected disabled></option>
                                <?php foreach($classes as $c):?>
                                    <option value="<?=$c['classcode']?>"><?=$c['classcode']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <input type="hidden" name="student_email" id="student_email" value="<?= $admission_details['email']?>">
                        <button id="btn_register" type="submit" class="btn btn-success pull-right"><i class="fas fa-save"></i>  Register</button>
                    </form>
                </div>
                
                <div id="modal-open" class="col-8 col-md-8 col-lg-8 order-2 order-md-1">
                    <div class="overlay" style="visibility: hidden;">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>
                    <div id="div_class_info" style="display: block;">
                        <div class="card card-primary mb-3" id="div_class_info_inner">
                            
                        </div>
                    </div>
                </div>

            </div>

        </section>

        <script>
            $('#form_reg_student').submit(function(e){
                e.preventDefault();
                $('#modal-open > .overlay').css('visibility', 'visible');
                var registerStudent = new FormData($(this)[0]);
                $.ajax({
                    url: "<?=site_url('admissions/add_class_to_student')?>",
                    data: registerStudent,
                    dataType: "json",
                    type: "post",
                    async: false,
                    success: function(data)
                    {
                        if(data.response == "false") {
                            $('#modal-open > .overlay').css('visibility', 'hidden');
                            Swal.fire({
                                html: data.message,
                                type: 'error',
                            })
                        } else {
                            $("#reg_select_classcode").val('');
                            $('#modal-open > .overlay').css('visibility', 'hidden');
                            Swal.fire({
                                title: 'Student Registered!',
                                type: 'success',
                            }).then((result) => {
                                location.reload();
                            })
                        }
                    },
                    contentType: false,
                    cache: false,
                    processData: false,
                });
            });
        </script>

        <script>
        
            $(document).ready(function(){
                $('#reg_select_classcode').change(function(){
                    $("#div_class_info").css('display', 'none');
                    $('#modal-open > .overlay').css('visibility', 'visible');
                    if($('#reg_select_classcode').val() == '' ){
                        // $('#div_admission_table').css('display', 'block');
                        // $('#div_searched_table').css('display', 'none');
                    } else {
                        // $('#div_admission_table').css('display', 'none');
                        // $('#div_searched_table').css('display', 'block');
                        $.ajax({
                            url: "<?=site_url('admissions/read_class_details')?>",
                            data: {classcode : $('#reg_select_classcode').val()},
                            type: "post",
                            success: function(data){
                                if(data.response == "false") {
                                } else {
                                    $('#modal-open > .overlay').css('visibility', 'hidden');
                                    $("#div_class_info").css('display', 'block');
                                    $("#div_class_info_inner").html(data);
                                }
                            },
                        })
                        return false;
                    }
                })
            })
        </script>