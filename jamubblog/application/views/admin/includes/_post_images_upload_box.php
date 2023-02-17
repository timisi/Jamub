<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php echo trans('additional_images'); ?></h3>
        </div>
    </div><!-- /.box-header -->

    <div class="box-body">

        <div class="form-group m0">
            <label class="control-label"><?php echo trans('additional_images'); ?></label>
            <div class="row">
                <div class="col-sm-12">

                    <a class='btn btn-sm bg-purple'>
                        <?php echo trans('select_image'); ?>
                        <input type="file" id="input_additional_image_file" name="file" class="uploadFile" accept=".png, .jpg, .jpeg, .gif" onchange="$('#input_additional_file_label').html($(this).val()); $('#input_additional_file_button').show();">
                    </a>

                    <a class='btn bg-gray btn-sm file-reset-button m-l-5' id="input_additional_file_button" onclick="reset_file_input('#input_additional_file');"><?php echo trans('reset'); ?></a>

                    <button type="button" onclick="upload_post_additional_image_session();" class="btn btn-sm bg-olive m-l-5"><?php echo trans('upload'); ?></button>

                    <div id="post_additional_image_upload_loader" class="upload-loader">
                        <img src="<?php echo base_url(); ?>assets/admin/img/loader.gif" alt="">
                    </div>
                </div>

                <div class="col-sm-12 m-b-10 m-t-10">
                    <label class='label label-info' id="input_additional_file_label"></label>
                </div>
            </div>
        </div>

        <div class="form-group m0">
            <?php $vr_additional_images = $this->session->userdata('vr_additional_images'); ?>
            <?php if (!empty($vr_additional_images)): ?>
                <?php foreach ($vr_additional_images as $image): ?>
                    <div class="row">
                        <div class="col-sm-12 m-b-15">
                            <div class="additional-image-list">
                                <img class="img-additional" src="<?php echo base_url() . $image["image_default"]; ?>" alt="">
                                <a class='btn btn-danger btn-sm m-l-5 delete-additional-image-button' id="btn_delete_file_image" onclick="delete_post_additional_image_session('<?php echo $image["image_default"]; ?>');"><i class="fa fa-times"></i> </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>

</div>
