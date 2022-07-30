<h2><?= $title?></h2>
<table class="table table-striped table-hover text-center">
<thead>
    <tr>
        <th>Order ID</th>
        <th>
            <?php if ($this->session->user_id == "Admin") {echo "User ID";} 
            else {echo 'User Full Name';
            }; ?>
        </th>
        <th>Total Cost (RM)</th>
        <th>Order Created at</th>
        <th>Order Status</th>
        <th></th>
    </tr>
</thead>
<tbody>
    <?php if(!empty($orders)){ foreach($orders as $order){  ?>
    <tr class="align-middle">
        <td><?php echo $order["order_id"]; ?></td>
        <td>
            <?php if ($this->session->user_id == "Admin") {echo $order["user_id"];} 
            else {echo $order['user_full_name'];
            }; ?>
        </td>
        <td>RM <?php echo $order["total_cost"]; ?></td>
        <td><?php echo $order["order_create_at"]; ?></td>
        <td><?php echo $order["order_status"]; ?></td>
        <td>
            <button class="btn btn-sm btn-info" 
            onclick="window.location.href='<?php echo base_url().'checkout/ordersuccess/'.$order["order_id"]; ?>'">View More</button>

            <!-- Complete and delete button is for admin only -->
            <?php if($this->session->user_id == "Admin") :?> 

                <?php if ($order["order_status"] == "Completed"): ?>
                    <button class="btn btn-sm btn-secondary" disabled>Complete</button>
                <?php else:?>
                    <button class="btn btn-sm btn-success"
                    onclick="return confirm('Are you sure to complete this order?')?
                    window.location.href='<?php echo base_url('orders/update/'.$order["order_id"]); ?>':false;">Complete</button>
                <?php endif;?>

                <button class="btn btn-sm btn-danger" 
                onclick="return confirm('Are you sure to delete the order?')?
                window.location.href='<?php echo base_url('orders/delete/'.$order["order_id"]); ?>':false;">Delete</button> 
            <?php endif; ?>
        </td>
    </tr>
    <?php } }else{ ?>
    <tr><td colspan="6"><p>Order list is empty.....</p></td>
    <?php } ?>
</tbody>
</table>
