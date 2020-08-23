<?php if($class_details):?>
    <?php foreach( $class_details as $sd):?>
        <form id="edit_class">
            <div class="card-body">
                <div class="form-group">
                    <label for="input_subjectcode">Subjectcode</label>
                    <input type="text" class="form-control" id="input_subjectcode" name="input_subjectcode" value="<?php echo $sd['subjectcode']?>">
                </div>
                <div class="form-group">
                    <label for="input_subjectname">Subjectname</label>
                    <input type="text" class="form-control" id="input_subjectname" name="input_subjectname" value="<?php echo $sd['subjectname']?>">
                </div>
                <div class="form-group">
                    <label for="input_subjectdesc">Subject Description</label>
                    <input type="text" class="form-control" id="input_subjectdesc" name="input_subjectdesc" value="<?php echo $sd['subjectdesc']?>">
                </div>
                <div class="form-group">
                    <label for="input_section">Section</label>
                    <input type="text" class="form-control" id="input_section" name="input_section" value="<?php echo $sd['section']?>">
                </div>
                <div class="form-group">
                    <label for="input_schedule">Schedule</label>
                    <input type="text" class="form-control" id="input_schedule" name="input_schedule" value="<?php echo $sd['schedule']?>">
                </div>
                <div class="form-group">
                    <label for="input_teacherid">Instructor</label>
                    <input type="text" class="form-control" id="input_teacherid" name="input_teacherid" value="<?php echo $sd['teacherid']?>">
                </div>
                <div class="form-group">
                    <label for="input_block_classcode">Blockclass</label>
                    <input type="text" class="form-control" id="input_block_classcode" name="input_block_classcode" value="<?php echo $sd['blockclassid']?>">
                </div>
            </div>

            <input type="hidden" name="hidden_id" value="<?php echo $sd['id']?>">
            <div class="mx-4 mb-4">
                <button type="submit" class="btn btn-success">Update Class</button>
            </div>
        </form>
    <?php endforeach;?>
<?php else:?>
    <h1>No Existing Class.</h1>
<?php endif;?>


<script>
    $("#edit_class").submit(function(e){
        e.preventDefault();
        $('.overlay').css('visibility', 'visible');
        var formEditClass = new FormData($(this)[0]);
        $.ajax({
            url: "<?=site_url('directory_class/insert_edit_class')?>",
            data: formEditClass,
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
                        title: 'Edit Class Successful!',
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
                $('.overlay').css('visibility', 'hidden');
            },
            contentType: false,
            cache: false,
            processData: false,
        });
    });
</script>