<div class="container">
    <form  id="changepasswordtecher" class="form-horizontal" action="<?= base_url('profile/Profiles/Changepassword_teacher'); ?>" method="post">
        <div class="form-group">
            <label for="newpass">New Password</label>
            <input id="newpass" class="form-control w-50" type="password" name="newpass" value="<?= set_value('newpass'); ?>" placeholder="New Password">
        </div>
        <div class="form-group">
            <label for="cnewpass">Confirm Password</label>
            <input id="cnewpass" class="form-control w-50" type="password" name="cnewpass" value="<?= set_value('cnewpass'); ?>" placeholder="Confirm Password" disabled>
        </div>
        <button type="submit" class="btn btn-flat btn-success btn-md">Changes Password</button>
    </form>
</div>
