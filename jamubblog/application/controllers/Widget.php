<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Widget extends Admin_Core_Controller
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
     * Add Widget
     */
    public function add_widget()
    {
        $data['title'] = trans("add_widget");

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/widget/add', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Widgets
     */
    public function widgets()
    {
        $data['title'] = trans("widgets");
        $data['widgets'] = $this->widget_model->get_widgets();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/widget/widgets', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Add Widget Post
     */
    public function add_widget_post()
    {
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'required|xss_clean|max_length[400]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->widget_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->widget_model->add()) {
                $this->session->set_flashdata('success', trans("widget") . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->widget_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update Widget
     */
    public function update_widget($id)
    {
        $data['title'] = trans("update_widget");

        //get widget
        $data['widget'] = $this->widget_model->get_widget($id);

        if (empty($data['widget'])) {
            redirect($this->agent->referrer());
        }

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/widget/update', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Widget Post
     */
    public function update_widget_post()
    {
        //widget id
        $id = $this->input->post('id', true);

        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'required|xss_clean|max_length[400]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->widget_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->widget_model->update($id)) {
                $this->session->set_flashdata('success', trans("widget") . " " . trans("msg_suc_updated"));
                redirect(base_url() . "widget/widgets");
            } else {
                $this->session->set_flashdata('form_data', $this->widget_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Delete Widget Post
     */
    public function delete_widget_post()
    {
        $id = $this->input->post('id', true);

        $widget = $this->widget_model->get_widget($id);

        //check if widget custom or not
        if ($widget->is_custom == 0) {
            $this->session->set_flashdata('error', trans("msg_widget_delete"));
            redirect($this->agent->referrer());
        }

        if ($this->widget_model->delete($id)) {
            $this->session->set_flashdata('success', trans("widget") . " " . trans("msg_suc_deleted"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

}
