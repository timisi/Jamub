<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--Post item small-->
<div class="post-item-small">
    <?php if (!empty($post->image_mid)): ?>
        <div class="left">
            <a href="<?php echo base_url(); ?>post/<?php echo html_escape($post->title_slug); ?>">

                <?php if ($post->post_type == "video"): ?>
                    <img src="<?php echo base_url(); ?>assets/img/icon_play.svg" alt="icon" class="post-icon post-icon-sm"/>
                <?php endif; ?>
                <?php if ($post->post_type == "audio"): ?>
                    <img src="<?php echo base_url(); ?>assets/img/icon_music.svg" alt="icon" class="post-icon post-icon-sm"/>
                <?php endif; ?>

                <img src="<?php echo $img_bg_sm; ?>" data-src="<?php echo base_url() . $post->image_small; ?>" alt="<?php echo html_escape($post->title); ?>" class="lazy img-responsive"/>
            </a>
        </div>
    <?php endif; ?>

    <div class="right <?php echo (empty($post->image_mid)) ? 'p-0-im' : ''; ?>">
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
</div>