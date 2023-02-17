<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rss extends Home_Core_Controller
{
    public function __construct()
    {
        parent::__construct();

        //load the library
        $this->load->helper('xml');

    }

    /**
     * Rss All Posts
     */
    public function rss_all_posts()
    {
        if ($this->settings->show_rss == 1):
            $data['feed_name'] = $this->settings->site_title . " - " . trans("all_posts");
            $data['encoding'] = 'utf-8';
            $data['feed_url'] = base_url() . "rss/posts";
            $data['page_description'] =$this->settings->site_title . " - " . trans("all_posts");
            $data['page_language'] = $this->get_lang();
            $data['creator_email'] = '';
            $data['posts'] = $this->post_model->get_posts();
            header("Content-Type: application/rss+xml; charset=utf-8");

            $this->load->view('rss', $data);
        endif;
    }


    /**
     * Rss By Category
     */
    public function rss_by_category($slug)
    {
        if ($this->settings->show_rss == 1):
            $slug = $this->security->xss_clean($slug);
            $category = $this->category_model->get_category_by_slug($slug);

            $category_id = $category->id;

            $data['category'] = $this->category_model->get_category($category_id);
            if (empty($data['category'])) {
                redirect(base_url());
            }

            $data['feed_name'] = $this->settings->site_title . " - " . trans("title_category") . ": " . $data['category']->name;
            $data['encoding'] = 'utf-8';
            $data['feed_url'] = base_url() . "rss/category/" . $data['category']->name_slug;
            $data['page_description'] = $this->settings->site_title . " - " . trans("title_category") . ": " . $data['category']->name;
            $data['page_language'] = $this->get_lang();
            $data['creator_email'] = '';
            $data['posts'] = $this->post_model->get_posts_by_category($data['category']->id);
            header("Content-Type: application/rss+xml; charset=utf-8");

            $this->load->view('rss', $data);
        endif;
    }


    public function get_lang()
    {
        $lang = $this->settings->site_lang;

        if ($lang == "english") {
            return "en";
        }
        if ($lang == "french") {
            return "fr";
        }
        if ($lang == "german") {
            return "dt";
        }
        if ($lang == "italian") {
            return "it";
        }
        if ($lang == "portuguese") {
            return "pt";
        }
        if ($lang == "russian") {
            return "ru";
        }
        if ($lang == "spanish") {
            return "sp";
        }
        if ($lang == "turkish") {
            return "tr";
        }

    }
}