<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view("partials/_ad_spaces", ["ad_space" => "sidebar_top", "class" => "p-b-30"]); ?>

<?php foreach ($widgets as $widget): ?>

    <?php if ($widget->visibility == 1): ?>

        <?php if ($widget->type == "popular-posts"): ?>

            <div class="row">
                <div class="col-sm-12">
                    <!--Include Widget Popular Posts-->
                    <?php $this->load->view('partials/_sidebar_widget_popular_posts', ['widget' => $widget]); ?>
                </div>
            </div>

        <?php endif; ?>


        <?php if ($widget->type == "recommended-posts"): ?>

            <div class="row">
                <div class="col-sm-12">
                    <!--Include Widget Our Picks-->
                    <?php $this->load->view('partials/_sidebar_widget_recommended_posts', ['widget' => $widget]); ?>
                </div>
            </div>

        <?php endif; ?>


        <?php if ($widget->type == "random-slider-posts"): ?>

            <div class="row">
                <div class="col-sm-12">
                    <!--Include Widget Random Slider-->
                    <?php $this->load->view('partials/_sidebar_widget_random_slider', ['widget' => $widget]); ?>
                </div>
            </div>

        <?php endif; ?>

        <?php if ($widget->type == "tags"): ?>

            <div class="row">
                <div class="col-sm-12">
                    <!--Include Widget Tags-->
                    <?php $this->load->view('partials/_sidebar_widget_tags', ['widget' => $widget]); ?>
                </div>
            </div>

        <?php endif; ?>

        <?php if ($widget->type == "poll"): ?>

            <div class="row">
                <div class="col-sm-12">
                    <!--Include Widget Comments-->
                    <?php $this->load->view('partials/_sidebar_widget_polls', ['widget' => $widget]); ?>
                </div>
            </div>

        <?php endif; ?>

        <?php if ($widget->type == "custom"): ?>

            <div class="row">
                <div class="col-sm-12">
                    <!--Include Widget Custom-->
                    <?php $this->load->view('partials/_sidebar_widget_custom', ['widget' => $widget]); ?>
                </div>
            </div>

        <?php endif; ?>

    <?php endif; ?>

<?php endforeach; ?>

    <!--Include banner-->
<?php $this->load->view("partials/_ad_spaces", ["ad_space" => "sidebar_bottom", "class" => ""]); ?>