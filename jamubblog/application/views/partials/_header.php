<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo html_escape($title); ?> - <?php echo html_escape($settings->site_title); ?></title>
    <meta name="description" content="<?php echo html_escape($description); ?>"/>
    <meta name="keywords" content="<?php echo html_escape($keywords); ?>"/>
    <meta name="author" content="Codingest"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:site_name" content="<?php echo $settings->application_name; ?>"/>
<?php if (isset($post_type)): ?>
    <meta property="og:type" content="<?php echo $og_type; ?>"/>
    <meta property="og:title" content="<?php $og_title; ?>"/>
    <meta property="og:description" content="<?php echo $og_description; ?>"/>
    <meta property="og:url" content="<?php echo $og_url; ?>"/>
    <meta property="og:image" content="<?php echo $og_image; ?>"/>
    <meta property="og:image:width" content="<?php echo $og_width; ?>"/>
    <meta property="og:image:height" content="<?php echo $og_height; ?>"/>
    <meta property="article:author" content="<?php echo $og_author; ?>"/>
<?php foreach ($og_tags as $tag): ?>
    <meta property="article:tag" content="<?php echo $tag->tag; ?>"/>
<?php endforeach; ?>
    <meta property="article:published_time" content="<?php echo $og_published_time; ?>"/>
    <meta property="article:modified_time" content="<?php echo $og_modified_time; ?>"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@<?php echo html_escape($settings->application_name); ?>"/>
    <meta name="twitter:creator" content="@<?php echo html_escape($og_creator); ?>"/>
    <meta name="twitter:title" content="<?php echo html_escape($post->title); ?>"/>
    <meta name="twitter:description" content="<?php echo html_escape($post->summary); ?>"/>
    <meta name="twitter:image" content="<?php echo $og_image; ?>"/>
 <?php else: ?>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="<?php echo html_escape($title); ?> - <?php echo html_escape($settings->site_title); ?>"/>
    <meta property="og:description" content="<?php echo html_escape($description); ?>"/>
    <meta property="og:url" content="<?php echo base_url(); ?>"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@<?php echo html_escape($settings->application_name); ?>"/>
    <meta name="twitter:title" content="<?php echo html_escape($title); ?> - <?php echo html_escape($settings->site_title); ?>"/>
    <meta name="twitter:description" content="<?php echo html_escape($description); ?>"/>
<?php endif; ?>
    <link rel="shortcut icon" type="image/png" href="<?php echo get_favicon($vsettings); ?>"/>
    <!-- Font-awesome CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
    <!-- Simple-line-icons CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet"/>
    <!-- Ionicons CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css"/>
    <?php echo $primary_font_url; ?>
    <?php echo $secondary_font_url; ?>
    <?php echo $tertiary_font_url; ?>
    <!-- Owl Carousel -->
    <link href="<?php echo base_url(); ?>assets/vendor/owl-carousel/owl.carousel.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/vendor/owl-carousel/owl.theme.default.min.css" rel="stylesheet"/>
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/icheck/minimal/grey.css"/>
    <!-- Jquery Confirm CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/jquery-confirm/jquery-confirm.min.css" rel="stylesheet"/>
    <!-- Magnific Popup-->
    <link href="<?php echo base_url(); ?>assets/vendor/magnific-popup/magnific-popup.css" rel="stylesheet"/>
<?php if (isset($post_type) && $post_type == "audio"): ?>
    <link href="<?php echo base_url(); ?>assets/vendor/audio-player/css/amplitude.min.css" rel="stylesheet"/>
<?php endif; ?>
<?php if (isset($post_type) && $post_type == "video"): ?>
     <link href="<?php echo base_url(); ?>assets/vendor/video-player/video-js.min.css" rel="stylesheet"/>
<?php endif; ?>
    <!-- Style -->
    <link href="<?php echo base_url(); ?>assets/css/style.min.css" rel="stylesheet"/>
    <!-- Color CSS -->
<?php if ($vsettings->site_color == '') : ?>
    <link href="<?php echo base_url(); ?>assets/css/colors/default.css" rel="stylesheet"/>
<?php else : ?>
    <link href="<?php echo base_url(); ?>assets/css/colors/<?php echo html_escape($vsettings->site_color); ?>.css" rel="stylesheet"/>
<?php endif; ?>
    <!-- Responsive -->
    <link href="<?php echo base_url(); ?>assets/css/responsive.min.css" rel="stylesheet"/>
    <!--Include Font Style-->
    <?php $this->load->view('partials/_font_style'); ?>
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php echo $settings->google_analytics; ?>
    <?php echo $settings->head_code; ?>
