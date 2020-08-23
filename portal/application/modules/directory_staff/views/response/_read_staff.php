<?php if($staff_details):?>
    <?php foreach( $staff_details as $sd):?>
        <?php if($sd['photo']):?>
            <div class="row">
                <div class="col-12 col-md-4 col-lg-4 my-2">
                    <img src="<?= base_url('public/uploads/profiles/'.$sd['photo']);?>" class="img-responsive" height="200vh">
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
                <p><?= $sd['lname']?>, <?= $sd['fname']?> <?= $sd['mname']?></p>
            </div>
            <div class="col-12 col-md-4 col-lg-4 my-2">
                <h5><strong>Email</strong></h5>
                <p><?= $sd['email']?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 col-lg-4 my-2">
                <h5><Strong>Role</Strong></h5>
                <p><?= $sd['role_display_name']?></p>
            </div>
            <div class="col-12 col-md-8 col-lg-8 my-2">
                <h5><strong>Address</strong></h5>
                <p><?= $sd['address']?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 col-lg-4 my-2">
                <h5><strong>Gender</strong></h5>
                <p><?= $sd['gender']?></p>
            </div>
            <div class="col-12 col-md-4 col-lg-4 my-2">
                <h5><strong>Birthday</strong></h5>
                <p><?= $sd['bday']?></p>
            </div>
            <div class="col-12 col-md-4 col-lg-4 my-2">
                <h5><strong>Phone</strong></h5>
                <p><?= $sd['phone']?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-auto">
                <h3 class="text-center">My Class</h3>
            </div>
        </div>
    <?php endforeach;?>
<?php else:?>
    <h1>No Existing Staff.</h1>
<?php endif;?>