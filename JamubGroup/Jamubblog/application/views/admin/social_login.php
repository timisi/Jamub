<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans('social_login_configuration'); ?></h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open('admin/social_login_configuration_post'); ?>
            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>

                <h4 style="margin-top: 0;">Facebook</h4>
                <div class="form-group">
                    <label class="label-sitemap"><?php echo trans('app_id'); ?></label>
                    <input type="text" class="form-control" name="facebook_app_id" placeholder="<?php echo trans('app_id'); ?>"
                           value="<?php echo $settings->facebook_app_id; ?>">
                </div>

                <div class="form-group">
                    <label class="label-sitemap"><?php echo trans('app_secret'); ?></label>
                    <input type="text" class="form-control" name="facebook_app_secret" placeholder="<?php echo trans('app_secret'); ?>"
                           value="<?php echo $settings->facebook_app_secret; ?>">
                </div>

                <h4>Google Plus</h4>
                <div class="form-group">
                    <label class="label-sitemap"><?php echo trans('app_name'); ?></label>
                    <input type="text" class="form-control" name="google_app_name" placeholder="<?php echo trans('app_name'); ?>"
                           value="<?php echo $settings->google_app_name; ?>">
                </div>
                <div class="form-group">
                    <label class="label-sitemap"><?php echo trans('client_id'); ?></label>
                    <input type="text" class="form-control" name="google_client_id" placeholder="<?php echo trans('client_id'); ?>"
                           value="<?php echo $settings->google_client_id; ?>">
                </div>

                <div class="form-group">
                    <label class="label-sitemap"><?php echo trans('client_secret'); ?></label>
                    <input type="text" class="form-control" name="google_client_secret" placeholder="<?php echo trans('client_secret'); ?>"
                           value="<?php echo $settings->google_client_secret; ?>">
                </div>

                <!-- /.box-body -->
                <div class="box-footer" style="padding-left: 0; padding-right: 0;">
                    <button type="submit" class="btn btn-primary pull-right"><?php echo trans('save_changes'); ?></button>
                </div>
                <!-- /.box-footer -->

                <?php echo form_close(); ?><!-- form end -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    <style>
        h4 {
            color: #0d6aad;
            text-align: left;
            font-weight: 600;
            margin-bottom: 15px;
            margin-top: 30px;
        }
    </style>