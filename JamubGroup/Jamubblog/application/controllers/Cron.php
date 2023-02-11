<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends Admin_Core_Controller
{

    public function __construct()
    {
        parent::__construct();

        //load the library
        $this->load->library('feed');
    }


    /**
     * Get Feed Posts
     */
    public function check_feed_posts()
    {
        $feeds = $this->rss_model->get_feeds();

        foreach ($feeds as $feed) {

            if (!empty($feed->feed_url) && $feed->auto_update == 1) {
                $this->rss_model->add_rss_feed_posts($feed);
            }

        }

    }
}