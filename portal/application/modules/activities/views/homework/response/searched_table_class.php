                                    <div class="card-body table-responsive p-0" id="div_admission_table">
                                        <table class="table table-hover table-head-fixed text-nowrap" id="admission_table">
                                            <?php if($searched_classes):?>  
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php foreach($searched_classes as $sc):?>
                                                        <tr>
                                                            <td>
                                                                <div class="icheck-primary d-flex ml-2">
                                                                    <input type="checkbox" value="<?=$sc['id']?>" name="toBulkRegister[]" id="toBulkRegister<?=$sc['id']?>">
                                                                    <label for="toBulkRegister<?=$sc['id']?>"></label>
                                                                    <span class="ml-3"><strong><?=$sc['subjectcode']?></strong> </span>
                                                                </div>
                                                                <input type="hidden" name="hidden_subject_id_class" id="hidden_subject_id_class" value="<?=$sc['id']?>">
                                                                <script>
                                                                    var subjectID = $('#toBulkRegister<?=$sc['id']?>').val();
                                                                    $('#hidden_subject_id').val(subjectID);
                                                                </script>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach;?>
                                                </tbody>

                                            <?php else:?>
                                                <div class="box-body">
                                                    <div class="card-body">
                                                        <div class="alert alert-warning alert-dismissible">
                                                            <h4><i class="fa fa-exclamation-triangle"></i> Alert!</h4>
                                                            No Existing Class.
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif;?>
                                        </table>
                                    </div>

                                    