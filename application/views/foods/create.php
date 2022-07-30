<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('foods/create'); ?><br>
  <div class="form-group">
    <label>Food Name</label>
    <input type="text" class="form-control" name="name" placeholder="Add Food Name">
  </div><br>
  <div class="form-group">
    <label>Food Description</label>
    <textarea  class="form-control" name="description" placeholder="Add Food Description" rows="3"></textarea>
  </div><br>
  <div class="form-group">
    <label>Food Unit Price</label>
    <div class="input-group mb-3">
      <span class="input-group-text">RM</span>
        <input type="text" class="form-control" aria-label="Amount (RM)" 
        name="unit_price" placeholder="Set Food Unit Price (RM)">
    </div>
  </div><br>

  <div class="form-group">
    <label>Category</label>
    <select name="category_id" class="form-select">
      <option value="" selected disabled hidden>Choose a category</option>
      <?php foreach($categories as $category) : ?>
        <option value="<?php echo $category['category_id'];?>"><?php echo $category['category_name'];?></option>
      <?php endforeach;?>
    </select>
  </div><br>
  <div class="form-group">
    <label>Upload Image</label><br>
    <input class="form-control" type="file" name="userfile" size="20" id="formFile">
  </div>
<br>
  <button type="submit" class="btn btn-secondary">Submit</button>
</form>