<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model
{

    public function set_filter_query()
    {
        $this->db->join('users', 'posts.user_id = users.id');
        $this->db->join('categories', 'posts.category_id = categories.id');
        $this->db->select('posts.*, categories.name as category_name, categories.color as category_color, users.username as username, users.slug as user_slug');
        $this->db->where('posts.created_at <= CURRENT_TIMESTAMP()');
        $this->db->where('posts.visibility', 1);
        $this->db->where('posts.status', 1);
    }

    //get post
    public function get_post($slug)
    {
        $this->set_filter_query();
        $this->db->where('posts.title_slug', $slug);
        $query = $this->db->get('posts');
        return $query->row();
    }

    //get posts
    public function get_posts()
    {
        $this->set_filter_query();
        $this->db->order_by('posts.created_at', 'DESC');
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get breaking news
    public function get_breaking_news()
    {
        $this->set_filter_query();
        $this->db->where('is_breaking', 1);
        $this->db->order_by('posts.created_at', 'DESC');
        $this->db->limit(20);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get slider posts
    public function get_slider_posts()
    {
        $this->set_filter_query();
        $this->db->where('is_slider', 1);
        $this->db->order_by('slider_order');
        $this->db->limit(20);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get featured posts
    public function get_featured_posts()
    {
        $this->set_filter_query();
        $this->db->where('is_featured', 1);
        $this->db->order_by('featured_order');
        $this->db->limit(4);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get last posts
    public function get_last_posts($limit, $skip)
    {
        $this->set_filter_query();
        $this->db->order_by('posts.created_at', 'DESC');
        $this->db->limit($limit, $skip);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get post count
    public function get_post_count()
    {
        $this->set_filter_query();
        $query = $this->db->get('posts');
        return $query->num_rows();
    }

    //get all posts
    public function get_paginated_all_posts($per_page, $offset)
    {
        $this->set_filter_query();
        $this->db->order_by('posts.created_at', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('posts');
        return $query->result();
    }


    //get popular posts
    public function get_popular_posts($limit)
    {
        $this->set_filter_query();
        $this->db->order_by('hit', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get recommended posts
    public function get_recommended_posts()
    {
        $this->set_filter_query();
        $this->db->where('is_recommended', 1);
        $this->db->order_by('posts.created_at', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get random posts
    public function get_random_posts($limit)
    {
        $this->set_filter_query();
        $this->db->where("posts.image_mid != ''");
        $this->db->order_by('rand()');
        $this->db->limit($limit);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get related posts
    public function get_related_posts($category_id, $post_id)
    {
        $this->set_filter_query();
        $this->db->where('posts.id !=', $post_id);
        $this->db->where('posts.category_id', $category_id);
        $this->db->order_by('rand()');
        $this->db->limit(4);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get posts by user
    public function get_paginated_user_posts($user_id, $per_page, $offset)
    {
        $this->set_filter_query();
        $this->db->where('posts.user_id', $user_id);
        $this->db->order_by('posts.created_at', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get post count by user
    public function get_post_count_by_user($user_id)
    {
        $this->set_filter_query();
        $this->db->where('posts.user_id', $user_id);
        $query = $this->db->get('posts');
        return $query->num_rows();
    }

    //get search posts
    public function get_paginated_search_posts($q, $per_page, $offset)
    {
        $this->set_filter_query();
        $this->db->like('posts.title', $q);
        $this->db->or_like('posts.content', $q);
        $this->db->or_like('posts.summary', $q);
        $this->db->order_by('posts.created_at', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get search post count
    public function get_search_post_count($q)
    {
        $this->set_filter_query();
        $this->db->like('posts.title', $q);
        $this->db->or_like('posts.content', $q);
        $this->db->or_like('posts.summary', $q);
        $query = $this->db->get('posts');
        return $query->num_rows();
    }

    //get posts by topcategory
    public function get_posts_by_category($category_id)
    {
        $this->set_filter_query();
        $this->db->where('category_id', $category_id);
        $this->db->order_by('posts.created_at', 'DESC');
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get last posts by topcategory
    public function get_last_posts_by_category($category_id, $count)
    {
        $this->set_filter_query();
        $this->db->where('category_id', $category_id);
        $this->db->order_by('posts.created_at', 'DESC');
        $this->db->limit($count);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get last posts by subcategory
    public function get_last_posts_by_subcategory($subcategory_id, $count)
    {
        $this->set_filter_query();
        $this->db->where('subcategory_id', $subcategory_id);
        $this->db->order_by('posts.created_at', 'DESC');
        $this->db->limit($count);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get paginated category posts
    public function get_paginated_category_posts($type, $category_id, $per_page, $offset)
    {
        if ($type == "parent") {
            $this->set_filter_query();
            $this->db->where('category_id', $category_id);
            $this->db->order_by('posts.created_at', 'DESC');
            $this->db->limit($per_page, $offset);
            $query = $this->db->get('posts');
            return $query->result();
        } else {
            $this->set_filter_query();
            $this->db->where('subcategory_id', $category_id);
            $this->db->order_by('posts.created_at', 'DESC');
            $this->db->limit($per_page, $offset);
            $query = $this->db->get('posts');
            return $query->result();
        }

    }

    //get post count by category
    public function get_post_count_by_category($type, $category_id)
    {
        if ($type == "parent") {
            $this->set_filter_query();
            $this->db->where('posts.category_id', $category_id);
            $query = $this->db->get('posts');
            return $query->num_rows();
        } else {
            $this->set_filter_query();
            $this->db->where('posts.subcategory_id', $category_id);
            $query = $this->db->get('posts');
            return $query->num_rows();
        }

    }

    //get posts by tag
    public function get_paginated_tag_posts($tag_slug, $per_page, $offset)
    {
        $this->set_filter_query();
        $this->db->join('tags', 'posts.id = tags.post_id');
        $this->db->where('tags.tag_slug', $tag_slug);
        $this->db->order_by('posts.created_at', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get post count by tag
    public function get_post_count_by_tag($tag_slug)
    {
        $this->set_filter_query();
        $this->db->join('tags', 'posts.id = tags.post_id');
        $this->db->where('tags.tag_slug', $tag_slug);
        $query = $this->db->get('posts');
        return $query->num_rows();
    }

    //get previous post
    public function get_previous_post($id)
    {
        $this->set_filter_query();
        $this->db->where('posts.id <', $id);
        $this->db->order_by('posts.created_at', 'DESC');
        $query = $this->db->get('posts');
        return $query->row();
    }

    //get next post
    public function get_next_post($id)
    {
        $this->set_filter_query();
        $this->db->where('posts.id >', $id);
        $this->db->order_by('posts.created_at');
        $query = $this->db->get('posts');
        return $query->row();
    }

    //get footer random posts
    public function get_footer_random_posts()
    {
        $this->set_filter_query();
        $this->db->order_by('rand()');
        $this->db->limit(3);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //increase post hit
    public function increase_post_hit($id)
    {
        //get post
        $post = $this->post_admin_model->get_post($id);

        if (!empty($post)):
            if (get_cookie('var_post_' . $id) != 1) :
                //increase hit
                set_cookie('var_post_' . $id, '1', time() + 8640000);
                $data = array(
                    'hit' => $post->hit + 1
                );

                $this->db->where('id', $id);
                $this->db->update('posts', $data);
            endif;
        endif;
    }
}