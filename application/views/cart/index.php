<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>

<script>
// Update item quantity
function updateCartItem(obj, rowid){
    $.get("<?php echo base_url('cart/updateItemQty/'); ?>", {rowid:rowid, qty:obj.value}, function(resp){
        if(resp == 'ok'){
            location.reload();
        }else{
            alert('Cart update failed, please try again.');
        }
    });
}
</script>

<h2>Cart</h2>
<table class="table table-striped">
<thead>
    <tr>
        <th width="10%"></th>
        <th width="30%">Product</th>
        <th width="15%">Price</th>
        <th width="13%">Quantity</th>
        <th width="20%" class="text-right">Subtotal</th>
        <th width="12%"></th>
    </tr>
</thead>
<tbody>
    <?php if($this->cart->total_items() > 0){ foreach($cartItems as $item){    ?>
    <tr class="align-middle">
        <td>
            <?php $imageURL = !empty($item["image"])?base_url('assets/images/foods/'.$item["image"]):base_url('assets/images/noimage.jpg'); ?>
            <img src="<?php echo $imageURL; ?>" class="w-100" style="height: 5vw; object-fit: cover;"/>
        </td>
        <td><?php echo $item["name"]; ?></td>
        <td><?php echo 'RM '.$item["price"]; ?></td>
        <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
        <td class="text-right"><?php echo 'RM '.$item["subtotal"]; ?></td>
        <td class="text-right">
            <button class="btn btn-sm btn-danger" 
            onclick="return confirm('Are you sure to delete item?')?
            window.location.href='<?php echo base_url('cart/removeItem/'.$item["rowid"]); ?>':false;">Delete</button> 
      </td>
    </tr>
    <?php } }else{ ?>
    <tr><td colspan="6"><p>Your cart is empty.....</p></td>
    <?php } ?>
    <?php if($this->cart->total_items() > 0){ ?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><strong>Cart Total</strong></td>
        <td class="text-right"><strong><?php echo 'RM '.$this->cart->total(); ?></strong></td>
        <td>
            <button class="btn btn-sm btn-warning" onclick="window.location.href='<?php echo base_url('checkout/index'); ?>'">Checkout</button> 
        </td>
    </tr>
    <?php } ?>
</tbody>
</table>
