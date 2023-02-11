<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends Admin_Core_Controller
{

    public function __construct()
    {
        parent::__construct();

        //check auth
        if (!is_admin()) {
            redirect('login');
        }

        //check permission
        if (!show_admin_panel()) {
            redirect('admin/login');
        }
    }


    /**
     * Gallery
     */
    public function index()
    {
        $data['title'] = trans("gallery");
        $data['images'] = $this->gallery_model->get_images();
        $data['categories'] = $this->gallery_category_model->get_categories();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/gallery/gallery', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Add Image Post
     */
    public function add_gallery_image_post()
    {
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'xss_clean|max_length[500]');
        $this->form_validation->set_rules('category_id', trans("category"), 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->gallery_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->gallery_model->add()) {
                $this->session->set_flashdata('success_form', trans("image") . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->gallery_model->input_values());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update Image
     */
    public function update_gallery_image($id)
    {
        $data['title'] = trans("update_image");

        //get post
        $data['image'] = $this->gallery_model->get_image($id);

        if (empty($data['image'])) {
            redirect($this->agent->referrer());
        }

        $data['categories'] = $this->gallery_category_model->get_categories();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/gallery/update', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Image Post
     */
    public function update_gallery_image_post()
    {
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'xss_clean|max_length[500]');
        $this->form_validation->set_rules('category_id', trans("category"), 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->gallery_model->input_values());
            redirect($this->agent->referrer());
        } else {

            $id = $this->input->post('id', true);

            if ($this->gallery_model->update($id)) {
                $this->session->set_flashdata('success', trans("image") . " " . trans("msg_suc_updated"));
                redirect('gallery/index');
            } else {
                $this->session->set_flashdata('form_data', $this->gallery_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Delete Image Post
     */
    public function delete_gallery_image_post()
    {
        $id = $this->input->post('id', true);

        if ($this->gallery_model->delete($id)) {
            $this->session->set_flashdata('success', trans("image") . " " . trans("msg_suc_deleted"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }


}
