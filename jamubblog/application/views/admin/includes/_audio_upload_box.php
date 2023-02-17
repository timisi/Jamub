<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php echo trans('audios'); ?></h3>
        </div>
    </div><!-- /.box-header -->

    <div class="box-body">
        <div class="form-group">
            <label class="control-label"><?php echo trans('audio_name'); ?></label>
            <input type="text" id="audio_name" class="form-control" placeholder="<?php echo trans('audio_name'); ?>">
        </div>

        <div class="form-group">

            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label"><?php echo trans('musician'); ?></label>
                    <input type="text" id="musician" class="form-control" placeholder="<?php echo trans('musician'); ?>">
                </div>
            </div>

        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-6 col-xs-12 col-lang">
                    <label><?php echo trans('download_button'); ?></label>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-12 col-lang">
                    <input type="radio" id="rb_download_button_1" name="download_button" value="1" class="square-purple" checked>&nbsp;&nbsp;
                    <label for="rb_download_button_1" class="cursor-pointer"><?php echo trans('show'); ?></label>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-12 col-lang">
                    <input type="radio" id="rb_download_button_2" name="download_button" value="0" class="square-purple">&nbsp;&nbsp;
                    <label for="rb_download_button_2" class="cursor-pointer"><?php echo trans('hide'); ?></label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo trans('audio_file'); ?></label>
            <div class="row">
                <div class="col-sm-12 m-b-10">
                    <a class='btn btn-sm bg-purple'>
                        <?php echo trans('select_file'); ?>
                        <input type="file" id="input_audio_file" name="audio_file" class="uploadFile" accept=".mp3,.wav" onchange="$('#input_audio_file_label').html($(this).val()); $('#input_audio_file_button').show();">
                    </a>

                    <a class='btn bg-gray btn-sm file-reset-button m-l-5' id="input_audio_file_button" onclick="reset_file_input('#input_audio_file');"><?php echo trans('reset'); ?></a>
                    <div id="audio_upload_loader" class="upload-loader">
                        <img src="<?php echo base_url(); ?>assets/admin/img/loader.gif" alt="">
                    </div>
                </div>

                <div class="col-sm-12">
                    <span class='label label-info' id="input_audio_file_label"></span>
                </div>

            </div>
        </div>



        <div class="form-group">
            <div class="row">
                <div class="col-sm-12">
                    <button type="button" id="audio_upload_button" onclick="upload_audio_session();" class="btn btn-md bg-olive pull-right"><?php echo trans('upload'); ?></button>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php echo trans('play_list'); ?></h3>
        </div>
    </div><!-- /.box-header -->

    <div class="box-body">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12">

                    <div class="audio-list">
                        <?php $vr_user_audios = $this->session->userdata('vr_user_audios'); ?>
                        <?php if (!empty($vr_user_audios)): ?>
                            <?php foreach ($vr_user_audios as $audio): ?>
                                <p class="play-list-item">
                                    <i class="fa fa-music"></i>
                                    <?php echo $audio["audio_name"]; ?>
                                    <a href="javascript:void(0)" onclick="delete_audio_session('<?php echo $audio["audio_path"]; ?>');" class="btn btn-xs btn-danger pull-right"><?php echo trans('delete'); ?></a>
                                </p>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <?php echo trans('play_list_empty'); ?>
                        <?php endif; ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>