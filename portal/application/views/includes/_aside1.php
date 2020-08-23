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

                            <?php if ($this->session->role_id == 1 || $this->session->role_id == 2 || $this->session->role_id == 3):?>
                                <!-- TEACHER -->
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-th"></i>
                                        <p>Dashboard <i class="fas fa-angle-left right"></i> </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>My Profile</p>
                                            </a>
                                        </li>



                                        	          <li class="nav-item">
                                            <a href="<?= base_url('timeline/Timeline'); ?>" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Timeline</p>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="<?= base_url('message/Messages'); ?>" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Messages</p>
                                            </a>
                                        </li>



                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Communicate</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Homeworks</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Reports</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Download Center</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>E-Books</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-edit"></i>
                                        <p>Managed  Student<i class="fas fa-angle-left right"></i> </p>
                                    </a>
                                    <ul class="nav nav-treeview">

                                      <li class="nav-item">
                                          <a href="<?= site_url('manage/Managestudent/');?>" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Enrolled Student</p>
                                          </a>
                                      </li>

                                    </ul>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>Student Information <i class="fas fa-angle-left right"></i> </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>My Student Details</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>My Student Case</p>
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
                                            <a href="<?= base_url('activities/attendance');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'attendance' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>My Student Attendance</p>
                                            </a>
                                        </li>
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
                                    </ul>
                                </li>

                                <li class="nav-item has-treeview <?php echo $this->session->flashdata('menu') == 'exam' ? 'menu-open' : '';?>">
                                    <a href="#" class="nav-link <?php echo $this->session->flashdata('menu') == 'exam' ? 'active' : '';?>">
                                        <i class="nav-icon fas fa-book"></i>
                                        <p>Create Exams <i class="fas fa-angle-left right"></i> </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?= base_url('exam/exam_header');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'exam_header' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Exam Header</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?= base_url('exam/exam_body');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'exam_body' ? 'active' : '';?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Exam Body</p>
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

                                <li class="nav-item has-treeview">
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
                                </li>

                       
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
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
                                            <a href="<?=base_url('elearning/download_center');?>" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Download Center</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif;?>

                            <?php if ($this->session->role_id == 4):?>
                                <!-- STUDENT -->
                      <li class="nav-item has-treeview <?php echo $this->session->flashdata('menu') == 'exam' ? 'menu-open' : '';?>">
                                    <a href="#" class="nav-link <?php echo $this->session->flashdata('menu') == 'exam' ? 'active' : '';?>">
                                        <i class="nav-icon fas fa-th"></i>
                                        <p>Dashboard <i class="fas fa-angle-left right"></i> </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                                     <li class="nav-item">
                                            <a href="<?= base_url('profile/Profiles');?>" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>My Profile</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?= base_url('timeline/Timeline'); ?>" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>TimeLine</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                              <a href="<?= base_url('message/Messages');?>" class="nav-link">
                                                  <i class="far fa-circle nav-icon"></i>
                                                  <p>Message</p>
                                              </a>
                                          </li>

                                    </ul>
                                </li>
                                
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-edit"></i>
                                        <p>Class Activities <i class="fas fa-angle-left right"></i> </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                      <li class="nav-item">
                                          <a href="<?= base_url('exam/online_exam_index');?>" class="nav-link <?php echo $this->session->flashdata('submenu') == 'online_exam_index' ? 'active' : '';?>"">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Online Exam</p>
                                          </a>
                                      </li>
                                      <li class="nav-item">
                                          <a href="#" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Homework</p>
                                          </a>
                                      </li>
                                      <li class="nav-item">
                                          <a href="#" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Seatwork</p>
                                          </a>
                                      </li>
                                    </ul>
                                </li>

                    <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
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
                                            <a href="<?=base_url('elearning/download_center');?>" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Download Center</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif;?>

                            <?php if ($this->session->role_id == 1 || $this->session->role_id == 2):?>
                                <!-- UTILITIES -->
                                <li class="nav-item has-treeview">
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
                                </li>
                            <?php endif;?>
                            
                            <!-- CHAT -->
                          <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-comment-dots"></i>
                                    <p>Chat <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('message/Messages'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Messages</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
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