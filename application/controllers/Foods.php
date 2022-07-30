<?php
class Foods extends CI_Controller {
    public function index($offset = 0) {
        // pagination config
        $config['base_url'] = base_url().'foods/index/';
        $config['total_rows'] = $this->db->count_all('foods');
        $config['per_page'] = 8;
        $config['uri_segment'] = 3;
        // config pagination attribute with bootstrap
        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';        
        $config['full_tag_close'] = '</ul>';        
        $config['first_link'] = 'First';        
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['first_tag_close'] = '</span></li>';        
        $config['prev_link'] = '&laquo';        
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['prev_tag_close'] = '</span></li>';        
        $config['next_link'] = '&raquo';        
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['next_tag_close'] = '</span></li>';        
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['last_tag_close'] = '</span></li>';        
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';        
        $config['cur_tag_close'] = '</a></li>';        
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['num_tag_close'] = '</span></li>';

        // init pagination
        $this->pagination->initialize($config);

        $data['title'] = 'Food';

        $data['foods'] = $this->food_model->get_foods(FALSE,  $config['per_page'], $offset);

        $this->load->view('templates/header');
        $this->load->view('foods/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($id = NULL) {
        $data['food'] = $this->food_model->get_foods($id);

        if(empty($data['food'])) {
            show_404();
        }

        $this->load->view('templates/header');
        $this->load->view('foods/view', $data);
        $this->load->view('templates/footer');
    }

    public function create(){
        // validate admin
        if(!$this->session->user_id = "Admin"){
            show_404();
        }

        $data['title'] = 'Add food';

        $data['categories'] = $this->food_model->get_categories();

        $this->form_validation->set_rules('category_id', 'Category ID', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('unit_price', 'Unit Price', 'required');

        if($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('foods/create', $data);
            $this->load->view('templates/footer');
        } else {
            //upload image
            $config['upload_path'] = './assets/images/foods';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '10000';
            $config['max_width'] = '7000';
            $config['max_height'] = '7000';

            $this->load->library('upload', $config);

            if(!$this->upload->do_upload()) {
                $food_image = 'noimage.png';
            } else {
                $data = array('upload_data' => $this->upload->data());
                $food_image = $_FILES['userfile']['name'];
            }

            $this->food_model->create_food($food_image);
            $this->session->set_flashdata('food_created', 'The food has been created.');
            redirect('foods');
        }
    }

    public function delete($id) {
        // validate admin
        if(!$this->session->user_id = "Admin"){
            show_404();
        }

        if ($this->food_model->delete_food($id)) {
            // set message
            $this->session->set_flashdata('food_deleted', 'The food has been deleted.');
        }
        redirect('foods');
    }

    public function edit($id){
        // validate admin
        if(!$this->session->user_id = "Admin"){
            show_404();
        }
        $data['food'] = $this->food_model->get_foods($id);

        $data['categories'] = $this->food_model->get_categories();

        if(empty($data['food'])) {
            show_404();
        }

        $data['title'] = 'Edit Food';

        $this->load->view('templates/header');
        $this->load->view('foods/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update(){
        // validate admin
        if(!$this->session->user_id = "Admin"){
            show_404();
        }
        $this->food_model->update_food();
        $this->session->set_flashdata('food_updated', 'The food has been updated.');
        redirect('foods');
    }

    public function addToCart($id){
        // check login 
        if(!$this->session->userdata('logged_in')){
            redirect('users/login');
        }
        // Fetch specific product by ID
        $food = $this->food_model->get_foods($id);
        
        // Add product to the cart
        $data = array(
            'id'    => $food['food_id'],
            'qty'    => 1,
            'price'    => $food['unit_price'],
            'name'    => $food['food_name'],
            'image' => $food['food_image']
        );
        $this->cart->insert($data);
        $this->session->set_flashdata('added_tocart', 'The item has been added to Cart.');
        // Redirect to the cart page
        redirect('foods/view/'.$id);
    }

} ?>