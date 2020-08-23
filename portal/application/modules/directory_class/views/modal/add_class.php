<link rel="stylesheet" href="<?= base_url('public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')?>">
<div class="content">
    <form id="form_add_class">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="input_subjectcode">Subject Code</label>
                        <input type="text" class="form-control" name="input_subjectcode" id="input_subjectcode">
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="input_subjectname">Subject Name</label>
                        <input type="text" class="form-control" name="input_subjectname" id="input_subjectname">
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="input_section">Section</label>
                        <input type="text" class="form-control" name="input_section" id="input_section">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8 col-md-8 col-lg-8">
                    <div class="form-group">
                        <label for="input_subjectdesc">Subject Description</label>
                        <input type="text" class="form-control" name="input_subjectdesc" id="input_subjectdesc">
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="select_instructor">Instructor</label>
                        <select class="form-control" name="select_instructor" id="select_instructor">
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
                        <label for="checkbox_day_sun"><input type="checkbox" name="checkbox_day" id="checkbox_day_sun" value="SUN"> Sunday </label> <br/>
                        <label for="checkbox_day_m"><input type="checkbox" name="checkbox_day" id="checkbox_day_m" value="M"> Monday </label> <br/>
                        <label for="checkbox_day_t"><input type="checkbox" name="checkbox_day" id="checkbox_day_t" value="T"> Tuesday </label> <br/>
                        <label for="checkbox_day_w"><input type="checkbox" name="checkbox_day" id="checkbox_day_w" value="W"> Wednesday </label> <br/>
                        <label for="checkbox_day_th"><input type="checkbox" name="checkbox_day" id="checkbox_day_th" value="TH"> Thursday </label> <br/>
                        <label for="checkbox_day_f"><input type="checkbox" name="checkbox_day" id="checkbox_day_f" value="F"> Friday </label> <br/>
                        <label for="checkbox_day_sat"><input type="checkbox" name="checkbox_day" id="checkbox_day_sat" value="SAT"> Saturday </label> <br/>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label>From:</label>
                            <input type="text" class="form-control datetimepicker-input" id="input_time" name="input_time" data-toggle="datetimepicker" data-target="#input_time">
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label>To:</label>
                            <input type="text" class="form-control datetimepicker-input" id="input_time1" name="input_time1" data-toggle="datetimepicker" data-target="#input_time1">
                        </div>
                    </div>
                </div>
                <p id="sched" style="display: none;"></p>
                <input type="hidden" id="input_sched" name="input_sched">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
<script src="<?= base_url('public/plugins/moment/moment.min.js')?>"></script>
<script src="<?= base_url('public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')?>"></script>
<script>

    $('input:checkbox[name=checkbox_day]').change(function(){
    $('#sched').text('');
    $('input:checkbox[name=checkbox_day]:checked').each(function() 
        {
            $('#sched').append($(this).val())
            $('#input_sched').val($('#sched').text());
        });
    })
    
    $('#form_add_class').submit(function(e){
        e.preventDefault();
        // alert($('#input_sched').val())
        $('#overlay_add_class > .overlay').css('visibility', 'visible');
        var addClass = new FormData($(this)[0]);
        $.ajax({
            url: "<?=site_url('directory_class/add_class')?>",
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
                        title: 'Class Added!',
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

    $('#input_time').datetimepicker({
      format: 'LT'
    })
    $('#input_time1').datetimepicker({
      format: 'LT'
    })
</script>