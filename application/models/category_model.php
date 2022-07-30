<?php 
    class Category_model extends CI_Model {
        public function __construct(){
            $this->load->database();
        }

        public function get_categories($limit = FALSE, $offset = FALSE) {
            if($limit) {
                $this->db->limit($limit, $offset);
            }

            $this->db->order_by('category_name');
            $query = $this->db->get('categories');
            return $query->result_array();
        }

        public function create_category($category_image){
            $data = array(
                'category_name' => $this->input->post('name'),
                'category_image' => str_replace(' ', '_', $category_image),
            );

            return $this->db->insert('categories', $data);
        }

        public function get_category($id){
            $query = $this->db->get_where('categories', array('category_id' => $id));
            return $query->row();
        }
        
        public function delete_category($id) {
            $image_file_name = $this->db->select('category_image')->get_where('categories', array('category_id' => $id))->row()->category_image;
            if($image_file_name != "noimage.png") {
                $cwd = getcwd(); // save the current working directory
                $image_file_path = $cwd."\\assets\\images\\categories";
                chdir($image_file_path);
                unlink($image_file_name);
                chdir($cwd); // restore the previous working directory
            }
            
            $this->db->where('category_id', $id);
            $this->db->delete('categories');
            return true;
        }
    }
?>