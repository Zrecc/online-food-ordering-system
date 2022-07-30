<h2 class="text-center"><?php echo $food['food_name'];?></h2><br>
<img src="<?php echo site_url(); ?>assets/images/foods/<?php echo $food['food_image'];?>" class="w-100" style="height: 20vw; object-fit: cover;">
<br><br>
<small class="post-date">In <Strong><?php echo $food['category_name']?></Strong> category</small><br>
<div class="food-body">
    <?php echo $food['description'];?>
</div><br>
<div class="food-body">
    <p>Unit Price: <h5>RM <?php echo $food['unit_price'];?></h5></p>
</div>
<div class="d-flex justify-content-between ">
    <p class="mt-auto mb-auto">Status: <b><?php echo $food['status'];?></b></p>

    <?php if(($food['status'] != "Available") && ($this->session->user_id != "Admin")) :?>
        <a class="btn btn-secondary disabled" >Not available</a>
    <?php elseif (!$this->session->userdata('logged_in')): ?>
        <a href="<?php echo base_url().'users/login'; ?>" class="btn btn-secondary">Add to Cart</a>
    <?php elseif (($this->session->user_id != "Admin")): ?>
        <a href="<?php echo base_url().'foods/addToCart/'.$food['food_id']; ?>" class="btn btn-primary">Add to Cart</a>
    <?php endif; ?>

</div>
<br>

<!-- edit and delete button -->
<?php if($this->session->user_id == "Admin") :?> 
    <hr>
    <a class="btn btn-secondary" style="float: left;" href="<?php echo base_url(); ?>foods/edit/<?php echo $food['food_id']; ?>">Edit</a> 
    <button class="btn btn-danger" 
    onclick="return confirm('Are you sure to delete this food?')?
    window.location.href='<?php echo base_url('foods/delete/'.$food["food_id"]); ?>':false;">Delete</button>
    <br><br> 
<?php endif; ?>

