            <title><?= $title;?></title>
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">Staff Information</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                                    <li class="breadcrumb-item active">Staff Directory</li>
                                    <li class="breadcrumb-item active"><a href="<?= current_url();?>">Staff Information</a></li>
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
                                        <h3 class="card-title">List of staffs</h3>
                                        <div class="card-tools">
                                            <button id="btn_add_staff" type="button" class="btn btn-warning"><i class="fas fa-user-plus"></i> Add Staff</button>
                                            <button id="btn_print_pdf" type="button" class="btn btn-danger"><i class="fas fa-print"></i> Print PDF</button>
                                            <button id="btn_import_excel" type="button" class="btn btn-success"><i class="fas fa-upload"></i> Upload CSV Format</button>
                                            <a href="<?=site_url('directory_staff/export_csv');?>"
            									class="btn btn-success"><i class="fas fa-download"></i> Download CSV
            									Format</a>
                                        </div>
                                    </div>
                                   
                                    <!-- <div class="card-body">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="input_search" id="input_search">
                                            <span class="input-group-append">
                                                <button type="button" class="btn bg-gradient-primary"><i class="fas fa-search"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="card-body table-responsive p-0" id="div_searched_table" style="display: none;">
                                        <table class="table table-striped table-hover table-head-fixed text-nowrap" id="searched_table">
                                            
                                        </table>
                                    </div> -->

                                    <div class="card-body table-responsive p-0" id="div_staff_table">
                                        <table class="table table-striped table-hover table-head-fixed text-nowrap" id="staff_table">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Teacher ID</th>
                                                        <th>Name</th>
                                                        <th>Gender</th>
                                                        <th>Role</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                  
                                                </tbody>
                                            
                                        </table>
                                    </div>
                                    <hr>
                                    <button class="btn btn-sm btn-danger" disabled="disabled"  id="btn_bulk_delete_teachers" name = "btn_bulk_delete_teachers">Delete Selected Staffs</button>
                                    
                                    <div class="modal fade" id="staff">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Staff Details</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body" id="staff_details" style="background: #fbfbfb;">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="staff_edit">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Staff</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body" id="staff_edit_response">
                                                </div>
                                                <div class="overlay" style="visibility: hidden;">
                                                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="staff_add">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Add Staff</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body" id="staff_add_response">
                                                    <?php $this->load->view('modal/add_staff')?>
                                                </div>
                                                <div id="overlay_add_staff" >
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
                                        <?= $links; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function () {
            		$("#staff_table").dataTable({
            			"columnDefs": [{
            				"orderable": false,
            				"targets": 0
            			}],
            			"ajax": '<?=site_url('directory_staff/generate_staff_table')?>',
            			lengthMenu: [15, 30, 50, 100],
            		});
                })
                $(document).on('click', "button.delete", function () {
            			// e.preventDefault();
            			Swal.fire({
            				title: 'Are you sure you want to delete staff <br>?',
            				text: "You won't be able to revert this!",
            				type: 'warning',
            				showCancelButton: true,
            				confirmButtonColor: '#d33',
            				cancelButtonColor: '#3085d6',
            				confirmButtonText: 'Yes, delete it!'
            			}).then((result) => {
            				var selected_id = $(this).data('classid');
            				selected_id = selected_id.replace("staff-", "");

            				if (result.value == true) {
            					$.ajax({
            						url: "<?=site_url('directory_staff/delete_staff')?>",
            						data: {
            							id: selected_id
            						},
            						type: "post",
            						success: function (data) {
            							Swal.fire(
            								'Deleted!',
            								' A Staff has been deleted.',
            								'success'
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
            			selected_id = selected_id.replace("staff-", "");
            			$.ajax({
            				url: "<?=site_url('directory_staff/edit_staff')?>",
            				data: {
            					id: selected_id
            				},
            				type: "post",
            				success: function (data) {
            					$("#staff_edit").modal('show');
            					$("#staff_edit_response").html(data);
            				}
            			})
            			return false;
            	});
                $(document).ready(function(){
                    $('#btn_add_staff').on('click', function(){
                        $("#staff_add").modal('show');
                    });
                })
                $(document).ready(function () {
            		$('#btn_import_excel').on('click', function () {
            			$("#block_upload_csv_file").modal('show');
            		});
            	})
                $(document).on('click',"input#chk_staff_delete",function ()
                {
                    // var isChecked = $("#chk_subject_delete").is(":checked");
                    var countChecked = $("#chk_staff_delete:checked").length;
                    if (countChecked > 0){
                        $('#btn_bulk_delete_teachers').removeAttr('disabled')
                    }else{
                        $('#btn_bulk_delete_teachers').attr('disabled','true')
                    }
                
                });
            </script>

            <script>
                $('.card-footer a').addClass('page-link');

                $('#input_search').keyup(function(){
                    if($('#input_search').val() == '' ){
                        $('#div_staff_table').css('display', 'block');
                        $('#div_searched_table').css('display', 'none');
                    } else {
                        $('#div_staff_table').css('display', 'none');
                        $('#div_searched_table').css('display', 'block');
                        $.ajax({
                            url: "<?=site_url('directory_staff/search_staff')?>",
                            data: {searchItem : $('#input_search').val()},
                            type: "post",
                            success: function(data){
                                if(data.response == "false") {
                                } else {
                                    $("#searched_table").html(data);
                                }
                            },
                        })
                        return false;
                    }
                })
            </script>

            <script>
                $(document).ready(function() {
                    $("#btn_bulk_delete_teachers").click(function(){
                        Swal.fire({
            				title: 'Are you sure you want to delete these Staffs <br>?',
            				text: "You won't be able to revert this!",
            				type: 'warning',
            				showCancelButton: true,
            				confirmButtonColor: '#d33',
            				cancelButtonColor: '#3085d6',
            				confirmButtonText: 'Yes, delete it!'
            			}).then((result) => {
            				var selectedIds = [];
                            $.each($("input[name='chk_staff_delete[]']:checked"), function(){
                                selectedIds.push($(this).val());
                            });
                            selectedIds =  selectedIds.join(',');
            				if (result.value == true) {
                                console.log(selectedIds);
            					$.ajax({
            						url: "<?=site_url('directory_staff/bulk_delete_staff')?>",
            						data: {
            							id: selectedIds
            						},
            						type: "post",
            						success: function (data) {
            							Swal.fire(
            								'Deleted!',
            								' Staffs has been deleted.',
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