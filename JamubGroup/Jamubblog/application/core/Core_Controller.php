<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Core_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $global_data['settings'] = $this->settings_model->get_settings();
        $global_data['vsettings'] = $this->visual_settings_model->get_settings();
        $this->settings = $global_data['settings'];

        //set language
        $this->config->set_item('language', $global_data['settings']->site_lang);

        //get site primary font
        $this->config->load('fonts');
        $global_data['primary_font'] = $this->settings->primary_font;
        $global_data['primary_font_family'] = $this->config->item($global_data['primary_font'] . '_font_family');
        $global_data['primary_font_url'] = $this->config->item($global_data['primary_font'] . '_font_url');

        //get site secondary font
        $global_data['secondary_font'] = $this->settings->secondary_font;
        $global_data['secondary_font_family'] = $this->config->item($global_data['secondary_font'] . '_font_family');
        $global_data['secondary_font_url'] = $this->config->item($global_data['secondary_font'] . '_font_url');

        //get site tertiary font
        $global_data['tertiary_font'] = $this->settings->tertiary_font;
        $global_data['tertiary_font_family'] = $this->config->item($global_data['tertiary_font'] . '_font_family');
        $global_data['tertiary_font_url'] = $this->config->item($global_data['tertiary_font'] . '_font_url');

        $this->load->vars($global_data);
    }

}

class Home_Core_Controller extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        //set language
        $this->lang->load("front_end", $this->settings->site_lang);

        //check remember me
        if (!auth_check()) {
            $user_id = get_cookie('varient_user_id');
            if (!empty($user_id)) {
                $user = $this->auth_model->get_user($user_id);
                if (!empty($user)) {
                    $this->auth_model->login_direct($user);
                }
            }
        }

        //main menu
        $global_data['main_menu'] = $this->navigation_model->get_menu_links();
        $global_data['ads'] = $this->ad_model->get_ads();
        $global_data['categories'] = $this->category_model->get_categories();
        $global_data['popular_posts'] = $this->post_model->get_popular_posts(5);
        $global_data['recommended_posts'] = $this->post_model->get_recommended_posts();
        $global_data['random_posts'] = $this->post_model->get_random_posts(5);
        $global_data['widgets'] = $this->widget_model->get_widgets();
        $global_data['tags'] = $this->tag_model->get_random_tags();
        $global_data['footer_random_posts'] = $this->post_model->get_footer_random_posts();
        $global_data['pages'] = $this->page_model->get_pages();
        $global_data['polls'] = $this->poll_model->get_polls();

        //Social Login
        $this->config->set_item('facebook_app_id', $this->settings->facebook_app_id);
        $this->config->set_item('facebook_app_secret', $this->settings->facebook_app_secret);

        $global_data['fb_login_state'] = 0;
        $global_data['google_login_state'] = 0;

        if (!empty($this->settings->facebook_app_id) && !empty($this->settings->facebook_app_secret)) {
            $global_data['facebook_login_url'] = $this->facebook->login_url();
            $global_data['fb_login_state'] = 1;
        }
        if (!empty($this->settings->google_client_id) && !empty($this->settings->google_client_secret)) {
            $global_data['google_plus_login_url'] = $this->googleplus->loginURL();
            $global_data['google_login_state'] = 1;
        }

        //bg images
        $global_data["img_bg_mid"] = base_url() . "assets/img/img_bg_mid.jpg";
        $global_data["img_bg_sm"] = base_url() . "assets/img/img_bg_sm.jpg";

        $this->load->vars($global_data);
    }
}

class Admin_Core_Controller extends Core_Controller
{

    public function __construct()
    {
        parent::__construct();

        //set language
        $this->lang->load("back_end", $this->settings->site_lang);

    }

    public function paginate($url, $total_rows)
    {
        //initialize pagination
        $page = $this->security->xss_clean($this->input->get('page'));
        $per_page = $this->input->get('show', true);
        if (empty($page)) {
            $page = 0;
        }

        if ($page != 0) {
            $page = $page - 1;
        }

        if (empty($per_page)) {
            $per_page = 15;
        }

        $config['num_links'] = 4;
        $config['base_url'] = $url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['reuse_query_string'] = true;
        $this->pagination->initialize($config);

        return array('per_page' => $per_page, 'offset' => $page * $per_page);
    }
}

