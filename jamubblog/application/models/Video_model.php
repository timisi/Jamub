<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video_model extends CI_Model
{
    //input values
    public function input_values()
    {
        $data = array(
            'title' => $this->input->post('title', true),
            'title_slug' => $this->input->post('title_slug', true),
            'summary' => $this->input->post('summary', true),
            'category_id' => $this->input->post('category_id', false),
            'subcategory_id' => $this->input->post('subcategory_id', false),
            'content' => $this->input->post('content', false),
            'optional_url' => $this->input->post('optional_url', true),
            'need_auth' => $this->input->post('need_auth', true),
            'is_slider' => $this->input->post('is_slider', true),
            'is_featured' => $this->input->post('is_featured', true),
            'is_recommended' => $this->input->post('is_recommended', true),
            'is_breaking' => $this->input->post('is_breaking', true),
            'visibility' => $this->input->post('visibility', true),
            'keywords' => $this->input->post('keywords', true),
            'video_image_url' => $this->input->post('video_image_url', true),
            'video_embed_code' => $this->input->post('video_embed_code', true),
        );
        return $data;
    }

    //add video
    public function add()
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

        $data["post_type"] = "video";

        $data['user_id'] = user()->id;
        $data['video_path'] = $this->get_video_session();
        $data['status'] = $this->input->post('status', true);

        if (empty($data["title_slug"])) {
            //slug for title
            $data["title_slug"] = str_slug(trim($data["title"]));
        }

        return $this->db->insert('posts', $data);
    }

    //update video
    public function update($id)
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

    //upload video to session
    public function upload_video_session()
    {
        if (isset($_FILES['input_video_file'])) {
            $file = $_FILES['input_video_file'];
            if (!empty($file['name'])) {

                $vr_video_file = $this->session->userdata('vr_video_file');
                if (!empty($vr_video_file)) {
                    delete_file_from_server($vr_video_file["video"]);
                }

                $vr_video_file = array(
                    'video' => $this->upload_model->video_upload($file),
                );

                if (!empty($vr_video_file["video"])) {
                    $this->session->set_userdata('vr_video_file', $vr_video_file);
                }
            }

        }
    }

    //upload video
    public function upload_video($post_id)
    {
        if (isset($_FILES['input_video_file'])) {
            $file = $_FILES['input_video_file'];
            if (!empty($file['name'])) {

                $post = $this->post_admin_model->get_post($post_id);

                if (!empty($post)) {

                    delete_file_from_server($post->video_path);

                    $data = array(
                        'video_path' => $this->upload_model->video_upload($file),
                    );

                    $this->db->where('id', $post_id);
                    return $this->db->update('posts', $data);
                }


            }
        }
    }

    //delete video
    public function delete_video($post_id)
    {
        $post = $this->post_admin_model->get_post($post_id);

        if (!empty($post)) {
            //delete from folder
            delete_file_from_server($post->video_path);

            $data = array(
                'video_path' => NULL,
            );

            $this->db->where('id', $post_id);
            return $this->db->update('posts', $data);
        }
    }

    //get video from session
    public function get_video_session()
    {
        $vr_video_file = $this->session->userdata('vr_video_file');

        if (!empty($vr_video_file)) {
            $this->session->unset_userdata('vr_video_file');
            return $vr_video_file['video'];
        } else {
            return null;
        }
    }

    //get video thumbnail
    public function get_video_thumbnail($url)
    {
        $this->load->library('video_url_parser');

        $service = $this->video_url_parser->identify_service($url);

        $img_thumbnail = "";

        if ($service == 'youtube') {

            $img_thumbnail = "https://img.youtube.com/vi/" . $this->video_url_parser->get_url_id($url) . "/maxresdefault.jpg";

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $img_thumbnail,
                CURLOPT_HEADER => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_NOBODY => true));

            $header = explode("\n", curl_exec($curl));
            curl_close($curl);

            if (strpos($header[0], '200') === false) {
                $img_thumbnail = "https://img.youtube.com/vi/" . $this->video_url_parser->get_url_id($url) . "/0.jpg";
            }


        }

        if ($service == 'vimeo') {
            $vimeo = unserialize(file_get_contents("http://vimeo.com/api/v2/video/" . $this->video_url_parser->get_url_id($url) . ".php"));
            $img_thumbnail = $vimeo[0]['thumbnail_large'];
        }

        return $img_thumbnail;
    }

    //delete video from session
    public function delete_video_session()
    {
        $vr_video_file = $this->session->userdata('vr_video_file');

        if (!empty($vr_video_file)) {
            delete_file_from_server($vr_video_file["video"]);
            $this->session->unset_userdata('vr_video_file');
        }

    }


}