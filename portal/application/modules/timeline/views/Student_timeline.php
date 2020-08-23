<style>
.comments-section{
  background:#fff;
}
.comment-area{
 background: none repeat scroll 0 0 #fff;
border: medium none;
-webkit-border-radius: 4px 4px 0 0;
-moz-border-radius: 4px 4px 0 0;
-ms-border-radius: 4px 4px 0 0;
-o-border-radius: 4px 4px 0 0;
border-radius: 4px 4px 0 0;
color: #777777;
float: left;
font-family: Lato;
font-size: 14px;
height: 150px;
letter-spacing: 0.3px;
padding: 10px 20px;
width: 100%;
resize:vertical;
outline:none;
border: 1px solid #F2F2F2;
}
.comment-btn{
  float: right;
  background: #4CAF50;
  margin: 5px 0;
  padding: 6px 15px;
  color: #fff;
  letter-spacing: 1.5px;
  outline: none;
  border-radius: 4px;
   box-shadow:none;
}
.comment-btn:hover , .comment-btn:focus {
  background:#2E7D32;
  outline: none;
  border-radius: 4px;
  box-shadow:none;
}

</style>
<title><?= $title;?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">TimeLine Board</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                        <li class="breadcrumb-item active">My Timeline</li>
                        <!-- <li class="breadcrumb-item active"><a href="">Notification Board</a></li> -->
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content ">
        <div class="container-fluid">
            <div class="row">
                  <div class="col-md-9 card p-4 "  style="min-width: auto;  width: 1500px">
                      <div class="card p-3">
                        <div class="timeline" style="min-width: auto;">
                          <?php if($GetmyTeacherPost->num_rows() > 0): ?>
                            <?php foreach($GetmyTeacherPost->result() as $GetmyTeacherPost_row): ?>
                        <div class="time-label">
                         <?php if(!empty($GetmyTeacherPost_row->subject_name)){ echo "  <span class='bg-info'>".$GetmyTeacherPost_row->subject_name."</span>";}else{echo  "<span class='bg-success'>".$GetmyTeacherPost_row->role_display_name."</span>";} ?>
                        </div>
                        <div>
                          <!-- <i class="fas fa-envelope bg-blue"></i> -->
                          <div class="timeline-item">
                            <span class="time" ><i style="color:violet; font-size: 15px;" class="fas fa-clock mr-2 "></i><?= date('M d, Y : h:i  ', strtotime($GetmyTeacherPost_row->created_at)); ?></span>
                            <h3 class="timeline-header"><span class="badge badge-pill badge-warning"><?= $GetmyTeacherPost_row->role_display_name?></span>  &nbsp; <a href="#"><?= $GetmyTeacherPost_row->name ?></a>  &nbsp;> &nbsp; <strong><?= $GetmyTeacherPost_row->title ?></strong> </h3>

                            <div class="timeline-body" >
                              <span style="display:block;text-overflow: ellipsis;height:  100px;width: auto;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 5; /* number of lines to show */-webkit-box-orient: vertical;">
                                  <?= $GetmyTeacherPost_row->description ?>
                              </span>
                            </div>
                            <div class="timeline-footer">
                              <a href="<?= site_url('timeline/Timeline/GetSpecificPost/').$GetmyTeacherPost_row->timeline_id;?>" class="btn btn-info btn-sm btn-flat">Read more</a>
                              <!-- <a class="btn btn-danger btn-sm">Delete</a> -->
                            </div>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    <?php else:
                      echo "<center> <strong> No data Available </strong> </center>";
                   endif; ?>

                        </div>
                      </div>
                  </div>
            </div>
            <div class=" text-center">
              <?= $links; ?>
            </div>
        </div>
    </div>
</div>
<script>
function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more";
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less";
    moreText.style.display = "inline";
  }
}
</script>
