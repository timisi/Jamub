<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_rss extends Admin_Core_Controller
{
    public function __construct()
    {
        parent::__construct();

        //check auth
        if (!is_admin() && !is_author()) {
            redirect('admin/login');
        }

        //check permission
        if (!show_admin_panel()) {
            redirect('admin/login');
        }

        //load the library
        $this->load->library('feed');
    }

    /**
     * Import Feed
     */
    public function import_feed()
    {
        prevent_author();

        $data['title'] = trans("import_rss_feed");
        $data['top_categories'] = $this->category_model->get_categories();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/rss/import_feed', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Import Feed Post
     */
    public function import_feed_post()
    {
        prevent_author();

        if ($this->rss_model->add_feed()) {

            $last_id = $this->db->insert_id();
            $this->rss_model->add_feed_posts($last_id);

            $this->session->set_flashdata('success', trans("feed") . " " . trans("msg_suc_added"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }


    /**
     * RSS Feeds
     */
    public function feeds()
    {
        prevent_author();

        $data['title'] = trans("rss_feeds");
        $data['feeds'] = $this->rss_model->get_feeds();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/rss/feeds', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update RSS Feed
     */
    public function update_feed($id)
    {
        prevent_author();

        $data["feed"] = $this->rss_model->get_feed($id);

        if (empty($data["feed"])) {
            redirect($this->agent->referrer());
        }

        $data['title'] = trans("update_rss_feed");
        $data['categories'] = $this->category_model->get_categories();
        $data['subcategories'] = $this->category_model->get_subcategories_by_parent_id($data["feed"]->category_id);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/rss/update_feed', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update RSS Feed Post
     */
    public function update_feed_post()
    {
        prevent_author();

        $id = $this->input->post('id', true);

        if ($this->rss_model->update_feed($id)) {
            $this->session->set_flashdata('success', trans("feed") . " " . trans("msg_suc_updated"));
            redirect('admin_rss/feeds');
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }


    /**
     * Delete Feed
     */
    public function delete_feed_post()
    {
        $id = $this->input->post('id', true);

        if ($this->rss_model->delete_feed($id)) {
            $this->session->set_flashdata('success', trans("feed") . " " . trans("msg_suc_deleted"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }
}