<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Audio extends Admin_Core_Controller
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
     * Add Audio Post
     */
    public function add_audio()
    {
        $data['title'] = trans("add_audio");
        $data['top_categories'] = $this->category_model->get_categories();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/post/add_audio', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Add Audio Post Post
     */
    public function add_audio_post()
    {
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'required|xss_clean|max_length[500]');
        $this->form_validation->set_rules('summary', trans("summary"), 'xss_clean|max_length[1000]');
        $this->form_validation->set_rules('category_id', trans("category"), 'required');
        $this->form_validation->set_rules('optional_url', trans("optional_url"), 'xss_clean|max_length[1000]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->audio_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //if post added
            if ($this->audio_model->add_post()) {
                //last id
                $last_id = $this->db->insert_id();

                //update slug
                $this->post_admin_model->update_slug($last_id);

                //insert post image
                $this->post_image_model->add_post_image($last_id, 'vr_audio_image');

                //insert post audio
                $this->audio_model->add_post_audio($last_id);

                //insert post tags
                $this->tag_model->add_post_tags($last_id);

                //reset session data
                $this->session->unset_userdata('vr_user_audios');

                $this->session->set_flashdata('success', trans("post") . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->audio_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update Audio Post
     */
    public function update_audio($id)
    {
        $data['title'] = trans("update_post");

        //get post
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

        //combine post tags
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
        $data['audios'] = get_post_audios($id);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/post/update_audio', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Audio Post Post
     */
    public function update_audio_post()
    {
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'required|xss_clean|max_length[500]');
        $this->form_validation->set_rules('summary', trans("summary"), 'xss_clean|max_length[1000]');
        $this->form_validation->set_rules('category_id', trans("category"), 'required');
        $this->form_validation->set_rules('optional_url', trans("optional_url"), 'xss_clean|max_length[1000]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->post_admin_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //post id
            $post_id = $this->input->post('id', true);

            if ($this->post_admin_model->update_post($post_id)) {
                //update slug
                $this->post_admin_model->update_slug($post_id);

                //update post tags
                $this->tag_model->update_post_tags($post_id);

                $this->session->set_flashdata('success', trans("post") . " " . trans("msg_suc_updated"));

                $referrer = $this->input->post("referrer");
                if (!empty($referrer)) {
                    redirect($referrer);
                } else {
                    redirect('admin_post/posts');
                }

            } else {
                $this->session->set_flashdata('form_data', $this->post_admin_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Upload Audio
     */
    public function upload_audio()
    {
        $post_id = $this->input->post('post_id', true);
        $this->audio_model->upload_audio($post_id);

        $data["post"] = $this->post_admin_model->get_post($post_id);

        $this->load->view('admin/includes/_audio_edit_box', $data);
    }


    /**
     * Upload Audio to Session
     */
    public function upload_audio_session()
    {
        $this->audio_model->upload_audio_session();
        $this->load->view('admin/includes/_audio_upload_box');
    }


    /**
     * Delete Audio from Session
     */
    public function delete_audio_session()
    {
        $path = $this->input->post('audio_path', true);

        $this->audio_model->delete_audio_session($path);
        $this->load->view('admin/includes/_audio_upload_box');
    }


    /**
     * Delete Audio
     */
    public function delete_audio()
    {
        $id = $this->input->post('id', true);
        $post_id = 0;

        $audio = $this->audio_model->get_audio($id);

        if (!empty($audio)) {
            $post_id = $audio->post_id;
            $this->audio_model->delete_audio($id);
        }

        $data["post"] = $this->post_admin_model->get_post($post_id);

        $this->load->view('admin/includes/_audio_edit_box', $data);
    }

}
