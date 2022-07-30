<?php echo validation_errors(); ?>

<?php echo form_open('users/register/'); ?>
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <h1 class="text-center"><?= $title; ?></h1>
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name">
            </div><br>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" placeholder="Username">
            </div><br>
            <div class="form-group">
                <label>Contact Number</label>
                <input type="text" class="form-control" name="contact_number" placeholder="Contact Number">
            </div><br>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div><br>
            <div class="form-group">
                <label>Address</label>
                <textarea name="address" class="form-control" rows="4" placeholder="Address"></textarea>
            </div><br>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div><br>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="password2" placeholder="Confirm Password">
            </div><br>
            <button type="Submit" class="btn btn-primary col-12">Submit</button>
        </div>
    </div>
<?php echo form_close();?>

