                                <div class="modal-header">
                                    <h4 class="modal-title">Class</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body" id="edit_body_modal">
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-lg-12">
                                            <label for="input_search_name_class">Search Name:</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="input_search_name_class" id="input_search_name_class">
                                                <span class="input-group-append">
                                                    <button id="btn_add_to_group" type="button" class="btn bg-gradient-primary"><i class="fas fa-plus"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-lg-12" id="div_searched_table_class" style="display: none;">
                                            <form id="form_bulk_add_class">   
                                                <div id="searched_table_class">
                                                    
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="modal-footer justify-content-between">
                                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-send"></i> Send to Class</button>
                                </div>

                                <div id="modal-open">
                                    <div class="overlay" style="visibility: hidden;">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>

                                <script>
                                    $('#form_bulk_add_class').submit(function(e){
                                        e.preventDefault();
                                        $('#.overlay').css('visibility', 'visible');
                                        var sendToClass = new FormData($(this)[0]);
                                        $.ajax({
                                            url: "<?=site_url('activities/bulk_homework_send_class')?>",
                                            data: sendToClass,
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
                                                        title: 'Class Added!',
                                                        type: 'success',
                                                    }).then((result) => {
                                                        location.reload();
                                                    })
                                                }
                                                $('#hidden_subject_id').val('');
                                                $('#hidden_student_id').val('');    
                                                $('.overlay').css('visibility', 'hidden');
                                            },
                                            contentType: false,
                                            cache: false,
                                            processData: false,
                                        });
                                    });
                                </script>

                                <script>
                                     $('#input_search_name_class').keyup(function(){
                                        if($('#input_search_name_class').val() == '' ){
                                            $('#div_searched_table_class').css('display', 'none');
                                        } else {
                                            $('#div_searched_table_class').css('display', 'block');
                                            $.ajax({
                                                url: "<?=site_url('activities/search_class_hw')?>",
                                                data: {searchItem : $('#input_search_name_class').val()},
                                                type: "post",
                                                success: function(data){
                                                    if(data.response == "false") {
                                                    } else {
                                                        // $("#div_searched_table_class").css('display', 'block');
                                                        $("#searched_table_class").html(data);
                                                    }
                                                },
                                            })
                                            return false;
                                        }
                                    })
                                </script>
                                