
<div class="card-body">
    <h3 class="card-title"><strong>Class Code: </strong>
        <?php if(empty($class_details[0]['classcode'])):?>
            No Class Code Available.
        <?php else:?>
            <?= $class_details[0]['classcode']?>
        <?php endif;?>
    </h3>
    <br>
    <strong>Class Type: </strong> 
    <?php if(empty($class_details[0]['classtype'])):?>
            No Class Type Available.
        <?php else:?>
            <?= $class_details[0]['classtype']?>
    <?php endif;?>
    <hr>
    <?php if(!$class_details):?>
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
            No Class Details Available.
        </div>
    <?php else:?>
        <table class="table table-bordered">
            <thead>                  
                <tr>
                    <th>Subject</th>
                    <th>Teacher</th>
                    <th>Section</th>
                    <th>Schedule</th>
                </tr>
            </thead>
            <tbody>
                
                    <?php foreach( $class_details as $cd):?>
                        <tr>
                            <td><?= $cd['subject'];?></td>
                            <td><?= $cd['teacher'];?></td>
                            <td><?= $cd['section'];?></td>
                            <td><?= $cd['schedule'];?></td>
                        </tr>
                    <?php endforeach;?>
            </tbody>
        </table>
</div>
<?php endif;?>