<?php
class Cart extends CI_Controller{
    function index(){
        // check login
        if(!$this->session->userdata('logged_in')){
            redirect('users/login');
        }
        $data = array();
        
        // Retrieve cart data from the session
        $data['cartItems'] = $this->cart->contents();
        
        // Load the cart view
        $this->load->view('templates/header');
        $this->load->view('cart/index', $data);
        $this->load->view('templates/footer');
    }
    
    function updateItemQty(){
        // check login
        if(!$this->session->userdata('logged_in')){
            redirect('users/login');
        }
        $update = 0;
        
        // Get cart item info
        $rowid = $this->input->get('rowid');
        $qty = $this->input->get('qty');
        
        // Update item in the cart
        if(!empty($rowid) && !empty($qty)){
            $data = array(
                'rowid' => $rowid,
                'qty'   => $qty
            );
            $update = $this->cart->update($data);
        }
        
        // Return response
        echo $update?'ok':'err';
    }
    
    function removeItem($rowid){
        // check login
        if(!$this->session->userdata('logged_in')){
            redirect('users/login');
        }
        // Remove item from cart
        $remove = $this->cart->remove($rowid);
        $this->session->set_flashdata('removed_fromcart', 'The item has been removed from Cart.');
        // Redirect to the cart page
        redirect('cart/index');
    }
}