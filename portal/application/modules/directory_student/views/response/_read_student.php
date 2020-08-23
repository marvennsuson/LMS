<?php if($student_details):?>
    <?php foreach( $student_details as $sd):?>
        <?php if($sd['avatar']):?>
            <div class="row">
                <div class="col-12 col-md-4 col-lg-4 my-2">
                    <img src="<?= base_url('public/uploads/profiles/'.$sd['avatar']);?>" class="img-responsive" height="200vh">
                </div>
            </div>
        <?php endif;?>
        <div class="row">
            <div class="col-12 col-md-4 col-lg-4 my-2">
                <h5><Strong>ID</Strong></h5>
                <p><?= $sd['id']?></p>
            </div>
            <div class="col-12 col-md-4 col-lg-4 my-2">
                <h5><strong>Name</strong></h5>
                <p><?= $sd['lastname']?>, <?= $sd['firstname']?> <?= $sd['middlename']?></p>
            </div>
            <div class="col-12 col-md-4 col-lg-4 my-2">
                <h5><strong>Email</strong></h5>
                <p><?= $sd['email']?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 col-lg-4 my-2">
                <h5><Strong>School Lvl</Strong></h5>
                <p><?= $sd['student_type']?></p>
            </div>
            <div class="col-12 col-md-8 col-lg-8 my-2">
                <h5><strong>Address</strong></h5>
                <p><?= $sd['address']?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 col-lg-4 my-2">
                <h5><strong>Gender</strong></h5>
                <p><?= $sd['sex']?></p>
            </div>
            <div class="col-12 col-md-4 col-lg-4 my-2">
                <h5><strong>Birthday</strong></h5>
                <p><?= $sd['birthdate']?></p>
            </div>
            <div class="col-12 col-md-4 col-lg-4 my-2">
                <h5><strong>Phone</strong></h5>
                <p><?= $sd['cellphone']?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-3 col-lg-3 my-2">
                <h5><strong>Guardian</strong></h5>
                <p><?= $sd['guardian_name']?></p>
            </div>
            <div class="col-12 col-md-3 col-lg-3 my-2">
                <h5><strong>Guardian Email</strong></h5>
                <p><?= $sd['guardian_email']?></p>
            </div>
            <div class="col-12 col-md-3 col-lg-3 my-2">
                <h5><strong>Guardian Phone</strong></h5>
                <p><?= $sd['guardian_mobile']?></p>
            </div>
            <div class="col-12 col-md-3 col-lg-3 my-2">
                <h5><strong>Guardian Address</strong></h5>
                <p><?= $sd['guardian_address']?></p>
            </div>
        </div>
    <?php endforeach;?>
<?php else:?>
    <h1>No Existing Student.</h1>
<?php endif;?>