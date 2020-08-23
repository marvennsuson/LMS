<?php
if (!empty($students)) {
    ?>
    <div class= "col-12">
      <div class="card card-warning card-outline">
        <div class="card-header">
                <h4 class="card-title">Student List</h4>
            </div>
            <div class="card-body table-responsive p-0" id="div_search_student_table">
                <div class="row">
                <?php
                    foreach ($students as $std) {
                        ?>
                        <div class="col-3 col-md-3 col-lg-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="chk_students[]" id="chk_students" value="<?php echo $std['student_number']; ?>">
                                <label class="" for="chk_students[]"><?php echo $std['firstname'] . " " . $std['middlename'] . " " . $std['lastname']?></label>
                            </div>
                        </div>

                        <?php
                    }
                ?>
                </div>

            </div>
        </div>
    </div>

    <?php
}else{
    ?>
    <div class="box-body w-100">
        <div class="card-body">
            <div class="alert alert-warning alert-dismissible">
                <h4><i class="fa fa-exclamation-triangle"></i> Alert!</h4>
                No Existing Student
            </div>
        </div>
    </div>

    <hr>
    <?php
}
?>
