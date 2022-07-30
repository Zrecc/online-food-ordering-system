<?php
    class Users extends CI_Controller {
        // Register user
        public function register(){
            $data['title'] = 'Register';

            $this->form_validation->set_rules('name', 'Full Name', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
            $this->form_validation->set_rules('contact_number', 'Contact_Number', 'required|callback_check_contactNumber_exists');
            $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

            if($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->load->view('users/register', $data);
                $this->load->view('templates/footer');
            } else {
                // Encrypt password
                $enc_password = md5($this->input->post('password'));

                $this->user_model->register($enc_password);

                // set message
                $this->session->set_flashdata('user_registered', 'You are now registered and can log in.');
                redirect('foods');
            }
        }

        // Login user
        public function login(){
            $data['title'] = 'Login';

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->load->view('users/login', $data);
                $this->load->view('templates/footer');
            } else {
                // Get username
                $username = $this->input->post('username');
                // Get and encrypt the password
                $password = $this->input->post('password');

                // Login Admin 
                $user_id = $this->user_model->login_admin($username, $password);
                if ($user_id == "Admin") {
                    $user_data = array(
                        'user_id' => "Admin",
                        'logged_in' => true,
                    );
                    $this->session->set_userdata($user_data);
                    // set message
                    $this->session->set_flashdata('user_loggedin', 'You are now logged in.');
                    redirect('foods');
                } else // login user
                { 
                    $user_id = $this->user_model->login($username, $password);
                    if($user_id) {
                        // Create session
                        $user_data = array(
                            'user_id' => $user_id,
                            'username' => $username,
                            'logged_in' => true,
                        );

                        $this->session->set_userdata($user_data);
                        // set message
                        $this->session->set_flashdata('user_loggedin', 'You are now logged in.');
                        redirect('foods');
                    } else {
                        // set message
                        $this->session->set_flashdata('login_failed', 'Login is invalid.');
                        redirect('users/login');
                    }
                }
            }
        }

        public function edit(){
            // check login
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            $data['title'] = 'Edit Profile';

            $data['user'] = $this->user_model->get_current_user_info();

                $this->form_validation->set_rules('address', 'Address', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required|callback_checkPassword');

            if($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->load->view('users/edit', $data);
                $this->load->view('templates/footer');
            } else {
                // update address
                if($this->user_model->update()) {
                    // set message
                    $this->session->set_flashdata('user_edited_profile', 'Your changes have been saved.');
                    redirect('foods');
                } else {
                    $this->session->set_flashdata('user_edit_profile_failed', 'Your changes have not been saved.');
                    redirect('users/edit');
                }
            }
        }

        // Log user out
        public function logout(){
            // Unset user data
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('username');

            // set message
            $this->session->set_flashdata('user_loggedout', 'You are now logged out.');
            redirect('users/login');
        }

        //check if username exists
        public function check_username_exists($username){
            $this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different one.');
            if ($this->user_model->check_username_exists($username)) {
                return true;
            } else {
                return false;
            }
        }

        public function check_email_exists($email){
            $this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose a different one.');
            if ($this->user_model->check_email_exists($email)) {
                return true;
            } else {
                return false;
            }
        }

        public function check_contactNumber_exists($contact_number){
            $this->form_validation->set_message('check_contactNumber_exists', 'That contact number is taken. Please choose a different one.');
            if ($this->user_model->check_contactNumber_exists($contact_number)) {
                return true;
            } else {
                return false;
            }
        }

        public function checkPassword($password){
            $this->form_validation->set_message('checkPassword', 'Invalid password input.');
            if ($this->user_model->checkPassword($password)) {
                return true;
            } else {
                return false;
            }
        }
        
    
    }
?>