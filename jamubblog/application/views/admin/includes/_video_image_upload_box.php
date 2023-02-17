<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php echo trans('video_thumbnails'); ?></h3>
        </div>
    </div><!-- /.box-header -->

    <div class="box-body">

        <div class="form-group m0">
            <label class="control-label"><?php echo trans('video_thumbnails'); ?>
                <small>(<?php echo trans('image_for_video'); ?>)</small>
            </label>
            <div class="row">
                <div class="col-sm-12">
                    <a class='btn btn-sm bg-purple'>
                        <?php echo trans('select_image'); ?>
                        <input type="file" id="input_image_file" name="file" class="uploadFile input-post-image-file" accept=".png, .jpg, .jpeg, .gif" onchange="$('#input_image_file_label').html($(this).val()); $('#input_image_file_button').show();">
                    </a>

                    <a class='btn btn-sm bg-gray file-reset-button m-l-5' id="input_image_file_button" onclick="reset_file_input('#input_image_file');"><?php echo trans('reset'); ?></a>

                    <button type="button" id="post_image_upload_button" onclick="upload_post_image_session('vr_video_image');" class="btn btn-sm bg-olive m-l-5"><?php echo trans('upload'); ?></button>

                    <a class='btn btn-danger btn-sm m-l-5 delete-file-image-button' id="btn_delete_file_image" onclick="delete_post_image_session('vr_video_image');"><?php echo trans('delete'); ?></a>

                    <div id="post_image_upload_loader" class="upload-loader">
                        <img src="<?php echo base_url(); ?>assets/admin/img/loader.gif" alt="">
                    </div>
                </div>

                <div class="col-sm-12 m-b-10 m-t-10">
                    <label class='label label-info' id="input_image_file_label"></label>
                </div>
                <div class="col-sm-12 m-b-10">
                    <label><?php echo trans('or'); ?><br></label>
                </div>
                <div class="col-sm-12 m-b-15">
                    <input type="text" class="form-control" name="video_image_url" id="video_thumbnail_url" placeholder="<?php echo trans('add_image_url'); ?>"
                           value="<?php echo old('video_image_url'); ?>">
                </div>

            </div>
        </div>

        <div class="form-group m0">
            <div class="row">
                <div class="col-sm-12">
                    <?php $vr_image = $this->session->userdata('vr_video_image'); ?>
                    <?php if (!empty($vr_image)): ?>
                        <img src="<?php echo base_url() . $vr_image["image_mid"]; ?>" id="img_video_thumbnail" class="img-responsive" alt="">
                        <style>
                            #btn_delete_file_image {
                                visibility: visible;
                            }
                        </style>
                    <?php else: ?>
                        <img src="" id="img_video_thumbnail" class="img-responsive" alt="">
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>

</div>
