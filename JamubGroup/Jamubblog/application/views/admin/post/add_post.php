<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12">

        <!-- form start -->
        <?php echo form_open_multipart('admin_post/add_post_post'); ?>

        <div class="row">
            <div class="col-sm-12 form-header">
                <h1 class="form-title"><?php echo trans('add_post'); ?></h1>
                <a href="<?php echo base_url(); ?>admin_post/posts" class="btn btn-sm btn-success btn-add-new pull-right">
                    <i class="fa fa-bars"></i>
                    <?php echo trans('posts'); ?>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-post">

                    <div class="form-post-left">
                        <?php $this->load->view("admin/includes/_form_add_post_left"); ?>
                    </div>

                    <div class="form-post-right">

                        <div id="post_image_upload_result">
                            <?php $this->load->view('admin/includes/_post_image_upload_box', ['type_name' => 'vr_post_image']); ?>
                        </div>

                        <div id="post_images_upload_result">
                            <?php $this->load->view('admin/includes/_post_images_upload_box'); ?>
                        </div>

                        <div>
                            <?php $this->load->view('admin/includes/_post_publish_box'); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?><!-- form end -->

    </div>
</div>


