<h2><?= $title ;?></h2>
<!-- food list for admin -->
<?php if ($this->session->user_id == "Admin") : ?>
    <table class="table table-striped table-hover text-center">
        <thead>
            <tr>
                <th></th>
                <th>Food id</th>
                <th>Food Name</th>
                <th>Category</th>
                <th>Unit Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($foods)){ foreach($foods as $food){  ?>
            <tr class="align-middle">
                <td>
                    <img src="<?php echo site_url(); ?>assets/images/foods/<?php echo $food['food_image'];?>" 
                    style="height: 5vw; object-fit: cover;" class="card-img-top w-100" alt="<?php echo $food['food_name']; ?>">
                </td>
                <td><?php echo $food["food_id"]; ?></td>
                <td><b><?php echo $food["food_name"]; ?></b></td>
                <td><?php echo $food["category_name"]; ?></td>
                <td>RM <?php echo $food["unit_price"]; ?></td>
                <td><?php echo $food["status"]; ?></td>
                <td>
                    <a href="<?php echo site_url('foods/'.$food['food_id']);?>" class="btn btn-info btn-sm">View More</a>
                    <a class="btn btn-secondary btn-sm" href="<?php echo base_url(); ?>foods/edit/<?php echo $food['food_id']; ?>">Edit</a> 
                    <button class="btn btn-danger btn-sm" 
                    onclick="return confirm('Are you sure to delete this food?')?
                    window.location.href='<?php echo base_url('foods/delete/'.$food["food_id"]); ?>':false;">Delete</button> 
                </td>
            </tr>
            <?php } }else{ ?>
            <tr><td colspan="6"><p>Food list is empty.....</p></td>
            <?php } ?>
        </tbody>
    </table>
<br>
<?php echo $this->pagination->create_links();?> 

<!-- food grid for member and visitor -->
<?php else :?> 
    <div class="row">
    <?php foreach($foods as $food) : ?> <br>
        <div class="col-6 col-sm-4 col-md-3 mt-4">
            <div class="card">
                    <img src="<?php echo site_url(); ?>assets/images/foods/<?php echo $food['food_image'];?>" 
                    style="height: 18vw; object-fit: cover;" class="card-img-top w-100" alt="<?php echo $food['food_name']; ?>">

                <div class="card-body d-flex flex-column" style="min-height: 22vw;">
                    <h5 class="card-title"><?php echo $food['food_name']; ?></h5>
                    <p class="card-text post-date">in <strong><?php echo $food['category_name']; ?></strong></p>
                    <p class="card-text text-justify"><?php echo word_limiter($food['description'], 12); ?></p>
                    <p class="card-text mt-auto"><b>RM <?php echo $food['unit_price']; ?></b></p>
                    <a href="<?php echo site_url('foods/'.$food['food_id']);?>" class="btn btn-info">View More / Order</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?><br>
</div>
<br>
<?php echo $this->pagination->create_links();?> 


<?php endif ;?>





