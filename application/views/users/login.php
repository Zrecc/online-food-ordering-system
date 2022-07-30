<?php echo form_open('users/login'); ?>
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <h1 class="text-center"><?php echo $title;?></h1><br>
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Enter Username" required autofocus>
            </div><br>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Enter Password" required autofocus>
            </div><br>
            <button type="Submit" class="btn btn-primary col-12">Login</button>
        </div>
    </div>
<?php echo form_close();?>