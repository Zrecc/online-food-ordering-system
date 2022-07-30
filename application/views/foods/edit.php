<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('foods/update'); ?><br>
  <input type="hidden" name="id" value="<?php echo $food['food_id'];?>">
    <div class="form-group">
      <label>Food Name</label>
      <input type="text" class="form-control" name="name" placeholder="Add Food Name"
      value="<?php echo $food['food_name'];?>">
    </div><br>
    <div class="form-group">
      <label>Food Description</label>
      <textarea class="form-control" name="description" placeholder="Add Food Description" rows="3">
      <?php echo $food['description'];?>
      </textarea>
    </div><br>
    <div class="form-group">
      <label>Food Unit Price</label>
      <input type="text" class="form-control" name="unit_price" placeholder="Set Food Unit Price"
      value="<?php echo $food['unit_price'];?>">
    </div><br>

    <div class="form-group">
      <label>Category</label>
      <select name="category_id" class="form-select">
        <?php foreach($categories as $category) : ?>
          <?php if ($food['category_id'] == $category['category_id']) {?>
            <option value="<?php echo $category['category_id'];?>" selected><?php echo $category['category_name'];?></option>
          <?php } else {?>
            <option value="<?php echo $category['category_id'];?>"><?php echo $category['category_name'];?></option>
          <?php }?>
        <?php endforeach;?>
      </select>
    </div><br>

    <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="status" id="food_status" value="Available" 
          <?php if($food['status'] == 'Available') {echo "checked";};?>>
          Available
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="status" id="food_status" value="Not available"
          <?php if($food['status'] == 'Not available') {echo "checked";};?>>
          Not Available
        </label>
    </div>

  <br>
    <button type="submit" class="btn btn-secondary">Submit</button>
</form>
