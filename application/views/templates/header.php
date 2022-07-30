<html>
    <head>
        <title>YY Food</title>
        <link rel='stylesheet' href="https://bootswatch.com/5/united/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
        <script>
            $("register").submit(function(event){
            loadAjax();
            event.preventDefault()
            })
      </script>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">YY Food</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo base_url(); ?>">Home
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>foods">Food</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>categories">Categories</a>
                    </li>
                </ul>

                <ul class="navbar-nav navbar-right">

                    <!-- function for visitor -->
                    <?php if(!$this->session->userdata('logged_in')) :?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>users/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>users/register">Register</a>
                        </li>
                    <?php endif;?>

                    <!-- function for admin only-->
                    <?php if($this->session->user_id == "Admin") :?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>foods/create">Add Food</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>categories/create">Create Category</a>
                        </li>
                    <?php endif;?>

                    <!-- function for member only -->
                    <?php if($this->session->userdata('logged_in') && $this->session->user_id != "Admin") :?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>users/edit">Edit Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>cart/index">Cart 
                                <?php if(($total = $this->cart->total_items()) != 0) :?>
                                <span class="badge bg-light rounded-pill"><?php echo $total;?></span>
                                <?php endif;?>
                            </a>
                        </li>
                    <?php endif;?>

                    <!-- function for all logined user -->
                    <?php if($this->session->userdata('logged_in')) :?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>orders/index">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>users/logout">Logout</a>
                        </li>
                    <?php endif;?>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <div class="container">
        <!-- flash message -->
        <?php if($this->session->flashdata('user_registered')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('login_failed')):?>
            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('user_loggedin')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedin').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('user_loggedout')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedout').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('order_success')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('order_success').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('added_tocart')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('added_tocart').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('removed_fromcart')):?>
            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('removed_fromcart').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('food_updated')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('food_updated').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('food_deleted')):?>
            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('food_deleted').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('food_created')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('food_created').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('category_created')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('category_created').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('category_deleted')):?>
            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('category_deleted').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('order_completed')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('order_completed').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('order_deleted')):?>
            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('order_deleted').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('food_delete_failed')):?>
            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('food_delete_failed').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('user_edited_profile')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_edited_profile').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('user_edit_profile_failed')):?>
            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('user_edit_profile_failed').'</p>';?>
        <?php endif;?>
        