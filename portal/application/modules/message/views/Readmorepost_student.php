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
border-radius:20px;
justify-content: center;
display: flex;
justify-content: center;
display: block;
margin-left: auto;
margin-right: auto;
font-family: Lato;
font-size: 14px;
height: 70px;
letter-spacing: 0.3px;
padding: 10px 20px;
width: 70%;
resize:vertical;
outline:none;
border: 1px solid #F2F2F2;
}
.comment-btn{
  float: right;
  background: #4CAF50;
  margin: 5px 0;
  margin-right: 200px;
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

.comment-box-wrapper{
 display:flex;
 border-radius: 50px;
 flex-direction:column;
 width:100%;
 margin:5px 0px;
}
.comment-box{
  display:flex;
  width:100%;
}
.comment-box a{
 color:#242475;
}
.commenter-image{
    height:55px;
    width:60px;
    border-radius:50%;
}
.comment-content{
    display:flex;
 flex-direction:column;
  background:#f2f3f5;
  margin-left:5px;
  padding:4px 20px;
  border-radius:10px;
}

.commenter-head{
display:block;
}


.commenter-head .commenter-name{
font-size:0.9rem;
font-weight:600;
}




.comment-date{
    font-size:0.7rem;
}
.comment-date i {
   margin:0 5px 0 10px;
}
.comment-body{
    padding:0 0 0 5px;
    display:flex;
    font-size:1rem;
    font-size:0.8rem;
font-weight:400;
}
.comment-footer{
    font-size:0.8rem;
    font-weight:600;
}

.comment-footer span{
   margin:0 15px 0 0;
}
.comment-footer span a{
   margin:0 0px 0 2px;
}


.comment-footer span.comment-likes  .active .fa-heart{
color:black;
font-size:1rem;
}
.comment-footer span.comment-likes  .active .fa-heart{
color:red;
}

.nested-comments{
    margin-left:50px;
}
</style>
<title><?= $title;?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Timeline  Board</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                        <li class="breadcrumb-item active">Other Post</li>

                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">


          <div class="row">
                <div class="col-sm-4 col-md-8 col-lg-9">
                      <div class="card w-100 mb-1" style="min-height: 400px;">
                            <?php if($getPost->num_rows() > 0): ?>
                              <?php foreach($getPost->result() as $getPost_row):
                                        $TimelineID = $getPost_row->message_id;

                                ?>
                              <div class="card-header bNotification-transparent">
                                  <h3 class="card-title"> <?= $getPost_row->title ?></h3>
                                    <div class="ml-auto clearfix float-right">
                                          <?= date('M d, Y : h:i  ', strtotime( $getPost_row->created_at ));?>
                                    </div>
                              </div>

                                  <div class="card-body">
                                        <?= $getPost_row->description ?>
                                  </div>

                      </div>


                      <div class="container-fluid">
<div class="">
  <div class="card-header">
      <div class="card-title">
        <h2>Reply Message</h2>
      </div>
  </div>
  <div class="card-body">
    <div class="row">
<div class="col-12">
<form id="CommentForm" class="comment-form" method="POST" action="<?= site_url('message/Messages/StudentReplyMessage'); ?>">
<input type="hidden" name="message_id" value="<?= $getPost_row->message_id  ?>">
 <input type="hidden" name="reciever_id" value="<?= $getPost_row->sender_id  ?>">
      <span style="color:red"><?= form_error('relpy_message');?></span>
  <textarea class="form-control comment-area"   name="relpy_message" rows="4" cols="80" placeholder="Reply"><?= set_value('relpy_message');?></textarea>
<button type="submit" class="btn btn-md comment-btn ">Reply Message Now</button>
</form>

</div>
</div>
  </div>
</div>
        <?php endforeach; ?>
      <?php endif; ?>
          <div class="container-fluid mt-3 mb-5 ">
                      <?php if($getComment->num_rows() > 0): ?>
                <div class="card p-3 w-75 justify-content-center mx-auto">

                  <?php foreach($getComment->result() as $getComment_row):?>
                <div class="comment-box mb-3">
                <img src="<?= base_url('public/userlogo2.jpg');?>"  class="commenter-image" alt="commenter_image">
                <div class="comment-content w-75">
                  <div class="commenter-head"><span class="commenter-name"><a href="" ><?= $getComment_row->email ?> </a></span> <span class="comment-date"><i class="far fa-clock"></i><?= date('M d, Y : h:i  ', strtotime($getComment_row->created_at)); ?></span></div>
                  <div class="comment-body">
                    <span class="comment"><?= $getComment_row->description ?></span>
                  </div>
                  <!-- <div class="comment-footer">
                    <span class="comment-likes">55 <a href="" class="comment-action active"> <i class="far fa-heart"></i></a></span> <span class="comment-reply">66 <a href="" class="comment-action">Reply</a></span>
                  </div> -->
                </div>

                </div>
              <?php endforeach; ?>

                </div>
              <?php else:
                echo "<center> <strong>No Available Comment </strong>  </center>";
               endif; ?>

          </div>

                      </div>
                </div>

          </div>

        </div>
    </div>
</div>
<script type="text/javascript">
$('#CommentForm').submit(function(e){

e.preventDefault();
 var fa = $(this);

  $.ajax({
    url: fa.attr('action'),
    type: 'post' ,
    data: fa.serialize(),
    // dataType: 'json',
    success: function(data) {
      if(data.response != "false"){

                  const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                  })

                  Toast.fire({
                    icon: 'success',
                    title: 'Sending Data'
                  }).then((result) => {
                          if (result.dismiss === Swal.DismissReason.timer) {
                            Swal.fire({
                                title: 'Succesfully Sent!',
                                type: 'success',
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) =>{

                              if(result.dismiss === Swal.DismissReason.timer){
                                    window.location.href='<?= current_url(); ?>';
                              }

                            });
                          }
                      });
      }
    }

 });


});

</script>
