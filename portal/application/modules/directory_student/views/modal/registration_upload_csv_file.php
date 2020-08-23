<div class="content">
	<form id="form_upload_csv_file"  enctype="multipart/form-data" method="post" class="form form-horizontal">
		<div class="row">
			<div class="col-lg-12">
				<input type="file" name="file" id="">
				<button class="btn btn-success">Submit</button>
			</div>
		</div>
	</form>
</div>

<script>
	$(document).ready(function () {
		$('#form_upload_csv_file').submit(function (e) {
			$('.overlay').css('visibility', 'visible');
			e.preventDefault();
			$.ajax({
				url:"<?=site_url('directory_student/import_registration_csv')?>",
				type: "POST",
				data: new FormData(this),
				processData: false,
				contentType: false,
				cache: false,
				async: false,
				success: function (data) {
					$('.overlay').css('visibility', 'hidden');
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
            title: 'Sending Data'
          }).then((result) => {

                  if (result.dismiss === Swal.DismissReason.timer) {

                    Swal.fire({
                        title: 'Succesfully sent!',
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
		})
	})

</script>
