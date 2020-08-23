<style>
    .note-editor{
        z-index: auto;
    }
</style>
<form rm id="form_create_homework">
    <div class="mb-3">
        <div class="row">
            <div class="col-6 col-md-6 col-lg-6">
                <label for="input_homework_title">Homework Title #:</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Homework Number</span>
                    </div>
                    <input type="number" class="form-control" name="input_homework_title" id="input_homework_title">
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

        <textarea class="textarea" id="textarea_homework" name="textarea_homework" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>

        <input type="hidden" name="hidden_subject_id" id="hidden_subject_id">
        <input type="hidden" name="hidden_student_id" id="hidden_student_id">

        <!-- <div class="row">
            <div class="col-6 col-md-6 col-lg-6 order-2 order-md-1">
                <div class="form-group">
                    <label for="select_options">Send to</label>
                    <select class="form-control" name="select_options" id="select_options">
                        <option selected disabled></option> -->
                        <!-- <option value="individual">Individual</option>
                        <option value="create group">Create Group</option> -->
                        <!-- <option value="class">Class</option>
                    </select>
                </div>
            </div>
        </div> -->

        <div class="row">
            <div class="table-responsive">
                <table id="table_ids" class="table table-sm">
                    <thead>
                      <tr>
                        <th> <input type="checkbox" id="checkalltable"  class="checkalltable"> </th>
                        <th>Subject Name</th>
                        <th>Schedule</th>
                      </tr>
                    </thead>
                    <tbody>
                          <?php foreach ($byClasstable as $byClasstable_row): ?>
                            <tr>
                            <td> <input type="checkbox" class="checkID" id="checkID" name="checkID[]" value="<?= $byClasstable_row->subjectcode ;?>"> </td>
                            <td><?= $byClasstable_row->subject_name ;?></td>
                            <td><?= $byClasstable_row->schedule ;?></td>
                            </tr>
                          <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
          <div class="justify-content-end d-flex">
                    <button type="submit" class="btn btn-success float-right mt-3"><i class="fas fa-pencil-alt"></i> Send Homework </button>
          </div>
    </div>
<!--
    <div class="modal fade" id="modal_individual">
        <div class="modal-dialog">
            <div class="modal-content" id="modal_individual_inner">
                </?= $this->load->view('modals/modal_individual');?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_create_group">
        <div class="modal-dialog">
            <div class="modal-content" id="modal_create_group_inner">

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_class">
        <div class="modal-dialog">
            <div class="modal-content" id="modal_class_inner">

            </div>
        </div>
    </div> -->

</form>


<script  src="<?= base_url('public/plugins/summernote/summernote-bs4.min.js');?>"></script>
<script>

  $(document).ready(function(){
        $('#table_ids').DataTable();
    $('#checkalltable').click(function () {
        $(':checkbox.checkID').prop('checked', this.checked);
     });
  });
    $(function(){
        $('.textarea').summernote({
            minHeight: 200,
        })
    })
    //
    // $('#select_options').change(function(){
    //     if($('#select_options').val() == 'individual'){
    //         $('#modal_individual').modal('show');
    //     }
    //     if($('#select_options').val() == 'create group'){
    //         $.ajax({
    //             url: "<//?=site_url('activities/search_student_by_teacher_hw')?>",
    //             data:{ teacherCode : '<//?php echo $this->session->teacher_code;?>' },
    //             type: "post",
    //             success: function(data)
    //             {
    //                // $('.overlay').css('visibility', 'hidden');
    //                $('#modal_create_group').modal('show');
    //                 $("#modal_create_group_inner").html(data);
    //             }
    //         })
    //         // return false;
    //     }
    //     if($('#select_options').val() == 'class'){
    //         $.ajax({
    //             url: "<//?=site_url('activities/search_class_by_teacher_hw')?>",
    //             data:{ teacherCode : '<//?php echo $this->session->teacher_code;?>' },
    //             type: "post",
    //             success: function(data)
    //             {
    //                // $('.overlay').css('visibility', 'hidden');
    //                $('#modal_class').modal('show');
    //                 $("#modal_class_inner").html(data);
    //             }
    //         })
    //     }
    // })

    $("#form_create_homework").submit(function(e){
        e.preventDefault();
        $('.overlay').css('visibility', 'visible');
        var formCreateHomework = new FormData($(this)[0]);
        $.ajax({
            url: "<?=site_url('activities/create_homework')?>",
            data: formCreateHomework,
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
                    $(':checkbox.checkID').prop('checked', false);
                    $(':checkbox.checkalltable').prop('checked', false);
                    $('#select_term').prop('selectedIndex',0);
                    $('#input_activity_score').val('');
                    $('#input_deadline').val('');
                    $('#textarea_homework').summernote('reset');
                    // $('#hidden_subject_id').val('');
                    // $('#hidden_student_id').val('');

                    Swal.fire({
                        title: 'Homework sent!',
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
