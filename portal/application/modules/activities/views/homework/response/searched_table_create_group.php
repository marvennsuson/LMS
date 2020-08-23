                                    <div class="card-body table-responsive p-0" id="div_admission_table">
                                        <table class="table table-hover table-head-fixed text-nowrap" id="admission_table">
                                            <?php if($searched_student):?>  
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php foreach($searched_student as $ss):?>
                                                        <tr>
                                                            <td><?=$ss['lastname'];?>, <?=$ss['firstname'];?> <?=$ss['middlename'];?></td>
                                                        </tr>
                                                    <?php endforeach;?>
                                                </tbody>

                                            <?php else:?>
                                                <div class="box-body">
                                                    <div class="card-body">
                                                        <div class="alert alert-warning alert-dismissible">
                                                            <h4><i class="fa fa-exclamation-triangle"></i> Alert!</h4>
                                                            No Existing Student.
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif;?>
                                        </table>
                                    </div>