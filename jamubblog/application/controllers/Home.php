<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Home_Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('bcrypt');
        $this->post_load_more_count = 6;

    }


    /**
     * Index Page
     */
    public function index()
    {
        $page = $this->page_model->get_page("index");

        $data['title'] = $this->settings->home_title;
        $data['description'] = get_page_description($page);
        $data['keywords'] = get_page_keywords($page);

        $data['page'] = $page;

        $data['categories'] = $this->category_model->get_categories();

        $data['featured_posts'] = $this->post_model->get_featured_posts();
        $data['slider_posts'] = $this->post_model->get_slider_posts();

        $data['last_posts'] = $this->post_model->get_last_posts($this->post_load_more_count, 0);
        $data['total_posts_count'] = $this->post_model->get_post_count();
        $this->session->set_userdata("vr_last_posts_limit", $this->post_load_more_count);

        $data['news_ticker_posts'] = $this->post_model->get_breaking_news();

        $this->load->view('partials/_header', $data);
        $this->load->view('index', $data);
        $this->load->view('partials/_footer');
    }


    /**
     * Posts Page
     */
    public function posts()
    {
        $page = $this->page_model->get_page("posts");

        $data['title'] = get_page_title($page);
        $data['description'] = get_page_description($page);
        $data['keywords'] = get_page_keywords($page);
        $data['page'] = $page;

        //check page auth
        $this->checkPageAuth($data['page']);

        if ($data['page']->visibility == 0) {
            $this->error_404();
        } else {
            //initialize pagination
            $page = $this->security->xss_clean($this->input->get('page'));
            if (empty($page)) {
                $page = 0;
            }

            if ($page != 0) {
                $page = $page - 1;
            }

            $config['base_url'] = base_url() . '/posts';
            $config['total_rows'] = $this->post_model->get_post_count();
            $config['per_page'] = $this->settings->pagination_per_page;
            $this->pagination->initialize($config);

            //get posts
            $data['posts'] = $this->post_model->get_paginated_all_posts($config['per_page'], $page * $config['per_page']);


            $this->load->view('partials/_header', $data);
            $this->load->view('posts', $data);
            $this->load->view('partials/_footer');
        }
    }


    /**
     * Post Page
     */
    public function post($slug)
    {
        $slug = $this->security->xss_clean($slug);

        $data['post'] = $this->post_model->get_post($slug);

        //check if post exists
        if (empty($data['post'])) {
            redirect(base_url());
        }

        $id = $data['post']->id;

        if (!auth_check() && $data['post']->need_auth == 1) {
            $this->session->set_flashdata('error', trans("message_post_auth"));
            redirect(base_url() . 'login');
        }

        $data["category"] = $this->category_model->get_category($data['post']->category_id);
        $data["subcategory"] = $this->category_model->get_category($data['post']->subcategory_id);
        $data['post_tags'] = $this->tag_model->get_post_tags($id);
        $data['post_image_count'] = $this->post_image_model->get_post_image_count($id);
        $data['post_images'] = $this->post_image_model->get_post_images($id);
        $data['post_user'] = $this->auth_model->get_user($data['post']->user_id);
        $data['comments'] = $this->comment_model->get_comments($id, 5);
        $data['vr_comment_limit'] = 5;

        $data['related_posts'] = $this->post_model->get_related_posts($data['post']->category_id, $id);
        $data['previous_post'] = $this->post_model->get_previous_post($id);
        $data['next_post'] = $this->post_model->get_next_post($id);

        $data['is_reading_list'] = $this->reading_list_model->is_post_in_reading_list($id);

        $data['post_type'] = $data['post']->post_type;

        if (!empty($data['post']->feed_id)) {
            $data['feed'] = $this->rss_model->get_feed($data['post']->feed_id);
        }

        $data['title'] = $data['post']->title;
        $data['description'] = $data['post']->summary;
        $data['keywords'] = $data['post']->keywords;

        $data['og_title'] = $data['post']->title;
        $data['og_description'] = $data['post']->summary;
        $data['og_type'] = "article";
        $data['og_url'] = base_url() . "post/" . $data['post']->title_slug;
        $data['og_image'] = base_url() . $data['post']->image_default;
        $data['og_width'] = "750";
        $data['og_height'] = "500";
        $data['og_creator'] = $data['post_user']->username;
        $data['og_author'] = $data['post_user']->username;
        $data['og_published_time'] = $data['post']->created_at;
        $data['og_modified_time'] = $data['post']->created_at;
        $data['og_tags'] = $data['post_tags'];


        $this->load->view('partials/_header', $data);
        $this->load->view('post', $data);
        $this->load->view('partials/_footer', $data);

        //increase post hit
        $this->load->helper('cookie');
        $this->post_model->increase_post_hit($id);

    }


    /**
     * Gallery Page
     */
    public function gallery()
    {
        $data['page'] = $this->page_model->get_page('gallery');

        //check page exists
        $this->is_page_exists($data['page']);

        //check page auth
        $this->checkPageAuth($data['page']);

        if ($data['page']->visibility == 0) {
            $this->error_404();
        } else {

            $data['title'] = get_page_title($data['page']);
            $data['description'] = get_page_description($data['page']);
            $data['keywords'] = get_page_keywords($data['page']);

            //get gallery categories
            $data['gallery_categories'] = $this->gallery_category_model->get_categories();
            //get gallery images
            $data['gallery_images'] = $this->gallery_model->get_images();

            $this->load->view('partials/_header', $data);
            $this->load->view('gallery', $data);
            $this->load->view('partials/_footer');
        }

    }


    /**
     * Category Page
     */
    public function category($slug)
    {
        $slug = $this->security->xss_clean($slug);

        $data['category'] = $this->category_model->get_category_by_slug($slug);

        //check category exists
        if (empty($data['category'])) {
            redirect(base_url());
        }

        $category_id = $data['category']->id;
        $data['title'] = $data['category']->name;
        $data['description'] = $data['category']->description;
        $data['keywords'] = $data['category']->keywords;

        //category type
        $data['category_type'] = "";
        if ($data['category']->parent_id == 0) {
            $data['category_type'] = "parent";
        } else {
            $data['category_type'] = "sub";
        }

        //initialize pagination
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }

        if ($page != 0) {
            $page = $page - 1;
        }

        $config['base_url'] = base_url() . '/category/' . $slug;
        $config['total_rows'] = $this->post_model->get_post_count_by_category($data['category_type'], $category_id);
        $config['per_page'] = $this->settings->pagination_per_page;
        $this->pagination->initialize($config);

        //get posts
        $data['posts'] = $this->post_model->get_paginated_category_posts($data['category_type'], $category_id, $config['per_page'], $page * $config['per_page']);

        $this->load->view('partials/_header', $data);
        $this->load->view('category', $data);
        $this->load->view('partials/_footer');
    }


    /**
     * Profile Page
     */
    public function profile($slug)
    {
        $slug = $this->security->xss_clean($slug);

        $data['author'] = $this->auth_model->get_user_by_slug($slug);

        //check author exists
        if (empty($data['author'])) {
            redirect(base_url());
        }

        if ($data['author']->role == "user") {
            redirect(base_url());
        }

        $data['title'] = $data['author']->username;
        $data['description'] = trans("title_author") . ': ' . $data['author']->username;
        $data['keywords'] = trans("title_author") . ', ' . $data['author']->username;


        //initialize pagination
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }

        if ($page != 0) {
            $page = $page - 1;
        }

        $config['base_url'] = base_url() . '/profile/' . $slug;
        $config['total_rows'] = $this->post_model->get_post_count_by_user($data['author']->id);
        $config['per_page'] = $this->settings->pagination_per_page;
        $this->pagination->initialize($config);

        //get posts
        $data['posts'] = $this->post_model->get_paginated_user_posts($data['author']->id, $config['per_page'], $page * $config['per_page']);

        $this->load->view('partials/_header', $data);
        $this->load->view('profile', $data);
        $this->load->view('partials/_footer');
    }


    /**
     * Tag Page
     */
    public function tag($tag_slug)
    {
        $tag_slug = $this->security->xss_clean($tag_slug);

        $data['tag'] = $this->tag_model->get_tag($tag_slug);

        //check tag exists
        if (empty($data['tag'])) {
            redirect(base_url());
        }

        $data['title'] = $data['tag']->tag;
        $data['description'] = trans("title_tag") . ': ' . $data['tag']->tag;
        $data['keywords'] = trans("title_tag") . ', ' . $data['tag']->tag;

        //initialize pagination
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }

        if ($page != 0) {
            $page = $page - 1;
        }

        $config['base_url'] = base_url() . '/tag/' . $tag_slug;
        $config['total_rows'] = $this->post_model->get_post_count_by_tag($tag_slug);
        $config['per_page'] = $this->settings->pagination_per_page;
        $this->pagination->initialize($config);

        //get posts
        $data['posts'] = $this->post_model->get_paginated_tag_posts($tag_slug, $config['per_page'], $page * $config['per_page']);

        $this->load->view('partials/_header', $data);
        $this->load->view('tag', $data);
        $this->load->view('partials/_footer');
    }


    /**
     * Rss Page
     */
    public function rss_channels()
    {
        $data['page'] = $this->page_model->get_page('rss-channels');

        //check page exists
        $this->is_page_exists($data['page']);

        //check page auth
        $this->checkPageAuth($data['page']);

        if ($this->settings->show_rss == 0 || $data['page']->visibility == 0) {
            $this->error_404();
        } else {

            $data['title'] = get_page_title($data['page']);
            $data['description'] = get_page_description($data['page']);
            $data['keywords'] = get_page_keywords($data['page']);

            $this->load->view('partials/_header', $data);
            $this->load->view('rss_channels', $data);
            $this->load->view('partials/_footer');

        }
    }


    /**
     * Dynamic Page by Name Slug
     */
    public function page($slug)
    {
        $slug = $this->security->xss_clean($slug);

        //index page
        if (empty($slug)) {
            redirect(base_url());
        }

        $data['page'] = $this->page_model->get_page($slug);

        //if not exists
        if (empty($data['page']) || $data['page'] == null) {
            $this->error_404();
        } //check if page disable
        else if ($data['page']->visibility == 0) {
            $this->error_404();
        } else {

            //check page auth
            $this->checkPageAuth($data['page']);

            $data['title'] = $data['page']->title;
            $data['description'] = $data['page']->description;
            $data['keywords'] = $data['page']->keywords;

            $this->load->view('partials/_header', $data);
            $this->load->view('page', $data);
            $this->load->view('partials/_footer');

        }
    }


    /**
     * Contact Page
     */
    public function contact()
    {
        $data['page'] = $this->page_model->get_page('contact');

        //check page auth
        $this->checkPageAuth($data['page']);

        if ($data['page']->visibility == 0) {
            $this->error_404();
        } else {

            $data['title'] = get_page_title($data['page']);
            $data['description'] = get_page_description($data['page']);
            $data['keywords'] = get_page_keywords($data['page']);

            $this->load->view('partials/_header', $data);
            $this->load->view('contact', $data);
            $this->load->view('partials/_footer');
        }

    }


    /**
     * Contact Page Post
     */
    public function contact_post()
    {
        //validate inputs
        $this->form_validation->set_rules('name', trans("placeholder_name"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('email', trans("placeholder_email"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('message', trans("placeholder_message"), 'required|xss_clean|max_length[5000]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->contact_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->contact_model->add_contact_message()) {
                $this->session->set_flashdata('success', trans("message_contact_success"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->contact_model->input_values());
                $this->session->set_flashdata('error', trans("message_contact_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Search Page
     */
    public function search()
    {
        $q = trim($this->input->get('q', TRUE));

        $data['q'] = $q;
        $data['title'] = trans("title_search") . ': ' . $q;
        $data['description'] = trans("title_search") . ': ' . $q;
        $data['keywords'] = trans("title_search") . ', ' . $q;

        //initialize pagination
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }

        if ($page != 0) {
            $page = $page - 1;
        }
        $data['post_count'] = $this->post_model->get_search_post_count($q);

        $config['base_url'] = base_url() . '/search?q=' . $q;
        $config['total_rows'] = $data['post_count'];
        $config['per_page'] = $this->settings->pagination_per_page;
        $this->pagination->initialize($config);

        //get posts
        $data['posts'] = $this->post_model->get_paginated_search_posts($q, $config['per_page'], $page * $config['per_page']);

        $this->load->view('partials/_header', $data);
        $this->load->view('search', $data);
        $this->load->view('partials/_footer');
    }


    /**
     * Add Comment
     */
    public function add_comment_post()
    {
        //input values
        $data = $this->comment_model->input_values();

        if ($data['post_id'] && $data['user_id'] && trim($data['comment'])) {
            $this->comment_model->add_comment();
        }

        $limit = $this->input->post('limit', true);

        $data["comment_post_id"] = $data['post_id'];
        $data["vr_comment_limit"] = $limit;

        $data['comments'] = $this->comment_model->get_comments($data['post_id'], $limit);
        $this->load->view('partials/_comments', $data);
    }


    /**
     * Delete Comment
     */
    public function delete_comment_post()
    {
        $id = $this->input->post('id', true);

        $comment = $this->comment_model->get_comment($id);
        $post_id = 0;
        //if comment exists
        if (!empty($comment)) {
            $post_id = $comment->post_id;
            $this->comment_model->delete_comment($id);
        }

        $limit = $this->input->post('limit', true);

        $data["comment_post_id"] = $post_id;
        $data["vr_comment_limit"] = $limit;

        $data['comments'] = $this->comment_model->get_comments($post_id, $limit);
        $data['comment_count'] = $this->comment_model->get_post_comment_count($post_id);
        $this->load->view('partials/_comments', $data);
    }


    /**
     * Like Comment
     */
    public function like_comment_post()
    {
        $id = $this->input->post('id', true);

        $comment = $this->comment_model->get_comment($id);

        //if comment exists
        if (!empty($comment)) {
            $this->comment_model->like_comment($comment);

            $limit = $this->input->post('limit', true);

            $data["comment_post_id"] = $comment->post_id;
            $data["vr_comment_limit"] = $limit;

            $data['comments'] = $this->comment_model->get_comments($comment->post_id, $limit);
            $data['comment_count'] = $this->comment_model->get_post_comment_count($comment->post_id);
            $this->load->view('partials/_comments', $data);
        }
    }


    /**
     * Load More Comments
     */
    public function load_more_comments()
    {
        //input values
        $id = $this->input->post('post_id', true);
        $limit = $this->input->post('limit', true);

        $limit = $limit + 5;
        $data["comment_post_id"] = $id;
        $data["vr_comment_limit"] = $limit;

        $data['comments'] = $this->comment_model->get_comments($id, $limit);

        $this->load->view('partials/_comments', $data);
    }


    /**
     * Add Poll Vote
     */
    public function add_vote()
    {
        $poll_id = $this->input->post('poll_id', true);
        $vote_permission = $this->input->post('vote_permission', true);
        $option = $this->input->post('option', true);

        if ($vote_permission == "all") {
            $result = $this->poll_model->add_unregistered_vote($poll_id, $option);
            if ($result == "success") {
                $data["poll"] = $this->poll_model->get_poll($poll_id);
                $this->load->view('partials/_poll_results', $data);
            } else {
                echo "voted";
            }
        } else {
            $user_id = user()->id;
            $result = $this->poll_model->add_registered_vote($poll_id, $user_id, $option);
            if ($result == "success") {
                $data["poll"] = $this->poll_model->get_poll($poll_id);
                $this->load->view('partials/_poll_results', $data);
            } else {
                echo "voted";
            }
        }

    }


    /**
     * Add to Newsletter
     */
    public function add_to_newsletter()
    {
        //input values
        $email = $this->input->post('email', true);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->session->set_flashdata('news_error', trans("message_invalid_email"));
        } else {
            if ($email) {
                //check if email exists
                if (empty($this->newsletter_model->get_newsletter($email))) {
                    //addd
                    if ($this->newsletter_model->add_to_newsletter($email)) {
                        $this->session->set_flashdata('news_success', trans("message_newsletter_success"));
                    }
                } else {
                    $this->session->set_flashdata('news_error', trans("message_newsletter_error"));
                }
            }

        }

        redirect($this->agent->referrer() . "#newsletter");
    }


    /**
     * Reading List Page
     */
    public function reading_list()
    {
        $data['page'] = $this->page_model->get_page('reading-list');

        $data['title'] = get_page_title($data['page']);
        $data['description'] = get_page_description($data['page']);
        $data['keywords'] = get_page_keywords($data['page']);

        //initialize pagination
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }

        if ($page != 0) {
            $page = $page - 1;
        }
        $data['post_count'] = $this->reading_list_model->get_reading_list_count();

        $config['base_url'] = base_url() . '/reading-list';
        $config['total_rows'] = $data['post_count'];
        $config['per_page'] = 6;
        $this->pagination->initialize($config);

        //get posts
        $data['posts'] = $this->reading_list_model->get_paginated_reading_list($config['per_page'], $page * $config['per_page']);

        $this->load->view('partials/_header', $data);
        $this->load->view('reading_list', $data);
        $this->load->view('partials/_footer');
    }


    /**
     * Load More Posts
     */
    public function load_more_posts()
    {
        $skip = $this->session->userdata("vr_last_posts_limit");

        $data['last_posts'] = $this->post_model->get_last_posts($this->post_load_more_count, $skip);
        $this->session->set_userdata("vr_last_posts_limit", $skip + $this->post_load_more_count);

        $data['total_posts_count'] = $this->post_model->get_post_count();

        $this->load->view('partials/_index_latest_posts', $data);
    }


    /**
     * Add or Delete Reading List
     */
    public function add_delete_reading_list_post()
    {
        $post_id = $this->input->post('post_id');

        if (empty($post_id)) {
            redirect($this->agent->referrer());
        }

        $is_post_in_reading_list = $this->reading_list_model->is_post_in_reading_list($post_id);

        //delete from list
        if ($is_post_in_reading_list == true) {
            $this->reading_list_model->delete_from_reading_list($post_id);
        } else {
            //add to list
            $this->reading_list_model->add_to_reading_list($post_id);
        }

        redirect($this->agent->referrer());
    }


    /**
     * Download Audio
     */
    public function download_audio()
    {
        $this->load->helper('download');

        $id = $this->input->post('id', true);
        $audio = $this->audio_model->get_audio($id);
        force_download(FCPATH . $audio->audio_path, NULL);
    }


    public function is_page_exists($page)
    {
        if (empty($page)) {
            redirect(base_url());
        }
    }


    public function checkPageAuth($page)
    {
        if (!auth_check() && $page->need_auth == 1) {
            $this->session->set_flashdata('error', trans("message_page_auth"));
            redirect(base_url() . 'login');
        }
    }

    public function error_404()
    {
        $data['title'] = "Error 404";
        $data['description'] = "Error 404";
        $data['keywords'] = "error,404";

        $this->load->view('partials/_header', $data);
        $this->load->view('errors/error_404');
        $this->load->view('partials/_footer');
    }


}
