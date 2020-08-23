<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= base_url('/public/images/logo/favicon.png')?>" rel="shortcut icon" type="image/ico">
    <link rel="stylesheet" href="<?= base_url('public/plugins/fontawesome-free/css/all.min.css');?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?= base_url('public/dist/css/adminlte.min.css');?>">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
    .custom_btn{
      background-color: #ffb90f;
      color:#fff;
    }
    .custom_btn:hover{
      background-color: #d69808;
      color:#fff;

    }

    </style>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <img src="<?= base_url('public/images/logo/nvac_logo_md.png');?>" alt="NVAC Logo" class="brand-image">
            </div>

            <div class="card">
                <div class="card-body login-card-body">
                    <div class="d-flex justify-content-center" style="min-height: 11vh;">
                        <h2 class="login-box-msg">NVAC Portal</h2>
                        <div class="overlay" style="display: none;">
                            <img class="img-fluid mx-auto d-block" src="<?=base_url('public/images/preloader.svg');?>" alt="">
                        </div>
                    </div>

                    <form id="form_login">
                        <label class="col-form-label text-danger" id="login_response" style="visibility: hidden;"></label>
                        <div class="input-group mb-3">
                            <?php echo form_error('email'); ?>
                            <input type="email" class="form-control" name="input_email" id="input_email" placeholder="Email" autocomplete="off" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <?php echo form_error('password'); ?>
                            <input type="password" class="form-control" name="input_password" id="input_password" placeholder="Password" autocomplete="off" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="justify-content-end d-flex mb-4">
                          <div class="form-check-inline">
  <label class="form-check-label">
    <input type="checkbox" class="form-check-input"  onclick="myFunction()">Show Password
  </label>
</div>

                        </div>
                        <div class="row">
                            <!-- <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">Remember Me</label>
                                </div>
                            </div> -->
                            <div class="col-12">
                                <button type="submit" class="custom_btn btn btn-flat btn-block">Sign In</button>
                            </div>
                        </div>
                    </form>

                    <p class="mt-4 mb-1">
                        <a href="forgot-password.html">I forgot my password</a>
                    </p>
                    <p class="mb-0">
                        <a href="register.html" class="text-center">Register a new membership</a>
                    </p>
                </div>
            </div>
        </div>

        <script src="<?= base_url('public/plugins/jquery/jquery.min.js');?>"></script>
        <script src="<?= base_url('public/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
        <script src="<?= base_url('public/dist/js/adminlte.min.js');?>"></script>

        <script>
        function myFunction() {
  var x = document.getElementById("input_password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
            $(function(){
                $("#form_login").submit(function(e){
                    e.preventDefault();

                    $("#login_response").html('');
                    $("#input_email").removeClass('is-invalid');
                    $("#input_password").removeClass('is-invalid');

                    $('.overlay').css('display', 'block');
                    $('.overlay').css('animation', '4s');
                    $('.login-box-msg').css('display', 'none');
                    var formData = new FormData($(this)[0]);

                    $.ajax({
                        url: "<?=site_url('login/verify_credentials')?>",
                        data: formData,
                        dataType: "json",
                        type: "post",
                        async: false,

                        success: function(data){

                            if(data.response == "true") {
                                $('.overlay').css('display', 'none');
                                $('.login-box-msg').css('display', 'block');
                                // $("#formSubmit").css('display','block');
                                // alert(data.message);
                                // $onSent.unbind('submit').submit();

                                setTimeout("window.location.href='<?= site_url('dashboard'); ?>'",1000);
                            } else {
                                $('.overlay').css('display', 'none');
                                $('.login-box-msg').css('display', 'block');
                                $("#login_response").css('visibility','visible');
                                $("#login_response").append(data.message);
                                $("#input_email").addClass('is-invalid');
                                $("#input_password").addClass('is-invalid');

                            }
                        },
                        contentType: false,
                        cache: false,
                        processData: false,
                    });
                });
            })
        </script>

    </body>
</html>
