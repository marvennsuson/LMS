<title><?= $title;?></title>
<style>
/* .emp-profile{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
} */
.profile-img{
    text-align: center;
}
.profile-img img{
    width: 70%;
    height: 100%;
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}
.profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
}
.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
}
.profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
}
.proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}
.profile-work{
    padding: 14%;
    margin-top: -15%;
}
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a{
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul{
    list-style: none;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
}

.foremail , .forno , .foradd{
border-radius: 10px;

}

.panel_data{
  background-color: #66d5cc;
  width: auto 100%;

}
.panel_header{
  margin-top: 0;
  margin-left: 5px;
  margin-right: 5px;
margin-bottom: 0;
  background-color: white;
  padding: 25px;
}
.title-header > h2{
  text-transform:uppercase;
  font-size: 40px;
  font-weight: 500;
  text-decoration: none;
}
.title-header > small{
  text-transform:uppercase;
  font-size: 20px;
  font-weight: 300;
  text-decoration: none;
}
.panel_notes{
    padding: 10px 10px 10px 20px;
  background-color: #b1e9e5;
  border: 2px solid #00d9e1;

}
.table_paneel{
  margin-left: 30px;
  margin-right: 30px;
}
table.table-bordered{
    border:6px solid  #66d5cc;
    margin-top:20px;
  }
table.table-bordered > thead > tr > th{
    border: 0px solid  #66d5cc;
    background: white;
    color:#02342b;

}
table.table-bordered > tbody > tr > td{
    border:6px solid  #66d5cc;
    background: white;
    color:#02342b;
}
</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">My Profile   </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>

                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid card p-5">

<div class="emp-profile">

            <div class="row">
                <div class="col-md-10">
                    <div class="profile-head">
                        <div class="m-0">
                          <h5 class="display-4" >
                                <?php
                                if($profilers->num_rows() > 0):
                                foreach ($profilers->result() as $value_row) {
                                  echo  htmlentities(ucfirst( $value_row->lastname)) . ' , ' . htmlentities(ucfirst( $value_row->firstname)) . ' ' .htmlentities(ucfirst( $value_row->middlename)) ;
                                }
                                else :
                                  echo "null";
                              endif;
                                 ?>
                          </h5>
                          <h6 class="text-dark h1">
                            <?php
                                if($profilers->num_rows() > 0):
                                foreach ($profilers->result()as $value_row) {
                                      if($value_row->grade != null){
                                      echo  htmlentities(ucfirst( $value_row->student_type)) . ' , ' . htmlentities(ucfirst( $value_row->year_lvl_name));
                                    }elseif($value_row->strand != null){
                                            echo  htmlentities(ucfirst( $value_row->student_type)) . ' , ' . htmlentities(ucfirst( $value_row->year_lvl_name));
                                    }elseif($value_row->course != null ){
                                          echo  htmlentities(ucfirst( $value_row->student_type)) . ' , ' . htmlentities(ucfirst( $value_row->year_lvl_name));
                                    }else{
                                      echo "NULL";
                                    }
                                }
                                else :
                                  echo "null";
                              endif;
                             ?>
                          </h6>
                        </div>
                                <i class="proile-rating"></i>
                        <ul class="nav nav-tabs mt-5" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="schoolfee-tab" data-toggle="tab" href="#schoolfee" role="tab" aria-controls="schoolfee" aria-selected="true">School Fee's</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="schedule-tab" data-toggle="tab" href="#schedule" role="tab" aria-controls="schedule" aria-selected="true">Class Schedule</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="changepass-tab" data-toggle="tab" href="#changepass" role="tab" aria-controls="changepass" aria-selected="true">Change Password</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" class="profile-edit-btn btn-success text-white"  data-toggle="modal" data-target="#Editprofile" >Edit Profile</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active " id="home" role="tabpanel" aria-labelledby="home-tab">
                      <div class="row">
                        <div class="col-md-3">
                              <div class="container">
                                <ul class="list-group list-group-sm list-group-flush">

                                  <?php
                                      if($profilers->num_rows() > 0):
                                      foreach ($profilers->result() as $value_row) {
                                        ?>

                                              <li class="list-group-item list-group-item-action"><label for="">Std Number :</label> &nbsp;<?= htmlentities(ucfirst( $value_row->student_number));   ?></li>


                                        <li class="list-group-item list-group-item-action"><label for="">Email :</label>  &nbsp;<?= htmlentities(ucfirst( $value_row->email));   ?></li>

                                  <?php    }

                                  else :
                                    echo "null";
                                endif;
                                   ?>

                               </ul>
                              </div>

                            <!-- <div class="profile-work">
                                <p>WORK LINK</p>
                                <a href="">Website Link</a><br/>
                                <a href="">Bootsnipp Profile</a><br/>
                                <a href="">Bootply Profile</a>
                                <p>SKILLS</p>
                                <a href="">Web Designer</a><br/>
                                <a href="">Web Developer</a><br/>
                                <a href="">WordPress</a><br/>
                                <a href="">WooCommerce</a><br/>
                                <a href="">PHP, .Net</a><br/>
                            </div> -->
                        </div>
                        <div class="col-md-8">
                          <div class="card">
                                <div class="card-header bg-dark">
                                    <div class="card-title">
                                            <strong>  My infromation</strong>
                                    </div>
                                </div>

                                <table class="table table-hover table-sm">
                                  <tbody class="">
                                    <?php
                                        if($profilers->num_rows() > 0):
                                     foreach ($profilers->result() as $value_row) {
                                    ?>
                                    <tr>
                                      <td>Phone</td>
                                      <td> <?= htmlentities(ucfirst( $value_row->cellphone));   ?></td>
                                    </tr>
                                    <tr>
                                      <td>Email</td>
                                      <td><?= htmlentities(ucfirst( $value_row->email));   ?></td>
                                    </tr>
                                    <tr>
                                      <td>Gender</td>
                                      <td> <?= htmlentities(ucfirst( $value_row->sex));   ?></td>
                                    </tr>
                                    <tr>
                                      <td>Date of Birth</td>
                                      <td> <?= htmlentities(ucfirst( $value_row->birthdate));   ?></td>
                                    </tr>

                                    <tr>
                                      <td>School Level</td>
                                      <td> <?= htmlentities(ucfirst( $value_row->student_type));   ?></td>
                                    </tr>
                                    <tr>
                                      <td>Section OR Course</td>
                                      <td><?php
                                      if($value_row->grade != null){
                                      echo  htmlentities(ucfirst( $value_row->year_lvl_name));
                                    }elseif($value_row->strand != null){
                                            echo  htmlentities(ucfirst( $value_row->strand));
                                    }elseif($value_row->course != null ){
                                          echo htmlentities(ucfirst( $value_row->course));
                                    }else{
                                      echo "NULL";
                                    }

                                      ?> </td>
                                    </tr>
<?php }
else :
  echo "null";
endif;
 ?>
                                  </tbody>
                                </table>

                          </div>
                          <div class="card">
                                <div class="card-header bg-dark">
                                    <div class="card-title">
                                            <strong> Address</strong>
                                    </div>
                                </div>

                                <table class="table table-hover table-sm">
                                  <tbody class="">
                                      <?php
                                          if($profilers->num_rows() > 0):
                                       foreach ($profilers->result() as $value_row) {

                                      ?>

                                      <tr>
                                        <td>Address</td>
                                        <td><?= htmlentities(ucfirst( $value_row->address));   ?></td>
                                      </tr>


<?php     }
else :
  echo "null";
  endif; ?>
                                  </tbody>
                                </table>

                          </div>
                          <div class="card">
                                <div class="card-header bg-dark">
                                    <div class="card-title">
                                            <strong>  Guardian Details</strong>
                                    </div>
                                </div>

                                <table class="table table-hover table-sm">
                                  <tbody class="">
                                          <?php
                                                if($profilers->num_rows() > 0):
                                           foreach ($profilers->result() as $value_row) {
                                        ?>
                                          <tr>
                                            <td>Guardian Name</td>
                                            <td><?= $value_row->guardian_name ?></td>
                                          </tr>

                                          <tr>
                                            <td>Guardian Mobile Number</td>
                                            <td><?= $value_row->guardian_mobile ?></td>
                                          </tr>
                                          <tr>
                                            <td>Guardian Email</td>
                                            <td><?= $value_row->guardian_email ?></td>
                                          </tr>
                                          <tr>
                                            <td>Guardian Address</td>
                                            <td> <?= $value_row->guardian_address ?></td>
                                          </tr>

                                        <?php  }
                                        else :
                                          echo "null";
                                      endif;
                                        ?>
                                  </tbody>
                                </table>

                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="tab-pane fade" id="schoolfee" role="tabpanel" aria-labelledby="schoolfee-tab">
                        <table class="table table-sm table-hover ">
                            <thead>
                              <tr>
                                <th>Fees Group</th>
                                  <th>Fees Code</th>
                                    <th> 	Due Date</th>
                                      <th>Status</th>
                                        <th>Amount (₱)</th>
                                          <th>Payment Id</th>
                                            <th>Mode</th>
                                              <th> 	Date</th>
                                                <th>Discount (₱)</th>
                                                  <th>Fine (₱)</th>
                                                    <th>Paid (₱) 	</th>
                                                      <th>Balance (₱)</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>None</td>
                                  <td>JHI32BQ</td>
                                    <td>August 30,2020</td>
                                      <td>Pending</td>
                                        <td> ₱ 5,000</td>
                                          <td>#002392</td>
                                            <td>Cash</td>
                                              <td>June 23,2020</td>
                                                <td> ₱ 500 </td>
                                                  <td>none</td>
                                                    <td>N-A</td>
                                                      <td> ₱ 5,000</td>

                              </tr>
                              <tr>
                                <td>None</td>
                                  <td>JHI32BQ</td>
                                    <td>August 30,2020</td>
                                      <td>Pending</td>
                                        <td> ₱ 5,000</td>
                                          <td>#002392</td>
                                            <td>Cash</td>
                                              <td>June 23,2020</td>
                                                <td> ₱ 500 </td>
                                                  <td>none</td>
                                                    <td>N-A</td>
                                                      <td> ₱ 5,000</td>

                              </tr>
                            </tbody>
                        </table>
                    </div>
                          <div class="tab-pane fade" id="schedule" role="schedule" aria-labelledby="schedule-tab">
                            <div class="container-fluid">
                                    <div class="panel_data card">
                                        <div class="panel_header mt-5 ">
                                            <div class="row ">
                                                <div class="col-7">
                                                  <div class="title-header text-center">
                                                      <h2>Class 4 Schedule</h2>
                                                      <small>Schedule For 2020-20201</small>
                                                  </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="">
                                                        <div class="panel_notes">
                                                          <h5>Notes:</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="table_paneel mt-5 mb-5">
                                            <table class=" table table-bordered">
                                              <thead class="text-white">
                                                <tr class="text-center h6">
                                                    <th>Subject Name</th>
                                                    <th>Schedule</th>
                                                    <th>Section</th>
                                                    <th>Instrutor</th>

                                                </tr>
                                              </thead>
                                              <tbody>
                                                <?php if($Schedule->num_rows() > 0): ?>
                                                <?php foreach($Schedule->result() as $Schedule_row): ?>
                                                  <tr class="text-black text-center">
                                                      <td  ><p> <?= $Schedule_row->subject_name ?></p></td>
                                                      <td><p>  <?= $Schedule_row->schedule ?> </p></td>
                                                      <td><p>  <?= $Schedule_row->section ?></p></td>
                                                      <td><p>  <?= $Schedule_row->name ?> </p></td>

                                                  </tr>
                                                <?php endforeach; ?>
                                              <?php
                                            else:
                                              echo "<center> <strong> No data</strong> </center>";
                                            endif; ?>



                                              </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="hidden" role="hidden" aria-labelledby="hidden-tab">
                            <div class="container-fluid">
                                    <div class="panel_data card">
                                        <div class="panel_header mt-5 ">
                                            <div class="row ">
                                                <div class="col-7">
                                                  <div class="title-header text-center">
                                                      <h2>Class 4 Schedule</h2>
                                                      <small>Schedule For 2020-20201</small>
                                                  </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="">
                                                        <div class="panel_notes">
                                                          <h5>Notes:</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="table_paneel mt-5 mb-5">
                                            <table class=" table table-bordered">
                                              <thead class="text-white">
                                                <tr class="text-center h6">
                                                    <th>Monday</th>
                                                    <th>Tuesday</th>
                                                    <th>Wednesday</th>
                                                    <th>Thursday</th>
                                                    <th>Friday</th>
                                                    <th>Saturday</th>
                                                    <th>Sunday</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr class="text-black text-center">
                                                    <td  ><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                </tr>
                                                <tr class="text-dark text-center">
                                                    <td ><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                </tr>
                                                <tr class="text-dark text-center">
                                                    <td ><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                </tr>
                                                <tr class="text-white text-center">
                                                    <td ><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                </tr>
                                                <tr class="text-white text-center">
                                                    <td ><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                </tr>
                                                <tr class="text-white text-center">
                                                    <td ><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                    <td><p> 7:30am - 9:30am <br> <strong> Maam. Glenzale Celino </strong> </p></td>
                                                </tr>

                                              </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                          </div>
                            <div class="tab-pane fade" id="changepass" role="changepass" aria-labelledby="changepass-tab">
                              <div class="container-fluid">
                                  <div class="justify-content-center mx-auto">
                                      <form id="changepassword" action="<?= site_url('profile/Profiles/Changepassword');  ?>" method="post" >
                                          <!-- <div class="form-group">
                                                <label for="oldPassword">Old Password</label><span id="message" style="color:red"><?//= form_error('oldpass');?></span>
                                                <input id="oldPassword" class="form-control w-50" type="password" name="oldpass" value="<?//= set_value('oldpass'); ?>" placeholder="Old password">
                                          </div> -->
                                          <div class="form-group">
                                                <label for="newpass">New Password</label><span id="message" style="color:red"></span>
                                                <input id="newpass" class="form-control w-50" type="password" name="newpass" value="<?= set_value('newpass'); ?>" placeholder="New password">
                                          </div>
                                          <div class="form-group">
                                                <label for="cnewpass">Confirm Password</label><span id="message" style="color:red"></span>
                                                <input id="cnewpass" class="form-control w-50" type="password" name="cnewpass" value="<?= set_value('cnewpass'); ?>" placeholder="Confirm, password" disabled>
                                          </div>
                                          <button type="submit" class="btn btn-flat btn-success btn-md" >Change Password</button>
                                      </form>
                                  </div>
                              </div>
                            </div>

                </div>
              </div>
            </div>



            <!-- The Modal -->
            <div class="modal fade" id="Editprofile">
              <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Update Profile</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                          <div class="container-fluid">
                              <form id="mydata" action="<?= base_url('profile/Profiles/UpdateStudentProfile');  ?>" method="post">
                                    <?php if($profilers->num_rows > 0 ): ?>
                                      <?php foreach($profilers->result() as $profilers_row ):   ?>
                                                                          <input type="hidden" name="base_id" value="<?= $profilers_row->student_number ?>">
                                                                            <div class="row">
                                                                                  <div class="col-sm-6">
                                                                                        <div class="form-group">
                                                                                                  <label class="tex-center" for="email">Email</label> <span style="color:red"> <?=  form_error('email');    ?></span>
                                                                                              <input id="email" class="form-control foremail" type="email" name="email" value="<?= $profilers_row->email ?>" placeholder="Your Email">
                                                                                        </div>
                                                                                  </div>
                                                                                  <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                          <label class="tex-center" for="mobileno">Mobile Number.</label> <span style="color:red"> <?=  form_error('mobileno');    ?></span>
                                                                                      <input id="mobileno" class="form-control forno" type="text" name="mobileno" value="<?=  $profilers_row->cellphone   ?>" placeholder="Mobile Number">
                                                                                </div>
                                                                                  </div>
                                                                                  <div class="col-sm-4">
                                                                                  </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-8">
                                                                                  <div class="form-group">
                                                                                            <label class="tex-center" for="address">Address</label>  <span style="color:red"> <?=  form_error('address');    ?></span>
                                                                                          <textarea  id="address" class="form-control foradd" name="address" rows="2" cols="30" placeholder="Place Address"><?=  $profilers_row->address   ?></textarea>
                                                                                  </div>
                                                                                </div>
                                                                                <div class="col-4">
                                                                                </div>
                                                                            </div>
                                                                              <hr>
                                                                              <div class="row">
                                                                                <div class="col-6">
                                                                                  <div class="form-group">
                                                                                            <label class="tex-center" for="guardian_name">Guardian Name</label> <span style="color:red"> <?=  form_error('guardian_name');    ?></span>
                                                                                        <input id="guardian_name" class="form-control forno" type="text" name="guardian_name" value="<?= $profilers_row->guardian_name  ?>" placeholder="Guardian Name">
                                                                                  </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                  <div class="form-group">
                                                                                        <label class="tex-center" for="guardian_mobile">Guardian Mobile Number</label> <span style="color:red"> <?=  form_error('guardian_mobile');    ?></span>
                                                                                        <input id="guardian_mobile" class="form-control forno" type="text" name="guardian_mobile" value="<?= $profilers_row->guardian_mobile  ?>" placeholder="Mobile Number" >
                                                                                  </div>
                                                                                </div>

                                                                              </div>
                                                                              <div class="row">
                                                                                <div class="col-8">
                                                                                  <div class="form-group">

                                                                                            <label class="tex-center" for="guardian_address">Guardian Address</label>  <span style="color:red"> <?=  form_error('guardian_address');    ?></span>

                                                                                          <textarea  id="guardian_address" class="form-control foradd" name="guardian_address" rows="2" cols="30" placeholder="Place Address"><?= $profilers_row->guardian_address ?></textarea>
                                                                                  </div>
                                                                                </div>
                                                                                <div class="col-4">

                                                                                </div>
                                                                              </div>


                                      <?php endforeach;   ?>
                                    <?php endif; ?>

                          </div>
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                  </div>
      </form>
                </div>
              </div>
            </div>
    </div>
        </div>
    </div>
</div>
<script>




$(document).ready(function(){
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
});

var activeTab = localStorage.getItem('activeTab');
if(activeTab){
    $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
}
});
$('#changepassword').submit(function(e){

// var password = document.getElementById("newpass").value;
// var cpassword = document.getElementById("cnewpass").value;
// var message = document.getElementById("message");
// if(form.newpass.value != form.cnewpass.value){
// form.error.innerHTML == 'Confirm password And Password Not The Same';
//  form.error.focus();
// }else{
  e.preventDefault();
   var fa = $(this);

    $.ajax({
      url: fa.attr('action'),
      type: 'post' ,
      // dataType: 'json',
      data: fa.serialize(),

      success: function (data) {
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })

        Toast.fire({
          icon: 'success',
          title: 'Updating Record'
        }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    window.location.href='<?= current_url(); ?>';
                }
            });

           },
           error: function (data) {
      alert('Something was Wrong');
           },

   });
// }




});
// const Toast = Swal.mixin({
//   toast: true,
//   position: 'top-end',
//   showConfirmButton: false,
//   timer: 3000,
//   timerProgressBar: true,
//   onOpen: (toast) => {
//     toast.addEventListener('mouseenter', Swal.stopTimer)
//     toast.addEventListener('mouseleave', Swal.resumeTimer)
//   }
// })
//
// Toast.fire({
//   icon: 'success',
//   title: 'Updating Record'
// }).then((result) => {
//         if (result.dismiss === Swal.DismissReason.timer) {
//             window.location.href='<?//= current_url(); ?>';
//         }
//     });


$('#mydata').submit(function(e){

e.preventDefault();
 var fa = $(this);

  $.ajax({
    url: fa.attr('action'),
    type: 'post' ,
    data: fa.serialize(),
    dataType: 'json',
    success: function(response) {

    }

 });
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })

          Toast.fire({
            icon: 'success',
            title: 'Updating Record'
          }).then((result) => {
                  if (result.dismiss === Swal.DismissReason.timer) {
                      window.location.href='<?= current_url(); ?>';
                  }
              });

});
</script>
