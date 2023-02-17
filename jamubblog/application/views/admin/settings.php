<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-md-12">

        <!-- form start -->
        <?php echo form_open_multipart('admin/settings_post'); ?>

        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><?php echo trans('general_settings'); ?></a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><?php echo trans('email_settings'); ?></a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false"><?php echo trans('contact_settings'); ?></a></li>
                <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false"><?php echo trans('social_media_settings'); ?></a></li>
                <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false"><?php echo trans('facebook_comments'); ?></a></li>
                <li class=""><a href="#tab_6" data-toggle="tab" aria-expanded="false"><?php echo trans('head_code'); ?></a></li>
                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content settings-tab-content">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>

                <div class="tab-pane active" id="tab_1">

                    <div class="form-group">
                        <label class="control-label"><?php echo trans('language'); ?></label>

                        <select name="site_lang" class="form-control custom-select">
                            <option value="english" <?php echo ($settings->site_lang == "english") ? "selected" : ""; ?>><?php echo trans('english'); ?></option>
                            <option value="french" <?php echo ($settings->site_lang == "french") ? "selected" : ""; ?>><?php echo trans('french'); ?></option>
                            <option value="german" <?php echo ($settings->site_lang == "german") ? "selected" : ""; ?>><?php echo trans('german'); ?></option>
                            <option value="italian" <?php echo ($settings->site_lang == "italian") ? "selected" : ""; ?>><?php echo trans('italian'); ?></option>
                            <option value="portuguese" <?php echo ($settings->site_lang == "portuguese") ? "selected" : ""; ?>><?php echo trans('portuguese'); ?></option>
                            <option value="russian" <?php echo ($settings->site_lang == "russian") ? "selected" : ""; ?>><?php echo trans('russian'); ?></option>
                            <option value="spanish" <?php echo ($settings->site_lang == "spanish") ? "selected" : ""; ?>><?php echo trans('spanish'); ?></option>
                            <option value="turkish" <?php echo ($settings->site_lang == "turkish") ? "selected" : ""; ?>><?php echo trans('turkish'); ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo trans('app_name'); ?></label>
                        <input type="text" class="form-control" name="application_name" placeholder="<?php echo trans('app_name'); ?>"
                               value="<?php echo html_escape($settings->application_name); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo trans('footer_about_section'); ?></label>
                        <textarea class="form-control text-area" name="about_footer" placeholder="<?php echo trans('footer_about_section'); ?>"
                                  style="min-height: 140px;"><?php echo html_escape($settings->about_footer); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo trans('optional_url_name'); ?></label>
                        <input type="text" class="form-control" name="optional_url_button_name"
                               placeholder="<?php echo trans('optional_url_name'); ?>"
                               value="<?php echo html_escape($settings->optional_url_button_name); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo trans('copyright'); ?></label>
                        <input type="text" class="form-control" name="copyright"
                               placeholder="<?php echo trans('copyright'); ?>"
                               value="<?php echo html_escape($settings->copyright); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo trans('pagination_number_posts'); ?></label>
                        <input type="number" class="form-control" name="pagination_per_page" value="<?php echo html_escape($settings->pagination_per_page); ?>" min="0" required style="max-width: 200px;">
                    </div>

                </div><!-- /.tab-pane -->

                <div class="tab-pane" id="tab_2">

                    <div class="form-group">
                        <label class="control-label"><?php echo trans('mail_protocol'); ?></label>

                        <select name="mail_protocol" class="form-control custom-select">
                            <option value="smtp" <?php echo ($settings->mail_protocol == "smtp") ? "selected" : ""; ?>><?php echo trans('smtp'); ?></option>
                            <option value="mail" <?php echo ($settings->mail_protocol == "mail") ? "selected" : ""; ?>><?php echo trans('mail'); ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo trans('mail_title'); ?></label>
                        <input type="text" class="form-control" name="mail_title"
                               placeholder="<?php echo trans('mail_title'); ?>" value="<?php echo html_escape($settings->mail_title); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo trans('mail_host'); ?></label>
                        <input type="text" class="form-control" name="mail_host"
                               placeholder="<?php echo trans('mail_host'); ?>" value="<?php echo html_escape($settings->mail_host); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo trans('mail_port'); ?></label>
                        <input type="text" class="form-control" name="mail_port"
                               placeholder="<?php echo trans('mail_port'); ?>" value="<?php echo html_escape($settings->mail_port); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo trans('mail_username'); ?></label>
                        <input type="text" class="form-control" name="mail_username"
                               placeholder="<?php echo trans('mail_username'); ?>" value="<?php echo html_escape($settings->mail_username); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo trans('mail_password'); ?></label>
                        <input type="password" class="form-control" name="mail_password"
                               placeholder="<?php echo trans('mail_password'); ?>" value="<?php echo html_escape($settings->mail_password); ?>">
                    </div>

                    <div class="callout" style="max-width: 500px;margin-top: 30px;">
                        <h4><?php echo trans('gmail_smtp'); ?></h4>

                        <p><strong><?php echo trans('mail_host'); ?>:&nbsp;&nbsp;</strong>ssl://smtp.googlemail.com</p>
                        <p><strong><?php echo trans('mail_port'); ?>:&nbsp;&nbsp;</strong>465</p>
                    </div>


                </div><!-- /.tab-pane -->

                <div class="tab-pane" id="tab_3">
                    <div class="form-group">
                        <label class="control-label"><?php echo trans('address'); ?></label>
                        <input type="text" class="form-control" name="contact_address"
                               placeholder="<?php echo trans('address'); ?>" value="<?php echo html_escape($settings->contact_address); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo trans('email'); ?></label>
                        <input type="text" class="form-control" name="contact_email"
                               placeholder="<?php echo trans('email'); ?>" value="<?php echo html_escape($settings->contact_email); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo trans('phone'); ?></label>
                        <input type="text" class="form-control" name="contact_phone"
                               placeholder="<?php echo trans('phone'); ?>" value="<?php echo html_escape($settings->contact_phone); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo trans('google_map_key'); ?></label>
                        <input type="text" class="form-control" name="map_api_key"
                               placeholder="<?php echo trans('google_map_key'); ?>" value="<?php echo html_escape($settings->map_api_key); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo trans('latitude'); ?></label>
                        <input type="text" class="form-control" name="latitude"
                               placeholder="<?php echo trans('latitude'); ?>" value="<?php echo html_escape($settings->latitude); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo trans('longitude'); ?></label>
                        <input type="text" class="form-control" name="longitude"
                               placeholder="<?php echo trans('longitude'); ?>" value="<?php echo html_escape($settings->longitude); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo trans('contact_text'); ?></label>
                        <textarea id="ckEditor" class="form-control" name="contact_text"
                                  placeholder="<?php echo trans('contact_text'); ?>"><?php echo html_escape($settings->contact_text); ?></textarea>
                    </div>


                </div><!-- /.tab-pane -->

                <div class="tab-pane" id="tab_4">
                    <div class="form-group">
                        <label class="control-label">Facebook <?php echo trans('url'); ?></label>
                        <input type="text" class="form-control" name="facebook_url"
                               placeholder="Facebook <?php echo trans('url'); ?>" value="<?php echo html_escape($settings->facebook_url); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Twitter <?php echo trans('url'); ?></label>
                        <input type="text" class="form-control"
                               name="twitter_url" placeholder="Twitter <?php echo trans('url'); ?>"
                               value="<?php echo html_escape($settings->twitter_url); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Google <?php echo trans('url'); ?></label>
                        <input type="text" class="form-control"
                               name="google_url" placeholder="Google <?php echo trans('url'); ?>"
                               value="<?php echo html_escape($settings->google_url); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Instagram <?php echo trans('url'); ?></label>
                        <input type="text" class="form-control" name="instagram_url" placeholder="Instagram <?php echo trans('url'); ?>"
                               value="<?php echo html_escape($settings->instagram_url); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Pinterest <?php echo trans('url'); ?></label>
                        <input type="text" class="form-control" name="pinterest_url" placeholder="Pinterest <?php echo trans('url'); ?>"
                               value="<?php echo html_escape($settings->pinterest_url); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">LinkedIn <?php echo trans('url'); ?></label>
                        <input type="text" class="form-control" name="linkedin_url" placeholder="LinkedIn <?php echo trans('url'); ?>"
                               value="<?php echo html_escape($settings->linkedin_url); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">VK <?php echo trans('url'); ?></label>
                        <input type="text" class="form-control" name="vk_url"
                               placeholder="VK <?php echo trans('url'); ?>" value="<?php echo html_escape($settings->vk_url); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Youtube <?php echo trans('url'); ?></label>
                        <input type="text" class="form-control" name="youtube_url"
                               placeholder="Youtube <?php echo trans('url'); ?>" value="<?php echo html_escape($settings->youtube_url); ?>">
                    </div>
                </div>

                <div class="tab-pane" id="tab_5">

                    <div class="form-group">
                        <label class="control-label"><?php echo trans('facebook_comments_code'); ?></label>
                        <textarea class="form-control text-area" name="facebook_comment" placeholder="<?php echo trans('facebook_comments_code'); ?>"
                                  style="min-height: 140px;"><?php echo html_escape($settings->facebook_comment); ?></textarea>
                    </div>

                </div>

                <div class="tab-pane" id="tab_6">

                    <div class="form-group">
                        <label class="control-label"><?php echo trans('head_code'); ?></label>
                        <textarea class="form-control text-area" name="head_code" placeholder="<?php echo trans('head_code'); ?>"
                                  style="min-height: 140px;"><?php echo html_escape($settings->head_code); ?></textarea>
                    </div>

                </div><!-- /.tab-pane -->
            </div><!-- /.tab-content -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php echo trans('save_changes'); ?></button>
            </div>
        </div><!-- nav-tabs-custom -->

        <?php echo form_close(); ?>
    </div><!-- /.col -->
</div>
