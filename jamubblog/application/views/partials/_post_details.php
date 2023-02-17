<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="post-image">
    <?php if ($post_image_count > 0) : ?>
        <!-- owl-carousel -->
        <div class="owl-carousel post-detail-slider" id="post-detail-slider">

            <div class="post-detail-slider-item">
                <a class="image-popup-no-title lightbox" href="<?php echo base_url() . $post->image_big; ?>" title="<?php echo html_escape($post->title); ?>">
                    <img src="<?php echo base_url() . html_escape($post->image_default); ?>"
                         class="img-responsive center-image"
                         alt="<?php echo html_escape($post->title); ?>"/>
                </a>
            </div>

            <!--List  random slider posts-->
            <?php foreach ($post_images as $image): ?>
                <!-- slider item -->
                <div class="post-detail-slider-item">

                    <a class="image-popup-no-title lightbox" href="<?php echo base_url() . $image->image_big; ?>" title="<?php echo html_escape($post->title); ?>">
                        <img src="<?php echo base_url() . html_escape($image->image_default); ?>"
                             class="img-responsive center-image"
                             alt="<?php echo html_escape($post->title); ?>"/>
                    </a>

                </div>
            <?php endforeach; ?>

        </div>

    <?php else: ?>

        <?php if (!empty($post->image_default)): ?>
            <a class="image-popup-no-title lightbox" href="<?php echo base_url() . $post->image_big; ?>" title="<?php echo html_escape($post->title); ?>">
                <img src="<?php echo base_url() . html_escape($post->image_default); ?>"
                     class="img-responsive center-image"
                     alt="<?php echo html_escape($post->title); ?>"/>
            </a>
        <?php endif; ?>

    <?php endif; ?>
</div>