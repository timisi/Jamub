<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$item = helper_get_category($item_id);
$category_posts = helper_get_last_posts_by_category($item->id, 5);
?>

<li class="dropdown megamenu-fw mega-li-<?php echo $item->id; ?> <?php echo (uri_string() == 'category/' . html_escape($item->name_slug)) ? 'active' : ''; ?>">
    <a href="<?php echo base_url(); ?>category/<?php echo html_escape($item->name_slug) ?>" class="dropdown-toggle disabled"
       data-toggle="dropdown" role="button" aria-expanded="false"><?php echo html_escape($item->name); ?>
        <span class="caret"></span>
    </a>

    <!--Check if has posts-->
    <?php if (count($category_posts) > 0): ?>
        <ul class="dropdown-menu megamenu-content dropdown-top" role="menu" data-mega-ul="<?php echo $item->id; ?>">
            <li>
                <div class="col-sm-12">
                    <div class="row">

                        <div class="sub-menu-right single-sub-menu">
                            <div class="row row-menu-right">

                                <?php foreach ($category_posts as $post): ?>

                                    <div class="col-sm-3 menu-post-item">

                                        <div class="post-item-image">
                                            <a href="<?php echo base_url(); ?>post/<?php echo html_escape($post->title_slug); ?>">

                                                <?php if ($post->post_type == "video"): ?>
                                                    <img src="<?php echo base_url(); ?>assets/img/icon_play.svg" alt="icon" class="post-icon post-icon-menu"/>
                                                <?php endif; ?>
                                                <?php if ($post->post_type == "audio"): ?>
                                                    <img src="<?php echo base_url(); ?>assets/img/icon_music.svg" alt="icon" class="post-icon post-icon-menu"/>
                                                <?php endif; ?>

                                                <?php if (!empty($post->image_mid)): ?>
                                                    <img src="<?php echo base_url() . $post->image_mid; ?>" alt="<?php echo html_escape($post->title); ?>" class="img-responsive"/>
                                                <?php else: ?>
                                                    <p>&nbsp;</p>
                                                <?php endif; ?>
                                            </a>
                                        </div>

                                        <h3 class="title">
                                            <a href="<?php echo base_url(); ?>post/<?php echo html_escape($post->title_slug); ?>">
                                                <?php echo html_escape(character_limiter($post->title, 55, '...')); ?>

                                            </a>
                                        </h3>
                                        <p class="post-meta">
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

                                <?php endforeach; ?>

                            </div>
                        </div>

                    </div>
                </div>
            </li>
        </ul>
    <?php endif; ?>
</li>


