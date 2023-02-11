<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="featured">
    <div class="container">

        <div class="featured-left">
            <!--Include Featured Slider-->
            <?php $this->load->view('partials/_featured_slider'); ?>
        </div>

        <div class="featured-right">
            <?php $count = 1; ?>
            <?php foreach ($featured_posts as $item): ?>
                <?php if ($count < 5): ?>
                    <?php $category = get_post_category($item); ?>
                    <div class="col-sm-6 col-xs-6 featured-box-<?php echo $count; ?>">
                        <div class="featured-box">

                            <a href="<?php echo base_url(); ?>category/<?php echo html_escape($category['name_slug']); ?>">
                                <label class="category-label"
                                       style="background-color: <?php echo html_escape($category['color']); ?>"><?php echo html_escape($category['name']); ?></label>
                            </a>

                            <a href="<?php echo base_url(); ?>post/<?php echo html_escape($item->title_slug); ?>">

                                <?php if (!empty($item->image_slider)): ?>

                                    <?php if ($item->post_type == "video"): ?>
                                        <img src="<?php echo base_url(); ?>assets/img/icon_play.svg" alt="icon" class="post-icon post-icon-md"/>
                                    <?php endif; ?>
                                    <?php if ($item->post_type == "audio"): ?>
                                        <img src="<?php echo base_url(); ?>assets/img/icon_music.svg" alt="icon" class="post-icon post-icon-md"/>
                                    <?php endif; ?>

                                    <img src="<?php echo base_url() . $item->image_slider; ?>" class="img-responsive" alt="<?php echo html_escape($item->title); ?>"/>
                                <?php else: ?>
                                    <img src="<?php echo base_url() . 'assets/img/img_bg_slider.jpg'; ?>" class="img-responsive" alt="<?php echo html_escape($item->title); ?>"/>
                                <?php endif; ?>

                                <div class="overlay"></div>
                                <div class="caption">
                                    <h3 class="title">
                                        <?php echo html_escape(character_limiter($item->title, 50, '...')); ?>
                                    </h3>

                                    <p class="post-meta">
                                        <?php if ($settings->show_post_author == 1): ?>
                                            <a href="<?php echo base_url(); ?>profile/<?php echo html_escape($item->user_slug); ?>"><?php echo html_escape($item->username); ?></a>
                                        <?php endif; ?>
                                        <?php if ($settings->show_post_date == 1): ?>
                                            <span><?php echo helper_date_format($item->created_at); ?></span>
                                        <?php endif; ?>
                                        <?php if ($settings->comment_system == 1): ?>
                                            <span><i class="fa fa-comments-o"></i><?php echo get_post_comment_count($item->id); ?></span>
                                        <?php endif; ?>
                                        <?php if ($settings->show_hits): ?>
                                            <span><i class="fa fa-eye"></i><?php echo $item->hit; ?></span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php $count++; ?>
            <?php endforeach; ?>
        </div>

    </div>
</div>