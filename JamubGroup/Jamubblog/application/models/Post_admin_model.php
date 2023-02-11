<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_admin_model extends CI_Model
{

    //input values
    public function input_values()
    {
        $data = array(
            'title' => $this->input->post('title', true),
            'title_slug' => $this->input->post('title_slug', true),
            'summary' => $this->input->post('summary', true),
            'category_id' => $this->input->post('category_id', true),
            'subcategory_id' => $this->input->post('subcategory_id', true),
            'content' => $this->input->post('content', false),
            'optional_url' => $this->input->post('optional_url', true),
            'need_auth' => $this->input->post('need_auth', true),
            'is_slider' => $this->input->post('is_slider', true),
            'is_featured' => $this->input->post('is_featured', true),
            'is_recommended' => $this->input->post('is_recommended', true),
            'is_breaking' => $this->input->post('is_breaking', true),
            'visibility' => $this->input->post('visibility', true),
            'keywords' => $this->input->post('keywords', true),
        );
        return $data;
    }

    //add post
    public function add_post()
    {
        $data = $this->input_values();

        if (!isset($data['is_featured'])) {
            $data['is_featured'] = 0;
        }
        if (!isset($data['is_breaking'])) {
            $data['is_breaking'] = 0;
        }
        if (!isset($data['is_slider'])) {
            $data['is_slider'] = 0;
        }
        if (!isset($data['is_recommended'])) {
            $data['is_recommended'] = 0;
        }
        if (!isset($data['need_auth'])) {
            $data['need_auth'] = 0;
        }

        $date_published = $this->input->post('date_published', true);
        if (!empty($date_published)) {
            $data["created_at"] = $date_published;
        }

        $data["post_type"] = "post";
        $data['user_id'] = user()->id;
        $data['status'] = $this->input->post('status', true);

        if (empty($data["title_slug"])) {
            //slug for title
            $data["title_slug"] = str_slug(trim($data["title"]));
        }

        return $this->db->insert('posts', $data);
    }

    //update post
    public function update_post($id)
    {
        $data = $this->input_values();

        if (!isset($data['is_featured'])) {
            $data['is_featured'] = 0;
        }
        if (!isset($data['is_breaking'])) {
            $data['is_breaking'] = 0;
        }
        if (!isset($data['is_slider'])) {
            $data['is_slider'] = 0;
        }
        if (!isset($data['is_recommended'])) {
            $data['is_recommended'] = 0;
        }
        if (!isset($data['need_auth'])) {
            $data['need_auth'] = 0;
        }

        $data["created_at"] = $this->input->post('date_published', true);

        $publish = $this->input->post('publish', true);
        if (!empty($publish) && $publish == 1) {
            $data["status"] = 1;
        }

        //if author set visibility
        if (is_author()) {
            $data['visibility'] = 0;
        }

        if (empty($data["title_slug"])) {
            //slug for title
            $data["title_slug"] = str_slug(trim($data["title"]));
        }

        $this->db->where('id', $id);
        return $this->db->update('posts', $data);
    }

    //update slug
    public function update_slug($id)
    {
        $post = $this->get_post($id);

        if (empty($post->title_slug)) {
            $data = array(
                'title_slug' => "post-" . $post->id
            );

            $this->db->where('id', $id);
            return $this->db->update('posts', $data);
        } else {
            if ($this->check_is_slug_unique($post->title_slug, $id) == true) {
                $data = array(
                    'title_slug' => $post->title_slug . "-" . $post->id
                );

                $this->db->where('id', $id);
                return $this->db->update('posts', $data);
            }
        }
    }

    //check slug
    public function check_is_slug_unique($slug, $id)
    {
        $this->db->where('posts.title_slug', $slug);
        $this->db->where('posts.id !=', $id);
        $query = $this->db->get('posts');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //check post exists
    public function check_is_post_exists($title)
    {
        $this->db->where('posts.title', $title);
        $query = $this->db->get('posts');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //get post
    public function get_post($id)
    {
        $this->db->where('posts.id', $id);
        $query = $this->db->get('posts');
        return $query->row();
    }

    //get posts count
    public function get_posts_count()
    {
        $user_id = user()->id;
        if (user()->role == "author"):
            $this->db->where('posts.user_id', $user_id);
        endif;

        $this->db->where('posts.visibility', 1);
        $this->db->where('posts.status', 1);
        $this->db->where('posts.created_at <= CURRENT_TIMESTAMP()');
        $query = $this->db->get('posts');
        return $query->num_rows();
    }

    //get pending posts count
    public function get_pending_posts_count()
    {
        $user_id = user()->id;
        if (user()->role == "author"):
            $this->db->where('posts.user_id', $user_id);
        endif;

        $this->db->where('posts.visibility', 0);
        $this->db->where('posts.status', 1);
        $this->db->where('posts.created_at <= CURRENT_TIMESTAMP()');
        $query = $this->db->get('posts');
        return $query->num_rows();
    }

    //get drafts count
    public function get_drafts_count()
    {
        $user_id = user()->id;
        if (user()->role == "author"):
            $this->db->where('posts.user_id', $user_id);
        endif;

        $this->db->where('posts.status', 0);
        $query = $this->db->get('posts');
        return $query->num_rows();
    }

    //get scheduled posts count
    public function get_scheduled_posts_count()
    {
        $user_id = user()->id;
        if (user()->role == "author"):
            $this->db->where('posts.user_id', $user_id);
        endif;

        $this->db->where('posts.status', 1);
        $this->db->where('posts.created_at > CURRENT_TIMESTAMP()');
        $query = $this->db->get('posts');
        return $query->num_rows();
    }

    //filter by values
    public function filter_posts()
    {
        $data = array(
            'post_type' => $this->input->get('post_type', true),
            'author' => $this->input->get('author', true),
            'category' => $this->input->get('category', true),
            'q' => $this->input->get('q', true),
        );

        $data['q'] = trim($data['q']);
        $data['user_id'] = "";

        //check if author
        if (user()->role == "author"):
            $data['user_id'] = user()->id;
        else:
            if (!empty($data['author'])) {
                $data['user_id'] = $data['author'];
            }
        endif;

        if (!empty($data['post_type'])) {
            $this->db->where('posts.post_type', $data['post_type']);
        }

        if (!empty($data['category'])) {
            $this->db->where('posts.category_id', $data['category']);
        }

        if (!empty($data['q'])) {
            $this->db->like('posts.title', $data['q']);
        }

        if (!empty($data['user_id'])) {
            $this->db->where('posts.user_id', $data['user_id']);
        }
    }

    //filter by list
    public function filter_posts_list($list)
    {
        if (!empty($list)) {
            if ($list == "slider_posts") {
                $this->db->where('posts.is_slider', 1);
            }
            if ($list == "featured_posts") {
                $this->db->where('posts.is_featured', 1);
            }
            if ($list == "breaking_news") {
                $this->db->where('posts.is_breaking', 1);
            }
            if ($list == "recommended_posts") {
                $this->db->where('posts.is_recommended', 1);
            }
        }
    }

    //get paginated posts
    public function get_paginated_posts($per_page, $offset, $list)
    {
        $this->filter_posts();
        $this->filter_posts_list($list);
        $this->db->where('posts.visibility', 1);
        $this->db->where('posts.status', 1);
        $this->db->where('posts.created_at <= CURRENT_TIMESTAMP()');
        $this->db->order_by('posts.created_at', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get paginated posts count
    public function get_paginated_posts_count($list)
    {
        $this->filter_posts();
        $this->filter_posts_list($list);
        $this->db->where('posts.visibility', 1);
        $this->db->where('posts.status', 1);
        $this->db->where('posts.created_at <= CURRENT_TIMESTAMP()');
        $query = $this->db->get('posts');
        return $query->num_rows();
    }

    //get paginated pending posts
    public function get_paginated_pending_posts($per_page, $offset)
    {
        $this->filter_posts();
        $this->db->where('posts.visibility', 0);
        $this->db->where('posts.status', 1);
        $this->db->where('posts.created_at <= CURRENT_TIMESTAMP()');
        $this->db->order_by('posts.created_at', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get paginated pending posts count
    public function get_paginated_pending_posts_count()
    {
        $this->filter_posts();
        $this->db->where('posts.visibility', 0);
        $this->db->where('posts.status', 1);
        $this->db->where('posts.created_at <= CURRENT_TIMESTAMP()');
        $query = $this->db->get('posts');
        return $query->num_rows();
    }

    //get paginated scheduled posts
    public function get_paginated_scheduled_posts($per_page, $offset)
    {
        $this->filter_posts();
        $this->db->where('posts.status', 1);
        $this->db->where('posts.created_at > CURRENT_TIMESTAMP()');
        $this->db->order_by('posts.created_at', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get paginated scheduled posts count
    public function get_paginated_scheduled_posts_count()
    {
        $this->filter_posts();
        $this->db->where('posts.status', 1);
        $this->db->where('posts.created_at > CURRENT_TIMESTAMP()');
        $query = $this->db->get('posts');
        return $query->num_rows();
    }

    //get paginated drafts
    public function get_paginated_drafts($per_page, $offset)
    {
        $this->filter_posts();
        $this->db->where('posts.status !=', 1);
        $this->db->order_by('posts.created_at', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get paginated drafts count
    public function get_paginated_drafts_count()
    {
        $this->filter_posts();
        $this->db->where('posts.status !=', 1);
        $query = $this->db->get('posts');
        return $query->num_rows();
    }

    //get post count by category
    public function get_post_count_by_category($category_id)
    {
        $category = $this->category_model->get_category($category_id);
        if ($category->parent_id == 0) {
            $this->db->where('posts.category_id', $category_id);
            $this->db->where('posts.visibility', 1);
            $this->db->where('posts.status', 1);
            $this->db->where('posts.created_at <= CURRENT_TIMESTAMP()');
            $query = $this->db->get('posts');
            return $query->num_rows();
        } else {
            $this->db->where('posts.subcategory_id', $category_id);
            $this->db->where('posts.visibility', 1);
            $this->db->where('posts.status', 1);
            $this->db->where('posts.created_at <= CURRENT_TIMESTAMP()');
            $query = $this->db->get('posts');
            return $query->num_rows();
        }
    }

    //get feed posts count
    public function get_feed_posts_count($feed_id)
    {
        $this->db->where('feed_id', $feed_id);
        $this->db->where('posts.visibility', 1);
        $this->db->where('posts.status', 1);
        $this->db->where('posts.created_at <= CURRENT_TIMESTAMP()');
        $query = $this->db->get('posts');
        return $query->num_rows();
    }

    //add or remove post from slider
    public function post_add_remove_slider($id)
    {
        //get post
        $post = $this->get_post($id);

        if (!empty($post)) {
            $result = "";
            if ($post->is_slider == 1) {
                //remove from slider
                $data = array(
                    'is_slider' => 0,
                );
                $result = "removed";
            } else {
                //add to slider
                $data = array(
                    'is_slider' => 1,
                );
                $result = "added";
            }

            $this->db->where('id', $id);
            $this->db->update('posts', $data);
            return $result;
        }
    }

    //add or remove post from featured
    public function post_add_remove_featured($id)
    {
        //get post
        $post = $this->get_post($id);

        if (!empty($post)) {
            $result = "";
            if ($post->is_featured == 1) {
                //remove from featured
                $data = array(
                    'is_featured' => 0,
                );
                $result = "removed";
            } else {
                //add to featured
                $data = array(
                    'is_featured' => 1,
                );
                $result = "added";
            }

            $this->db->where('id', $id);
            $this->db->update('posts', $data);
            return $result;
        }
    }

    //add or remove post from breaking
    public function post_add_remove_breaking($id)
    {
        //get post
        $post = $this->get_post($id);

        if (!empty($post)) {
            $result = "";
            if ($post->is_breaking == 1) {
                //remove from breaking
                $data = array(
                    'is_breaking' => 0,
                );
                $result = "removed";
            } else {
                //add to breaking
                $data = array(
                    'is_breaking' => 1,
                );
                $result = "added";
            }

            $this->db->where('id', $id);
            $this->db->update('posts', $data);
            return $result;
        }
    }

    //approve post
    public function approve_post($id)
    {

        $data = array(
            'visibility' => 1,
        );

        $this->db->where('id', $id);
        return $this->db->update('posts', $data);
    }

    //publish post
    public function publish_post($id)
    {
        $sql = "UPDATE posts SET created_at = CURRENT_TIMESTAMP() WHERE id = ?";
        return $this->db->query($sql, array($id));
    }

    //publish draft
    public function publish_draft($id)
    {
        $data = array(
            'status' => 1,
        );

        $this->db->where('id', $id);
        return $this->db->update('posts', $data);
    }

    //add or remove post from recommended
    public function post_add_remove_recommended($id)
    {
        //get post
        $post = $this->get_post($id);

        if (!empty($post)) {
            $result = "";
            if ($post->is_recommended == 1) {
                //remove from recommended
                $data = array(
                    'is_recommended' => 0,
                );
                $result = "removed";
            } else {
                //add to recommended
                $data = array(
                    'is_recommended' => 1,
                );
                $result = "added";
            }

            $this->db->where('id', $id);
            $this->db->update('posts', $data);
            return $result;
        }
    }

    //save feaured post order
    public function save_featured_post_order($id, $order)
    {
        //get post
        $post = $this->get_post($id);

        if (!empty($post)):
            $data = array(
                'featured_order' => $order,
            );
            $this->db->where('id', $id);
            $this->db->update('posts', $data);
        endif;
    }

    //save home slider post order
    public function save_home_slider_post_order($id, $order)
    {
        //get post
        $post = $this->get_post($id);

        if (!empty($post)):
            $data = array(
                'slider_order' => $order,
            );
            $this->db->where('id', $id);
            $this->db->update('posts', $data);
        endif;
    }

    //delete post
    public function delete_post($id)
    {
        $post = $this->get_post($id);

        if (!empty($post)):
            //delete posts images
            delete_image_from_server($post->image_big);
            delete_image_from_server($post->image_default);
            delete_image_from_server($post->image_slider);
            delete_image_from_server($post->image_mid);
            delete_image_from_server($post->image_small);

            //delete additional images
            $this->post_image_model->delete_post_additional_images($id);

            //delete audios
            $this->audio_model->delete_post_audios($id);

            $this->db->where('id', $id);
            return $this->db->delete('posts');
        else:
            return false;
        endif;
    }

    //delete multi post
    public function delete_multi_posts($post_ids)
    {
        foreach ($post_ids as $id) {
            $post = $this->get_post($id);

            if (!empty($post)) {

                //delete post tags
                $this->tag_model->delete_post_tags($id);

                $this->db->where('id', $id);
                $this->db->delete('posts');
            }
        }

    }
}