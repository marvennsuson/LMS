            <title><?= $title;?></title>
            <div class="content-wrapper">
            	<div class="content-header">
            		<div class="container-fluid">
            			<div class="row mb-2">
            				<div class="col-sm-6">
            					<h1 class="m-0 text-dark">Class Information</h1>
            				</div>
            				<div class="col-sm-6">
            					<ol class="breadcrumb float-sm-right">
            						<li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
            						<li class="breadcrumb-item active">Class Directory</li>
            						<li class="breadcrumb-item active"><a href="<?= current_url();?>">Class
            								Information</a></li>
            					</ol>
            				</div>
            			</div>
            		</div>
            	</div>
            	<div class="content">
            		<div class="container-fluid">
            			<div class="row">
            				<div class="col-12">
            					<div class="card">
            						<div class="card-header">
            							<h3 class="card-title">List of classes</h3>
            							<div class="card-tools">
            								<button id="btn_add_class" type="button" class="btn btn-warning"><i
            										class="fas fa-user-plus"></i> Add Class</button>
            								<button id="btn_add_class_block" type="button" class="btn btn-info"><i
            										class="fas fa-cube"></i> Add Block Class</button>
            								<button id="btn_print_pdf" type="button" class="btn btn-danger"><i
            										class="fas fa-print"></i> Print PDF</button>
            								<button id="btn_import_excel" type="button" class="btn btn-success"><i
            										class="fas fa-upload"></i> Upload CSV Format</button>
            								<a href="<?=site_url('directory_class/export_csv');?>"
            									class="btn btn-success"><i class="fas fa-download"></i> Download CSV
            									Format</a>
            							</div>
            						</div>

            						<div class="card-body table-responsive p-0" id="div_class_table">
            							<table class="table table-striped table-hover table-head-fixed text-nowrap"
            								id="class_table">

            								<thead>
            									<tr>
													<th></th>
            										<th>Subject Code</th>
            										<th>Subject Name</th>
            										<th>Schedule</th>
            										<th>Instructor</th>
            										<th>Action</th>
            									</tr>
            								</thead>


            								</tbody>


            							</table>
            						</div>
									<hr>
									<button class="btn btn-sm btn-danger" disabled="disabled"  id="btn_bulk_delete_class" name = "btn_bulk_delete_class">Delete Selected Class</button>
            						<div class="modal fade" id="class">
            							<div class="modal-dialog modal-xl">
            								<div class="modal-content">
            									<div class="modal-header">
            										<h4 class="modal-title">Class Details</h4>
            										<button type="button" class="close" data-dismiss="modal"
            											aria-label="Close">
            											<span aria-hidden="true">&times;</span></button>
            									</div>
            									<div class="modal-body" id="class_details" style="background: #fbfbfb;">
            									</div>
            									<div class="modal-footer">
            										<button type="button" class="btn btn-default pull-right"
            											data-dismiss="modal">Close</button>
            									</div>
            								</div>
            							</div>
            						</div>

            						<div class="modal fade" id="class_edit">
            							<div class="modal-dialog modal-xl">
            								<div class="modal-content">
            									<div class="modal-header">
            										<h4 class="modal-title">Edit Class</h4>
            										<button type="button" class="close" data-dismiss="modal"
            											aria-label="Close">
            											<span aria-hidden="true">&times;</span></button>
            									</div>
            									<div class="modal-body" id="class_edit_response">
            									</div>
            									<div class="overlay" style="visibility: hidden;">
            										<i class="fas fa-2x fa-sync-alt fa-spin"></i>
            									</div>
            								</div>
            							</div>
            						</div>

            						<div class="modal fade" id="class_add">
            							<div class="modal-dialog modal-lg">
            								<div class="modal-content">
            									<div class="modal-header">
            										<h4 class="modal-title">Add Class</h4>
            										<button type="button" class="close" data-dismiss="modal"
            											aria-label="Close">
            											<span aria-hidden="true">&times;</span></button>
            									</div>
            									<div class="modal-body" id="class_add_response">
            										<?php $this->load->view('modal/add_class')?>
            									</div>
            									<div id="overlay_add_class">
            										<div class="overlay" style="visibility: hidden;">
            											<i class="fas fa-2x fa-sync-alt fa-spin"></i>
            										</div>
            									</div>
            								</div>
            							</div>
            						</div>

            						<div class="modal fade" id="block_class_add">
            							<div class="modal-dialog modal-lg">
            								<div class="modal-content">
            									<div class="modal-header">
            										<h4 class="modal-title">Add Block Class</h4>
            										<button type="button" class="close" data-dismiss="modal"
            											aria-label="Close">
            											<span aria-hidden="true">&times;</span></button>
            									</div>
            									<div class="modal-body" id="block_class_add_response">
            										<?php $this->load->view('modal/add_block_class')?>
            									</div>
            									<div id="overlay_add_class">
            										<div class="overlay" style="visibility: hidden;">
            											<i class="fas fa-2x fa-sync-alt fa-spin"></i>
            										</div>
            									</div>
            								</div>
            							</div>
            						</div>
            						<div class="modal fade" id="block_upload_csv_file">
            							<div class="modal-dialog modal-lg">
            								<div class="modal-content">
            									<div class="modal-header">
            										<h4 class="modal-title">Upload CSV File</h4>
            										<button type="button" class="close" data-dismiss="modal"
            											aria-label="Close">
            											<span aria-hidden="true">&times;</span></button>
            									</div>
            									<div class="modal-body" id="block_class_add_response">
            										<?php $this->load->view('modal/upload_csv_file')?>
            									</div>
            									<div id="overlay_add_class">
            										<div class="overlay" style="visibility: hidden;">
            											<i class="fas fa-2x fa-sync-alt fa-spin"></i>
            										</div>
            									</div>
            								</div>
            							</div>
            						</div>

            						<div class="card-footer clearfix">

            						</div>
            					</div>
            				</div>
            			</div>

            		</div>
            	</div>
            </div>

            <script>
            	$(document).ready(function () {
            		$("#class_table").dataTable({
            			"columnDefs": [{
            				"orderable": false,
            				"targets": 0
            			}],
            			"ajax": '<?=site_url('directory_class/generate_class_table')?>',
            			lengthMenu: [15, 30, 50, 100],
            		});
            	})
            	$(document).ready(function () {
            		$('#btn_add_class').on('click', function () {
            			$("#class_add").modal('show');
            		});
            	})

            	$(document).ready(function () {
            		$('#btn_add_class_block').on('click', function () {
            			$("#block_class_add").modal('show');
            		});
            	})
            	$(document).ready(function () {
            		$('#btn_import_excel').on('click', function () {
            			$("#block_upload_csv_file").modal('show');
            		});
            	})

            </script>
            <script>
            	$(document).ready(function () {
            		$(document).on('click', "button.delete", function () {
            			// e.preventDefault();
            			Swal.fire({
            				title: 'Are you sure you want to delete class <br>?',
            				text: "You won't be able to revert this!",
            				type: 'warning',
            				showCancelButton: true,
            				confirmButtonColor: '#d33',
            				cancelButtonColor: '#3085d6',
            				confirmButtonText: 'Yes, delete it!'
            			}).then((result) => {
            				var selected_id = $(this).data('classid');
            				selected_id = selected_id.replace("class-", "");

            				if (result.value == true) {
            					$.ajax({
            						url: "<?=site_url('directory_class/delete_class')?>",
            						data: {
            							id: selected_id
            						},
            						type: "post",
            						success: function (data) {
            							Swal.fire(
            								'Deleted!',
            								' A Class has been deleted.',
            								'info'
            							).then((result) => {
            								location.reload();
            							})
            						}
            					})

            				}
            			})
            		});
            		$(document).on('click', "button.edit", function () {
            			var selected_id = $(this).data('classid');
            			selected_id = selected_id.replace("class-", "");
            			$.ajax({
            				url: "<?=site_url('directory_class/edit_class')?>",
            				data: {
            					id: selected_id
            				},
            				type: "post",
            				success: function (data) {
            					$("#class_edit").modal('show');
            					$("#class_edit_response").html(data);
            				}
            			})
            			return false;
            		});
                    $(document).on('click', "button.read", function () {
                        var selected_id = $(this).data('classid');
            			selected_id = selected_id.replace("class-", "");
            			$.ajax({
            				url: "<?=site_url('directory_class/read_class')?>",
            				data: {
            					id:selected_id
            				},
            				type: "post",
            				success: function (data) {
            					$("#class").modal('show');
            					$("#class_details").html(data);
            				}
            			})
            			return false;
            		});
					$(document).on('click',"input#chk_class_delete",function ()
					{
						// var isChecked = $("#chk_subject_delete").is(":checked");
						var countChecked = $("#chk_class_delete:checked").length;
						if (countChecked > 0){
							$('#btn_bulk_delete_class').removeAttr('disabled')
						}else{
							$('#btn_bulk_delete_class').attr('disabled','true')
						}
					
					});


            	})

            </script>
			<script>
                $(document).ready(function() {
                    $("#btn_bulk_delete_class").click(function(){
                        Swal.fire({
            				title: 'Are you sure you want to delete these Class <br>?',
            				text: "You won't be able to revert this!",
            				type: 'warning',
            				showCancelButton: true,
            				confirmButtonColor: '#d33',
            				cancelButtonColor: '#3085d6',
            				confirmButtonText: 'Yes, delete it!'
            			}).then((result) => {
            				var selectedIds = [];
                            $.each($("input[name='chk_class_delete[]']:checked"), function(){
                                selectedIds.push($(this).val());
                            });
                            selectedIds =  selectedIds.join(',');
            				if (result.value == true) {
                                console.log(selectedIds);
            					$.ajax({
            						url: "<?=site_url('directory_class/bulk_delete_class')?>",
            						data: {
            							id: selectedIds
            						},
            						type: "post",
            						success: function (data) {
            							Swal.fire(
            								'Deleted!',
            								' Class has been deleted.',
            								'success'
            							).then((result) => {
            								location.reload();
            							})
            						}
            					})

            				}
            			})

                    });
                });
            </script>