</head>
<body>

<header id="header">

    <div class="top-bar">
        <div class="container">

            <div class="col-sm-12">
                <div class="row">
                    <ul class="top-menu top-menu-left">
                        <!--Print top menu pages-->
                        <?php foreach ($main_menu as $menu_item): ?>
                            <?php if ($menu_item['visibility'] == 1 && $menu_item['location'] == "top"): ?>
                                <li>
                                    <a href="<?php echo $menu_item['link']; ?>"><?php echo html_escape($menu_item['title']); ?> </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <?php if (auth_check()): ?>
                            <?php if (user()->role == "admin" || user()->role == "author") { ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin"><?php echo trans("admin_panel"); ?></a>
                                </li>
                            <?php } ?>
                        <?php endif; ?>
                    </ul>

                    <ul class="top-menu top-menu-right">
                        <!--Check auth-->
                        <?php if (auth_check()): ?>
                            <li class="dropdown profile-dropdown">
                                <a class="dropdown-toggle a-profile" data-toggle="dropdown" href="#"
                                   aria-expanded="false">
                                    <img src="<?php echo html_escape(get_user_avatar(user())) ?>" alt="<?php echo html_escape(user()->username); ?>">
                                    <?php echo html_escape(user()->username); ?> <span class="fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <?php if (user()->role == "admin" || user()->role == "author") { ?>
                                        <li>
                                            <a href="<?php echo base_url(); ?>profile/<?php echo user()->slug; ?>">
                                                <i class="fa fa-bars"></i>
                                                <?php echo trans("my_posts"); ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <li>
                                        <a href="<?php echo base_url(); ?>reading-list">
                                            <i class="fa fa-star"></i>
                                            <?php echo trans("title_reading_list"); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>profile-update">
                                            <i class="fa fa-user"></i>
                                            <?php echo trans("update_profile"); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>change-password">
                                            <i class="fa fa-lock"></i>
                                            <?php echo trans("change_password"); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>logout">
                                            <i class="fa fa-sign-out"></i>
                                            <?php echo trans("logout"); ?>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        <?php else: ?>
                            <?php if ($settings->registration_system == 1): ?>
                                <li class="top-li-auth">
                                    <a href="#" data-toggle="modal"
                                       data-target="#modal-login"><?php echo trans("login"); ?></a>
                                    <span>/</span>
                                    <a href="<?php echo base_url(); ?>register"><?php echo trans("register"); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>

                    <ul class="top-menu top-menu-social <?php echo ($this->settings->registration_system != 1 && !auth_check()) ? 'm-0-imp' : ''; ?>">
                        <!--Include social media links-->
                        <?php $this->load->view('partials/_social_media_links', ['rss_hide' => false]); ?>
                    </ul>

                </div>
            </div>
        </div><!--/.container-->
    </div><!--/.top-bar-->

    <div class="logo-banner">
        <div class="container">

            <div class="col-sm-12">
                <div class="row">

                    <div class="left">
                        <a href="<?php echo base_url(); ?>">
                            <img src="<?php echo get_logo($vsettings); ?>" alt="logo" class="logo">
                        </a>
                    </div>

                    <div class="right">
                        <div class="pull-right">
                            <!--Include banner-->
                            <?php $this->load->view("partials/_ad_spaces", ["ad_space" => "header"]); ?>
                        </div>
                    </div>

                </div>
            </div>

        </div><!--/.container-->
    </div><!--/.top-bar-->

    <nav class="navbar navbar-default main-menu megamenu">
        <div class="container">

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse">
                <div class="row">

                    <ul class="nav navbar-nav">
                        <?php $total_item = 0; ?>
                        <?php $menu_item_count = 1; ?>

                        <?php foreach ($main_menu as $menu_item): ?>

                            <?php if ($menu_item['visibility'] == 1 && $menu_item['location'] == "main" && $menu_item['parent_id'] == "0"): ?>
                                <?php if ($menu_item_count <= $settings->menu_limit): ?>

                                    <?php $sub_links = helper_get_sub_menu_links($menu_item['id'], $menu_item['type']); ?>

                                    <?php if ($menu_item['type'] == "category"): ?>

                                        <?php if (!empty($sub_links)): ?>
                                            <!--Include mega menu-->
                                            <?php $this->load->view('partials/_megamenu_multicategory', ['item_id' => $menu_item['id']]); ?>
                                        <?php else: ?>
                                            <!--Include mega menu-->
                                            <?php $this->load->view('partials/_megamenu_singlecategory', ['item_id' => $menu_item['id']]); ?>
                                        <?php endif; ?>

                                    <?php else: ?>


                                        <?php if (!empty($sub_links)): ?>

                                            <li class="dropdown <?php echo (uri_string() == 'category/' . $menu_item['slug'] ||
                                                uri_string() == $menu_item['slug'] || (uri_string() == "" && $menu_item['slug'] == "index")) ? 'active' : ''; ?>">
                                                <a class="dropdown-toggle disabled" data-toggle="dropdown"
                                                   href="<?php echo $menu_item['link']; ?>">
                                                    <?php echo html_escape($menu_item['title']); ?>
                                                    <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu dropdown-more dropdown-top">

                                                    <?php foreach ($sub_links as $sub_item): ?>
                                                        <?php if ($sub_item["visibility"] == 1): ?>
                                                            <li>
                                                                <a role="menuitem" href="<?php echo $sub_item['link']; ?>">
                                                                    <?php echo html_escape($sub_item['title']); ?>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>


                                                </ul>
                                            </li>

                                        <?php else: ?>
                                            <li class="<?php echo (uri_string() == 'category/' . $menu_item['slug'] ||
                                                uri_string() == $menu_item['slug'] || (uri_string() == "" && $menu_item['slug'] == "index")) ? 'active' : ''; ?>">
                                                <a href="<?php echo $menu_item['link']; ?>">
                                                    <?php echo html_escape($menu_item['title']); ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>


                                    <?php endif; ?>


                                    <?php $menu_item_count++; ?>
                                <?php endif; ?>
                                <?php $total_item++; ?>
                            <?php endif; ?>

                        <?php endforeach; ?>

                        <?php if ($total_item > $settings->menu_limit): ?>
                            <li class="dropdown">
                                <a class="dropdown-toggle dropdown-more-icon" data-toggle="dropdown" href="#">
                                    <i class="fa fa-ellipsis-h"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-more dropdown-top">
                                    <?php $menu_item_count = 1; ?>
                                    <?php foreach ($main_menu as $menu_item): ?>

                                        <?php if ($menu_item['visibility'] == 1 && $menu_item['location'] == "main" && $menu_item['parent_id'] == "0"): ?>
                                            <?php if ($menu_item_count > $settings->menu_limit): ?>

                                                <?php $sub_links = helper_get_sub_menu_links($menu_item['id'], $menu_item['type']); ?>

                                                <?php if (!empty($sub_links)): ?>

                                                    <li class="dropdown-more-item">
                                                        <a class="dropdown-toggle disabled" data-toggle="dropdown" href="<?php echo $menu_item['link']; ?>">
                                                            <?php echo html_escape($menu_item['title']); ?> <span class="ion-android-arrow-dropright"></span>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-sub">
                                                            <?php foreach ($sub_links as $sub_item): ?>
                                                                <?php if ($sub_item["visibility"] == 1): ?>
                                                                    <li>
                                                                        <a role="menuitem"
                                                                           href="<?php echo $sub_item['link']; ?>">
                                                                            <?php echo html_escape($sub_item['title']); ?>
                                                                        </a>
                                                                    </li>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </li>

                                                <?php else: ?>
                                                    <li>
                                                        <a href="<?php echo $menu_item['link']; ?>">
                                                            <?php echo html_escape($menu_item['title']); ?>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>


                                            <?php endif; ?>

                                            <?php $menu_item_count++; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="li-search">
                            <a class="search-icon"><i class="fa fa-search"></i></a>
                            <div class="search-form">
                                <?php echo form_open('search', ['method' => 'get']); ?>
                                <input type="text" name="q" maxlength="300" pattern=".*\S+.*"
                                       class="form-control form-input"
                                       placeholder="<?php echo trans("placeholder_search"); ?>" required>
                                <button class="btn btn-default"><i class="fa fa-search"></i></button>
                                <?php echo form_close(); ?>
                            </div>
                        </li>
                    </ul>

                </div>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>

    <div class="col-sm-12">
        <div class="row">

            <div class="nav-mobile">

                <div class="logo-cnt">
                    <a href="<?php echo base_url(); ?>">
                        <img src="<?php echo get_logo($vsettings); ?>" alt="logo" class="logo">
                    </a>
                </div>

                <div class="mobile-nav-search">
                    <a class="search-icon"><i class="fa fa-search"></i></a>
                    <div class="search-form">
                        <?php echo form_open('search', ['method' => 'get']); ?>
                        <input type="text" name="q" maxlength="300" pattern=".*\S+.*"
                               class="form-control form-input"
                               placeholder="<?php echo trans("placeholder_search"); ?>" required>
                        <button class="btn btn-default"><i class="fa fa-search"></i></button>
                        <?php echo form_close(); ?>
                    </div>
                </div>

                <span onclick="open_mobile_nav();" class="mobile-menu-icon"><i class="ion-navicon-round"></i> </span>

            </div>
        </div>
    </div>

