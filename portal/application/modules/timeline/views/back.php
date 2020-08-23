
          <div class="row">
                <div class="col-sm-4 col-md-8 col-lg-9">
                      <div class="card w-100 mb-1" style="min-height: 400px;">
                            <?php if($GetSpecifiPost->num_rows() > 0): ?>
                              <?php foreach($GetSpecifiPost->result() as $GetSpecifiPost_row):
                                        $TimelineID = $GetSpecifiPost_row->timeline_id;

                                ?>
                              <div class="card-header bNotification-transparent">
                                  <h3 class="card-title"> <?= $GetSpecifiPost_row->title ?></h3>
                                    <div class="ml-auto clearfix float-right">
                                          <?= $GetSpecifiPost_row->created_at ?>
                                    </div>

                              </div>


                                  <div class="card-body">
                                        <?= $GetSpecifiPost_row->description ?>
                                  </div>

                      </div>


                      <div class="container-fluid">
<div class="">
  <div class="card-header">
      <div class="card-title">
        <h2>Comments</h2>
      </div>
  </div>
  <div class="card-body">
    <div class="row">
<div class="col-12">

<form class="comment-form" id="mydata"; method="POST" action="<?= base_url('timeline/Timeline/CreateComment');?>">
<input type="hidden" name="timelineid" value="<?= $GetSpecifiPost_row->timeline_id ?>">
<textarea class="comment-area" name="user_comment" placeholder="Write your comment here" ><?= set_value('user_comment');?></textarea>
<button type="submit" class="btn btn-md comment-btn ">Comment Now</button>
</form>

</div>
</div>
  </div>
</div>
        <?php endforeach; ?>
      <?php endif; ?>
          <div class="container-fluid mt-3 mb-5 ">
                      <?php if($commentshow->num_rows() > 0): ?>
                <div class="card p-3 w-75 justify-content-center mx-auto">

                  <?php foreach($commentshow->result() as $commentshow_row):?>
                <div class="comment-box mb-3">
                <img src="<?= base_url('public/userlogo2.jpg');?>"  class="commenter-image" alt="commenter_image">
                <div class="comment-content w-75">
                  <div class="commenter-head"><span class="commenter-name"><a href="" ><?= $commentshow_row->email ?> </a></span> <span class="comment-date"><i class="far fa-clock"></i><?= $commentshow_row->created_at ?></span></div>
                  <div class="comment-body">
                    <span class="comment"><?= $commentshow_row->description ?></span>
                  </div>
                  <!-- <div class="comment-footer">
                    <span class="comment-likes">55 <a href="" class="comment-action active"> <i class="far fa-heart"></i></a></span> <span class="comment-reply">66 <a href="" class="comment-action">Reply</a></span>
                  </div> -->


                </div>

                </div>
              <?php endforeach; ?>

                </div>
              <?php else:
               endif; ?>

          </div>

                      </div>
                </div>

          </div>
