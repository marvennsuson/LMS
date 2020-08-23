<?php if($GetInfo->num_rows() > 0): ?>
<?php foreach($GetInfo->result() as $GetInfo_row ): ?>

  <form id="ProfileUpdate" method="POST" action="<?= site_url('profile/Profiles/UpdateTeacherProfile'); ?>" class="form-horizontal">
    <div class="form-group row">
      <label for="inputName" class="col-sm-2 col-form-label">FullName</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputName" name="name" placeholder="FullName" value="<?= $GetInfo_row->name ?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" value="<?= $GetInfo_row->email ?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputNo" class="col-sm-2 col-form-label">Mobile Number</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="inputNo" name="mobile" placeholder="Mobile Number" value="<?= $GetInfo_row->mobile ?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputExperience" class="col-sm-2 col-form-label">Locaton & Address</label>
      <div class="col-sm-10">
        <textarea class="form-control" id="inputExperience" placeholder="Addresss" name="address"><?= $GetInfo_row->address ?></textarea>
      </div>
    </div>
    <!-- <div class="form-group row">
      <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
      </div>
    </div> -->
    <!-- <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
        <div class="checkbox">
          <label>
            <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
          </label>
        </div>
      </div>
    </div> -->
    <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
        <button type="submit" class="btn btn-success btn-flat">Update Profile</button>
      </div>
    </div>
  </form>


<?php endforeach; ?>
<?php endif; ?>
