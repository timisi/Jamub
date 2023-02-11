<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_video extends Admin_Core_Controller
{
    public function __construct()
    {
        parent::__construct();

        //check auth
        if (!is_admin() && !is_author()) {
            redirect('login');
        }

        //check permission
        if (!show_admin_panel()) {
            redirect('admin/login');
        }
    }


    /**
     * Add Video
     */
    public function add_video()
    {
        $data['title'] = trans("add_video");
        $data['top_categories'] = $this->category_model->get_categories();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/post/add_video', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Add Video Post
     */
    public function add_video_post()
    {
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'required|xss_clean|max_length[500]');
        $this->form_validation->set_rules('optional_url', trans("optional_url"), 'xss_clean|max_length[1000]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->video_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //if video added
            if ($this->video_model->add()) {
                //last id
                $last_id = $this->db->insert_id();
                //update slug
                $this->post_admin_model->update_slug($last_id);
                //insert video image
                $this->post_image_model->add_post_image($last_id, 'vr_video_image');
                //add video tags
                $this->tag_model->add_post_tags($last_id);

                $this->session->set_flashdata('success', trans("video") . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->video_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update Video
     */
    public function update_video($id)
    {
        $data['title'] = trans("update_video");

        //get video
        $data['post'] = $this->post_admin_model->get_post($id);

        if (empty($data['post'])) {
            redirect($this->agent->referrer());
        }

        //check if author
        if (is_author()) {
            //check owner
            if ($data['post']->user_id != user()->id):
                redirect("admin");
            endif;
        }

        //combine video tags
        $tags = "";
        $count = 0;
        $tags_array = $this->tag_model->get_post_tags($id);
        foreach ($tags_array as $item) {
            if ($count > 0) {
                $tags .= ",";
            }
            $tags .= $item->tag;
            $count++;
        }

        $data['tags'] = $tags;
        $data['categories'] = $this->category_model->get_categories();
        $data['subcategories'] = $this->category_model->get_subcategories_by_parent_id($data['post']->category_id);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/post/update_video', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Video Post
     */
    public function update_video_post()
    {
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'required|xss_clean|max_length[500]');
        $this->form_validation->set_rules('summary', trans("summary"), 'xss_clean|max_length[1000]');
        $this->form_validation->set_rules('category_id', trans("category"), 'required');
        $this->form_validation->set_rules('optional_url', trans("optional_url"), 'xss_clean|max_length[1000]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->video_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //post id
            $post_id = $this->input->post('id', true);

            if ($this->video_model->update($post_id)) {

                //update slug
                $this->post_admin_model->update_slug($post_id);

                //update post tags
                $this->tag_model->update_post_tags($post_id);

                //update video image
                $this->post_image_model->add_video_image_from_url($post_id);

                $this->session->set_flashdata('success', trans("video") . " " . trans("msg_suc_updated"));

                $referrer = $this->input->post("referrer");
                if (!empty($referrer)) {
                    redirect($referrer);
                } else {
                    redirect('admin_post/posts');
                }

            } else {
                $this->session->set_flashdata('form_data', $this->video_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Get Video from URL
     */
    public function get_video_from_url()
    {
        $url = $this->input->post('url', true);

        $this->load->library('video_url_parser');
        echo $this->video_url_parser->get_url_embed($url);

    }


    /**
     * Get Video Thumbnail
     */
    public function get_video_thumbnail()
    {
        $url = $this->input->post('url', true);

        echo $this->video_model->get_video_thumbnail($url);
    }


    /**
     * Upload Video Session
     */
    public function upload_video_session()
    {
        $this->video_model->upload_video_session();
        $this->load->view('admin/includes/_video_upload_box');
    }


    /**
     * Upload Video
     */
    public function upload_video()
    {
        $post_id = $this->input->post('post_id', true);

        $this->video_model->upload_video($post_id);
        $data["post"] = $this->post_admin_model->get_post($post_id);

        $this->load->view('admin/includes/_video_edit_box', $data);

    }


    /**
     * Delete Video Session
     */
    public function delete_video_session()
    {
        $this->video_model->delete_video_session();
        $this->load->view('admin/includes/_video_upload_box');
    }


    /**
     * Delete Video
     */
    public function delete_video()
    {
        $post_id = $this->input->post('post_id', true);

        $this->video_model->delete_video($post_id);
        $data["post"] = $this->post_admin_model->get_post($post_id);

        $this->load->view('admin/includes/_video_edit_box', $data);
    }
}
