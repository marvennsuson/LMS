<div class="content-wrapper" style="margin-left: 0 !important; padding-top: 5vh;  background: rgb(75,221,60); background: radial-gradient(circle, rgba(75,221,60,0.04243704317664565) 0%, rgba(242,240,36,0.08165272945115543) 100%); ">
    <img src="<?= base_url('public/images/logo/nvac_logo_md.png')?>" width="100" class="mx-auto d-block" alt="NVAC logo">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h1 class="m-0 text-dark"> <?= $exam['exam_title']?> <small></small></h1>
                    <p class="lead"><strong>Instruction:</strong> <?= $exam['instruction']?></p>
                    <h4 class="mt-2"><div>Time left = <span class="text-success" id="timer"></span></div></h4>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <form id="form_exam">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= $exam['exam_body_title']?></h5>
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="false" data-wrap="false">
                                    <div class="carousel-inner">
                                        <div class="mx-sm-1 px-sm-1 mx-md-3 px-md-3">
                                            <div class="row mx-sm-1 px-sm-1 mx-md-5 px-md-5">
                                                <div class="col-12 col-md-12 col-lg-12">
                                                    <div class="mx-5 px-5">
                                                        <?= $exam['exam_created_form']?>

                                                        <div class="carousel-item">
                                                            <button id="btn_submit_test" type="submit" class="btn btn-success mx-auto d-block btn-lg mt-5 btn-block">Submit Test</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-5">
                                                <div class="col-6 col-md-12 col-lg-6 d-flex justify-content-start">
                                                    <button id="btn_prev" class="btn btn-secondary" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                                        <span class="p-4" aria-hidden="true" style="width: 4%; filter: invert(100%)">Prev</span>
                                                        <span class="sr-only">Previous</span>
                                                    </button>
                                                </div>
                                                <div class="col-6 col-md-12 col-lg-6 d-flex justify-content-end">
                                                    <button id="btn_next" class="btn btn-secondary" href="#carouselExampleIndicators" role="button" data-slide="next">
                                                        <span class="p-4" aria-hidden="true" style="width: 4%; filter: invert(100%)">Next</span>
                                                        <span class="sr-only">Next</span>
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
                
                <input type="hidden" id="hidden_term" name="hidden_term" value="<?= $exam['term']?>">
                <input type="hidden" id="hidden_type" name="hidden_type" value="<?= $exam['type']?>">
                <input type="hidden" id="hidden_input_score" name="hidden_input_score" value="0">
                <input type="hidden" id="hidden_classes_id" name="hidden_classes_id" value="<?= $exam['class']?>">
                <input type="hidden" id="hidden_teacher_id" name="hidden_teacher_id" value="<?= $exam['created_by']?>">
                <input type="hidden" id="hidden_student_id" name="hidden_student_id" value="<?= $this->session->user_id?>">
                <input type="hidden" id="hidden_joined_header_body_id" name="hidden_joined_header_body_id" value="<?= $exam['joined_header_body_id']?>">
                <input type="hidden" id="hidden_exam_header_id" name="hidden_exam_header_id" value="<?= $exam['exam_header_id']?>">
                <input type="hidden" id="hidden_exam_body_id" name="hidden_exam_body_id" value="<?= $exam['exam_body_id']?>">
                
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $( ".form-group" ).wrap( "<div class='carousel-item'>");
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

        // $('#btn_prev').hide();
        
        // $( ".carousel-item" ).last().append('<button id="btn_submit_test" type="button" class="btn btn-success mt-5">Submit</button>');
    })

    // $('#btn_submit_test').on('click', function(){
    //     var questionsCount = $('.form-group').length
        
    //     var i;
    //     for(i=0; i<questionsCount; i++)
    //     {
    //         // alert($('.form-group').attr('name').index(i))
    //         alert($('input').attr('name').index( this ))
    //     }
    // })
    
    var count = 0;
    var total = 0;
    var temp = 0;

    // $("input[type='radio']").on("click", function () {
    //     var radioValue = $("input[name='radio_answer']:checked").val();
    //         if(radioValue){
    //             count=radioValue;
    //             temp=count;
    //         } else if(!radioValue){
    //             if(count!=0){
    //                 count--;
    //             } else {
    //                 count==radioValue;
    //             }
    //             temp=count;
    //         }
    //     total=count;
    //     alert(total)
    // });

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
            // $('#btn_next').hide();
            // $('#btn_prev').show();
        }
    })

    $('#btn_prev').click(function(){
        total-=temp;
        $('#hidden_input_score').val(total)
        // alert(total)
        if($(".carousel-item > .form-group").first()){
            // $('#btn_prev').hide();
            // $('#btn_next').show();
        }
    })
    
    

    // $('#btn_submit_test').click(function(){
    //     $('.card-body').append('Your total score is:'+total+'<br>');
    //     $('#hidden_input_score').val(total)
    //     alert($('#hidden_input_score').val())
    // })


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
                text: "Sorry, you ran out of time answering your online test.",
                type: 'warning',
                allowOutsideClick: false,
                confirmButtonColor: '#f5b942',
                confirmButtonText: 'Submit Test!'
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
                        title: 'Test Submitted!',
                        text: 'Your total score is: '+total,
                        type: 'success',
                    }).then((result) => {
                        // location.reload();
                        window.opener.location.reload();
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