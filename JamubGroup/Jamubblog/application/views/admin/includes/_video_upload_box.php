<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-md-12">

        <!-- form start -->
        <?php echo form_open_multipart('admin/settings_post'); ?>

        <!-- Custom Tabs -->
        <div class="nav-tabs-custom video-upload-tab">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><?php echo trans('upload_video'); ?><small>&nbsp;(mp4,webm)</small></a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><?php echo trans('get_video_from_url'); ?></a></li>
            </ul>
            <div class="tab-content settings-tab-content">

                <div class="tab-pane active" id="tab_1">

                    <div class="form-group m0">
                        <div class="row">
                            <div class="col-sm-12">
                                <a class='btn btn-sm bg-purple'>
                                    <?php echo trans('select_file'); ?>
                                    <input type="file" id="input_video_file" name="file" class="uploadFile" onchange="$('#input_video_file_label').html($(this).val()); $('#input_video_file_button').show();" accept=".mp4, .webm">
                                </a>

                                <a class='btn btn-sm bg-gray file-reset-button m-l-5' id="input_video_file_button" onclick="reset_file_input('#input_video_file');"><?php echo trans('reset'); ?></a>

                                <button type="button" id="video_upload_button" onclick="upload_video_session();" class="btn btn-sm bg-olive m-l-5"><?php echo trans('upload'); ?></button>

                                <a class='btn btn-danger btn-sm m-l-5 delete-file-image-button' id="btn_delete_file_video" onclick="delete_video_session();"><?php echo trans('delete'); ?></a>

                                <div id="video_upload_loader" class="upload-loader">
                                    <img src="<?php echo base_url(); ?>assets/admin/img/loader.gif" alt="">
                                </div>
                            </div>

                            <div class="col-sm-12 m-t-10 m-b-10">
                                <label class='label label-info' id="input_video_file_label"></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group m0">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php $vr_video_file = $this->session->userdata('vr_video_file'); ?>
                                <?php if (!empty($vr_video_file)): ?>

                                    <video controls class="video-preview">
                                        <source src="<?php echo base_url() . $vr_video_file["video"]; ?>" type="video/mp4">
                                        <source src="<?php echo base_url() . $vr_video_file["video"]; ?>" type="video/ogg">
                                        Your browser does not support the video tag.
                                    </video>

                                    <style>
                                        #btn_delete_file_video {
                                            visibility: visible;
                                        }
                                    </style>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane" id="tab_2">

                    <div class="form-group">
                        <label class="control-label"><?php echo trans('video_url'); ?>&nbsp;(
                            <small>Youtube&nbsp;<?php echo trans('or'); ?>&nbsp;Vimeo)</small>
                        </label>
                        <input type="text" class="form-control" id="video_url" placeholder="<?php echo trans('video_url'); ?>">
                        <a href="javascript:void(0)" class="btn btn-sm btn-info pull-right btn-get-embed" onclick="get_video_from_url();"><?php echo trans('get_video'); ?></a>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo trans('video_embed_code'); ?></label>
                        <textarea class="form-control text-embed"
                                  name="video_embed_code" id="video_embed_code" placeholder="<?php echo trans('video_embed_code'); ?>"><?php echo old('video_embed_code'); ?></textarea>
                    </div>

                    <iframe src="" id="video_embed_preview" frameborder="0" allow="encrypted-media" allowfullscreen class="video-embed-preview"></iframe>

                </div>


            </div><!-- /.tab-content -->


        </div><!-- nav-tabs-custom -->

        <?php echo form_close(); ?>
    </div><!-- /.col -->
</div>
