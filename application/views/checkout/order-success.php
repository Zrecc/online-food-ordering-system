<h1>Order Status</h1>
<?php if(!empty($order)){ ?>
	
    <!-- Order status & shipping info -->
    <div class="row col-lg-12 ord-addr-info">
        <h5>Order Info</h5>
        <p><b>Reference ID:</b> #<?php echo $order['order_id']; ?></p>
        <p><b>Total:</b> <?php echo 'RM '.$order['total_cost']; ?></p>
        <p><b>Order Status:</b> <?php echo $order['order_status']; ?></p>
        <p><b>Placed On:</b> <?php echo $order['order_create_at']; ?></p>
        <p><b>Buyer Full Name:</b> <?php echo $order['user_full_name']; ?></p>
        <p><b>Email:</b> <?php echo $order['email']; ?></p>
        <p><b>Phone:</b> <?php echo $order['contact_number']; ?></p>
        <p><b>Address:</b> <?php echo $order['address']; ?></p>
    </div>
	
    <!-- Order items -->
    <div class="row col-lg-12">
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th></th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>QTY</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(!empty($order['items'])){  
                    foreach($order['items'] as $item){ 
                ?>
                <tr class="align-middle">
                    <td>
                        <?php $imageURL = base_url().'assets/images/foods/'.$item["food_image"]; ?>
                        <img src="<?php echo $imageURL; ?>" class="w-100" style="height: 5vw; object-fit: cover;"/>
                    </td>
                    <td><?php echo $item["food_name"]; ?></td>
                    <td><?php echo 'RM '.$item["unit_price"]; ?></td>
                    <td><?php echo $item["quantity"]; ?></td>
                    <td><?php echo 'RM '.$item["sub_total"]; ?></td>
                </tr>
                <?php } 
                } ?>
            </tbody>
        </table>
    </div>
<?php }else{ ?>
<div class="col-md-12">
    <div class="alert alert-danger">Your order submission failed.</div>
</div>
<?php } ?>