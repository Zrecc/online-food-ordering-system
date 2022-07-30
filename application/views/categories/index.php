<h2><?= $title; ?></h2>
<!-- category list for admin -->
<?php if ($this->session->user_id == "Admin") : ?>
    <table class="table table-striped table-hover text-center">
        <thead>
            <tr>
                <th></th>
                <th>
                    Category ID
                </th>
                <th>Category Name</th>
                <th>Category Create at</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($categories)){ foreach($categories as $category){  ?>
            <tr class="align-middle">
                <td>
                    <img src="<?php echo site_url(); ?>assets/images/categories/<?php echo $category['category_image'];?>" 
                    style="height: 5vw; object-fit: cover;" class="w-100" alt="<?php echo $category['category_name']; ?>">
                </td>
                <td><?php echo $category["category_id"]; ?></td>
                <td><b><?php echo $category["category_name"]; ?></b></td>
                <td><?php echo $category["create_at"]; ?></td>
                <td>
                    <a href="<?php echo site_url('categories/foods/'.$category['category_id']);?>" class="btn btn-info">Browse</a>
                    <button class="btn btn-danger" 
                    onclick="return confirm('Are you sure to delete this category?')?
                    window.location.href='<?php echo base_url('categories/delete/'.$category['category_id']); ?>':false;">Delete</button> 
                </td>
            </tr>
            <?php } }else{ ?>
            <tr><td colspan="6"><p>Category list is empty.....</p></td>
            <?php } ?>
        </tbody>
    </table>
<br>
<?php echo $this->pagination->create_links();?> 

<!-- category grid for member and visitor -->
<?php else :?> 
<div class="row">
    <?php foreach($categories as $category) : ?> <br>
        <div class="col-6 col-sm-4 col-md-3 mt-4">
            <div class="card">
                    <img src="<?php echo site_url(); ?>assets/images/categories/<?php echo $category['category_image'];?>" 
                    style="height: 18vw; object-fit: cover;" class="card-img-top w-100" alt="<?php echo $category['category_name']; ?>">

                <div class="card-body d-flex flex-column" style="min-height: 10vw;">
                    <h5 class="card-title text-center"><?php echo $category['category_name']; ?></h5>
                    <a href="<?php echo site_url('categories/foods/'.$category['category_id']);?>" class="btn btn-info mt-auto">Browse</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?><br>
</div>
<br>



<?php endif ;?>