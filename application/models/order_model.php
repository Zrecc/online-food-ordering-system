<?php
    class Order_model extends CI_Model {
        public function getOrderList($id){
            $this->db->from('orders');
            $this->db->join('users', 'users.user_id = orders.user_id');
            $this->db->order_by('order_id', 'DESC');
            if ($id != "Admin"){         // Get a particular order for order success page
                $this->db->where('orders.user_id', $id);
                $query = $this->db->get();
                $result = $query->result_array();
            } else {         // Get all order
                $query = $this->db->get();
                $result = $query->result_array();
            }         
            // Return fetched data
            return !empty($result)?$result:false;
        }

       // Get a particular order for order success page
        public function getOrder($id){
            $this->db->from('orders');
            $this->db->join('users', 'users.user_id = orders.user_id');
            $this->db->where('orders.order_id', $id);
            $query = $this->db->get();
            $result = $query->row_array();
        
            // Get order items
            $this->db->select('i.*, f.food_image, f.food_name, f.unit_price');
            $this->db->from('order_items as i');
            $this->db->join('foods as f', 'f.food_id = i.food_id', 'left');
            $this->db->where('i.order_id', $id);
            $query2 = $this->db->get();
            $result['items'] = ($query2->num_rows() > 0)?$query2->result_array():array();
            
            // Return fetched data
            return !empty($result)?$result:false;
        }
            
        public function insertOrder($data){           
            // Insert order data
            $insert = $this->db->insert('orders', $data);
    
            // Return the status
            return $insert?$this->db->insert_id():false;
        }
        
        public function insertOrderItems($data = array()) {
            
            // Insert order items
            $insert = $this->db->insert_batch('order_items', $data);
    
            // Return the status
            return $insert?true:false;
        }  

        public function update_order_status($ordID) {
            $data = array (
                'order_status' => "Completed"
            );

            $this->db->where('order_id', $ordID);
            return $this->db->update('orders', $data);
        }

        public function delete_order($ordID) {
            $this->db->where('order_id', $ordID);
            $this->db->delete('orders');
            $this->db->where('order_id', $ordID);
            $this->db->delete('order_items');
            return true;
        }
    }

?>