<h2>Checkout</h2><br>
<div class="checkout">
    <div class="row">
        <div class="col-md-8 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your Cart</span>
                <span class="badge badge-secondary badge-pill"><?php echo $this->cart->total_items(); ?></span>
            </h4>
            <ul class="list-group mb-3">
                <?php if($this->cart->total_items() > 0){ foreach($cartItems as $item){ ?>
                <li class="list-group-item d-flex justify-content-between">
                    <div>
                        <?php $imageURL = base_url().'assets/images/foods/'.$item["image"]; ?>
                        <img src="<?php echo $imageURL; ?>" class="w-100" style="height: 8vw; object-fit: cover;"/>
                        <h6 class="my-0"><?php echo $item["name"]; ?></h6>
                        <small class="text-muted"><?php echo 'RM '.$item["price"]; ?>(<?php echo $item["qty"]; ?>)</small>
                    </div>
                    <span class="text-muted"><?php echo 'RM '.$item["subtotal"]; ?></span>
                </li>
				            <?php } }else{ ?>
                <li class="list-group-item d-flex justify-content-between">
                    <p>No items in your cart...</p>
                </li>
                <?php } ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (RM)</span>
                    <strong><?php echo 'RM '.$this->cart->total(); ?></strong>
                </li>
            </ul>

            <div class="d-flex justify-content-between">
                <div><a href="<?php echo base_url('foods/index'); ?>" class="btn btn-block btn-info">Add Items</a></div>
                <div>
                    
                    <button class="btn btn-success btn-lg btn-block" name="placeOrder" value="Place Order"
                    onclick="window.location.href='<?php echo base_url('checkout/placeorder'); ?>'">Place Order</button>
                </div>
            </div>

        </div>
        <div class="col-md-4 order-md-1">
            <h4 class="mb-3">Contact Details</h4>
            <p><b>Full Name</b> <br><?php echo $custData['user_full_name']?></p>
            <p><b>Username</b> <br><?php echo $custData['username']?></p>
            <p><b>Contact Number</b> <br><?php echo $custData['contact_number']?></p>
            <p><b>Email</b>  <br><?php echo $custData['email']?></p>
            <p><b>Address</b>  <br><?php echo $custData['address']?></p>
        </div>
    </div>
</div>