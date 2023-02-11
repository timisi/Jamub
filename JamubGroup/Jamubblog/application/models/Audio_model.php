<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Audio_model extends CI_Model
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

        $data["post_type"] = "audio";
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

    //get post audios
    public function get_post_audios($post_id)
    {
        $this->db->where('audios.post_id', $post_id);
        $this->db->order_by('audios.id');
        $query = $this->db->get('audios');
        return $query->result();
    }

    //get audio
    public function get_audio($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('audios');
        return $query->row();
    }

    //add post audio
    public function add_post_audio($post_id)
    {
        $vr_user_audios = $this->session->userdata('vr_user_audios');

        if (!empty($vr_user_audios)):
            foreach ($vr_user_audios as $audio):
                if (!empty($audio["audio_path"])) {
                    $data = array(
                        'post_id' => $post_id,
                        'audio_path' => $audio["audio_path"],
                        'audio_name' => $audio["audio_name"],
                        'musician' => $audio["musician"],
                        'download_button' => $audio["download_button"],
                    );

                    $this->db->insert('audios', $data);

                }
            endforeach;
        endif;
    }

    //upload audio
    public function upload_audio($post_id)
    {
        if (isset($_FILES['input_audio_file'])) {
            $file = $_FILES['input_audio_file'];
            if (!empty($file['name'])) {

                $data = array(
                    'post_id' => $post_id,
                    'audio_path' => $this->upload_model->audio_upload($file),
                    'audio_name' => $this->input->post('audio_name', true),
                    'musician' => $this->input->post('musician', true),
                    'download_button' => $this->input->post('download_button', true),
                );

                if (!empty($data["audio_path"])) {
                    $this->db->insert('audios', $data);
                }

            }
        }
    }

    //upload audio session
    public function upload_audio_session()
    {
        if (isset($_FILES['input_audio_file'])) {
            $file = $_FILES['input_audio_file'];
            if (!empty($file['name'])) {

                $user_audios = array();
                $vr_user_audios = $this->session->userdata('vr_user_audios');
                if (!empty($vr_user_audios)) {
                    $user_audios = $vr_user_audios;
                }

                $item = array(
                    'audio_path' => $this->upload_model->audio_upload($file),
                    'audio_name' => $this->input->post('audio_name', true),
                    'musician' => $this->input->post('musician', true),
                    'download_button' => $this->input->post('download_button', true),
                );

                if (!empty($item["audio_path"])) {
                    array_push($user_audios, $item);
                }

                $this->session->set_userdata('vr_user_audios', $user_audios);

            }

        }
    }

    //delete audio
    public function delete_audio_session($path)
    {
        $temp_array = array();
        $vr_user_audios = $this->session->userdata('vr_user_audios');

        if (!empty($vr_user_audios)):
            foreach ($vr_user_audios as $audio):

                if (!empty($audio["audio_path"]) && $audio["audio_path"] == $path) {
                    delete_file_from_server($audio["audio_path"]);
                } else {
                    array_push($temp_array, $audio);
                }

            endforeach;

            $this->session->set_userdata('vr_user_audios', $temp_array);
            unset($temp_array);
        endif;

    }

    //delete audio
    public function delete_audio($id)
    {
        //find audio
        $audio = $this->get_audio($id);

        if (!empty($audio)) {
            //delete from folder
            delete_file_from_server($audio->audio_path);

            $this->db->where('id', $id);
            $this->db->delete('audios');
        }
    }

    //delete post audios
    public function delete_post_audios($post_id)
    {
        $audios = $this->get_post_audios($post_id);

        if (!empty($audios)):
            foreach ($audios as $audio) {
                delete_file_from_server($audio->audio_path);

                $this->db->where('id', $audio->id);
                $this->db->delete('audios');
            }
        endif;
    }
}