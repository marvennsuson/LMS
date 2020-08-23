
    <div class="mb-3">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4 order-2 order-md-1">
                <div class="form-group">
                    <label for="select_class_q1">Class</label>
                    <select class="form-control" name="select_class_q1" id="select_class_q1">
                        <option selected disabled></option>
                        <?php foreach($all_classes_by_teacher as $acbt):?>
                            <option value="<?= $acbt['subjectcode'];?>"><?= $acbt['subject_name'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="col-4 col-md-4 col-lg-4 order-2 order-md-1" id="select_type_q1" style="display: none;">
                <div class="form-group">
                    <label for="select_test_type_q1">Type</label>
                    <select class="form-control" name="select_test_type_q1" id="select_test_type_q1">
                        <option selected disabled></option>
                        <option value="quiz">Quiz</option>
                        <option value="exam">Exam</option>
                        <option value="final exam">Final Exam</option>
                    </select>
                </div>
            </div>
        </div>

        <div id="div_class_info_q1" stlye="display: none;">
            <div id="div_class_info_q1_inner">

            </div>
        </div>


    </div>

<script>
    $('#select_class_q1').change(function(){
        $('#select_type_q1').css('display', 'block');
    })

    $('#select_test_type_q1').change(function(){
        $('.overlay').css('visibility', 'visible');
        $.ajax({
            url: "<?=site_url('activities/search_class_info_q1')?>",
            data: {classCode : $('#select_class_q1').val(), testType : $('#select_test_type_q1').val() },
            type: "post",
            success: function(data){
                if(data.response == "false") {
                      alert('error');
                } else {
                    $('.overlay').css('visibility', 'hidden');
                    $("#div_class_info_q1").css('display', 'block');
                    $("#div_class_info_q1_inner").html(data);
                }
            },
        })
        return false;
    })
</script>
