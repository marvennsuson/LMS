
<?php if($getallpost->num_rows() > 0): ?>
<div class="row">
<div class="card p-3 w-100">
  <div class="justify-content-end d-flex">
    <!-- <input type="text" class="search-box" name="" value=""> -->
    <button type="submit" class="btn btn-sm btn-flat btn-info text-white" name="button"> <a class="text-white" href="<?= site_url('timeline/Timeline');?>">Back Timeline</a> </button>
  </div>
    <div class="row">
      <div class="col-md-12 ">
            <div class="timeline" style="min-width: auto;">
                <?php foreach($getallpost->result() as $getallpost_row): ?>
            <div class="time-label">
              <span class="bg-warning "> <?php if(!empty( $getallpost_row->subject_name)) {echo  $getallpost_row->subject_name;  }else{ echo $getallpost_row->role_display_name; } ?></span>
            </div>
            <div>
              <i class="fas fa-comments bg-yellow"></i>
              <div class="timeline-item" style="min-width: auto;">
                <span class="time"><i style="color:violet; font-size: 15px;" class="fas fa-clock mr-2"></i><?= date('M d, Y : h:i  ', strtotime( $getallpost_row->created_at)); ?></span>
                <h3 class="timeline-header"><span class="badge badge-pill badge-warning"><?= $getallpost_row->role_display_name?></span>  &nbsp;<a href="#"><?= $getallpost_row->name ?></a>  &nbsp;> &nbsp; <strong><?= $getallpost_row->title ?></strong> </h3>

                <div class="timeline-body">
                  <span style="display:block;text-overflow: ellipsis;height:  100px;width: auto;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 5; /* number of lines to show */-webkit-box-orient: vertical;">
          <?= $getallpost_row->description ?>
        </span>
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-info btn-flat btn-sm" href="<?= site_url('timeline/Timeline/GetSpecificPost/').$getallpost_row->timeline_id;?>">Read more</a>
                  <!-- <a class="btn btn-danger btn-sm">Delete</a> -->
                </div>
              </div>
            </div>
          <?php endforeach; ?>

            </div>
      </div>
    </div>
    <div class=" text-center">
      <?= $pagination1; ?>
    </div>
  </div>



</div>
<?php
else:
echo "<center> <strong> No data Available</strong> </center>";
endif; ?>
<!-- <script type="text/javascript">
$(document).ready(function(){
  $('.search-box input[type="text"]').on("keyup input", function(){
      /* Get input value on change */
      var inputVal = $(this).val();
      var resultDropdown = $(this).siblings(".result");
      if(inputVal.length){
          $.get("<//?= site_url('Profile/Profiles/Getsearch'); ?>", {term: inputVal}).done(function(data){
              // Display the returned data in browser
              resultDropdown.html(data);
          });
      } else{
          resultDropdown.empty();
      }
  });
</script> -->
