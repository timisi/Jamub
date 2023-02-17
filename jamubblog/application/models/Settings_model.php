<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model
{
    //input values
    public function input_values()
    {
        $data = array(
            'application_name' => $this->input->post('application_name', true),
            'site_lang' => $this->input->post('site_lang', true),
            'pagination_per_page' => $this->input->post('pagination_per_page', true),
            'facebook_url' => $this->input->post('facebook_url', true),
            'twitter_url' => $this->input->post('twitter_url', true),
            'google_url' => $this->input->post('google_url', true),
            'instagram_url' => $this->input->post('instagram_url', true),
            'pinterest_url' => $this->input->post('pinterest_url', true),
            'linkedin_url' => $this->input->post('linkedin_url', true),
            'vk_url' => $this->input->post('vk_url', true),
            'youtube_url' => $this->input->post('youtube_url', true),
            'optional_url_button_name' => $this->input->post('optional_url_button_name', true),
            'about_footer' => $this->input->post('about_footer', true),
            'copyright' => $this->input->post('copyright', true),
            'contact_text' => $this->input->post('contact_text', false),
            'contact_address' => $this->input->post('contact_address', true),
            'contact_email' => $this->input->post('contact_email', true),
            'contact_phone' => $this->input->post('contact_phone', true),
            'map_api_key' => $this->input->post('map_api_key', true),
            'latitude' => $this->input->post('latitude', true),
            'longitude' => $this->input->post('longitude', true),
            'mail_protocol' => $this->input->post('mail_protocol', true),
            'mail_host' => $this->input->post('mail_host', true),
            'mail_port' => $this->input->post('mail_port', true),
            'mail_username' => $this->input->post('mail_username', true),
            'mail_password' => $this->input->post('mail_password', true),
            'mail_title' => $this->input->post('mail_title', true),
            'facebook_comment' => $this->input->post('facebook_comment', false),
            'head_code' => $this->input->post('head_code', false)
        );
        return $data;
    }

    public function preferences_input_values()
    {
        $data = array(
            'registration_system' => $this->input->post('registration_system', true),
            'comment_system' => $this->input->post('comment_system', true),
            'facebook_comment_active' => $this->input->post('facebook_comment_active', true),
            'show_rss' => $this->input->post('show_rss', true),
            'show_featured_section' => $this->input->post('show_featured_section', true),
            'show_latest_posts' => $this->input->post('show_latest_posts', true),
            'show_newsticker' => $this->input->post('show_newsticker', true),
            'show_post_author' => $this->input->post('show_post_author', true),
            'show_post_date' => $this->input->post('show_post_date', true),
            'show_hits' => $this->input->post('show_hits', true),
        );
        return $data;
    }

    //get settings
    public function get_settings()
    {
        $query = $this->db->get_where('settings', array('id' => 1));
        return $query->row();
    }

    //update preferences
    public function update_preferences()
    {
        $data = $this->settings_model->preferences_input_values();
        $this->db->where('id', 1);
        return $this->db->update('settings', $data);
    }

    //update settings
    public function update_settings()
    {
        $data = $this->settings_model->input_values();
        $this->db->where('id', 1);
        return $this->db->update('settings', $data);
    }

    //update social settings
    public function update_social_settings()
    {
        $data = array(
            'facebook_app_id' => $this->input->post('facebook_app_id', true),
            'facebook_app_secret' => $this->input->post('facebook_app_secret', true),
            'google_app_name' => $this->input->post('google_app_name', true),
            'google_client_id' => $this->input->post('google_client_id', true),
            'google_client_secret' => $this->input->post('google_client_secret', true),
        );

        //update
        $this->db->where('id', 1);
        return $this->db->update('settings', $data);
    }

}