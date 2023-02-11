<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12 col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?php echo trans('add_widget'); ?></h3>
                </div>
                <div class="right">
                    <a href="<?php echo base_url(); ?>widget/widgets" class="btn btn-sm btn-success btn-add-new">
                        <i class="fa fa-bars"></i>
                        <?php echo trans('widgets'); ?>
                    </a>
                </div>
            </div><!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('widget/add_widget_post'); ?>

            <input type="hidden" name="is_custom" value="1">
            <input type="hidden" name="type" value="custom">

            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('title'); ?></label>
                    <input type="text" class="form-control" name="title" placeholder="<?php echo trans('title'); ?>" value="<?php echo old('title'); ?>" required>
                </div>
                <div class="form-group">
                    <label class="control-label"><?php echo trans('order_1'); ?></label>
                    <input type="number" class="form-control max-400" name="widget_order" min="1" max="99999" placeholder="<?php echo trans('order_1'); ?>" value="<?php echo old('widget_order'); ?>"
                           required>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 col-lang">
                            <label><?php echo trans('visibility'); ?></label>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12 col-lang">
                            <input type="radio" id="rb_visibility_1" name="visibility" value="1" class="square-purple" <?php echo (old('visibility') != "0") ? 'checked' : ''; ?>>&nbsp;&nbsp;
                            <label for="rb_visibility_1" class="cursor-pointer"><?php echo trans('show'); ?></label>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12 col-lang">
                            <input type="radio" id="rb_visibility_2" name="visibility" value="0" class="square-purple" <?php echo (old('visibility') == "0") ? 'checked' : ''; ?>>&nbsp;&nbsp;
                            <label for="rb_visibility_2" class="cursor-pointer"><?php echo trans('hide'); ?></label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('content'); ?></label>
                    <textarea id="ckEditor" class="form-control"
                              name="content" placeholder="Content" required><?php echo old('content'); ?></textarea>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php echo trans('add_widget'); ?></button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>
</div>