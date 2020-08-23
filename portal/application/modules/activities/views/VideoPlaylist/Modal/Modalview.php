<style>
  .left_arrow_cirlcle{
 transition: background 0.8s;
  }
  .right_arrow_cirlcle{
     transition: background 0.8s;
  }
  #btn_prev{
      background-color: #6741d9;
  }
  #btn_next{
  background-color: #6741d9;
  }
  #btn_prev:hover {
    background-color: #845ef7;
color:#fff;
}
#btn_next:hover {
      background-color: #845ef7;
color:#fff;
}
.left_arrow_cirlcle:active {
  background-color: #ffff;
  background-size: 100%;
  transition: background 0s;
}
.right_arrow_cirlcle:active {
  background-color: #ffff;
  background-size: 100%;

  transition: background 0s;
}


</style>
      <!-- <h4 class="float-right clearfix mr-4"><div id="pane_time"><small>Your Time is</small> <span class="text-success" id="timer"></span></div></h4> -->
<div class="content-wrapper" style="margin-left: 0 !important; padding-top: 5vh;  background: rgb(75,221,60); background: radial-gradient(circle, rgba(75,221,60,0.04243704317664565) 0%, rgba(242,240,36,0.08165272945115543) 100%); ">
    <img src="<?= base_url('public/images/logo/nvac_logo_md.png')?>" width="100" class="mx-auto d-block mb-2" alt="NVAC logo">



    <div class="content">
        <form id="form_exam">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">  <h4 class="m-0 text-dark ">Lesson Number : <?= $lesson[0]["lesson_number"] ?> <small></small></h4>
                                 <p class="lead"><strong class="h6">Lesson Topic:</strong>   <small><?= $lesson[0]["lesson_topic"]?></small> </p></h5>
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="false" data-wrap="false">
                                    <div class="carousel-inner">
                                        <div class="mx-sm-1 px-sm-1 mx-md-3 px-md-3">
                                            <div class="row mx-sm-1 px-sm-1 mx-md-5 px-md-5">
                                                <div class="col-12 col-md-12 col-lg-12">
                                                    <div class="mx-5 px-5">
                                                      <div class="embed-responsive embed-responsive-16by9">
                                                      <iframe id="videoframe" class="embed-responsive-item" src="<?= $lesson[0]["youtube_link"]?>" allowfullscreen></iframe>
                                                    </div>
                                                        <div class="carousel-item">
                                                            <button id="btn_submit_test" type="submit" class="btn btn-success mx-auto d-block btn-lg mt-5 btn-block">Submit Test</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                           <div class="row mt-5">
                                                <div class="col-6 col-md-12 col-lg-6 d-flex justify-content-start">
                                                    <button id="btn_prev" class=" btn btn-flat" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                                        <span class="p-4 text-white"  aria-hidden="true" style="width: 4%;"><i style="font-size:18px; color:#fff"  class=" left_arrow_cirlcle fas fa-arrow-circle-left"></i>&nbsp;Prev</span>
                                                        <span class="sr-only"><i class="fas fa-arrow-circle-left"></i></span>
                                                    </button>
                                                </div>
                                                <div class="col-6 col-md-12 col-lg-6 d-flex justify-content-end">
                                                    <button id="btn_next" class=" btn btn-flat" href="#carouselExampleIndicators" role="button" data-slide="next">
                                                        <span class="p-4 text-white" aria-hidden="true" style="width: 4%; "><i  style="font-size:18px; color:#fff" class="right_arrow_cirlcle  fas fa-arrow-circle-right"></i>&nbsp;Next</span>
                                                        <span class="sr-only"><i class="far fa-arrow-alt-circle-right"></i></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" id="hidden_term" name="hidden_term" value="">
                <input type="hidden" id="hidden_type" name="hidden_type" value="">
                <input type="hidden" id="hidden_input_score" name="hidden_input_score" value="0">
                <input type="hidden" id="hidden_classes_id" name="hidden_classes_id" value="49">
                <input type="hidden" id="hidden_teacher_id" name="hidden_teacher_id" value="">
                <input type="hidden" id="hidden_student_id" name="hidden_student_id" value="">
                <input type="hidden" id="hidden_joined_header_body_id" name="hidden_joined_header_body_id" value="">
                <input type="hidden" id="hidden_exam_header_id" name="hidden_exam_header_id" value="">
                <input type="hidden" id="hidden_exam_body_id" name="hidden_exam_body_id" value="">

            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $( ".form-group" ).wrap( "<div class='carousel-item' />");
        $( ".form-check-label" ).removeClass('text-success');
        $( ".carousel-item" ).first().addClass('active');

        //disable right click
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        //diabled keybopard keys
        document.onkeydown = function (e) {
            return false;
        }

    })

    var count = 0;
    var total = 0;
    var temp = 0;

    $("input[type='radio']").on("click", function () {
        var radioValue = $("input[name='radio_answer']:checked").val();
            if(radioValue == 1){
                temp = 1;
            } else if(radioValue == 0){
                temp = 0;
            }
            count = temp;
            if(count<0){
                count == 0;
            }
        // alert(temp)
    });

    $('#btn_next').click(function(){
        total+=count;
        $('#hidden_input_score').val(total)
        // alert(total)
        if($(".carousel-item > .form-group").last()){

        }
    })

    $('#btn_prev').click(function(){
        total-=temp;
        $('#hidden_input_score').val(total)
        // alert(total)
        if($(".carousel-item > .form-group").first()){

        }
    })


    //countdonw timer
    document.getElementById('timer').innerHTML = <?= $exam['time_duration']?> + ":" + 00;
    startTimer();

    function startTimer() {
        var presentTime = document.getElementById('timer').innerHTML;
        var timeArray = presentTime.split(/[:]+/);
        var m = timeArray[0];
        var s = checkSecond((timeArray[1] - 1));
        if(s==59){m=m-1}
        if(m==10 && s==00){
            $('#timer').addClass('text-warning').removeClass('text-success')
        }
        if(m==5 && s==00){
            $('#timer').addClass('text-danger').removeClass('text-success')
        }
        //timer completed
        if(m<0){
            Swal.fire({
                title: 'Time is up!',
                text: "Sorry, you ran out of time answering your online quiz.",
                type: 'warning',
                allowOutsideClick: false,
                confirmButtonColor: '#f5b942',
                confirmButtonText: 'Submit Exam!'
            }).then((result) => {
                if (result.value == true) {
                    var formExam = $("#form_exam")[0];
                    $.ajax({
                        url: "<?=site_url('exam/submit_exam')?>",
                        data: new FormData(formExam),
                        type: "post",
                        success: function(data)
                        {
                            Swal.fire(
                                'Exam Submitted!',
                                'Your total score is: '+total,
                                'success'
                            ).then((result) => {
                                window.close();
                            })
                        },
                        contentType: false,
                        cache: false,
                        processData: false,
                    })
                }
                // $('.overlay').css('visibility', 'hidden');
            })
        } else {
            document.getElementById('timer').innerHTML =
            m + ":" + s;
            console.log(m)
            setTimeout(startTimer, 1000);
        }


    }

    function checkSecond(sec) {
        if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
        if (sec < 0) {sec = "59"};
        return sec;
    }


    $("#form_exam").submit(function(e){
        e.preventDefault();
        // $('.overlay').css('visibility', 'visible');
        var formExam = new FormData($(this)[0]);
        $.ajax({
            url: "<?=site_url('exam/submit_exam')?>",
            data: formExam,
            dataType: "json",
            type: "post",
            async: false,
            success: function(data){
                if(data.response == "false") {
                    Swal.fire({
                        html: data.message,
                        type: 'error',
                    })
                } else {
                    Swal.fire({
                        title: 'Exam Submitted!',
                        text: 'Your total score is: '+total,
                        type: 'success',
                    }).then((result) => {
                        // location.reload();
                        window.close();
                    })
                }
                // $('.overlay').css('visibility', 'hidden');
            },
            contentType: false,
            cache: false,
            processData: false,
        });
    })

</script>
