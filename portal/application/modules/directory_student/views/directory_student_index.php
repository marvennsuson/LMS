            <title><?= $title;?></title>
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">Student Information</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                                    <li class="breadcrumb-item active">Student Directory</li>
                                    <li class="breadcrumb-item active"><a href="<?= current_url();?>">Student Information</a></li>
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
                                        <h3 class="card-title">List of students</h3>
                                        <div class="card-tools">
                                            <button id="btn_add_student" type="button" class="btn btn-warning"><i class="fas fa-user-plus"></i> Add Student</button>
                                            <button id="btn_print_pdf" type="button" class="btn btn-danger"><i class="fas fa-print"></i> Print PDF</button>
                                            <button id="btn_import_excel" type="button" class="btn btn-success"><i class="fas fa-upload"></i> Upload CSV Format</button>
                                            <a href="<?=site_url('directory_student/export_csv');?>"class="btn btn-success"><i class="fas fa-download"></i> Download CSV Format</a>
                                            
                                        </div>
                                    </div>
                                   
            
                                    <div class="card-body table-responsive p-0" id="div_student_table">
                                        <table class="table table-striped table-hover table-head-fixed text-nowrap" id="student_table">
                                           
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Student ID</th>
                                                        <th>Name</th>
                                                        <th>Gender</th>
                                                        <th>School Lvl</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                
                                                       
                                                </tbody>

                                                                                     
                                        </table>
                                    </div>
                                    <hr>
                                    <button class="btn btn-sm btn-danger" disabled="disabled"  id="btn_bulk_delete_student" name = "btn_bulk_delete_student">Delete Selected Students</button>

                                    <div class="modal fade" id="student">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Student Details</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body" id="student_details" style="background: #fbfbfb;">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="student_edit">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Student</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body" id="student_edit_response">
                                                </div>
                                                <div class="overlay" style="visibility: hidden;">
                                                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="student_add">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Add Student</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body" id="student_add_response">
                                                    <?php $this->load->view('modal/add_student')?>
                                                </div>
                                                <div id="overlay_add_student" >
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
            		$("#student_table").dataTable({
            			"columnDefs": [{
            				"orderable": false,
            				"targets": 0
            			}],
            			"ajax": '<?=site_url('directory_student/generate_student_table')?>',
            			lengthMenu: [15, 30, 50, 100],
            		});
            	})
                $(document).ready(function(){
                    $('#btn_add_student').on('click', function(){
                        $("#student_add").modal('show');
                    });
                })
   
                $(document).ready(function () {
            		$('#btn_import_excel').on('click', function () {
            			$("#block_upload_csv_file").modal('show');
            		});
            	})
                
            </script>

         

            <script>
                $('.card-footer a').addClass('page-link');

                $('#input_search').keyup(function(){
                    if($('#input_search').val() == '' ){
                        $('#div_student_table').css('display', 'block');
                        $('#div_searched_table').css('display', 'none');
                    } else {
                        $('#div_student_table').css('display', 'none');
                        $('#div_searched_table').css('display', 'block');
                        $.ajax({
                            url: "<?=site_url('directory_student/search_student')?>",
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
            	$(document).ready(function () {
            		$(document).on('click', "button.delete", function () {
            			// e.preventDefault();
            			Swal.fire({
            				title: 'Are you sure you want to delete this student <br>?',
            				text: "You won't be able to revert this!",
            				type: 'warning',
            				showCancelButton: true,
            				confirmButtonColor: '#d33',
            				cancelButtonColor: '#3085d6',
            				confirmButtonText: 'Yes, delete it!'
            			}).then((result) => {
            				var selected_id = $(this).data('classid');
            				selected_id = selected_id.replace("student-", "");

            				if (result.value == true) {
            					$.ajax({
            						url: "<?=site_url('directory_student/delete_student')?>",
            						data: {
            							id: selected_id
            						},
            						type: "post",
            						success: function (data) {
            							Swal.fire(
            								'Deleted!',
            								' A Student has been deleted.',
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
            			selected_id = selected_id.replace("student-", "");
            			$.ajax({
            				url: "<?=site_url('directory_student/edit_student')?>",
            				data: {
            					id: selected_id
            				},
            				type: "post",
            				success: function (data) {
            					$("#student_edit").modal('show');
            					$("#student_edit_response").html(data);
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
                    $(document).on('click',"input#chk_student_delete",function ()
                    {
                        // var isChecked = $("#chk_subject_delete").is(":checked");
                        var countChecked = $("#chk_student_delete:checked").length;
                        if (countChecked > 0){
                            $('#btn_bulk_delete_student').removeAttr('disabled')
                        }else{
                            $('#btn_bulk_delete_student').attr('disabled','true')
                        }
                    
                    });


            	})

            </script>

            <script>
                $(document).ready(function() {
                    $("#btn_bulk_delete_student").click(function(){
                        Swal.fire({
            				title: 'Are you sure you want to delete these Students <br>?',
            				text: "You won't be able to revert this!",
            				type: 'warning',
            				showCancelButton: true,
            				confirmButtonColor: '#d33',
            				cancelButtonColor: '#3085d6',
            				confirmButtonText: 'Yes, delete it!'
            			}).then((result) => {
            				var selectedIds = [];
                            $.each($("input[name='chk_student_delete[]']:checked"), function(){
                                selectedIds.push($(this).val());
                            });
                            selectedIds =  selectedIds.join(',');
            				if (result.value == true) {
                                console.log(selectedIds);
            					$.ajax({
            						url: "<?=site_url('directory_student/bulk_delete_student')?>",
            						data: {
            							id: selectedIds
            						},
            						type: "post",
            						success: function (data) {
            							Swal.fire(
            								'Deleted!',
            								' Students has been deleted.',
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