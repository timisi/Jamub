<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h1 class="title-index"><?php echo html_escape($page->title); ?></h1>

<!--Include featured section-->
<?php if ($settings->show_featured_section == 1): ?>
    <?php $this->load->view('partials/_featured_posts', $featured_posts); ?>
<?php endif; ?>

<div id="wrapper" class="index-wrapper m-t-0">
    <div class="container">
        <div class="row">

            <!--Include news ticker-->
            <?php $this->load->view('partials/_news_ticker', $news_ticker_posts); ?>

            <div class="col-sm-12 col-xs-12 bn-header-mobile">
                <div class="row">
                    <?php $this->load->view("partials/_ad_spaces", ["ad_space" => "header", "class" => ""]); ?>
                </div>
            </div>

            <div id="content" class="col-sm-8 col-xs-12">

                <?php
                $x = 0;
                foreach ($categories as $category): ?>
                    <?php if ($category->show_at_homepage == 1): ?>

                        <?php if ($category->block_type == "block-1"): ?>
                            <!--Include Block 1-->
                            <?php $this->load->view('partials/_category_block_type_1', ['category' => $category]); ?>

                        <?php endif; ?>

                        <?php if ($category->block_type == "block-2"): ?>
                            <!--Include Block 2-->
                            <?php $this->load->view('partials/_category_block_type_2', ['category' => $category]); ?>
                        <?php endif; ?>

                        <?php if ($category->block_type == "block-3"): ?>
                            <!--Include Block 3-->
                            <?php $this->load->view('partials/_category_block_type_3', ['category' => $category]); ?>
                        <?php endif; ?>

                        <?php if ($category->block_type == "block-4"): ?>
                            <!--Include Block 4-->
                            <?php $this->load->view('partials/_category_block_type_4', ['category' => $category]); ?>
                        <?php endif; ?>

                        <?php if ($category->block_type == "block-5"): ?>
                            <!--Include Block 5-->
                            <?php $this->load->view('partials/_category_block_type_5', ['category' => $category]); ?>
                        <?php endif; ?>

                        <?php if ($x == 0): ?>
                            <!--Include banner-->
                            <?php $this->load->view("partials/_ad_spaces", ["ad_space" => "index_top", "class" => "bn-p-b"]); ?>
                        <?php
                        endif;
                        $x++;
                    endif;
                endforeach;
                ?>

                <!--Include banner-->
                <?php $this->load->view("partials/_ad_spaces", ["ad_space" => "index_bottom", "class" => "bn-p-b"]); ?>

                <!--Index Latest Posts-->
                <?php if ($settings->show_latest_posts == 1): ?>


                    <?php if (count($last_posts) > 0): ?>
                        <div class="col-sm-12 col-xs-12">
                            <div class="row">
                                <section class="section">
                                    <div class="section-head">
                                        <h4 class="title">
                                            <a href="<?php echo base_url(); ?>posts">
                                                <?php echo trans("title_latest_posts"); ?>
                                            </a>
                                        </h4>

                                        <a href="<?php echo base_url(); ?>posts" class="a-view-all">
                                            <?php echo trans("view_all_posts"); ?>&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i>
                                        </a>
                                    </div><!--End section head-->

                                    <div class="section-content">
                                        <div class="row latest-articles">
                                            <div id="last_posts_content">
                                                <?php $this->load->view('partials/_index_latest_posts', ["last_posts" => $last_posts, "total_posts_count" => $total_posts_count]); ?>
                                            </div>
                                        </div>
                                    </div><!--End section content-->

                                    <div id="load_posts_spinner" class="col-sm-12 col-xs-12 load-more-spinner">
                                        <div class="row">
                                            <div class="spinner">
                                                <div class="bounce1"></div>
                                                <div class="bounce2"></div>
                                                <div class="bounce3"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-xs-12">
                                        <div class="row">
                                            <button class="btn-load-more" onclick="load_more_posts();">
                                                <?php echo trans("load_more"); ?>
                                            </button>
                                        </div>
                                    </div>

                                </section><!--End section-->
                            </div>
                        </div>
                    <?php endif; ?>


                <?php endif; ?>
            </div>

            <div id="sidebar" class="col-sm-4 col-xs-12">
                <!--include sidebar -->
                <?php $this->load->view('partials/_sidebar'); ?>

            </div>
        </div>
    </div>

</div>