<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--Post row item-->
<div class="col-sm-12 col-xs-12">
    <div class="row">
        <div class="post-item-horizontal">

            <?php if (isset($show_label)): ?>

                <?php $post_category = get_post_category($post); ?>

                <?php if (!empty($post_category['id'])):
                    if (!empty($post->image_mid)): ?>
                        <a href="<?php echo base_url(); ?>category/<?php echo html_escape($post_category['name_slug']); ?>">
                            <label class="category-label" style="background-color: <?php echo html_escape($post_category['color']); ?>"><?php echo html_escape($post_category['name']); ?></label>
                        </a>
                    <?php else: ?>
                        <a href="<?php echo base_url(); ?>category/<?php echo html_escape($post_category['name_slug']); ?>">
                            <label class="category-label category-label-relative l-15-im" style="background-color: <?php echo html_escape($post_category['color']); ?>"><?php echo html_escape($post_category['name']); ?></label>
                        </a>
                    <?php endif;
                endif; ?>

            <?php endif; ?>

            <?php if (!empty($post->image_mid)): ?>
                <div class="col-sm-5 col-xs-12 item-image">
                    <div class="post-item-image">
                        <a href="<?php echo base_url(); ?>post/<?php echo html_escape($post->title_slug); ?>">

                            <?php if ($post->post_type == "video"): ?>
                                <img src="<?php echo base_url(); ?>assets/img/icon_play.svg" alt="icon" class="post-icon post-icon-md"/>
                            <?php endif; ?>
                            <?php if ($post->post_type == "audio"): ?>
                                <img src="<?php echo base_url(); ?>assets/img/icon_music.svg" alt="icon" class="post-icon post-icon-md"/>
                            <?php endif; ?>

                            <?php if (!empty($post->image_mid)): ?>
                                <img src="<?php echo $img_bg_mid; ?>" data-src="<?php echo base_url() . html_escape($post->image_mid); ?>" alt="<?php echo html_escape($post->title); ?>" class="lazy img-responsive post-image"/>
                            <?php endif; ?>

                        </a>
                    </div>
                </div>
            <?php endif; ?>


            <div class="<?php echo (empty($post->image_mid)) ? 'col-sm-12' : 'col-sm-7'; ?> col-xs-12 item-content">
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

                <p class="description">
                    <?php echo html_escape(character_limiter($post->summary, 130, '...')); ?>
                </p>
            </div>
        </div>
    </div>
</div>