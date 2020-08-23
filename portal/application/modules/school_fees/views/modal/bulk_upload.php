<div class="content">

<style>
/* layout.css Style */
.upload-drop-zone {
  height: 200px;
  border-width: 2px;
  margin-bottom: 20px;
}

/* skin.css Style*/
.upload-drop-zone {
  color: #ccc;
  border-style: dashed;
  border-color: #ccc;
  line-height: 200px;
  text-align: center
}
.upload-drop-zone.drop {
  color: #222;
  border-color: #222;
}
</style>
<div id="overlay1" class="overlay" style="visibility: hidden;">
              <i class="fas fa-2x fa-sync-alt fa-spin"></i>
          </div>
	
	<form method="post" enctype="multipart/form-data" id="bulk_upload_form">
        	<div class="form-inline">
              <div class="form-group">
                <input type="file" name="files[]" id="js-upload-files" multiple>
              </div>
              <button type="button" class="btn btn-sm btn-primary" id="btn_upload">Upload files</button>
            </div>

			<!-- Drop Zone -->
			<h4>Or drag and drop files below</h4>
			<div class="upload-drop-zone" id="drop-zone">
				Just drag and drop files here
			</div>

          	<!-- Upload Finished -->
			<div class="js-upload-finished" style = "display:none">
				<h3>Processed files</h3>
				<div class="list-group" id ="processed_list">
			
				</div>
			</div>
    </form>

          
	<!-- </form> -->
</div>


<script>
	$(document).ready(function () {
		$('#form_upload_csv_file').submit(function (e) {
			$('.overlay').css('visibility', 'visible');
			e.preventDefault();
			$.ajax({
				url:"<?=site_url('school_fees/import_csv')?>",
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
	});
	// $('.file-upload').file_upload();
</script>

<script>
	$(document).ready(function(){
		var dropZone = document.getElementById('drop-zone');
		var uploadForm = document.getElementById('js-upload-form');

		var startUpload = function(files) {
			console.log(files)
		}


		$('#btn_upload').click(function(e){
			
			var files = document.getElementById('js-upload-files').files;
			// console.log(files);
			if (files) {
				var form_data = new FormData();
				$('.list-group-item').remove();
				$('.js-upload-finished').css('display','block');
				for (let i = 0; i < files.length; i++) {
					$('#processed_list').prepend('<a href="#" class="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success</span>'+files[i]['name']+'</a>');
					form_data.append('files_'+i ,files[i]);
				}
				
				$.ajax({
					url: "<?=site_url('school_fees/bulk_upload')?>",
					data: form_data,
					type: "post",
					processData: false,
					contentType: false,
					success: function (data) {
						var b = JSON.parse(data);
						if (b.response == true) {
							Swal.fire(
								'Success',
								b.message,
								'success'
							).then((result) => {
								location.reload();
							})
						}else{
							Swal.fire(
								'ERROR',
								b.message,
								'error'
							).then((result) => {
								// location.reload();
							})
						}
						
					}
				});

			}

		});
		dropZone.ondrop = function(e) {
			e.preventDefault();
			// console.log(1);
			
			this.className = 'upload-drop-zone';
		
			var files = e.dataTransfer.files;
			
			if (files) {
				var form_data = new FormData();
				$('.list-group-item').remove();
				$('.js-upload-finished').css('display','block');
				for (let i = 0; i < files.length; i++) {
					$('#processed_list').prepend('<a href="#" class="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success</span>'+files[i]['name']+'</a>');
					form_data.append('files_'+i ,files[i]);
				}
				
				$.ajax({
					url: "<?=site_url('school_fees/bulk_upload')?>",
					data: form_data,
					type: "post",
					processData: false,
					contentType: false,
					success: function (data) {
						var b = JSON.parse(data);
						if (b.response == true) {
							Swal.fire(
								'Success',
								b.message,
								'success'
							).then((result) => {
								location.reload();
							})
						}else{
							Swal.fire(
								'ERROR',
								b.message,
								'error'
							).then((result) => {
								// location.reload();
							})
						}
						
					}
				});

			}
		}

		dropZone.ondragover = function() {
			this.className = 'upload-drop-zone drop';
			return false;
		}

		dropZone.ondragleave = function() {
			this.className = 'upload-drop-zone';
			return false;
		}
	});
</script>