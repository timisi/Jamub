<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<ul class="share-box">
    <li class="share-li-lg">
        <a href="javascript:void(0)"
           onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url(); ?>post/<?php echo html_escape($post->title_slug); ?>', 'Share This Post', 'width=640,height=450');return false"
           class="social-btn-sm facebook">
            <i class="fa fa-facebook"></i>
            <span><?php echo trans("facebook"); ?></span>
        </a>
    </li>

    <li class="share-li-lg">
        <a href="javascript:void(0)"
           onclick="window.open('https://twitter.com/share?url=<?php echo base_url(); ?>post/<?php echo html_escape($post->title_slug); ?>&amp;text=<?php echo html_escape($post->title); ?>', 'Share This Post', 'width=640,height=450');return false"
           class="social-btn-sm twitter">
            <i class="fa fa-twitter"></i>
            <span><?php echo trans("twitter"); ?></span>
        </a>
    </li>
    <li class="share-li-lg">
        <a href="javascript:void(0)"
           onclick="window.open('https://plus.google.com/share?url=<?php echo base_url(); ?>post/<?php echo html_escape($post->title_slug); ?>', 'Share This Post', 'width=640,height=450');return false"
           class="social-btn-sm google">
            <i class="fa fa-google-plus"></i>
            <span><?php echo trans("google"); ?></span>
        </a>
    </li>


    <li class="share-li-sm">
        <a href="javascript:void(0)"
           onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url(); ?>post/<?php echo html_escape($post->title_slug); ?>', 'Share This Post', 'width=640,height=450');return false"
           class="social-btn-sm facebook">
            <i class="fa fa-facebook"></i>
        </a>
    </li>

    <li class="share-li-sm">
        <a href="javascript:void(0)"
           onclick="window.open('https://twitter.com/share?url=<?php echo base_url(); ?>post/<?php echo html_escape($post->title_slug); ?>&amp;text=<?php echo html_escape($post->title); ?>', 'Share This Post', 'width=640,height=450');return false"
           class="social-btn-sm twitter">
            <i class="fa fa-twitter"></i>
        </a>
    </li>

    <li class="share-li-sm">
        <a href="javascript:void(0)"
           onclick="window.open('https://plus.google.com/share?url=<?php echo base_url(); ?>post/<?php echo html_escape($post->title_slug); ?>', 'Share This Post', 'width=640,height=450');return false"
           class="social-btn-sm google">
            <i class="fa fa-google-plus"></i>
        </a>
    </li>

    <li>
        <a href="javascript:void(0)"
           onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo base_url(); ?>post/<?php echo html_escape($post->title_slug); ?>', 'Share This Post', 'width=640,height=450');return false"
           class="social-btn-sm linkedin">
            <i class="fa fa-linkedin"></i>
        </a>
    </li>
    <li>
        <a href="javascript:void(0)"
           onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php echo base_url(); ?>post/<?php echo html_escape($post->title_slug); ?>&amp;media=<?php echo base_url() . html_escape($post->image_default); ?>', 'Share This Post', 'width=640,height=450');return false"
           class="social-btn-sm pinterest">
            <i class="fa fa-pinterest"></i>
        </a>
    </li>
    <li>
        <a href="javascript:void(0)"
           onclick="window.open('http://www.tumblr.com/share/link?url=<?php echo base_url(); ?>post/<?php echo html_escape($post->title_slug); ?>&amp;title=<?php echo html_escape($post->title); ?>', 'Share This Post', 'width=640,height=450');return false"
           class="social-btn-sm tumblr">
            <i class="fa fa-tumblr"></i>
        </a>
    </li>
    <li>
        <a href="javascript:void(0)" id="print_post" class="social-btn-sm btn-print">
            <i class="fa fa-print"></i>
        </a>
    </li>

</ul>



