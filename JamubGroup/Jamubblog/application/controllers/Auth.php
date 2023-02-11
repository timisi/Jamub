<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Home_Core_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('bcrypt');

    }


    /**
     * Login
     */
    public function login()
    {
        $this->is_registration_active();

        //check if logged in
        if (auth_check()) {
            redirect(base_url());
        }

        $page = $this->page_model->get_page("login");

        //check if page exists
        if (empty($page)) {
            redirect(base_url());
        }

        $data['title'] = get_page_title($page);
        $data['description'] = get_page_description($page);
        $data['keywords'] = get_page_keywords($page);

        $this->load->view('partials/_header', $data);
        $this->load->view('auth/login');
        $this->load->view('partials/_footer');
    }


    /**
     * Login Post
     */
    public function login_post()
    {
        //check if logged in
        if (auth_check()) {
            redirect(base_url());
        }

        //validate inputs
        $this->form_validation->set_rules('email', trans("form_email"), 'required|xss_clean|max_length[100]');
        $this->form_validation->set_rules('password', trans("form_password"), 'required|xss_clean|max_length[30]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->auth_model->input_values());
            redirect($this->agent->referrer());
        } else {

            $result = $this->auth_model->login();

            if ($result == "banned") {
                //user banned
                $this->session->set_flashdata('form_data', $this->auth_model->input_values());
                $this->session->set_flashdata('error', trans("message_ban_error"));
                redirect($this->agent->referrer());
            } elseif ($result == "success") {

                if (auth_check()) {
                    $remember_me = $this->input->post('remember_me', true);
                    if ($remember_me == 1) {
                        $this->auth_model->remember_me(user()->id);
                    }
                }

                redirect(base_url());

            } else {
                //error
                $this->session->set_flashdata('form_data', $this->auth_model->input_values());
                $this->session->set_flashdata('error', trans("login_error"));
                redirect($this->agent->referrer());
            }

        }
    }

    /**
     * Admin Login
     */
    public function admin_login()
    {
        if (show_admin_panel()) {
            redirect("admin");
        }

        $page = $this->page_model->get_page("login");

        //check if page exists
        if (empty($page)) {
            redirect(base_url());
        }

        $data['title'] = get_page_title($page);
        $data['description'] = get_page_description($page);
        $data['keywords'] = get_page_keywords($page);


        $this->load->view('admin/login', $data);

    }


    /**
     * Admin Login Post
     */
    public function admin_login_post()
    {
        //validate inputs
        $this->form_validation->set_rules('email', trans("form_email"), 'required|xss_clean|max_length[100]');
        $this->form_validation->set_rules('password', trans("form_password"), 'required|xss_clean|max_length[30]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->auth_model->input_values());
            redirect($this->agent->referrer());
        } else {

            if ($this->auth_model->admin_login()) {
                redirect("admin");
            } else {
                //error
                $this->session->set_flashdata('form_data', $this->auth_model->input_values());
                $this->session->set_flashdata('error', trans("login_error"));
                redirect($this->agent->referrer());
            }

        }
    }


    /**
     * Login Ajax Post
     */
    public function login_ajax_post()
    {
        $this->reset_flash_data();

        //validate inputs
        $this->form_validation->set_rules('email', trans("form_email"), 'required|xss_clean|max_length[100]');
        $this->form_validation->set_rules('password', trans("form_password"), 'required|xss_clean|max_length[30]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->auth_model->input_values());
            $this->load->view('partials/_messages');
        } else {

            $result = $this->auth_model->login();

            if ($result == "banned") {
                //user banned
                $this->session->set_flashdata('error', trans("message_ban_error"));
                $this->load->view('partials/_messages');
                $this->reset_flash_data();
            } elseif ($result == "success") {
                //logged in
                echo $result;
                $this->reset_flash_data();
            } else {
                //error
                $this->session->set_flashdata('error', trans("login_error"));
                $this->load->view('partials/_messages');
                $this->reset_flash_data();
            }
        }
    }


    /**
     * Login with Facebook
     */
    public function login_with_facebook()
    {
        $this->is_registration_active();

        //check if logged in
        if (auth_check()) {
            redirect(base_url());
        }

        if ($this->facebook->logged_in()) {
            $user = $this->facebook->user();
            if (!empty($user["data"])) {
                $user_profile = $user["data"];
                if (!empty($user_profile['id']) && !empty($user_profile['email'])) {
                    $this->auth_model->login_with_facebook($user_profile);
                }
            }
        }

        redirect($this->agent->referrer());
    }


    /**
     * Login with Google
     */
    public function login_with_google()
    {
        $this->is_registration_active();

        //check if logged in
        if (auth_check()) {
            redirect(base_url());
        }

        $code = $this->input->get('code');

        if (!empty($code)) {
            $this->googleplus->getAuthenticate();
            $user_info = $this->googleplus->getUserInfo();

            if (!empty($user_info['id']) && !empty($user_info['email'])) {
                $this->auth_model->login_with_google($user_info);
            }
        }

        redirect($this->agent->referrer());
    }


    /**
     * Register
     */
    public function register()
    {
        $this->is_registration_active();

        //check if logged in
        if (auth_check()) {
            redirect(base_url());
        }

        $page = $this->page_model->get_page("register");

        //check if page exists
        if (empty($page)) {
            redirect(base_url());
        }

        $data['title'] = get_page_title($page);
        $data['description'] = get_page_description($page);
        $data['keywords'] = get_page_keywords($page);

        $this->load->view('partials/_header', $data);
        $this->load->view('auth/register');
        $this->load->view('partials/_footer');
    }


    /**
     * Register Post
     */
    public function register_post()
    {
        $this->reset_flash_data();

        //validate inputs
        $this->form_validation->set_rules('username', trans("form_username"), 'required|xss_clean|min_length[4]|max_length[100]');
        $this->form_validation->set_rules('email', trans("form_email"), 'required|xss_clean|max_length[200]|is_unique[users.email]');
        $this->form_validation->set_rules('password', trans("form_password"), 'required|xss_clean|min_length[4]|max_length[30]');
        $this->form_validation->set_rules('confirm_password', trans("form_confirm_password"), 'required|xss_clean|matches[password]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->auth_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //register
            $user = $this->auth_model->register();
            if ($user) {
                $this->auth_model->login_direct($user);
                redirect($this->agent->referrer());
            } else {
                //error
                $this->session->set_flashdata('form_data', $this->auth_model->input_values());
                $this->session->set_flashdata('error', trans("message_register_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Logout
     */
    public function logout()
    {
        $this->auth_model->logout();
        redirect($this->agent->referrer());
    }


    /**
     * Update Profile
     */
    public function update_profile()
    {
        //check if logged in
        if (!auth_check()) {
            redirect('login');
        }

        $page = $this->page_model->get_page("profile-update");
        //check if page exists
        if (empty($page)) {
            redirect(base_url());
        }

        $data['title'] = get_page_title($page);
        $data['description'] = get_page_description($page);
        $data['keywords'] = get_page_keywords($page);

        $data["user"] = user();

        $this->load->view('partials/_header', $data);
        $this->load->view('auth/update_profile');
        $this->load->view('partials/_footer');
    }


    /**
     * Update Profile Post
     */
    public function update_profile_post()
    {
        //check if logged in
        if (!auth_check()) {
            redirect('login');
        }

        $this->form_validation->set_rules('email', trans("form_email"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer());
        } else {
            $email = $this->input->post('email', true);
            //is email unique
            if (!$this->auth_model->is_unique_email($email, user()->id)) {
                $this->session->set_flashdata('error', trans("message_email_unique_error"));
                redirect($this->agent->referrer());
            }
            if ($this->auth_model->update_user(user()->id)) {
                $this->session->set_flashdata('success', trans("message_profile_success"));
            }
            redirect($this->agent->referrer());
        }
    }


    /**
     * Change Password
     */
    public function change_password()
    {
        //check if logged in
        if (!auth_check()) {
            redirect('login');
        }

        $page = $this->page_model->get_page("change-password");
        //check if page exists
        if (empty($page)) {
            redirect(base_url());
        }
        $data['title'] = get_page_title($page);
        $data['description'] = get_page_description($page);
        $data['keywords'] = get_page_keywords($page);

        $data["user"] = user();

        $this->load->view('partials/_header', $data);
        $this->load->view('auth/change_password');
        $this->load->view('partials/_footer');
    }


    /**
     * Change Password Post
     */
    public function change_password_post()
    {
        //check if logged in
        if (!auth_check()) {
            redirect('login');
        }

        $old_password_empty = $this->input->post('old_password_empty', true);

        if ($old_password_empty == 1) {
            $this->form_validation->set_rules('old_password', html_escape(trans("form_old_password")), 'required|xss_clean|max_length[50]');
        }

        $this->form_validation->set_rules('password', html_escape(trans("form_password")), 'required|xss_clean|min_length[4]|max_length[50]');
        $this->form_validation->set_rules('password_confirmation', html_escape(trans("form_confirm_password")), 'required|xss_clean|max_length[50]|matches[password]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->auth_model->change_password_input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->auth_model->change_password($old_password_empty)) {
                $this->session->set_flashdata('success', html_escape(trans("message_change_password_success")));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error', html_escape(trans("message_change_password_error")));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Reset Password
     */
    public function reset_password()
    {
        $this->is_registration_active();

        //check if logged in
        if (auth_check()) {
            redirect('login');
        }

        $page = $this->page_model->get_page("reset-password");
        //check if page exists
        if (empty($page)) {
            redirect(base_url());
        }
        $data['title'] = get_page_title($page);
        $data['description'] = get_page_description($page);
        $data['keywords'] = get_page_keywords($page);

        $this->load->view('partials/_header', $data);
        $this->load->view('auth/reset_password');
        $this->load->view('partials/_footer');
    }


    /**
     * Reset Password Post
     */
    public function reset_password_post()
    {
        $this->reset_flash_data();

        $email = $this->input->post('email', true);

        //get user
        $user = $this->auth_model->get_user_by_email($email);


        //if user not exists
        if (empty($user)) {
            $this->session->set_flashdata('error', html_escape(trans("reset_password_error")));
            redirect($this->agent->referrer());
        } else {
            //generate new password
            $new_password = $this->auth_model->reset_password($email);

            $subject = "Password Reset";
            $message = trans("email_reset_password") . " <strong>" . $new_password . "</strong>";

            //send email
            if ($this->email_model->send_email($email, $subject, $message)) {
                $this->session->set_flashdata('success', html_escape(trans("reset_password_success")));
                redirect($this->agent->referrer());
            }
        }
    }


    public function reset_flash_data()
    {
        $this->session->set_flashdata('errors', "");
        $this->session->set_flashdata('error', "");
        $this->session->set_flashdata('success', "");
    }


    public function is_registration_active()
    {
        if ($this->settings->registration_system != 1) {
            redirect(base_url());
        }
    }

}
