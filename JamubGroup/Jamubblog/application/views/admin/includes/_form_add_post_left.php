<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php echo trans('post_details'); ?></h3>
        </div>
    </div><!-- /.box-header -->

    <div class="box-body">
        <!-- include message block -->
        <?php $this->load->view('admin/includes/_messages'); ?>

        <div class="form-group">
            <label class="control-label"><?php echo trans('title'); ?></label>
            <input type="text" class="form-control" name="title" placeholder="<?php echo trans('title'); ?>"
                   value="<?php echo old('title'); ?>" required>
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo trans('slug'); ?>
                <small>(<?php echo trans('slug_exp'); ?>)</small>
            </label>
            <input type="text" class="form-control" name="title_slug" placeholder="<?php echo trans('slug'); ?>"
                   value="<?php echo old('title_slug'); ?>">
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo trans('summary'); ?> & <?php echo trans("description"); ?> (<?php echo trans('meta_tag'); ?>)</label>
            <textarea class="form-control text-area"
                      name="summary" placeholder="<?php echo trans('summary'); ?> & <?php echo trans("description"); ?> (<?php echo trans('meta_tag'); ?>)"><?php echo old('summary'); ?></textarea>
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo trans('keywords'); ?> (<?php echo trans('meta_tag'); ?>)</label>
            <input type="text" class="form-control" name="keywords"
                   placeholder="<?php echo trans('keywords'); ?> (<?php echo trans('meta_tag'); ?>)" value="<?php echo old('keywords'); ?>">
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo trans('category'); ?></label>
            <select name="category_id" class="form-control max-600" onchange="get_sub_categories(this.value);" required>
                <option value=""><?php echo trans('select_category'); ?></option>
                <?php foreach ($top_categories as $item): ?>
                    <?php if ($item->id == old('category_id')): ?>
                        <option value="<?php echo html_escape($item->id); ?>"
                                selected><?php echo html_escape($item->name); ?></option>
                    <?php else: ?>
                        <option value="<?php echo html_escape($item->id); ?>"><?php echo html_escape($item->name); ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>

        <div id="subcategories">
            <div class="form-group">
                <label class="control-label"><?php echo trans('subcategory'); ?></label>
                <select name="subcategory_id" class="form-control max-600">
                    <option value=""><?php echo trans('select_category'); ?></option>
                </select>
            </div>
        </div>


        <?php if (is_admin()): ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3 col-xs-12 col-lang">
                        <label><?php echo trans('visibility'); ?></label>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-12 col-lang">
                        <input type="radio" id="rb_visibility_1" name="visibility" value="1" class="square-purple" checked>&nbsp;&nbsp;
                        <label for="rb_visibility_1" class="cursor-pointer"><?php echo trans('show'); ?></label>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-12 col-lang">
                        <input type="radio" id="rb_visibility_2" name="visibility" value="0" class="square-purple">&nbsp;&nbsp;
                        <label for="rb_visibility_2" class="cursor-pointer"><?php echo trans('hide'); ?></label>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <input type="hidden" name="visibility" value="0">
        <?php endif; ?>



        <?php if (is_admin()): ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?php echo trans('add_featured'); ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12">
                        <input type="checkbox" name="is_featured" value="1" class="square-purple" <?php echo (old('is_featured') == 1) ? 'checked' : ''; ?>>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <input type="hidden" name="is_featured" value="0">
        <?php endif; ?>


        <?php if (is_admin()): ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?php echo trans('add_breaking'); ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12">
                        <input type="checkbox" name="is_breaking" value="1" class="square-purple" <?php echo (old('is_breaking') == 1) ? 'checked' : ''; ?>>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <input type="hidden" name="is_breaking" value="0">
        <?php endif; ?>


        <?php if (is_admin()): ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?php echo trans('add_slider'); ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12">
                        <input type="checkbox" name="is_slider" value="1" class="square-purple" <?php echo (old('is_slider') == 1) ? 'checked' : ''; ?>>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <input type="hidden" name="is_slider" value="0">
        <?php endif; ?>

        <?php if (is_admin()): ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?php echo trans('add_recommended'); ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12">
                        <input type="checkbox" name="is_recommended" value="1" class="square-purple" <?php echo (old('is_recommended') == 1) ? 'checked' : ''; ?>>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <input type="hidden" name="is_recommended" value="0">
        <?php endif; ?>


        <div class="form-group">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <label class="control-label"><?php echo trans('show_only_registered'); ?></label>
                </div>
                <div class="col-md-9 col-sm-12">
                    <input type="checkbox" name="need_auth" value="1" class="square-purple" <?php echo (old('need_auth') == 1) ? 'checked' : ''; ?>>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo trans('tags'); ?></label>
            <input id="tags_1" type="text" name="tags" class="form-control tags"/>
            <small>(<?php echo trans('type_tag'); ?>)</small>
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo trans('optional_url'); ?></label>
            <input type="text" class="form-control"
                   name="optional_url" placeholder="<?php echo trans('optional_url'); ?>"
                   value="<?php echo old('optional_url'); ?>">
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo trans('content'); ?></label>
            <textarea id="ckEditor" class="form-control"
                      name="content" placeholder="Content" required><?php echo old('content'); ?></textarea>
        </div>


    </div>
</div>