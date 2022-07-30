<?php echo validation_errors(); ?>

<?php echo form_open('users/edit/'); ?>
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <h1 class="text-center"><?= $title; ?></h1>
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $user['user_full_name']?>" disabled>
            </div><br>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $user['username']?>" disabled>
            </div><br>
            <div class="form-group">
                <label>Contact Number</label>
                <input type="text" class="form-control" name="contact_number" placeholder="Contact Number" value="<?php echo $user['contact_number']?>" disabled>
            </div><br>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $user['email']?>" disabled>
            </div><br>
            <div class="form-group">
                <label>Address</label>
                <textarea name="address" class="form-control" rows="4" placeholder="Address"><?php echo $user['address']?></textarea>
            </div><br>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div><br>
            <div class = "btn-group col-12">
                <button type="Submit" class="btn btn-primary col-6" value="submit">Save Changes</button>
                <a href="<?php echo base_url()?>foods" class="btn btn-secondary col-6">Cancel</a>
            </div>
        </div>
    </div>
<?php echo form_close();?>