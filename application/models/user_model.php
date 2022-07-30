<?php 
    class user_model extends CI_Model {
        public function register($enc_password){
            $data = array(
                'user_full_name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'contact_number' => $this->input->post('contact_number'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'password' => $enc_password,
            );
            // Insert user
            return $this->db->insert('users', $data);
        }

        // Log user in
        public function login($username, $password){
            // Validate
            $this->db->where('username', $username);
            $this->db->where('password', md5($password));

            $result = $this->db->get('users');

            if($result->num_rows() == 1) {
                return $result->row(0)->user_id;
            } else {
                return false;
            }
        }

        public function checkPassword($password){
            // Validate
            $this->db->where('user_id', $this->session->user_id);
            $this->db->where('password', md5($password));

            $result = $this->db->get('users');

            if($result->num_rows() == 1) {
                return true;
            } else {
                return false;
            }
        }

        public function update(){
            $data = array(
                'address' => $this->input->post('address'),
            );
            // Insert user
            $this->db->where('user_id', $this->session->user_id);
            return $this->db->update('users', $data);
        }

        public function login_admin($username, $password){
            // Validate
            $this->db->where('username', $username);
            $this->db->where('password', $password);

            $result = $this->db->get('admin');

            if($result->num_rows() == 1) {
                return "Admin";
            } else {
                return false;
            }
        }

        // check username exist
        public function check_username_exists($username) {
            // check username in admin table 
            $query = $this->db->get_where('admin', array ('username' => $username));
            // check username in users table
            if (empty($query->row_array())) {
                $query = $this->db->get_where('users', array ('username' => $username));
                if (empty($query->row_array())) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function check_email_exists($email) {
            $query = $this->db->get_where('users', array ('email' => $email));
            if (empty($query->row_array())) {
                return true;
            } else {
                return false;
            }
        }

        public function check_contactNumber_exists($contact_number) {
            $query = $this->db->get_where('users', array ('contact_number' => $contact_number));
            if (empty($query->row_array())) {
                return true;
            } else {
                return false;
            }
        }

        public function get_current_user_info() {
            $query = $this->db->get_where('users', array ('user_id' => $this->session->user_id));
            return $query->row_array();
        }
    }
?>