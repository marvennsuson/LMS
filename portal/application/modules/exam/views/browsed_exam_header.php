<?php if($browse_exam_header):?>
    <?php foreach($browse_exam_header as $beh):?>
        <div class="callout callout-warning">
            <div class="row">
                <div class="col-6 col-md-6 col-lg-6">
                    <div class="row">
                        <dt class="col-5 col-md-5 col-lg-5">Subject:</dt>
                        <dd class="col-7 col-md-7 col-lg-7">--------</dd>
                    </div>
                </div>

                <div class="col-6 col-md-6 col-lg-6">
                    <div class="row">
                        <dt class="col-5 col-md-5 col-lg-5">Test Title:</dt>
                        <dd class="col-7 col-md-7 col-lg-7"><?= $beh['exam_title']?></dd>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6 col-md-6 col-lg-6">
                    <div class="row">
                        <dt class="col-5 col-md-5 col-lg-5">Term:</dt>
                        <dd class="col-7 col-md-7 col-lg-7"><?= $beh['term']?></dd>
                    </div>
                </div>

                <div class="col-6 col-md-6 col-lg-6">
                    <div class="row">
                        <dt class="col-5 col-md-5 col-lg-5">Type:</dt>
                        <dd class="col-7 col-md-7 col-lg-7"><?= $beh['type']?></dd>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6 col-md-6 col-lg-6">
                    <div class="row">
                        <dt class="col-5 col-md-5 col-lg-5">Passing Rate:</dt>
                        <dd class="col-7 col-md-7 col-lg-7"><?= $beh['passing_rate']?></dd>
                    </div>
                </div>

                <div class="col-6 col-md-6 col-lg-6">
                    <div class="row">
                        <dt class="col-5 col-md-5 col-lg-5">Exam Attempt:</dt>
                        <dd class="col-7 col-md-7 col-lg-7"><?= $beh['exam_attempt']?></dd>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6 col-md-6 col-lg-6">
                    <div class="row">
                        <dt class="col-5 col-md-5 col-lg-5">Expiration Date:</dt>
                        <dd class="col-7 col-md-7 col-lg-7"><?= $beh['expiration_date']?></dd>
                    </div>
                </div>

                <div class="col-6 col-md-6 col-lg-6">
                    <div class="row">
                        <dt class="col-5 col-md-5 col-lg-5">Time Duration:</dt>
                        <dd class="col-7 col-md-7 col-lg-7"><?= $beh['time_duration']?></dd>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 col-md-12 col-lg-12">
                    <dt>Instruction:</dt>
                    <dd><?= $beh['instruction']?></dd>
                </div>
            </div>

        </div>
    <?php endforeach;?>
<?php endif;?>