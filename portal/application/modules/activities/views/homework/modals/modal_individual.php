                                <div class="modal-header">
                                    <h4 class="modal-title">Individual Option</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body" id="edit_body_modal">
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-lg-12">
                                            <label for="input_search_name">Search Name:</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="input_search_name" id="input_search_name">
                                                <span class="input-group-append">
                                                    <button type="button" class="btn bg-gradient-primary"><i class="fas fa-search"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-lg-12" id="div_searched_table" style="display: none;">
                                            <div id="searched_table">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer justify-content-between">
                                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-send"></i> Send </button>
                                </div>

                                <div id="modal-open">
                                    <div class="overlay" style="visibility: hidden;">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>


                                <script>
                                     $('#input_search_name').keyup(function(){
                                        if($('#input_search_name').val() == '' ){
                                            $('#div_searched_table').css('display', 'none');
                                        } else {
                                            $('#div_searched_table').css('display', 'block');
                                            $.ajax({
                                                url: "<?=site_url('activities/search_student')?>",
                                                data: {searchItem : $('#input_search_name').val()},
                                                type: "post",
                                                success: function(data){
                                                    if(data.response == "false") {
                                                    } else {
                                                        $("#searched_table").html(data);
                                                    }
                                                },
                                            })
                                            return false;
                                        }
                                        
                                    })
                                </script>