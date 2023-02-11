<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rss_model extends CI_Model
{
    //input values
    public function input_values()
    {
        $data = array(
            'feed_name' => $this->input->post('feed_name', true),
            'feed_url' => $this->input->post('feed_url', true),
            'post_limit' => $this->input->post('post_limit', true),
            'category_id' => $this->input->post('category_id', true),
            'subcategory_id' => $this->input->post('subcategory_id', true),
            'auto_update' => $this->input->post('auto_update', true),
            'read_more_button' => $this->input->post('read_more_button', true),
            'read_more_button_text' => $this->input->post('read_more_button_text', true)
        );
        return $data;
    }

    //add feed
    public function add_feed()
    {
        $data = $this->input_values();

        $file = $_FILES['file'];
        if (!empty($file['name'])) {
            $data["image_big"] = $this->upload_model->post_big_image_upload($file);
            $data["image_default"] = $this->upload_model->post_default_image_upload($file);
            $data["image_slider"] = $this->upload_model->post_slider_image_upload($file);
            $data["image_mid"] = $this->upload_model->post_mid_image_upload($file);
            $data["image_small"] = $this->upload_model->post_small_image_upload($file);
        }

        $data["user_id"] = user()->id;

        return $this->db->insert('rss_feeds', $data);
    }

    //update feed
    public function update_feed($id)
    {
        $feed = $this->get_feed($id);

        if (!empty($feed)) {
            $data = $this->input_values();

            $file = $_FILES['file'];
            if (!empty($file['name'])) {
                $data["image_big"] = $this->upload_model->post_big_image_upload($file);
                $data["image_default"] = $this->upload_model->post_default_image_upload($file);
                $data["image_slider"] = $this->upload_model->post_slider_image_upload($file);
                $data["image_mid"] = $this->upload_model->post_mid_image_upload($file);
                $data["image_small"] = $this->upload_model->post_small_image_upload($file);
            }

            $this->db->where('id', $id);
            return $this->db->update('rss_feeds', $data);
        } else {
            return false;
        }
    }

    //add feed posts
    public function add_feed_posts($feed_id)
    {
        $feed = $this->get_feed($feed_id);

        if (!empty($feed)) {
            $this->add_rss_feed_posts($feed);
        }
    }

    //add rss feed posts
    public function add_rss_feed_posts($feed)
    {
        if (!empty($feed)) {
            $rss = $this->feed->loadRss($feed->feed_url);

            $i = 0;
            foreach ($rss->item as $item) {

                if ($feed->post_limit == $i) {
                    break;
                }

                if ($this->post_admin_model->check_is_post_exists($item->title) == false) {
                    $data = array(
                        'title' => $item->title,
                        'title_slug' => str_slug(trim($item->title)),
                        'summary' => $item->description,
                        'content' => $item->description,
                        'category_id' => $feed->category_id,
                        'subcategory_id' => $feed->subcategory_id,
                        'image_big' => $feed->image_big,
                        'image_default' => $feed->image_default,
                        'image_slider' => $feed->image_slider,
                        'image_mid' => $feed->image_mid,
                        'image_small' => $feed->image_small,
                        'need_auth' => 0,
                        'is_slider' => 0,
                        'is_featured' => 0,
                        'is_recommended' => 0,
                        'is_breaking' => 0,
                        'visibility' => 1,
                        'post_type' => "post",
                        'user_id' => $feed->user_id,
                        'status' => 1,
                        'feed_id' => $feed->id,
                        'post_url' => $item->link,
                    );

                    $this->db->insert('posts', $data);
                    $this->post_admin_model->update_slug($this->db->insert_id());
                }

                $i++;
            }
        }
    }

    //get feed
    public function get_feed($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('rss_feeds');
        return $query->row();
    }

    //get feeds
    public function get_feeds()
    {
        $query = $this->db->get('rss_feeds');
        return $query->result();
    }

    //get feed posts
    public function get_feed_posts($feed_id)
    {
        $this->db->where('feed_id', $feed_id);
        $query = $this->db->get('feed_posts');
        return $query->result();
    }


    //delete feed
    public function delete_feed($id)
    {
        $feed = $this->get_feed($id);

        if (!empty($feed)) {
            $this->db->where('id', $id);
            return $this->db->delete('rss_feeds');
        } else {
            return false;
        }
    }

}