</header>

<div id="mobile-menu" class="mobile-menu">
    <div class="mobile-menu-inner">
        <p class="text-right p-close-menu">
            <a href="javascript:void(0)" class="closebtn" onclick="close_mobile_nav();"><i
                        class="ion-ios-close-empty"></i></a>
        </p>

        <div class="col-sm-12">
            <div class="row">
                <nav class="navbar">
                    <ul class="nav navbar-nav">

                        <?php foreach ($main_menu as $menu_item): ?>
                            <?php if ($menu_item['visibility'] == 1 && $menu_item['location'] == "main" && $menu_item['parent_id'] == "0"): ?>


                                <?php $sub_links = helper_get_sub_menu_links($menu_item['id'], $menu_item['type']); ?>

                                <?php if (!empty($sub_links)): ?>

                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                           aria-haspopup="true" aria-expanded="true">
                                            <?php echo html_escape($menu_item['title']) ?>
                                            <span class="ion-chevron-down mobile-dropdown-arrow"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <?php if ($menu_item['type'] == "category"): ?>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>category/<?php echo html_escape($menu_item['slug']) ?>"><?php echo trans("all"); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php foreach ($sub_links as $sub): ?>
                                                <li>
                                                    <a href="<?php echo $sub['link']; ?>">
                                                        <?php echo html_escape($sub['title']) ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>

                                        </ul>
                                    </li>

                                <?php else: ?>
                                    <li>
                                        <a href="<?php echo $menu_item['link']; ?>">
                                            <?php echo html_escape($menu_item['title']); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>


                            <?php endif; ?>
                        <?php endforeach; ?>

                        <?php if (auth_check()): ?>
                            <?php if (user()->role == "admin" || user()->role == "author") { ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin"><?php echo trans("admin_panel"); ?></a>
                                </li>
                            <?php } ?>
                        <?php endif; ?>


                        <!--Check auth-->
                        <?php if (auth_check()): ?>
                            <li class="dropdown profile-dropdown">
                                <a class="dropdown-toggle a-profile" data-toggle="dropdown" href="#"
                                   aria-expanded="false">
                                    <img src="<?php echo html_escape(get_user_avatar(user())) ?>" alt="<?php echo html_escape(user()->username); ?>">
                                    <?php echo html_escape(user()->username); ?> <span class="fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php if (user()->role == "admin" || user()->role == "author") { ?>
                                        <li>
                                            <a href="<?php echo base_url(); ?>profile/<?php echo user()->slug; ?>">
                                                <i class="fa fa-bars"></i>
                                                <?php echo trans("my_posts"); ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <li>
                                        <a href="<?php echo base_url(); ?>reading-list">
                                            <i class="fa fa-star"></i>
                                            <?php echo trans("title_reading_list"); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>profile-update">
                                            <i class="fa fa-user"></i>
                                            <?php echo trans("update_profile"); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>change-password">
                                            <i class="fa fa-lock"></i>
                                            <?php echo trans("change_password"); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>logout">
                                            <i class="fa fa-sign-out"></i>
                                            <?php echo trans("logout"); ?>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        <?php else: ?>
                            <?php if ($settings->registration_system == 1): ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>login"
                                       class="close-menu-click"><?php echo trans("login"); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>register"
                                       class="close-menu-click"><?php echo trans("register"); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>

                    </ul>
                </nav>
            </div>

            <div class="row">
                <div class="mobile-search">
                    <?php echo form_open('search', ['method' => 'get']); ?>
                    <input type="text" name="q" maxlength="300" pattern=".*\S+.*" class="form-control form-input"
                           placeholder="<?php echo trans("placeholder_search"); ?>" required>
                    <button class="btn btn-default"><i class="fa fa-search"></i></button>
                    <?php echo form_close(); ?>
                </div>
            </div>

            <div class="row">
                <ul class="mobile-menu-social">
                    <!--Include social media links-->
                    <?php $this->load->view('partials/_social_media_links'); ?>
                </ul>
            </div>

        </div>


    </div>

</div>

<!--Include modals-->
<?php $this->load->view('partials/_modals'); ?>


