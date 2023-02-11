<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php foreach ($last_posts as $post): ?>

    <!--include horizontal post item-->
    <?php $this->load->view("partials/_post_item_horizontal", ["post" => $post, "show_label" => true]); ?>

<?php endforeach; ?>

<?php if ($this->session->userdata("vr_last_posts_limit") >= $total_posts_count): ?>
    <style>
        .btn-load-more {
            display: none;
        }
    </style>
<?php endif; ?>
