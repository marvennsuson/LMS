
<div class="content">
    <form id="form_add_block_class">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="input_block_class_code">Block Class Code</label>
                        <input type="text" class="form-control" name="input_block_class_code" id="input_block_class_code">
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="input_block_subjectname">Subject Name</label>
                        <input type="text" class="form-control" name="input_block_subjectname" id="input_block_subjectname">
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="input_block_section">Section</label>
                        <input type="text" class="form-control" name="input_block_section" id="input_block_section">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8 col-md-8 col-lg-8">
                    <div class="form-group">
                        <label for="input_block_subjectdesc">Subject Description</label>
                        <input type="text" class="form-control" name="input_block_subjectdesc" id="input_block_subjectdesc">
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="select_block_instructor">Instructor</label>
                        <select class="form-control" name="select_block_instructor" id="select_block_instructor">
                            <option selected disabled></option>
                            <?php foreach($teachers_list as $tl):?>
                                <option value="<?= $tl['staffcode']?>"><?= $tl['name']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-4 col-md-4 col-lg-4">
                    <label for="">Schedule</label>
                    <div class="form-group">
                        <label for="checkbox_day_block_sun"><input type="checkbox" name="checkbox_day_block" id="checkbox_day_block_sun" value="SUN"> Sunday </label> <br/>
                        <label for="checkbox_day_block_m"><input type="checkbox" name="checkbox_day_block" id="checkbox_day_block_m" value="M"> Monday </label> <br/>
                        <label for="checkbox_day_block_t"><input type="checkbox" name="checkbox_day_block" id="checkbox_day_block_t" value="T"> Tuesday </label> <br/>
                        <label for="checkbox_day_block_w"><input type="checkbox" name="checkbox_day_block" id="checkbox_day_block_w" value="W"> Wednesday </label> <br/>
                        <label for="checkbox_day_block_th"><input type="checkbox" name="checkbox_day_block" id="checkbox_day_block_th" value="TH"> Thursday </label> <br/>
                        <label for="checkbox_day_block_f"><input type="checkbox" name="checkbox_day_block" id="checkbox_day_block_f" value="F"> Friday </label> <br/>
                        <label for="checkbox_day_block_sat"><input type="checkbox" name="checkbox_day_block" id="checkbox_day_block_sat" value="SAT"> Saturday </label> <br/>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label>From:</label>
                            <input type="text" class="form-control datetimepicker-input" id="input_block_time2" name="input_block_time2" data-toggle="datetimepicker" data-target="#input_block_time2">
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label>To:</label>
                            <input type="text" class="form-control datetimepicker-input" id="input_block_time3" name="input_block_time3" data-toggle="datetimepicker" data-target="#input_block_time3">
                        </div>
                    </div>
                </div>
                <p id="sched" style="display: none;"></p>
                <input type="hidden" id="input_block_sched" name="input_block_sched">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>

<script>

    $('input:checkbox[name=checkbox_day_block]').change(function(){
    $('#sched').text('');
    $('input:checkbox[name=checkbox_day_block]:checked').each(function() 
        {
            $('#sched').append($(this).val())
            $('#input_block_sched').val($('#sched').text());
        });
    })
    
    $('#form_add_block_class').submit(function(e){
        e.preventDefault();
        $('#overlay_add_class > .overlay').css('visibility', 'visible');
        var addClass = new FormData($(this)[0]);
        $.ajax({
            url: "<?=site_url('directory_class/add_block_class')?>",
            data: addClass,
            dataType: "json",
            type: "post",
            async: false,
            success: function(data)
            {
                if(data.response == "false") {
                    $('#overlay_add_class > .overlay').css('visibility', 'hidden');
                    Swal.fire({
                        html: data.message,
                        type: 'error',
                    })
                } else {
                    $("#reg_select_classcode").val('');
                    $('#overlay_add_class > .overlay').css('visibility', 'hidden');
                    Swal.fire({
                        title: 'Block Class Added!',
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

    $('#input_block_time2').datetimepicker({
      format: 'LT'
    })
    $('#input_block_time3').datetimepicker({
      format: 'LT'
    })
</script>