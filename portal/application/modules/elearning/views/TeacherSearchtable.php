<?php if($downloads_list):?>
    <thead>
        <tr>
            <th>Filename</th>
            <th>Uploaded</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($downloads_list as $dl):?>
            <tr>
                <td><?=$dl['filename'];?></td>
                <td><?=$dl['created_at'];?></td>
                <td>
                    <a href="<?=site_url('elearning/Elearning/downloadfile/').$dl['filename'];?>" ><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#staff_edit"><i class="fa fa-download"></i> Download</button></a>
                </td>
            </tr>
        <?php endforeach;?>
    </tbody>

<?php else:?>
    <div class="box-body">
        <div class="card-body">
            <div class="alert alert-warning alert-dismissible">
                <h4><i class="fa fa-exclamation-triangle"></i> Alert!</h4>
                No Existing Upload
            </div>
        </div>
    </div>
<?php endif;?>
