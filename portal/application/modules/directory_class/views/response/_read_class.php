<?php if($class_details):?>
    <?php foreach( $class_details as $cd):?>
        <div class="row">
            <div class="col-12 col-md-4 col-lg-4 my-2">
                <h5><Strong>ID</Strong></h5>
                <p><?= $cd['id']?></p>
            </div>
            <div class="col-12 col-md-4 col-lg-4 my-2">
                <h5><strong>Subjectcode</strong></h5>
                <p><?= $cd['subjectcode']?></p>
            </div>
            <div class="col-12 col-md-4 col-lg-4 my-2">
                <h5><strong>Subject Name</strong></h5>
                <p><?= $cd['subjectname']?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 col-lg-4 my-2">
                <h5><Strong>Subject Description</Strong></h5>
                <p><?= $cd['subjectdesc']?></p>
            </div>
            <div class="col-12 col-md-8 col-lg-8 my-2">
                <h5><strong>Section</strong></h5>
                <p><?= $cd['section']?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 col-lg-4 my-2">
                <h5><strong>Schedule</strong></h5>
                <p><?= $cd['schedule']?></p>
            </div>
            <div class="col-12 col-md-4 col-lg-4 my-2">
                <h5><strong>Instructor</strong></h5>
                <p><?= $cd['teacherid']?></p>
            </div>
            <div class="col-12 col-md-4 col-lg-4 my-2">
                <h5><strong>Blockclass id</strong></h5>
                <p><?= $cd['blockclassid']?></p>
            </div>
        </div>
    <?php endforeach;?>
<?php else:?>
    <h1>No Existing Student.</h1>
<?php endif;?>