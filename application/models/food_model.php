<?php 
    class Food_model extends CI_Model {
        public function __construct() {
            $this->load->database();
        }

        public function get_foods($id = FALSE, $limit = FALSE, $offset = FALSE) {
            if($limit) {
                $this->db->limit($limit, $offset);
            }
            
            if($id === FALSE) {
                $this->db->order_by('foods.food_id', 'DESC');
                $this->db->join('categories', 'categories.category_id = foods.category_id');
                $query = $this->db->get('foods');
                return $query->result_array();
            }

            $this->db->join('categories', 'categories.category_id = foods.category_id');
            $query = $this->db->get_where('foods', array('food_id' => $id));
            return $query->row_array();
        }

        public function create_food($food_image){
            $data = array (
                'category_id' => $this->input->post('category_id'),
                'food_name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'unit_price' => $this->input->post('unit_price'),
                'food_image' => str_replace(' ', '_', $food_image),
                'status' => 'Available'
            );

            return $this->db->insert('foods', $data);
        }

        public function delete_food($id) {
            $image_file_name = $this->db->select('food_image')->get_where('foods', array('food_id' => $id))->row()->food_image;
            
            $this->db->where('food_id', $id);

            if ($this->db->delete('foods')) {
                if ($image_file_name != "noimage.png") {
                    $cwd = getcwd(); // save the current working directory
                    $image_file_path = $cwd."\\assets\\images\\foods";
                    chdir($image_file_path);
                    unlink($image_file_name);
                    chdir($cwd); // restore the previous working directory
                }
            return true;
            }
        }
        
        public function update_food(){
            $data = array (
                'category_id' => $this->input->post('category_id'),
                'food_name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'unit_price' => $this->input->post('unit_price'),
                'status' => $this->input->post('status'),
            );

            $this->db->where('food_id', $this->input->post('id'));
            return $this->db->update('foods', $data);
        }

        public function get_categories() {
            $this->db->order_by('category_name');
            $query = $this->db->get('categories');
            return $query->result_array();
        }

        public function get_foods_by_category($category_id) {
            $this->db->order_by('foods.food_id', 'DESC');
            $this->db->join('categories', 'foods.category_id = categories.category_id');
            $query = $this->db->get_where('foods', array('foods.category_id' => $category_id));
            return $query->result_array();
        }
    }
?>