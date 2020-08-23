<div class="container-fluid">
<small class="h4 p-5">My Inbox Recieve</small> <div class="float-right clearfix">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
Manage Remove Inbox
</button></div>
<hr>

<div class="row">
<div class="col-5 col-sm-3">
<div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
<a class="nav-link active" id="vert-tabs-recieve-tab" data-toggle="pill" href="#vert-tabs-recieve" role="tab" aria-controls="vert-tabs-recieve" aria-selected="true">Message Recieve <span class="badge bg-warning float-right"><?= $CountInboxRecieve ?></span></a>
<a class="nav-link" id="vert-tabs-deletedrecieve-tab" data-toggle="pill" href="#vert-tabs-deletedrecieve" role="tab" aria-controls="vert-tabs-deletedrecieve" aria-selected="false">Removed Message<span class="badge bg-danger float-right"><?= $CountInboxRemove ?></span></a>

</div>

</div>
<div class="col-7 col-sm-9">
<div class="tab-content" id="vert-tabs-tabContent">
<div class="tab-pane text-left fade show active" id="vert-tabs-recieve" role="tabpanel" aria-labelledby="vert-tabs-recieve-tab">
<div class="">
<?php if($messageRecievelist->num_rows() > 0): ?>
<?php foreach($messageRecievelist->result() as $messageRecievelist_row): ?>
<div class="card">
<div class="card-header bg-dark d-flex align-items-center">
<h3 class="card-title"><?= $messageRecievelist_row->title ?></h3>
<div class=" ml-auto">
<strong><?=  date('M d, Y : h:i  ', strtotime($messageRecievelist_row->created_at)); ?></strong>
</div>
</div>
<div class="card-body">
<p>
<?= $messageRecievelist_row->description ?>
</p>
</div>
<div class="card-footer d-flex align-items-center">
<strong>   <?= $messageRecievelist_row->email ?> </strong>
<div class=" ml-auto">
<a class="btn btn-success flat-btn"  href="<?= site_url('message/Messages/StudentViewMessage/').$messageRecievelist_row->message_id;  ?>" > <i style="font-size:14px" class="far fa-paper-plane"></i>&nbsp;&nbsp;Reply now</a>
</div>
</div>
</div>
<?php endforeach; ?>
<?php
else:
echo "<center> <strong> No List of Data </strong> </center>";

endif; ?>
</div>
</div>
<div class="tab-pane fade" id="vert-tabs-deletedrecieve" role="tabpanel" aria-labelledby="vert-tabs-deletedrecieve-tab">
<div class="">
<?php if($MessageRemoveList->num_rows() > 0): ?>
<?php foreach($MessageRemoveList->result() as $MessageRemoveList_row): ?>
<div class="card">
<div class="card-header bg-danger d-flex align-items-center">
<h3 class="card-title"><?= $MessageRemoveList_row->title ?></h3>
<div class=" ml-auto">
<strong><?=  date('M d, Y : h:i  ', strtotime($MessageRemoveList_row->created_at)); ?></strong>
</div>
</div>
<div class="card-body">
<p>
<?= $MessageRemoveList_row->description ?>
</p>
</div>
<div class="card-footer d-flex align-items-center">
<strong>   <?= $MessageRemoveList_row->email ?> </strong>
<div class=" ml-auto">
<a  href="<?= site_url('message/Messages/DeleteMessageRecieve/').$MessageRemoveList_row->message_id;?>" class="btn btn-danger btn-flat" ><i style=" color: #fff ; font-size:14px"  class="far fa-trash-alt"></i>&nbsp;&nbsp;Permanently Deleted</a>
</div>
</div>
</div>
<?php endforeach; ?>
<?php
else:
echo "<center> <strong> No List of Data </strong> </center>";
endif; ?>
</div>
</div>

</div>
</div>
</div>
</div>
