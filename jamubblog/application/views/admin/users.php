<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php echo trans('users'); ?></h3>
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
                    <table class="table table-bordered table-striped dataTable" id="cs_datatable" role="grid"
                           aria-describedby="example1_info">
                        <thead>
                        <tr role="row">
                            <th width="20"><?php echo trans('id'); ?></th>
                            <th><?php echo trans('avatar'); ?></th>
                            <th><?php echo trans('username'); ?></th>
                            <th><?php echo trans('email'); ?></th>
                            <th><?php echo trans('role'); ?></th>
                            <th><?php echo trans('status'); ?></th>
                            <th><?php echo trans('date'); ?></th>
                            <th class="max-width-120"><?php echo trans('options'); ?></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo html_escape($user->id); ?></td>
                                <td>
                                    <img src="<?php echo get_user_avatar($user); ?>" alt="user" class="img-responsive" style="height: 50px;">
                                </td>
                                <td><?php echo html_escape($user->username); ?></td>
                                <td><?php echo html_escape($user->email); ?></td>
                                <td>
                                    <?php if ($user->role == "admin"): ?>
                                        <label class="label bg-olive"><?php echo trans('admin'); ?></label>
                                    <?php elseif ($user->role == "author"): ?>
                                        <label class="label label-warning"><?php echo trans('author'); ?></label>
                                    <?php else: ?>
                                        <label class="label label-default"><?php echo trans('user'); ?></label>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($user->status == 1): ?>
                                        <label class="label label-success"><?php echo trans('active'); ?></label>
                                    <?php else: ?>
                                        <label class="label label-danger"><?php echo trans('banned'); ?></label>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo nice_date($user->created_at, 'd.m.Y'); ?></td>

                                <td>
                                    <!-- form delete user -->
                                    <?php echo form_open('admin/user_options_post'); ?>

                                    <input type="hidden" name="id" value="<?php echo html_escape($user->id); ?>">

                                    <div class="dropdown">
                                        <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                type="button"
                                                data-toggle="dropdown"><?php echo trans('select_an_option'); ?>
                                            <span class="caret"></span>
                                        </button>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="p0">
                                                    <button type="button" class="btn-list-button" data-toggle="modal"
                                                            data-target="#myModal"
                                                            onclick="$('#modal_user_id').val('<?php echo html_escape($user->id); ?>');">
                                                        <i class="fa fa-user i-edit"></i><?php echo trans('change_user_role'); ?>
                                                    </button>
                                                </a>
                                            </li>
                                            <?php if ($user->status == "1"): ?>
                                                <li>
                                                    <a class="p0">
                                                        <button type="submit" name="option" value="ban" class="btn-list-button"
                                                                onclick="return confirm('<?php echo trans("confirm_ban"); ?>');">
                                                            <i class="fa fa-stop-circle i-delete"></i><?php echo trans('ban_user'); ?>
                                                        </button>
                                                    </a>
                                                </li>
                                            <?php else: ?>
                                                <li>
                                                    <a class="p0">
                                                        <button type="submit" name="option" value="remove_ban" class="btn-list-button"
                                                                onclick="return confirm('<?php echo trans("confirm_remove_ban"); ?>');">
                                                            <i class="fa fa-stop-circle i-delete"></i><?php echo trans('remove_ban'); ?>
                                                        </button>
                                                    </a>
                                                </li>
                                            <?php endif; ?>


                                            <li>
                                                <a href="<?php echo base_url(); ?>admin/update_profile/<?php echo html_escape($user->id); ?>">
                                                    <i class="fa fa-edit i-edit"></i><?php echo trans('edit'); ?></a>
                                            </li>

                                            <li>
                                                <a class="p0">
                                                    <button type="submit" name="option" value="delete"
                                                            class="btn-list-button"
                                                            onclick="return confirm('<?php echo trans("confirm_user"); ?>');">
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
                </div>
            </div>
        </div>
    </div><!-- /.box-body -->
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo trans('change_user_role'); ?></h4>
            </div>
            <?php echo form_open('admin/change_user_role_post'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">

                        <input type="hidden" name="user_id" id="modal_user_id" value="">

                        <div class="col-sm-4">
                            <input type="radio" name="role" value="admin" id="role_admin"
                                   class="square-purple" required>
                            <label for="role_admin" class="option-label"><?php echo trans('admin'); ?></label>
                        </div>
                        <div class="col-sm-4">
                            <input type="radio" name="role" value="author" id="role_editor"
                                   class="square-purple" required>
                            <label for="role_editor" class="option-label"><?php echo trans('author'); ?></label>

                        </div>
                        <div class="col-sm-4">
                            <input type="radio" name="role" value="user" id="role_user"
                                   class="square-purple" required>
                            <label for="role_user" class="option-label"><?php echo trans('user'); ?></label>

                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success"><?php echo trans('save'); ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('close'); ?></button>
            </div>

            <?php echo form_close(); ?><!-- form end -->
        </div>

    </div>
</div>