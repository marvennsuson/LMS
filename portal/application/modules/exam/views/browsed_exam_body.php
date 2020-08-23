<?php if($browse_exam_body):?>
    <?php foreach($browse_exam_body as $beb):?>
        <div class="container">
            <h3>Questions:</h3>
            <?= $beb['exam_created_form']?>
        </div>
    <?php endforeach;?>
<?php endif;?>