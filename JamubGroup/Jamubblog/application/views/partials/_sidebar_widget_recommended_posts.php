<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--Widget: Recommended Posts-->
<div class="sidebar-widget">
    <div class="widget-head">
        <h4 class="title"><?php echo html_escape($widget->title); ?></h4>
    </div>
    <div class="widget-body">
        <ul class="recommended-posts">


            <!--Print Picked Posts-->
            <?php $count = 0; ?>
            <?php foreach ($recommended_posts as $post): ?>

                <?php $post_category = get_post_category($post); ?>

                <?php if ($count == 0): ?>
                    <li class="recommended-posts-first">

                        <div class="post-item-image">
                            <a href="<?php echo base_url(); ?>post/<?php echo html_escape($post->title_slug); ?>">

                                <?php if ($post->post_type == "video"): ?>
                                    <img src="<?php echo base_url(); ?>assets/img/icon_play.svg" alt="icon" class="post-icon post-icon-md"/>
                                <?php endif; ?>
                                <?php if ($post->post_type == "audio"): ?>
                                    <img src="<?php echo base_url(); ?>assets/img/icon_music.svg" alt="icon" class="post-icon post-icon-md"/>
                                <?php endif; ?>

                                <img src="<?php echo $img_bg_mid; ?>" data-src="<?php echo base_url() . $post->image_mid; ?>" alt="<?php echo html_escape($post->title); ?>" class="lazy img-responsive"/>
                                <div class="overlay"></div>
                            </a>
                        </div>

                        <div class="caption">
                            <a href="<?php echo base_url(); ?>category/<?php echo html_escape($post_category['name_slug']); ?>">
                                <label class="category-label"
                                       style="background-color: <?php echo html_escape($post_category['color']); ?>"><?php echo html_escape($post_category['name']); ?></label>
                            </a>
                            <h3 class="title">
                                <a href="<?php echo base_url(); ?>post/<?php echo html_escape($post->title_slug); ?>">
                                    <?php echo html_escape(character_limiter($post->title, 55, '...')); ?>
                                </a>
                            </h3>

                            <p class="small-post-meta">
                                <?php if ($settings->show_post_author == 1): ?>
                                    <a href="<?php echo base_url(); ?>profile/<?php echo html_escape($post->user_slug); ?>"><?php echo html_escape($post->username); ?></a>
                                <?php endif; ?>
                                <?php if ($settings->show_post_date == 1): ?>
                                    <span><?php echo helper_date_format($post->created_at); ?></span>
                                <?php endif; ?>
                                <?php if ($settings->comment_system == 1): ?>
                                    <span><i class="fa fa-comments-o"></i><?php echo get_post_comment_count($post->id); ?></span>
                                <?php endif; ?>
                                <?php if ($settings->show_hits): ?>
                                    <span class="m-r-0"><i class="fa fa-eye"></i><?php echo $post->hit; ?></span>
                                <?php endif; ?>
                            </p>

                        </div>
                    </li>
                <?php else: ?>

                    <li>
                        <?php $this->load->view("partials/_post_item_small", ["post" => $post]); ?>
                    </li>
                <?php endif; ?>

                <?php $count++; ?>
            <?php endforeach; ?>

        </ul>
    </div>
</div>