<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seo_model extends CI_Model
{
    //input values
    public function input_values()
    {
        $data = array(
            'site_title' => $this->input->post('site_title', true),
            'home_title' => $this->input->post('home_title', true),
            'google_analytics' => $this->input->post('google_analytics', false),
        );
        return $data;
    }

    //update seo tools
    public function update()
    {
        $data = $this->input_values();

        $this->db->where('id', 1);
        return $this->db->update('settings', $data);
    }

    //update homepage
    public function update_homepage()
    {
        $page = $this->page_model->get_page('index');

        if (!empty($page)) {

            $data = array(
                'description' => $this->input->post('description', true),
                'keywords' => $this->input->post('keywords', true),
            );

            $this->db->where('id', $page->id);
            $this->db->update('pages', $data);
        }
    }
}