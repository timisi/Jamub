<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php echo trans('image'); ?></h3>
        </div>
    </div><!-- /.box-header -->

    <div class="box-body">

        <div class="form-group m0">
            <label class="control-label"><?php echo trans('main_image'); ?></label>
            <div class="row">
                <div class="col-sm-12">
                    <a class='btn btn-sm bg-purple'>
                        <?php echo trans('select_image'); ?>
                        <input type="file" id="input_image_file" name="file" class="uploadFile input-post-image-file" accept=".png, .jpg, .jpeg, .gif" onchange="$('#input_image_file_label').html($(this).val()); $('#input_image_file_button').show();">
                    </a>

                    <a class='btn bg-gray btn-sm file-reset-button m-l-5' id="input_image_file_button" onclick="reset_file_input('#input_image_file');"><?php echo trans('reset'); ?></a>

                    <button type="button" onclick="upload_post_image('<?php echo $post->id; ?>');" class="btn btn-sm bg-olive m-l-5"><?php echo trans('upload'); ?></button>

                    <div id="post_image_upload_loader" class="upload-loader">
                        <img src="<?php echo base_url(); ?>assets/admin/img/loader.gif" alt="">
                    </div>
                </div>

                <div class="col-sm-12 m-b-10 m-t-10">
                    <label class='label label-info' id="input_image_file_label"></label>
                </div>
            </div>
        </div>

        <div class="form-group m0">
            <div class="row">
                <div class="col-sm-12">
                    <img src="<?php echo base_url() . $post->image_mid; ?>" class="img-responsive" alt="">
                </div>
            </div>
        </div>

    </div>

</div>
