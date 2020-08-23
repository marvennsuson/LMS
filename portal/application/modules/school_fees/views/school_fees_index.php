            <title><?= $title;?></title>
            <div class="content-wrapper">
            	<div class="content-header">
            		<div class="container-fluid">
            			<div class="row mb-2">
            				<div class="col-sm-6">
            					<h1 class="m-0 text-dark">School Fees</h1>
            				</div>
            				<div class="col-sm-6">
            					<ol class="breadcrumb float-sm-right">
            						<li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
            						<li class="breadcrumb-item active">School Fees</li>
            						<li class="breadcrumb-item active"><a href="<?= current_url();?>">School Fees
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
            							<h3 class="card-title">List of school fees</h3>
            							<div class="card-tools">
            								<button id="btn_add_school_fee" type="button" class="btn btn-warning"><i
            										class="fas fa-user-plus"></i> Add School Fee</button>
            								<button id="btn_bulk_upload_school_fee" type="button" class="btn btn-success"><i
            										class="fas fa-upload"></i> Bulk upload</button>
            								<a href="<?=site_url('school_fees/export_csv');?>"
            									class="btn btn-success"><i class="fas fa-download"></i> Download CSV
            									Format</a>
            							</div>
            						</div>

            						<div class="card-body table-responsive p-0" id="div_school_fees_table">
            							<table class="table table-striped table-hover table-head-fixed text-nowrap"
            								id="school_fees_table">

            								<thead>
            									<tr>
													<th></th>
            										<th>Student ID</th>
            										<th>Student Name</th>
            										<th>File</th>
            										<th>Description</th>
            										<th>Action</th>
            									</tr>
            								</thead>


            								</tbody>


            							</table>
            						</div>
									<hr>
									<button class="btn btn-sm btn-danger" disabled="disabled"  id="btn_bulk_delete_fees" name = "btn_bulk_delete_fees">Delete Selected Fees</button>
            						

            						<div class="modal fade" id="school_fee_edit">
            							<div class="modal-dialog modal-xl">
            								<div class="modal-content">
            									<div class="modal-header">
            										<h4 class="modal-title">Edit Bill Info</h4>
            										<button type="button" class="close" data-dismiss="modal"
            											aria-label="Close">
            											<span aria-hidden="true">&times;</span></button>
            									</div>
            									<div class="modal-body" id="school_fee_edit_response">
            									</div>
												<div id = "overlay_add_school_fees">
													<div class="overlay" style="visibility: hidden;">
														<i class="fas fa-2x fa-sync-alt fa-spin"></i>
													</div>
												</div>
            								</div>
            							</div>
            						</div>

            						<div class="modal fade" id="school_fee_add">
            							<div class="modal-dialog modal-lg">
            								<div class="modal-content">
            									<div class="modal-header">
            										<h4 class="modal-title">Add School Fee</h4>
            										<button type="button" class="close" data-dismiss="modal"
            											aria-label="Close">
            											<span aria-hidden="true">&times;</span></button>
            									</div>
            									<div class="modal-body" id="school_fee_add_response">
            										<?php $this->load->view('modal/add_school_fee')?>
            									</div>
            									<div id="overlay_add_school_fees">
            										<div class="overlay" style="visibility: hidden;">
            											<i class="fas fa-2x fa-sync-alt fa-spin"></i>
            										</div>
            									</div>
            								</div>
            							</div>
            						</div>

            		
            						<div class="modal fade" id="bulk_upload_student_fee">
            							<div class="modal-dialog modal-lg">
            								<div class="modal-content">
            									<div class="modal-header">
            										<h4 class="modal-title">Upload CSV File</h4>
            										<button type="button" class="close" data-dismiss="modal"
            											aria-label="Close">
            											<span aria-hidden="true">&times;</span></button>
            									</div>
            									<div class="modal-body" id="bulk_upload_response">
            										<?php $this->load->view('modal/bulk_upload')?>
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
            		$("#school_fees_table").dataTable({
            			"columnDefs": [{
            				"orderable": false,
            				"targets": 0
            			}],
            			"ajax": '<?=site_url('school_fees/generate_school_fees_table')?>',
            			lengthMenu: [15, 30, 50, 100],
            		});
            	})
            	$(document).ready(function () {
            		$('#btn_add_school_fee').on('click', function () {
            			$("#school_fee_add").modal('show');
            		});
            	})

            
            	$(document).ready(function () {
            		$('#btn_bulk_upload_school_fee').on('click', function () {
            			$("#bulk_upload_student_fee").modal('show');
            		});
            	})

            </script>
            <script>
            	$(document).ready(function () {
            		$(document).on('click', "button.delete", function () {
            			// e.preventDefault();
            			Swal.fire({
            				title: 'Are you sure you want to delete this bill <br>?',
            				text: "You won't be able to revert this!",
            				type: 'warning',
            				showCancelButton: true,
            				confirmButtonColor: '#d33',
            				cancelButtonColor: '#3085d6',
            				confirmButtonText: 'Yes, delete it!'
            			}).then((result) => {
            				var selected_id = $(this).data('classid');
            				selected_id = selected_id.replace("studfee-", "");

            				if (result.value == true) {
            					$.ajax({
            						url: "<?=site_url('school_fees/delete_school_fees')?>",
            						data: {
            							id: selected_id
            						},
            						type: "post",
            						success: function (data) {
            							Swal.fire(
            								'Deleted!',
            								' School Fee has been deleted.',
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
            			selected_id = selected_id.replace("studfee-", "");
            			$.ajax({
            				url: "<?=site_url('school_fees/edit_school_fee')?>",
            				data: {
            					id: selected_id
            				},
            				type: "post",
            				success: function (data) {
            					$("#school_fee_edit").modal('show');
            					$("#school_fee_edit_response").html(data);
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
					$(document).on('click',"input#chk_student_fees_delete",function ()
					{
						// var isChecked = $("#chk_subject_delete").is(":checked");
						var countChecked = $("#chk_student_fees_delete:checked").length;
						if (countChecked > 0){
							$('#btn_bulk_delete_fees').removeAttr('disabled')
						}else{
							$('#btn_bulk_delete_fees').attr('disabled','true')
						}
					});


            	})

            </script>
			<script>
                $(document).ready(function() {
                    $("#btn_bulk_delete_fees").click(function(){
                        Swal.fire({
            				title: 'Are you sure you want to delete these fees <br>?',
            				text: "You won't be able to revert this!",
            				type: 'warning',
            				showCancelButton: true,
            				confirmButtonColor: '#d33',
            				cancelButtonColor: '#3085d6',
            				confirmButtonText: 'Yes, delete it!'
            			}).then((result) => {
            				var selectedIds = [];
                            $.each($("input[name='chk_student_fees_delete[]']:checked"), function(){
                                selectedIds.push($(this).val());
                            });
                            selectedIds =  selectedIds.join(',');
            				if (result.value == true) {
                                // console.log(selectedIds);
            					$.ajax({
            						url: "<?=site_url('school_fees/bulk_delete_fee')?>",
            						data: {
            							id: selectedIds
            						},
            						type: "post",
            						success: function (data) {
            							Swal.fire(
            								'Deleted!',
            								'Student Fee has been deleted.',
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
