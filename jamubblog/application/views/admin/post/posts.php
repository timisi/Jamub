<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php echo $title; ?></h3>
        </div>
        <div class="right">
            <div class="dropdown">
                <button class="btn btn-sm btn-success btn-add-new dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-plus"></i> <?php echo trans('add_post'); ?>
                    <span class="caret"></span></button>
                <ul class="dropdown-menu pull-right">
                    <li><a href="<?php echo base_url(); ?>admin_post/add_post"><?php echo trans('add_post'); ?></a></li>
                    <li><a href="<?php echo base_url(); ?>admin_video/add_video"><?php echo trans('add_video'); ?></a></li>
                    <li><a href="<?php echo base_url(); ?>audio/add_audio"><?php echo trans('add_audio'); ?></a></li>
                </ul>
            </div>
        </div>
    </div><!-- /.box-header -->

    <!-- include message block -->
    <div class="col-sm-12">
        <?php $this->load->view('admin/includes/_messages'); ?>
    </div>

    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" role="grid">
                        <?php $this->load->view('admin/includes/_filter_posts'); ?>
                        <thead>
                        <tr role="row">
                            <th width="20"><input type="checkbox" class="checkbox-table" id="checkAll"></th>
                            <th width="20"><?php echo trans('id'); ?></th>
                            <th><?php echo trans('post'); ?></th>
                            <th><?php echo trans('post_type'); ?></th>
                            <th><?php echo trans('category'); ?></th>
                            <th><?php echo trans('author'); ?></th>
                            <th></th>
                            <?php if ($list_type == "slider_posts"): ?>
                                <th><?php echo trans('slider_order'); ?></th>
                            <?php endif; ?>
                            <?php if ($list_type == "featured_posts"): ?>
                                <th><?php echo trans('featured_posts'); ?></th>
                            <?php endif; ?>
                            <th><?php echo trans('date_added'); ?></th>
                            <th class="max-width-120"><?php echo trans('options'); ?></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($posts as $item): ?>
                            <tr>
                                <td><input type="checkbox" name="checkbox-table" class="checkbox-table" value="<?php echo $item->id; ?>"></td>
                                <td><?php echo html_escape($item->id); ?></td>
                                <td class="td-post">
                                    <img src="<?php echo base_url() . html_escape($item->image_small); ?>" alt="">
                                    <?php echo html_escape($item->title); ?>
                                </td>
                                <td class="td-post-type"><?php echo html_escape($item->post_type); ?></td>
                                <td>
                                    <?php $category = helper_get_category($item->category_id);
                                    if (!empty($category)): ?>
                                        <label class="category-label m-r-5 label-table" style="background-color: <?php echo html_escape($category->color); ?>!important;">
                                            <?php echo html_escape($category->name); ?>
                                        </label>
                                    <?php endif; ?>

                                    <?php $category = helper_get_category($item->subcategory_id);
                                    if (!empty($category)): ?>
                                        <label class="category-label label-table" style="background-color: <?php echo html_escape($category->color); ?>">
                                            <?php echo html_escape($category->name); ?>
                                        </label>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php $author = get_user($item->user_id);
                                    if (!empty($author)): ?>
                                        <a href="<?php echo base_url(); ?>profile/<?php echo html_escape($author->slug); ?>" target="_blank">
                                            <strong><?php echo html_escape($author->username); ?></strong>
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td class="td-post-sp">
                                    <?php if ($item->visibility == 1): ?>
                                        <label class="label label-success label-table"><i class="fa fa-eye"></i></label>
                                    <?php else: ?>
                                        <label class="label label-danger label-table"><i class="fa fa-eye"></i></label>
                                    <?php endif; ?>

                                    <?php if ($item->is_slider): ?>
                                        <label class="label bg-red label-table"><?php echo trans('slider'); ?></label>
                                    <?php endif; ?>

                                    <?php if ($item->is_featured): ?>
                                        <label class="label bg-olive label-table"><?php echo trans('featured'); ?></label>
                                    <?php endif; ?>

                                    <?php if ($item->is_recommended): ?>
                                        <label class="label bg-aqua label-table"><?php echo trans('recommended'); ?></label>
                                    <?php endif; ?>

                                    <?php if ($item->is_breaking): ?>
                                        <label class="label bg-teal label-table"><?php echo trans('breaking'); ?></label>
                                    <?php endif; ?>

                                    <?php if ($item->need_auth): ?>
                                        <label class="label label-warning label-table"><?php echo trans('only_registered'); ?></label>
                                    <?php endif; ?>

                                </td>
                                <?php if ($list_type == "slider_posts"): ?>
                                    <td>
                                        <?php echo form_open('admin_post/home_slider_posts_order_post'); ?>
                                        <div class="slider-order">
                                            <div class="slider-order-left">
                                                <input type="hidden" name="id"
                                                       value="<?php echo html_escape($item->id); ?>">
                                                <input type="number" name="slider_order" class="form-control"
                                                       value="<?php echo html_escape($item->slider_order); ?>" min="1" max="99999">
                                            </div>
                                            <div class="slider-order-right">
                                                <button type="submit" class="btn btn-sm btn-success"><i
                                                            class="fa fa-check"></i></button>
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </td>
                                <?php endif; ?>
                                <?php if ($list_type == "featured_posts"): ?>
                                    <td>
                                        <?php echo form_open('admin_post/featured_posts_order_post'); ?>
                                        <div class="slider-order">
                                            <div class="slider-order-left">
                                                <input type="hidden" name="id"
                                                       value="<?php echo html_escape($item->id); ?>">
                                                <input type="number" name="featured_order" class="form-control"
                                                       value="<?php echo html_escape($item->featured_order); ?>" min="1" max="99999">
                                            </div>
                                            <div class="slider-order-right">
                                                <button type="submit" class="btn btn-sm btn-success"><i
                                                            class="fa fa-check"></i></button>
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </td>
                                <?php endif; ?>
                                <td><?php echo $item->created_at; ?></td>

                                <td>
                                    <!-- form delete user -->
                                    <?php echo form_open('admin_post/post_options_post'); ?>

                                    <input type="hidden" name="id" value="<?php echo html_escape($item->id); ?>">

                                    <div class="dropdown">
                                        <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                type="button"
                                                data-toggle="dropdown"><?php echo trans('select_an_option'); ?>
                                            <span class="caret"></span>
                                        </button>

                                        <ul class="dropdown-menu pull-right options-list">

                                            <?php if ($item->post_type == "video"): ?>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>admin_video/update_video/<?php echo html_escape($item->id); ?>">
                                                        <i class="fa fa-edit i-edit"></i><?php echo trans('edit'); ?></a>
                                                </li>
                                            <?php elseif ($item->post_type == "audio"): ?>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>audio/update_audio/<?php echo html_escape($item->id); ?>">
                                                        <i class="fa fa-edit i-edit"></i><?php echo trans('edit'); ?></a>
                                                </li>
                                            <?php else: ?>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>admin_post/update_post/<?php echo html_escape($item->id); ?>">
                                                        <i class="fa fa-edit i-edit"></i><?php echo trans('edit'); ?></a>
                                                </li>
                                            <?php endif; ?>


                                            <?php if (is_admin()): ?>
                                                <?php if ($item->is_slider == 1): ?>
                                                    <li>
                                                        <a class="p0">
                                                            <button type="submit" name="option" value="add-remove-from-slider" class="btn-list-button">
                                                                <i class="fa fa-times i-delete"></i><?php echo trans('remove_slider'); ?>
                                                            </button>
                                                        </a>
                                                    </li>
                                                <?php else: ?>
                                                    <li>
                                                        <a class="p0">
                                                            <button type="submit" name="option" value="add-remove-from-slider" class="btn-list-button">
                                                                <i class="fa fa-plus i-delete"></i><?php echo trans('add_slider'); ?>
                                                            </button>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>


                                                <?php if ($item->is_featured == 1): ?>
                                                    <li>
                                                        <a class="p0">
                                                            <button type="submit" name="option" value="add-remove-from-featured" class="btn-list-button">
                                                                <i class="fa fa-times i-delete"></i><?php echo trans('remove_featured'); ?>
                                                            </button>
                                                        </a>
                                                    </li>
                                                <?php else: ?>
                                                    <li>
                                                        <a class="p0">
                                                            <button type="submit" name="option" value="add-remove-from-featured" class="btn-list-button">
                                                                <i class="fa fa-plus i-delete"></i><?php echo trans('add_featured'); ?>
                                                            </button>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if ($item->is_breaking == 1): ?>
                                                    <li>
                                                        <a class="p0">
                                                            <button type="submit" name="option" value="add-remove-from-breaking" class="btn-list-button">
                                                                <i class="fa fa-times i-delete"></i><?php echo trans('remove_breaking'); ?>
                                                            </button>
                                                        </a>
                                                    </li>
                                                <?php else: ?>
                                                    <li>
                                                        <a class="p0">
                                                            <button type="submit" name="option" value="add-remove-from-breaking" class="btn-list-button">
                                                                <i class="fa fa-plus i-delete"></i><?php echo trans('add_breaking'); ?>
                                                            </button>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if ($item->is_recommended == 1): ?>
                                                    <li>
                                                        <a class="p0">
                                                            <button type="submit" name="option" value="add-remove-from-recommended" class="btn-list-button">
                                                                <i class="fa fa-times i-delete"></i><?php echo trans('remove_recommended'); ?>
                                                            </button>
                                                        </a>
                                                    </li>
                                                <?php else: ?>
                                                    <li>
                                                        <a class="p0">
                                                            <button type="submit" name="option" value="add-remove-from-recommended" class="btn-list-button">
                                                                <i class="fa fa-plus i-delete"></i><?php echo trans('add_recommended'); ?>
                                                            </button>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                            <li>
                                                <a class="p0">
                                                    <button type="submit" name="option" value="delete"
                                                            class="btn-list-button"
                                                            onclick="return confirm('<?php echo trans("confirm_post"); ?>');">
                                                        <i class="fa fa-trash i-delete"></i><?php echo trans('delete'); ?>
                                                    </button>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>

                                    <?php echo form_close(); ?><!-- form end -->

                                </td>
                            </tr>

                        <?php endforeach; ?>

                        </tbody>
                    </table>

                    <div class="col-sm-12">
                        <div class="row">

                            <div class="pull-right">
                                <?php echo $this->pagination->create_links(); ?>
                            </div>

                            <?php if (count($posts) > 0): ?>
                                <div class="pull-left">
                                    <button class="btn btn-sm btn-danger btn-table-delete" onclick="delete_selected_posts('<?php echo trans("confirm_posts"); ?>');"><?php echo trans('delete'); ?></button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div><!-- /.box-body -->
</div>