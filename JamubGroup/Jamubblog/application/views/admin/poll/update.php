<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans('update_poll'); ?></h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('poll/update_poll_post'); ?>

            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>

                <input type="hidden" name="id" value="<?php echo html_escape($poll->id); ?>">

                <div class="form-group">
                    <label class="control-label"><?php echo trans('question'); ?></label>
                    <textarea class="form-control text-area"
                              name="question" placeholder="<?php echo trans('question'); ?>" required><?php echo html_escape($poll->question); ?></textarea>

                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('option_1'); ?></label>
                    <input type="text" class="form-control" name="option1" placeholder="<?php echo trans('option_1'); ?>"
                           value="<?php echo html_escape($poll->option1); ?>" required>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('option_2'); ?></label>
                    <input type="text" class="form-control" name="option2" placeholder="<?php echo trans('option_2'); ?>"
                           value="<?php echo html_escape($poll->option2); ?>" required>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('option_3'); ?></label>
                    <input type="text" class="form-control" name="option3" placeholder="<?php echo trans('option_3'); ?> (<?php echo trans('optional'); ?>)"
                           value="<?php echo html_escape($poll->option3); ?>">
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('option_4'); ?></label>
                    <input type="text" class="form-control" name="option4" placeholder="<?php echo trans('option_4'); ?> (<?php echo trans('optional'); ?>)"
                           value="<?php echo html_escape($poll->option4); ?>">
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('option_5'); ?></label>
                    <input type="text" class="form-control" name="option5" placeholder="<?php echo trans('option_5'); ?> (<?php echo trans('optional'); ?>)"
                           value="<?php echo html_escape($poll->option5); ?>">
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('option_6'); ?></label>
                    <input type="text" class="form-control" name="option6" placeholder="<?php echo trans('option_6'); ?> (<?php echo trans('optional'); ?>)"
                           value="<?php echo html_escape($poll->option6); ?>">
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('option_7'); ?></label>
                    <input type="text" class="form-control" name="option7" placeholder="<?php echo trans('option_7'); ?> (<?php echo trans('optional'); ?>)"
                           value="<?php echo html_escape($poll->option7); ?>">
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('option_8'); ?></label>
                    <input type="text" class="form-control" name="option8" placeholder="<?php echo trans('option_8'); ?> (<?php echo trans('optional'); ?>)"
                           value="<?php echo html_escape($poll->option8); ?>">
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('option_9'); ?></label>
                    <input type="text" class="form-control" name="option9" placeholder="<?php echo trans('option_9'); ?> (<?php echo trans('optional'); ?>)"
                           value="<?php echo html_escape($poll->option9); ?>">
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('option_10'); ?></label>
                    <input type="text" class="form-control" name="option10" placeholder="<?php echo trans('option_10'); ?> (<?php echo trans('optional'); ?>)"
                           value="<?php echo html_escape($poll->option10); ?>">
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 col-lang">
                            <label><?php echo trans('vote_permission'); ?></label>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12 col-lang">
                            <input type="radio" name="vote_permission" value="all" id="vote_permission1" class="square-purple" <?php echo ($poll->vote_permission == "all") ? 'checked' : ''; ?>>
                            <label for="vote_permission1" class="option-label"><?php echo trans('all_users_can_vote'); ?></label>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12 col-lang">
                            <input type="radio" name="vote_permission" value="registered" id="vote_permission2" class="square-purple" <?php echo ($poll->vote_permission == "registered") ? 'checked' : ''; ?>>
                            <label for="vote_permission2" class="option-label"><?php echo trans('registered_users_can_vote'); ?></label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 col-lang">
                            <label><?php echo trans('status'); ?></label>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12 col-lang">
                            <input type="radio" name="status" value="1" id="status1" class="square-purple" <?php echo ($poll->status == "1") ? 'checked' : ''; ?>>
                            <label for="status1" class="option-label"><?php echo trans('active'); ?></label>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12 col-lang">
                            <input type="radio" name="status" value="0" id="status2" class="square-purple" <?php echo ($poll->status == "0") ? 'checked' : ''; ?>>
                            <label for="status2" class="option-label"><?php echo trans('inactive'); ?></label>
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
    </div>
</div>