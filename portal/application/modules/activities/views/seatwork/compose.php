<style>
    .note-editor{
        z-index: auto;
    }
</style>
<form  id="form_create_seatwork">
    <div class="mb-3">
        <div class="row">
            <div class="col-6 col-md-6 col-lg-6">
                <label for="input_seatwork_title">Seatwork Number:</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Number</span>
                    </div>
                    <input type="number" class="form-control" name="input_seatwork_title" id="input_seatwork_title">
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="userfile">Attach File:</label>
                    <input type="file" name="userfile" id="userfile" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6 col-md-6 col-lg-6 order-2 order-md-1">
                <div class="form-group">
                    <label for="select_term">Term</label>
                    <select class="form-control" name="select_term" id="select_term">
                        <option selected disabled></option>
                        <option value="1st quarter">1st Quarter</option>
                        <option value="2nd quarter">2nd Quarter</option>
                        <option value="3rd quarter">3rd Quarter</option>
                        <option value="4th quarter">4th Quarter</option>
                    </select>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="input_activity_score">Points:</label>
                    <input type="text" name="input_activity_score" id="input_activity_score" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="input_deadline">Deadline:</label>
                    <input type="date" name="input_deadline" id="input_deadline" class="form-control">
                </div>
            </div>
        </div>

        <textarea class="textarea" id="textarea_seatwork" name="textarea_seatwork" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>

        <input type="hidden" name="hidden_subject_id" id="hidden_subject_id">
        <input type="hidden" name="hidden_student_id" id="hidden_student_id">



                <div class="row w-100 justify-content-center d-flex">
                    <div class="table-responsive">
                      <table id="table_ids" class="table table-sm w-100">
                          <thead style="max-width: 100% !important">
                            <tr>
                              <th><input type="checkbox" id="checkalltable" ></th>
                              <th>Subject Name</th>
                                <th>Schedule</th>
                            </tr>
                          </thead>
                          <tbody style="max-width: 100% !important" >
                              <?php foreach($class_by as $classes_row): ?>
                                <tr>
                                  <td > <input type="checkbox" name="CheckId[]" id="CheckId" class="CheckId" value="<?= $classes_row["subjectcode"] ?>"> </td>
                                      <td ><?= $classes_row["subject_name"] ?></td>
                                          <td><?=  $classes_row["schedule"] ?></td>
                                </tr>
                            <?php endforeach; ?>
                          </tbody>
                      </table>

                    </div>
                </div>
        <button type="submit" class="btn btn-success float-left mt-3"><i class="fas fa-pencil-alt"></i> Send Seatwork </button>
    </div>



</form>



<script  src="<?= base_url('public/plugins/summernote/summernote-bs4.min.js');?>"></script>
<script>


  $(document).ready(function(){
        $('#table_ids').DataTable();
    $('#checkalltable').click(function () {
        $(':checkbox.CheckId').prop('checked', this.checked);
     });
  });
    $(function(){
        $('.textarea').summernote({
            minHeight: 200,
        })
    })


    $("#form_create_seatwork").submit(function(e){
        e.preventDefault();
        // $('.overlay').css('visibility', 'visible');
        var formCreateSeatwork = new FormData($(this)[0]);
        // e.preventDefault();
        //  var fa = $(this);

        $.ajax({
            url: "<?=site_url('activities/create_seatwork')?>",
            data: formCreateSeatwork,
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
                    $('#input_seatwork_title').val('');
                    $('#userfile').val('');
                    $('#select_options').prop('selectedIndex',0);
                    $('#select_term').prop('selectedIndex',0);
                    $('#input_activity_score').val('');
                    $('#input_deadline').val('');
                    $('#textarea_seatwork').summernote('reset');
                    // $('#hidden_subject_id').val('');
                    // $('#hidden_student_id').val('');

                    Swal.fire({
                        title: 'Seatwork sent!',
                        type: 'success',
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
