<?php
class Checkout extends CI_Controller{
    function index(){
        // check login
        if(!$this->session->userdata('logged_in')){
            redirect('users/login');
        }
        if($this->cart->total_items() <= 0){
            redirect('foods/');
        }
        
        // If order request is submitted
        $submit = $this->input->post('placeOrder');
        
        // Retrieve cart data from the session
        $data['cartItems'] = $this->cart->contents();
        // Customer data
        $data['custData'] = $this->user_model->get_current_user_info();
        
        // Pass products data to the view
        $this->load->view('templates/header');
        $this->load->view('checkout/index', $data);
        $this->load->view('templates/footer');

    }
    
    function placeOrder(){
        // check login
        if(!$this->session->userdata('logged_in')){
            redirect('users/login');
        }
        // Insert order data
        $ordData = array(
            'user_id' => $this->session->user_id,
            'total_cost' => $this->cart->total(),
            'order_status' => "Awaiting Shipment"
        );
        $insertOrder = $this->order_model->insertOrder($ordData);
        
        if($insertOrder){
            // Retrieve cart data from the session
            $cartItems = $this->cart->contents();
            
            // Cart items
            $ordItemData = array();
            $i=0;
            foreach($cartItems as $item){
                $ordItemData[$i]['order_id']     = $insertOrder;
                $ordItemData[$i]['food_id']     = $item['id'];
                $ordItemData[$i]['quantity']     = $item['qty'];
                $ordItemData[$i]['sub_total']     = $item["subtotal"];
                $i++;
            }
            
            if(!empty($ordItemData)){
                // Insert order items
                $insertOrderItems = $this->order_model->insertOrderItems($ordItemData);
                
                if($insertOrderItems){
                    // Remove items from the cart
                    $this->cart->destroy();
                    $this->session->set_flashdata('order_success', 'Your order has been placed successfully.');
                    redirect('checkout/ordersuccess/'.$insertOrder);
                }
            }
        }
        return false;
    }
    
    function orderSuccess($ordID){
        // check login
        if(!$this->session->userdata('logged_in')){
            redirect('users/login');
        }
        // Fetch order data from the database
        $data['order'] = $this->order_model->getOrder($ordID);
        
        // Load order details view
        $this->load->view('templates/header');
        $this->load->view('checkout/order-success', $data);
        $this->load->view('templates/footer');

    }
    
}