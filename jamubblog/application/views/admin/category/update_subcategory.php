<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans("update_subcategory"); ?></h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open('admin_category/update_subcategory_post'); ?>

            <input type="hidden" name="id" value="<?php echo html_escape($category->id); ?>">

            <div class="box-body">

                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>

                <div class="form-group">
                    <label><?php echo trans("category_name"); ?></label>
                    <input type="text" class="form-control" name="name" placeholder="<?php echo trans("category_name"); ?>"
                           value="<?php echo html_escape($category->name); ?>" maxlength="200" required>
                </div>


                <div class="form-group">
                    <label class="control-label"><?php echo trans("slug"); ?> <small>(<?php echo trans("slug_exp"); ?>)</small></label>
                    <input type="text" class="form-control" name="name_slug" placeholder="<?php echo trans("slug"); ?>"
                           value="<?php echo html_escape($category->name_slug); ?>">
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('description'); ?> (<?php echo trans('meta_tag'); ?>)</label>
                    <input type="text" class="form-control" name="description"
                           placeholder="<?php echo trans('description'); ?> (<?php echo trans('meta_tag'); ?>)" value="<?php echo html_escape($category->description); ?>">
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('keywords'); ?> (<?php echo trans('meta_tag'); ?>)</label>
                    <input type="text" class="form-control" name="keywords"
                           placeholder="<?php echo trans('keywords'); ?> (<?php echo trans('meta_tag'); ?>)" value="<?php echo html_escape($category->keywords); ?>">
                </div>

                <div class="form-group">
                    <label><?php echo trans('parent_category'); ?></label>
                    <select class="form-control" name="parent_id" required>
                        <option value=""><?php echo trans('select'); ?></option>
                        <?php foreach ($top_categories as $item): ?>
                            <option value="<?php echo $item->id; ?>" <?php echo ($category->parent_id == $item->id) ? 'selected' : ''; ?>><?php echo $item->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 col-lang">
                            <label><?php echo trans('show_on_menu'); ?></label>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12 col-lang">
                            <input type="radio" id="rb_show_on_menu_1" name="show_on_menu" value="1" class="square-purple" <?php echo ($category->show_on_menu == '1') ? 'checked' : ''; ?>>&nbsp;&nbsp;
                            <label for="rb_show_on_menu_1" class="cursor-pointer"><?php echo trans('yes'); ?></label>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12 col-lang">
                            <input type="radio" id="rb_show_on_menu_2" name="show_on_menu" value="0" class="square-purple" <?php echo ($category->show_on_menu != '1') ? 'checked' : ''; ?>>&nbsp;&nbsp;
                            <label for="rb_show_on_menu_2" class="cursor-pointer"><?php echo trans('no'); ?></label>
                        </div>
                    </div>
                </div>

            </div>


            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php echo trans('save_changes'); ?></button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>

</div>
