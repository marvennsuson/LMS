<?php if($student_type):?>
    <form id="form_bulk_regi">
        <?php foreach($student_type as $st):?>
            <li class="my-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <div class="icheck-primary d-flex ml-2">
                            <input type="checkbox" value="<?=$st['lastname']?>, <?=$st['firstname']?> <?=$st['middlename']?>" name="toBulkRegister[]" id="toBulkRegister<?=$st['admission_id']?>">
                            <label for="toBulkRegister<?=$st['admission_id']?>"></label>
                            <span class="ml-3"><strong><?=$st['lastname']?>, <?=$st['firstname']?> <?=$st['middlename']?></strong> </span>
                        </div>
                    </div>
                    
                    <label for="bulk_reg_select_class_code" class="mr-4">Class Code: </label>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control" name="bulk_reg_select_class_code[]" id="bulk_reg_select_class_code">
                                <option selected disabled></option>
                                <?php foreach($classes as $c):?>
                                    <option value="<?=$c['classcode']?>"><?=$c['classcode']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
            </li>
            <hr>
            <input type="hidden" name="toBulkRegister_admission_id[]" id="toBulkRegister_admission_id<?=$st['admission_id']?>" value="<?=$st['admission_id']?>">
            <input type="hidden" name="toBulkRegister_email[]" id="toBulkRegister_email<?=$st['admission_id']?>" value="<?=$st['email']?>">
        <?php endforeach;?>
        <button type="submit" class="btn btn-info float-right"><i class="fas fa-plus"></i> Save</button>
    </form>
<?php else:?>
    <div class="alert alert-warning alert-dismissible" id="search_by_level_response">
        <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
        No Student Available.
    </div>
<?php endif;?>

<script>
    $('#form_bulk_regi').submit(function(e){
        e.preventDefault();
        $('.overlay').css('visibility', 'visible');
        var registerStudent = new FormData($(this)[0]);
        $.ajax({
            url: "<?=site_url('admissions/bulk_registration_insert')?>",
            data: registerStudent,
            dataType: 'json',
            type: "post",
            async: false,
            success: function(data)
            {
                if(data.response == "false") {
                    $('.overlay').css('visibility', 'hidden');
                    Swal.fire({
                        html: data.message,
                        type: 'error',
                    })
                } else {
                    $("#reg_select_classcode").val('');
                    
                    Swal.fire({
                        title: 'Student Registered!',
                        type: 'success',
                    }).then((result) => {
                        location.reload();
                    })
                }
                $('.overlay').css('visibility', 'hidden');
            },
            contentType: false,
            cache: false,
            processData: false,
        });
    });
</script>