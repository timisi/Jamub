<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--Partial: Footer Random Posts-->
<div class="footer-widget f-widget-random">
    <div class="col-sm-12">
        <div class="row">
            <h4 class="title"><?php echo html_escape(trans("footer_random_posts")); ?></h4>
            <div class="title-line"></div>
            <ul class="f-random-list">

                <!--List random posts-->
                <?php foreach ($footer_random_posts as $item): ?>
                    <li>
                        <?php if (!empty($item->image_small)): ?>
                            <div class="list-left">

                                <?php if ($item->post_type == "video"): ?>
                                    <img src="<?php echo base_url(); ?>assets/img/icon_play.svg" alt="icon" class="post-icon post-icon-sm"/>
                                <?php endif; ?>
                                <?php if ($item->post_type == "audio"): ?>
                                    <img src="<?php echo base_url(); ?>assets/img/icon_music.svg" alt="icon" class="post-icon post-icon-sm"/>
                                <?php endif; ?>

                                <a href="<?php echo base_url() . 'post/' . html_escape($item->title_slug); ?>">
                                    <?php if (!empty($item->image_small)): ?>
                                        <img src="" data-src="<?php echo base_url() . $item->image_small; ?>" alt="<?php echo html_escape($item->title); ?>" class="lazy"/>
                                    <?php endif; ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="list-right <?php echo (empty($item->image_mid)) ? 'p-0-im' : ''; ?>">
                            <h5 class="title">
                                <a href="<?php echo base_url() . 'post/' . html_escape($item->title_slug); ?>">
                                    <?php echo html_escape(character_limiter($item->title, 55, '...')); ?>
                                </a>
                            </h5>
                        </div>

                    </li>
                <?php endforeach; ?>

            </ul>
        </div>
    </div>
</div>
