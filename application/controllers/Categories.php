<?php class Categories extends CI_Controller{
    public function index($offset = 0){
        // pagination config
        $config['base_url'] = base_url().'categories/index/';
        $config['total_rows'] = $this->db->count_all('categories');
        $config['per_page'] = 5;
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

        $data['title'] = 'Categories';
        
        if(($this->session->user_id) == "Admin"){
            $data['categories'] = $this->category_model->get_categories($config['per_page'], $offset);
        } else {
            $data['categories'] = $this->category_model->get_categories();
        }

        $this->load->view('templates/header');
        $this->load->view('categories/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        // validate admin
        if(!$this->session->user_id = "Admin"){
            show_404();
        }
        $data['title'] = 'Create Category';

        $this->form_validation->set_rules('name', 'Name', 'required');
        if($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('categories/create', $data);
            $this->load->view('templates/footer');
        } else {
            // upload photo
            $config['upload_path'] = './assets/images/categories';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '0';
            $config['max_width'] = '7000';
            $config['max_height'] = '7000';

            $this->load->library('upload', $config);

            if(!$this->upload->do_upload()) {
                $category_image = 'noimage.png';
            } else {
                $data = array('upload_data' => $this->upload->data());
                $category_image = $_FILES['userfile']['name'];
            }

            $this->category_model->create_category($category_image);
            $this->session->set_flashdata('category_created', 'The category has been created.');
            redirect('categories');
        }
    }

    public function foods($id){
        $data['title'] = $this->category_model->get_category($id)->category_name;

        $data['foods'] = $this->food_model->get_foods_by_category($id);

        $this->load->view('templates/header');
        $this->load->view('foods/index', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id) {
        // validate admin
        if(!$this->session->user_id = "Admin"){
            show_404();
        }
        $this->category_model->delete_category($id);
        // set message
        $this->session->set_flashdata('category_deleted', 'The category has been deleted.');
        redirect('categories');
    }

}?>