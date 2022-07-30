<?php
class Orders extends CI_Controller{
    function index(){
        // check login
        if(!$this->session->userdata('logged_in')){
            redirect('users/login');
        }
        $data['orders'] = $this->order_model->getOrderList($this->session->user_id);
        
        // Retrieve cart data from the session
        $data['title'] = 'Orders';
        
        // Load the cart view
        $this->load->view('templates/header');
        $this->load->view('orders/index', $data);
        $this->load->view('templates/footer');
    }

    public function update($ordID){
        // check login 
        if(!$this->session->userdata('logged_in')){
            redirect('users/login');
        }
        $this->order_model->update_order_status($ordID);
        $this->session->set_flashdata('order_completed', 'The order has been marked as completed.');
        redirect('orders/index');
    }

    public function delete($ordID) {
        // check login 
        if(!$this->session->userdata('logged_in')){
            redirect('users/login');
        }
        $this->order_model->delete_order($ordID);
        // set message
        $this->session->set_flashdata('order_deleted', 'The order has been deleted.');
        redirect('orders/index');
    }

}