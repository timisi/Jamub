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
                                <h1 class="auth-title font-1"><?php echo trans("title_register"); ?></h1>
                            </div>

                            <div class="box-body">

                                <?php if ($fb_login_state == 1 || $google_login_state == 1): ?>
                                    <p class="p-auth-modal">
                                        <?php echo trans("register_with_social"); ?>
                                    </p>
                                <?php endif; ?>

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

                                <?php if ($fb_login_state == 1 || $google_login_state == 1): ?>
                                    <p class="p-auth-modal-or">
                                        <span><?php echo trans("or"); ?></span>
                                    </p>
                                <?php endif; ?>

                                <!-- form start -->
                                <?php echo form_open("auth/register_post", ['onsubmit' => "if (!check_captcha($('#captcha-mregister').val())) { $('#captcha-mregister').addClass('has-error'); return false };"]); ?>

                                <!-- include message block -->
                                <?php $this->load->view('partials/_messages'); ?>

                                <div class="form-group has-feedback">
                                    <input type="text" name="username" class="form-control form-input"
                                           placeholder="<?php echo trans("placeholder_username"); ?>"
                                           value="<?php echo old("username"); ?>" required>
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                </div>

                                <div class="form-group has-feedback">
                                    <input type="email" name="email" class="form-control form-input"
                                           placeholder="<?php echo trans("placeholder_email"); ?>"
                                           value="<?php echo old("email"); ?>" required>
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                </div>

                                <div class="form-group has-feedback">
                                    <input type="password" name="password" class="form-control form-input"
                                           placeholder="<?php echo trans("placeholder_password"); ?>"
                                           value="<?php echo old("password"); ?>" required>
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <input type="password" name="confirm_password" class="form-control form-input"
                                           placeholder="<?php echo trans("placeholder_confirm_password"); ?>" required>
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>

                                <div class="form-group has-feedback">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="captcha-cnt cap-register-cnt">
                                                <a class="captcha-refresh" onclick="refresh_captcha();"><i
                                                            class="fa fa-refresh"></i></a>
                                                <img class="img-captcha" id='imageCaptcha' alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group has-feedback">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="text" id="captcha-mregister" class="form-control pull-right form-input captcha-input"
                                                   placeholder="<?php echo trans("placeholder_captcha"); ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group has-feedback">
                                    <p class="register-terms"><?php echo trans("register_message"); ?>
                                        <a href="<?php echo base_url(); ?>user-agreement" target="_blank"><?php echo trans("user_agreement"); ?></a></p>
                                </div>


                                <div class="row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-custom pull-right margin-top-15">
                                            <?php echo trans("btn_register"); ?>
                                        </button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?><!-- form end -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.Section: wrapper -->

