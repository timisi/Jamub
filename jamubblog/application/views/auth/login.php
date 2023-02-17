<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Section: wrapper -->
<section id="wrapper">
    <div class="container">
        <div class="row">

            <!-- breadcrumb -->
            <div class="col-sm-12 page-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo base_url(); ?>"><?php echo trans("breadcrumb_home"); ?></a>
                    </li>
                    <li class="breadcrumb-item active"><?php echo $title; ?></li>
                </ol>
            </div>

            <div class="col-sm-12 page-login">
                <div class="row">
                    <div class="col-sm-6 col-xs-12 login-box-cnt center-box">
                        <div class="login-box">
                            <div class="box-head">
                                <h1 class="auth-title font-1"><?php echo trans("title_login"); ?></h1>
                            </div>
                            <div class="box-body">

                                <?php if ($settings->registration_system == 1): ?>
                                    <?php if ($fb_login_state == 1 || $google_login_state == 1): ?>
                                        <p class="p-auth-modal">
                                            <?php echo trans("login_with_social"); ?>
                                        </p>
                                    <?php else: ?>
                                        <p>&nbsp;</p>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if ($settings->registration_system != 1): ?>
                                    <p>&nbsp;</p>
                                <?php endif; ?>


                                <?php if ($settings->registration_system == 1): ?>
                                    <div class="row row-login-ext">
                                        <?php if ($fb_login_state == 1): ?>
                                            <div class="col-xs-6 <?php echo ($google_login_state != 1) ? 'col-sm-12' : 'col-sm-6'; ?>">
                                                <a href="<?php echo $facebook_login_url; ?>" class="btn-login-ext btn-login-facebook">
                                                    <span class="icon"><i class="ion-social-facebook"></i></span>
                                                    <span class="text"><?php echo trans("facebook"); ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($google_login_state == 1): ?>
                                            <div class="col-xs-6 <?php echo ($fb_login_state != 1) ? 'col-sm-12' : 'col-sm-6'; ?>">
                                                <a href="<?php echo $google_plus_login_url; ?>" class="btn-login-ext btn-login-google">
                                                    <span class="icon"> <i class="ion-social-googleplus"></i> </span>
                                                    <span class="text"><?php echo trans("google"); ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($settings->registration_system == 1): ?>
                                    <?php if ($fb_login_state == 1 || $google_login_state == 1): ?>
                                        <p class="p-auth-modal-or">
                                            <span><?php echo trans("or"); ?></span>
                                        </p>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <!-- form start -->
                                <?php echo form_open("auth/login_post"); ?>

                                <!-- include message block -->
                                <?php $this->load->view('partials/_messages'); ?>

                                <?php if ($settings->registration_system == 1): ?>
                                    <input type="hidden" name="user_type" value="user">
                                <?php else: ?>
                                    <input type="hidden" name="user_type" value="admin">
                                <?php endif; ?>

                                <div class="form-group has-feedback">
                                    <input type="email" name="email" class="form-control form-input"
                                           placeholder="<?php echo trans("placeholder_email"); ?>"
                                           value="<?php echo old('email'); ?>" required>
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                </div>

                                <div class="form-group has-feedback">
                                    <input type="password" name="password" class="form-control form-input"
                                           placeholder="<?php echo trans("placeholder_password"); ?>"
                                           value="<?php echo old('password'); ?>" required>
                                    <span class=" glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>

                                <div class="row">
                                    <div class="col-sm-7 col-xs-7">
                                        <input type="checkbox" id="remember_me" name="remember_me" value="1" class="flat-blue" checked>&nbsp;&nbsp;
                                        <label for="remember_me" class="label-remember"><?php echo trans("remember_me"); ?></label>
                                    </div>
                                    <div class="col-sm-5 col-xs-5">
                                        <button type="submit" class="btn btn-primary btn-custom pull-right">
                                            <?php echo trans("btn_login"); ?>
                                        </button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?><!-- form end -->

                            </div>

                            <div class="box-footer">
                                <a href="<?php echo base_url(); ?>reset-password" class="link-forget">
                                    <?php echo trans("title_forgot_password"); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.Section: wrapper -->

