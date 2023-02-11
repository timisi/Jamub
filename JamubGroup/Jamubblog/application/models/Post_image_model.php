<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_image_model extends CI_Model
{
    //upload post image session
    public function upload_post_image_session($type_name)
    {
        if (isset($_FILES['input_post_image_file'])) {
            $file = $_FILES['input_post_image_file'];
            if (!empty($file['name'])) {

                if ($type_name == "vr_post_image") {
                    $this->sess_save_post_image($file);
                }
                if ($type_name == "vr_audio_image") {
                    $this->sess_save_audio_image($file);
                }
                if ($type_name == "vr_video_image") {
                    $this->sess_save_video_image($file);
                }
            }

        }
    }

    //save post image
    public function sess_save_post_image($file)
    {
        $vr_image = $this->session->userdata('vr_post_image');
        if (!empty($vr_image)) {
            delete_image_from_server($vr_image["image_big"]);
            delete_image_from_server($vr_image["image_default"]);
            delete_image_from_server($vr_image["image_slider"]);
            delete_image_from_server($vr_image["image_mid"]);
            delete_image_from_server($vr_image["image_small"]);
        }

        $vr_image = array(
            'image_big' => $this->upload_model->post_big_image_upload($file),
            'image_default' => $this->upload_model->post_default_image_upload($file),
            'image_slider' => $this->upload_model->post_slider_image_upload($file),
            'image_mid' => $this->upload_model->post_mid_image_upload($file),
            'image_small' => $this->upload_model->post_small_image_upload($file),
        );

        if (!empty($vr_image["image_mid"])) {
            $this->session->set_userdata('vr_post_image', $vr_image);
        }
    }

    //save audio image
    public function sess_save_audio_image($file)
    {
        $vr_image = $this->session->userdata('vr_audio_image');
        if (!empty($vr_image)) {
            delete_image_from_server($vr_image["image_default"]);
            delete_image_from_server($vr_image["image_slider"]);
            delete_image_from_server($vr_image["image_mid"]);
            delete_image_from_server($vr_image["image_small"]);
        }

        $vr_image = array(
            'image_default' => $this->upload_model->audio_image_upload($file),
            'image_slider' => $this->upload_model->post_slider_image_upload($file),
            'image_mid' => $this->upload_model->post_mid_image_upload($file),
            'image_small' => $this->upload_model->post_small_image_upload($file),
        );

        if (!empty($vr_image["image_mid"])) {
            $this->session->set_userdata('vr_audio_image', $vr_image);
        }
    }

    //save video image
    public function sess_save_video_image($file)
    {
        $vr_image = $this->session->userdata('vr_video_image');
        if (!empty($vr_image)) {
            delete_image_from_server($vr_image["image_default"]);
            delete_image_from_server($vr_image["image_slider"]);
            delete_image_from_server($vr_image["image_mid"]);
            delete_image_from_server($vr_image["image_small"]);
        }

        $vr_image = array(
            'image_default' => $this->upload_model->video_image_upload($file),
            'image_slider' => $this->upload_model->post_slider_image_upload($file),
            'image_mid' => $this->upload_model->post_mid_image_upload($file),
            'image_small' => $this->upload_model->post_small_image_upload($file),
        );

        if (!empty($vr_image["image_mid"])) {
            $this->session->set_userdata('vr_video_image', $vr_image);
        }
    }

    //upload post image
    public function upload_post_image($post_id)
    {
        if (isset($_FILES['input_post_image_file'])) {
            $file = $_FILES['input_post_image_file'];
            if (!empty($file['name'])) {

                $post = $this->post_admin_model->get_post($post_id);

                if (!empty($post)) {
                    if ($post->post_type == "video") {
                        delete_image_from_server($post->image_default);
                        delete_image_from_server($post->image_slider);
                        delete_image_from_server($post->image_mid);
                        delete_image_from_server($post->image_small);

                        $data = array(
                            'image_default' => $this->upload_model->video_image_upload($file),
                            'image_slider' => $this->upload_model->post_slider_image_upload($file),
                            'image_mid' => $this->upload_model->post_mid_image_upload($file),
                            'image_small' => $this->upload_model->post_small_image_upload($file)
                        );
                    } elseif ($post->post_type == "audio") {
                        delete_image_from_server($post->image_default);
                        delete_image_from_server($post->image_slider);
                        delete_image_from_server($post->image_mid);
                        delete_image_from_server($post->image_small);

                        $data = array(
                            'image_default' => $this->upload_model->audio_image_upload($file),
                            'image_slider' => $this->upload_model->post_slider_image_upload($file),
                            'image_mid' => $this->upload_model->post_mid_image_upload($file),
                            'image_small' => $this->upload_model->post_small_image_upload($file)
                        );
                    } else {
                        delete_image_from_server($post->image_big);
                        delete_image_from_server($post->image_default);
                        delete_image_from_server($post->image_slider);
                        delete_image_from_server($post->image_mid);
                        delete_image_from_server($post->image_small);

                        $data = array(
                            'image_big' => $this->upload_model->post_big_image_upload($file),
                            'image_default' => $this->upload_model->post_default_image_upload($file),
                            'image_slider' => $this->upload_model->post_slider_image_upload($file),
                            'image_mid' => $this->upload_model->post_mid_image_upload($file),
                            'image_small' => $this->upload_model->post_small_image_upload($file)
                        );
                    }


                    $this->db->where('id', $post->id);
                    return $this->db->update('posts', $data);
                }
            }
        }
    }

    //delete post image from session
    public function delete_post_image_session($type_name)
    {
        if ($type_name == "vr_post_image") {
            $vr_image = $this->session->userdata('vr_post_image');

            if (!empty($vr_image)) {
                delete_file_from_server($vr_image["image_big"]);
                delete_file_from_server($vr_image["image_default"]);
                delete_file_from_server($vr_image["image_slider"]);
                delete_file_from_server($vr_image["image_mid"]);
                delete_file_from_server($vr_image["image_small"]);

                $this->session->unset_userdata('vr_post_image');
            }
        }
        if ($type_name == "vr_audio_image") {
            $vr_image = $this->session->userdata('vr_audio_image');

            if (!empty($vr_image)) {
                delete_file_from_server($vr_image["image_default"]);
                delete_file_from_server($vr_image["image_slider"]);
                delete_file_from_server($vr_image["image_mid"]);
                delete_file_from_server($vr_image["image_small"]);

                $this->session->unset_userdata('vr_audio_image');
            }
        }
        if ($type_name == "vr_video_image") {
            $vr_image = $this->session->userdata('vr_video_image');

            if (!empty($vr_image)) {
                delete_file_from_server($vr_image["image_slider"]);
                delete_file_from_server($vr_image["image_mid"]);
                delete_file_from_server($vr_image["image_small"]);

                $this->session->unset_userdata('vr_video_image');
            }
        }
    }

    //upload post additional image session
    public function upload_post_additional_image_session()
    {
        if (isset($_FILES['input_additional_image_file'])) {
            $file = $_FILES['input_additional_image_file'];
            if (!empty($file['name'])) {

                $vr_additional_images = $this->session->userdata('vr_additional_images');
                $additional_images = array();

                if (!empty($vr_additional_images)) {
                    $additional_images = $vr_additional_images;
                }

                $item = array(
                    'image_big' => $this->upload_model->post_big_image_upload($file),
                    'image_default' => $this->upload_model->post_default_image_upload($file),
                );

                if (!empty($item["image_default"])) {
                    array_push($additional_images, $item);
                }

                $this->session->set_userdata('vr_additional_images', $additional_images);
            }

        }
    }

    //upload post additional image
    public function upload_post_additional_image($post_id)
    {
        if (isset($_FILES['input_additional_image_file'])) {
            $file = $_FILES['input_additional_image_file'];
            if (!empty($file['name'])) {

                $data = array(
                    'image_big' => $this->upload_model->post_big_image_upload($file),
                    'image_default' => $this->upload_model->post_default_image_upload($file),
                    'post_id' => $post_id,

                );

                $this->db->insert('post_images', $data);
            }
        }
    }

    //delete additional image from session
    public function delete_post_additional_image_session($path)
    {
        $temp_array = array();

        $vr_additional_images = $this->session->userdata('vr_additional_images');

        if (!empty($vr_additional_images)):

            foreach ($vr_additional_images as $image):

                if (!empty($image["image_default"]) && $image["image_default"] == $path) {
                    delete_file_from_server($image["image_big"]);
                    delete_file_from_server($image["image_default"]);
                } else {
                    array_push($temp_array, $image);
                }

            endforeach;

            $this->session->set_userdata('vr_additional_images', $temp_array);
            unset($temp_array);

        endif;
    }

    //delete additional image
    public function delete_post_additional_image($image_id)
    {
        //find image
        $image = $this->post_image_model->get_post_image($image_id);

        if (!empty($image)) {
            //delete from folder
            delete_image_from_server($image->image_big);
            delete_image_from_server($image->image_default);

            $this->db->where('id', $image_id);
            $this->db->delete('post_images');
        }
    }

    //add post image to database
    public function add_post_image($post_id, $type_name)
    {
        if ($type_name == "vr_post_image") {
            $vr_image = $this->session->userdata('vr_post_image');

            if (!empty($vr_image)) {
                $data = array();
                $data["image_big"] = $vr_image["image_big"];
                $data["image_default"] = $vr_image["image_default"];
                $data["image_slider"] = $vr_image["image_slider"];
                $data["image_mid"] = $vr_image["image_mid"];
                $data["image_small"] = $vr_image["image_small"];

                $this->db->where('id', $post_id);
                $this->db->update('posts', $data);

                $this->session->unset_userdata('vr_post_image');
            }
        }
        if ($type_name == "vr_audio_image") {
            $vr_image = $this->session->userdata('vr_audio_image');

            if (!empty($vr_image)) {
                $data = array();
                $data["image_default"] = $vr_image["image_default"];
                $data["image_slider"] = $vr_image["image_slider"];
                $data["image_mid"] = $vr_image["image_mid"];
                $data["image_small"] = $vr_image["image_small"];

                $this->db->where('id', $post_id);
                $this->db->update('posts', $data);

                $this->session->unset_userdata('vr_audio_image');
            }
        }
        if ($type_name == "vr_video_image") {
            $vr_image = $this->session->userdata('vr_video_image');

            if (!empty($vr_image)) {
                $data = array();
                $data["image_default"] = $vr_image["image_default"];
                $data["image_slider"] = $vr_image["image_slider"];
                $data["image_mid"] = $vr_image["image_mid"];
                $data["image_small"] = $vr_image["image_small"];

                $this->db->where('id', $post_id);
                $this->db->update('posts', $data);

                $this->session->unset_userdata('vr_video_image');
            }

            $this->add_video_image_from_url($post_id);
        }
    }

    //add post additional images to database
    public function add_post_additional_images($post_id)
    {
        $vr_additional_images = $this->session->userdata('vr_additional_images');

        if (!empty($vr_additional_images)):
            foreach ($vr_additional_images as $image):
                $data = array();
                $data["image_big"] = $image["image_big"];
                $data["image_default"] = $image["image_default"];
                $data["post_id"] = $post_id;

                $this->db->insert('post_images', $data);

            endforeach;

            $this->session->unset_userdata('vr_additional_images');

        endif;
    }

    //get post images
    public function get_post_images($post_id)
    {
        $this->db->where('post_id', $post_id);
        $query = $this->db->get('post_images');
        return $query->result();
    }

    //get post image
    public function get_post_image($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('post_images');
        return $query->row();
    }

    //get post image count
    public function get_post_image_count($post_id)
    {
        $this->db->where('post_id', $post_id);
        $query = $this->db->get('post_images');
        return $query->num_rows();
    }

    //delete additional images
    public function delete_post_additional_images($post_id)
    {
        $images = $this->get_post_images($post_id);

        if (!empty($images)):

            foreach ($images as $image) {
                delete_image_from_server($image->image_big);
                delete_image_from_server($image->image_default);

                $this->db->where('id', $image->id);
                $this->db->delete('post_images');
            }

        endif;
    }

    //add video image from url
    public function add_video_image_from_url($post_id)
    {
        $video = $this->post_admin_model->get_post($post_id);

        if (!empty($video) && !empty($video->video_image_url)) {
            header('Content-type: image/jpeg');
            $response = file_get_contents($video->video_image_url);

            if (!empty($response)) {
                file_put_contents("./uploads/tmp/tmp.jpg", $response);
            }

            if (file_exists(FCPATH . "uploads/tmp/tmp.jpg")) {
                $file = FCPATH . "uploads/tmp/tmp.jpg";

                $data = array(
                    'image_default' => $this->upload_model->video_image_upload($file),
                    'image_slider' => $this->upload_model->post_slider_image_upload($file),
                    'image_mid' => $this->upload_model->post_mid_image_upload($file),
                    'image_small' => $this->upload_model->post_small_image_upload($file),
                );

                $this->db->where('id', $post_id);
                return $this->db->update('posts', $data);
            }

            delete_image_from_server("uploads/tmp/tmp.jpg");
        }
    }

}