<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-6">
    <?php foreach($showEdit as $row): ?>

    <form id="UpdateModal" action="<?= site_url('activities/Virtuallesson_controller/UpdateLesson'); ?>"  method="post">
      <input type="hidden" name="SubjectCode" value="<?=  $row["Subject_code"] ?>">
      <input type="hidden" name="RowID" value="<?= $row['id'] ?>">
        <div class="form-group">
            <label for="lessonnum" class="form-control-label">Lesson #</label>
            <input id="lessonnum" class="form-control form-control-sm col-md-12" type="text" name="lessonnumUpdate" value="<?= $row["lesson_number"]?>">
        </div>
        <div class="form-group">
            <label for="lessontopic" class="form-control-label">Lesson Topic</label>
            <input id="lessontopic" class="form-control form-control-sm col-md-12" type="text" name="lessontopicUpdate" value="<?= $row["lesson_topic"]?>">
        </div>
        <div class="form-group">
            <label for="lessonInst" class="form-control-label">Lesson Instrution</label>
            <input id="lessonInst" class="form-control form-control-sm col-md-12" type="text" name="lessonInstUpdate" value="<?= $row["lesson_instruct"]?>">
        </div>
        <div class="form-group col-md-12">
          <label for="">Youtube ID link</label>
          <div class="input-group mb-3 input-group-sm">
    <div class="input-group-prepend bg-success">
    <span class="input-group-text" id="embeddataupdate">https://www.youtube.com/embed/</span>
    </div>
    <input type="text" class="form-control form-control-sm ytlinkupdate" autocomplete="off" name="ytlinkupdate" id="ytlinkupdate" placeholder="Youtube Link"  value="">
    </div>
        </div>
        <div class="justify-content-end d-flex">
            <button type="submit" id="update" class="btn btn-sm btn-flat btn-warning text-white">Update Lesson</button>
        </div>
    </form>
    <script type="text/javascript">
    $(document).ready(function(){
    var str = '<?= $row["youtube_link"]?>';
    var words=str.split('/');
    $('input.ytlinkupdate').val(words[4].split('?')[0]);
    // $('input.ytlink').on('input',function(e){
    // $('#ytlink').val(words[4].split('?')[0]);
    // });
    });
    </script>


  </div>
  <div class="col-xs-12 col-sm-6 col-md-6">
    <div class="embed-responsive embed-responsive-16by9">
    <iframe id="videoframeupdate" class="embed-responsive-item" src="" allowfullscreen></iframe>
  </div>
  </div>
    <?php endforeach; ?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
    $(".ytlinkupdate").keyup(function() {
          var textareaValue = $("#ytlinkupdate").val();
          var Spanval = document.getElementById("embeddataupdate").innerText;
       $('#videoframeupdate').attr('src', Spanval+textareaValue);
    });
  });


  $('#UpdateModal').submit(function(e){


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
                        timer: 2000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                          toast.addEventListener('mouseenter', Swal.stopTimer)
                          toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                      })

                      Toast.fire({
                        icon: 'success',
                        title: 'Submmiting Lesson Data'
                      }).then((result) => {

                              if (result.dismiss === Swal.DismissReason.timer) {

                                Swal.fire({
                                    title: 'Succesfully Submmited!',
                                    type: 'success',
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then((result) =>{

                                  if(result.dismiss === Swal.DismissReason.timer){
                                        window.location.href='<?= site_url('activities/Virtuallesson_controller'); ?>';
                                  }

                                });

                              }
                          });
                    }
                }

             });



  });

</script>
