            <aside class="main-sidebar sidebar-light-yellow elevation-4">
                <a href="<?= base_url();?>" class="brand-link navbar-yellow">
                    <img src="<?= base_url('public/images/logo/nvac_logo_md.png');?>" alt="NVAC Portal" class="brand-image"
                        style="opacity: .8; margin-left: 0.1rem;">
                    <span class="brand-text font-weight-light">NVAC Portal</span>
                </a>

                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="<?= base_url('public/users/user.png');?>" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block"><?= $this->session->email?>
                            <br><small class="badge badge-dark"><?= $this->session->role ?></small>
                            </a>
                            <br>
                            <a href="<?= base_url('login/logout');?>" class="btn btn-sm btn-block btn-warning">Log out</a>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <?php if ($this->session->role_id == 1 || $this->session->role_id == 2):?>
                                <!-- ADMISSION -->
                                <li class="nav-item has-treeview <?php echo $this->session->flashdata('menu') == 'admission' ? 'menu-open' : '';?>">
                                    <a href="#" class="nav-link <?php echo $this->session->flashdata('menu') == 'admission' ? 'active' : '';?>">
                                        <i class="nav-icon fas fa-file-alt"></i>
                                        <p>Admission <i class="fas fa-angle-left right"></i> </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?= base_url('admissions/list_of_admissions');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'list_of_admissions' ? 'active' : '';?> ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>List of Admissions</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?= base_url('admissions/bulk_registration');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'bulk_registration' ? 'active' : '';?> ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Bulk Registration</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif;?>

                            <?php if ($this->session->role_id == 3):?>
                                <!-- TEACHER -->
                                <li class="nav-item has-treeview <?php echo $this->session->flashdata('menu') == 'dashboardteacher' ? 'menu-open' : '';?>">
                                    <a href="#" class="nav-link <?php echo $this->session->flashdata('menu') == 'dashboardteacher' ? 'active' : '';?>">
                                        <i class="nav-icon fas fa-th"></i>
                                        <p>Dashboard <i class="fas fa-angle-left right"></i> </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                       <li class="nav-item">
                                            <a href="<?= site_url('profile/Profiles'); ?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'profile' ? 'active' : '';?> ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>My Profile</p>
                                            </a>
                                        </li>

                                          <li class="nav-item">
                                            <a href="<?= base_url('timeline/Timeline'); ?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'timeline' ? 'active' : '';?> ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Timeline</p>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="<?= base_url('message/Messages'); ?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'message' ? 'active' : '';?> ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Messages</p>
                                            </a>
                                        </li>

                                    </ul>
                                </li>


                                	 <li class="nav-item has-treeview  <?php echo $this->session->flashdata('menu') == 'manage_student' ? 'menu-open' : '';?>">
                                    <a href="#" class="nav-link <?php echo $this->session->flashdata('menu') == 'manage_student' ? 'active' : '';?>">
                                        <i class="nav-icon fas fa-edit"></i>
                                        <p>Managed  Student<i class="fas fa-angle-left right"></i> </p>
                                    </a>
                                    <ul class="nav nav-treeview">

                                      <li class="nav-item">
                                          <a href="<?= site_url('manage/Managestudent/');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'add' ? 'active' : '';?>">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Add to Class</p>
                                          </a>
                                      </li>
                                      <li class="nav-item">
                                          <a href="<?= site_url('ManageStudent/CLassStudent/');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'drop' ? 'active' : '';?>">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Drop Student</p>
                                          </a>
                                      </li>


                                    </ul>
                                </li>
                                <li class="nav-item has-treeview <?php echo $this->session->flashdata('menu') == 'activities' ? 'menu-open' : '';?>">
                                    <a href="#" class="nav-link <?php echo $this->session->flashdata('menu') == 'activities' ? 'active' : '';?>">
                                        <i class="nav-icon fas fa-running"></i>
                                        <p>Class Activities <i class="fas fa-angle-left right"></i> </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <!-- <li class="nav-item">
                                            <a href="</?= base_url('activities/attendance');?>" class="nav-link </?php echo $this->session->flashdata('submenu') == 'attendance' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>My Student Attendance</p>
                                            </a>
                                        </li> -->
                                        <li class="nav-item">
                                            <a href="<?= base_url('activities/seatwork');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'seatwork' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Seatwork</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?= base_url('activities/homework');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'homework' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Homework</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?= base_url('activities/test_result');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'test_result' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Test Result</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?=base_url('activities/Virtuallesson_controller');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'video_lesson' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Video lesson</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item has-treeview <?php echo $this->session->flashdata('menu') == 'exam' ? 'menu-open' : '';?>">
                                    <a href="#" class="nav-link <?php echo $this->session->flashdata('menu') == 'exam' ? 'active' : '';?>">
                                        <i class="nav-icon fas fa-book"></i>
                                        <p>Create Test <i class="fas fa-angle-left right"></i> </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?= base_url('exam/exam_header');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'exam_header' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Test Header</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?= base_url('exam/exam_body');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'exam_body' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Test Body</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?= base_url('exam/join_header_body');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'join_header_body' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Join Header and Body</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-percentage"></i>
                                        <p>Grades System <i class="fas fa-angle-left right"></i> </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Overall Grade</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li> -->

                                <li class="nav-item has-treeview <?php echo $this->session->flashdata('menu') == 'elearning' ? 'menu-open' : '';?>">
                                    <a href="#" class="nav-link <?php echo $this->session->flashdata('menu') == 'elearning' ? 'active' : '';?>">
                                        <i class="nav-icon fas fa-book"></i>
                                        <p>E-Learning Materials <i class="fas fa-angle-left right"></i> </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?=base_url('elearning/ebooks');?>" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>E-Books</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?=base_url('elearning/upload_center');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'upload_center' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Upload Center</p>
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                            <?php endif;?>

                            <?php if ($this->session->role_id == 1 || $this->session->role_id == 2):?>
                                <li class="nav-item has-treeview <?php echo $this->session->flashdata('menu') == 'dashboardadmin' ? 'menu-open' : '';?>">
                                    <a href="#" class="nav-link <?php echo $this->session->flashdata('menu') == 'dashboardadmin' ? 'active' : '';?>">
                                        <i class="nav-icon fas fa-th"></i>
                                        <p>Dashboard <i class="fas fa-angle-left right"></i> </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link <?php echo $this->session->flashdata('submenu') == 'profile' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>My Profile</p>
                                            </a>
                                        </li>

                                          <li class="nav-item">
                                            <a href="<?= base_url('timeline/Timeline'); ?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'timeline' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Timeline</p>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="<?= base_url('message/Messages'); ?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'mesages' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Messages</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                              <li class="nav-item has-treeview  <?php echo $this->session->flashdata('menu') == 'createAccount' ? 'menu-open' : '';?>">
					             <a href="#" class="nav-link <?php echo $this->session->flashdata('menu') == 'createAccount' ? 'active' : '';?>">
					                 <i class="nav-icon fas fa-edit"></i>
					                 <p>Login Credentials<i class="fas fa-angle-left right"></i> </p>
					             </a>
					             <ul class="nav nav-treeview">
					               <li class="nav-item">
					                   <a href="<?= base_url('registration/Student_controller'); ?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'registrationstudent' ? 'active' : '';?>">
					                       <i class="far fa-circle nav-icon"></i>
					                       <p>Student Registration</p>
					                   </a>
					               </li>
					               <li class="nav-item">
					                   <a href="<?= base_url('registration/Teacher_controller');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'registrationteacher' ? 'active' : '';?>">
					                       <i class="far fa-circle nav-icon"></i>
					                       <p>Teacher Registration</p>
					                   </a>
					               </li>
					             </ul>
					         </li>
                                <li class="nav-item has-treeview <?php echo $this->session->flashdata('menu') == 'student directory' ? 'menu-open' : '';?>">
                                    <a href="#" class="nav-link <?php echo $this->session->flashdata('menu') == 'student directory' ? 'active' : '';?>">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>Student Directory <i class="fas fa-angle-left right"></i> </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?=base_url('directory_student/student_information');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'student_information' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Student Information</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?=base_url('directory_student/registration');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'registration' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Registration</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item has-treeview <?php echo $this->session->flashdata('menu') == 'staff directory' ? 'menu-open' : '';?>">
                                    <a href="#" class="nav-link <?php echo $this->session->flashdata('menu') == 'staff directory' ? 'active' : '';?>">
                                        <i class="nav-icon fas fa-users-cog"></i>
                                        <p>School Staff Directory <i class="fas fa-angle-left right"></i> </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?=base_url('directory_staff/staff_information');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'staff_information' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Staff Information</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?=base_url('directory_staff/teachers_review');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'teachers_review' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Teachers Review</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item has-treeview <?php echo $this->session->flashdata('menu') == 'class directory' ? 'menu-open' : '';?>">
                                    <a href="#" class="nav-link <?php echo $this->session->flashdata('menu') == 'class directory' ? 'active' : '';?>">
                                        <i class="nav-icon fas fa-book"></i>
                                        <p>Class <i class="fas fa-angle-left right"></i> </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?=base_url('directory_class/class_information');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'class_information' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Create Class</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?=base_url('directory_class/block_class_information');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'block_class_information' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Create Block-Class</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif;?>

                            <?php if ($this->session->role_id == 4):?>
                                <!-- STUDENT -->
                                <li class="nav-item has-treeview <?php echo $this->session->flashdata('menu') == 'dashboardStudent' ? 'menu-open' : '';?>">
                                    <a href="#" class="nav-link <?php echo $this->session->flashdata('menu') == 'dashboardStudent' ? 'active' : '';?>">
                                        <i class="nav-icon fas fa-th"></i>
                                        <p>Dashboard <i class="fas fa-angle-left right"></i> </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                                     <li class="nav-item">
                                            <a href="<?= base_url('profile/Profiles');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'profile' ? 'active' : '';?> ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>My Profile</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?= base_url('timeline/Timeline'); ?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'timeline' ? 'active' : '';?> ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>TimeLine</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                              <a href="<?= base_url('message/Messages');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'message' ? 'active' : '';?>">
                                                  <i class="far fa-circle nav-icon"></i>
                                                  <p>Message</p>
                                              </a>
                                          </li>


                                    </ul>
                                </li>
                                <li class="nav-item has-treeview <?php echo $this->session->flashdata('menu') == 'activities' ? 'menu-open' : '';?>">
                                    <a href="#" class="nav-link <?php echo $this->session->flashdata('menu') == 'activities' ? 'active' : '';?>">
                                        <i class="nav-icon fas fa-running"></i>
                                        <p>Class Activities <i class="fas fa-angle-left right"></i> </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?= base_url('exam/online_exam_index');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'online_exam_index' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Online Test</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?= base_url('activities/seatwork_stud');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'seatwork' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Seatwork</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?= base_url('activities/homework_stud');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'homework' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Homework</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?= base_url('activities/test_result');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'test_result' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Test Result</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?= base_url('activities/Video_PlaylistIndex');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'playlists' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Video Playlists</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item has-treeview <?php echo $this->session->flashdata('menu') == 'elearning' ? 'menu-open' : '';?>">
                                    <a href="#" class="nav-link <?php echo $this->session->flashdata('menu') == 'elearning' ? 'active' : '';?>">
                                        <i class="nav-icon fas fa-book"></i>
                                        <p>E-Learning Materials <i class="fas fa-angle-left right"></i> </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?=base_url('elearning/Elearning/ebooksStudent');?>" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>E-Books</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?=base_url('elearning/download_center');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'download_center' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Download Center</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif;?>

                            <?php if ($this->session->role_id == 1 || $this->session->role_id == 2):?>
                                <!-- UTILITIES -->
                                <!-- <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-cogs"></i>
                                        <p>Utilities <i class="fas fa-angle-left right"></i> </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Add Teacher</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Add Student</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Add Parent</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li> -->
                            <?php endif;?>

                            <!-- CHAT -->
                                    <?php if($this->session->role_id == 5): ?>
                    <li class="nav-item has-treeview <?php echo $this->session->flashdata('menu') == 'dashboardParent' ? 'menu-open' : '';?>">
                        <a href="#" class="nav-link <?php echo $this->session->flashdata('menu') == 'dashboardParent' ? 'active' : '';?>">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Dashboard <i class="fas fa-angle-left right"></i> </p>
                        </a>
                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                                <a href="<?= site_url('parent/Account_controller'); ?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'account' ? 'active' : '';?> ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Account</p>
                                </a>
                            </li>

                              <li class="nav-item">
                                <a href="<?= site_url('parent/Schoolfee_controller'); ?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'schoolfee' ? 'active' : '';?> ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>School Fee</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= site_url('parent/ClassSched_controller'); ?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'schedule' ? 'active' : '';?> ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Class Schedule</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= site_url('parent/Grade_controller'); ?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'gradereports' ? 'active' : '';?> ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Grade Reports</p>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="</?= site_url('parent/Timeline_controller'); ?>" class="nav-link </?php echo $this->session->flashdata('submenu') == 'timeline' ? 'active' : '';?> ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Timeline</p>
                                </a>
                            </li> -->
                            <li class="nav-item">
                                <a href="<?= site_url('parent/Message_controller'); ?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'message' ? 'active' : '';?> ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Messages</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                            <!-- MY PORTAL -->
                                 <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-info-circle"></i>
                                    <p>Portal <i class="fas fa-angle-left right"></i> </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="https://urclassroomcommunity.biz/portfolio.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>FAQs</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="https://urclassroomcommunity.biz/contact.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Contact UCC</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="https://urclassroomcommunity.biz/about-us.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>About Us</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Privacy Policy</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>
            </aside>
