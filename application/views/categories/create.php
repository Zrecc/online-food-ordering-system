<h2><?= $title; ?></h2>

<?php echo validation_errors();?>

<?php echo form_open_multipart('categories/create');?>
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name" placeholder="Insert name">
    </div><br>
    <div class="form-group">
        <label>Upload Image</label><br>
        <input class="form-control" type="file" name="userfile" size="20" id="formFile">
    </div><br>
    <button type="submit" class="btn btn-secondary">Submit</button>
</form>