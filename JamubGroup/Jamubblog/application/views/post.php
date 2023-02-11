<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Section: wrapper -->
<div id="wrapper">
    <div class="container">
        <div class="row">

            <!-- breadcrumb -->
            <div class="col-sm-12 page-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo base_url(); ?>"><?php echo trans("breadcrumb_home"); ?></a>
                    </li>
                    <?php if (!empty($category)): ?>
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url(); ?>category/<?php echo html_escape($category->name_slug); ?>">
                                <?php echo html_escape($category->name); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (!empty($subcategory)): ?>
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url(); ?>category/<?php echo html_escape($subcategory->name_slug); ?>">
                                <?php echo html_escape($subcategory->name); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="breadcrumb-item active"> <?php echo html_escape(character_limiter($post->title, 160, '...')); ?></li>
                </ol>
            </div>

            <div id="content" class="col-sm-8 col-xs-12">

                <div class="post-content">

                    <?php if (!empty($subcategory)): ?>

                        <p class="m-0">
                            <a href="<?php echo base_url(); ?>category/<?php echo html_escape($subcategory->name_slug) ?>">
                                <label class="category-label"
                                       style="background-color: <?php echo html_escape($subcategory->color); ?>">
                                    <?php echo html_escape($subcategory->name); ?>
                                </label>
                            </a>
                        </p>

                    <?php else: ?>

                        <?php if (!empty($category)): ?>
                            <p class="m-0">
                                <a href="<?php echo base_url(); ?>category/<?php echo html_escape($category->name_slug) ?>">
                                    <label class="category-label"
                                           style="background-color: <?php echo html_escape($category->color); ?>">
                                        <?php echo html_escape($category->name); ?>
                                    </label>
                                </a>
                            </p>
                        <?php endif; ?>

                    <?php endif; ?>

                    <h1 class="title"><?php echo html_escape($post->title); ?></h1>

                    <p class="post-meta">
                        <?php if ($settings->show_post_author == 1): ?>
                            <span class="post-author-meta sp-left">
            <a href="<?php echo base_url(); ?>profile/<?php echo html_escape($post->user_slug); ?>">
                <img src="<?php echo get_user_avatar_by_id($post->user_id); ?>"
                     alt="<?php echo html_escape($post->username); ?>">
                <?php echo html_escape($post->username); ?>
            </a>
        </span>
                        <?php endif; ?>

                        <?php if ($settings->show_post_date == 1): ?>
                            <span class="sp-left"><?php echo helper_date_format($post->created_at); ?></span>
                        <?php endif; ?>

                        <?php if ($settings->show_hits): ?>
                            <span class="sp-right"><i class="fa fa-eye"></i><?php echo $post->hit; ?></span>
                        <?php endif; ?>

                        <?php if ($settings->comment_system == 1): ?>
                            <span class="sp-right"><i
                                        class="fa fa-comments-o"></i><?php echo get_post_comment_count($post->id); ?></span>
                        <?php endif; ?>
                    </p>

                    <div class="post-share">
                        <!--include Social Share -->
                        <?php $this->load->view('partials/_post_share_box'); ?>
                    </div>

                    <?php if ($post->post_type == "video"): ?>
                        <!-- Include audio post details -->
                        <?php $this->load->view('partials/_post_details_video', ['post' => $post]); ?>

                    <?php elseif ($post->post_type == "audio"): ?>
                        <!-- Include audio post details -->
                        <?php $this->load->view('partials/_post_details_audio', ['post' => $post]); ?>

                    <?php else: ?>
                        <!-- Include audio post details -->
                        <?php $this->load->view('partials/_post_details', ['post' => $post]); ?>

                    <?php endif; ?>

                    <?php $this->load->view("partials/_ad_spaces", ["ad_space" => "post_top", "class" => "bn-p-t-20"]); ?>

                    <div class="post-text">
                        <?php echo $post->content; ?>
                    </div>

                    <!--Optional Url Button -->
                    <?php if (!empty($post->optional_url)) : ?>
                        <div class="optional-url-cnt">
                            <a href="<?php echo html_escape($post->optional_url); ?>" class="btn btn-primary btn-custom"
                               target="_blank">
                                <?php echo html_escape($settings->optional_url_button_name); ?>&nbsp;&nbsp;&nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    <?php endif; ?>

                    <!--Optional Url Button -->
                    <?php if (isset($feed)): ?>
                        <?php if ($feed->read_more_button == 1): ?>
                            <div class="optional-url-cnt">
                                <a href="<?php echo $post->post_url; ?>" class="btn btn-primary btn-custom" target="_blank">
                                    <?php echo htmlspecialchars($feed->read_more_button_text); ?>&nbsp;&nbsp;&nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="post-tags">
                        <?php if (!isset($feed)): ?>
                            <h2 class="tags-title"><?php echo trans("title_post_tags"); ?></h2>
                            <ul class="tag-list">
                                <?php foreach ($post_tags as $tag) : ?>
                                    <li>
                                        <a href="<?php echo base_url() . 'tag/' . html_escape($tag->tag_slug); ?>">
                                            <?php echo html_escape($tag->tag); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>


                    <div class="post-share post-share-bottom">
                        <div class="share-left">
                            <h3 class="share-title"><i class="fa fa-share-alt"></i> <?php echo trans("title_share"); ?>
                            </h3>
                        </div>
                        <div class="share-right">
                            <!--include Social Share -->
                            <?php $this->load->view('partials/_post_share_box_bottom'); ?>
                        </div>
                    </div>

                </div>

                <!--include next previous post -->
                <?php $this->load->view('partials/_post_next_prev', ['previous_post' => $previous_post, 'next_post' => $next_post]); ?>

                <!--Include banner-->
                <?php $this->load->view("partials/_ad_spaces", ["ad_space" => "post_bottom", "class" => "bn-p-b"]); ?>

                <!--include about author -->
                <?php if ($settings->show_post_author == 1): ?>
                    <?php $this->load->view('partials/_post_about_author', ['post_user' => $post_user]); ?>
                <?php endif; ?>

                <section class="section section-related-posts">
                    <div class="section-head">
                        <h4 class="title"><?php echo trans("title_related_posts"); ?></h4>
                    </div>

                    <div class="section-content">
                        <div class="row">
                            <?php $i = 0; ?>
                            <?php foreach ($related_posts as $item): ?>

                                <?php if ($i > 0 && $i % 2 == 0): ?>
                                    <div class="col-sm-12"></div>
                                <?php endif; ?>

                                <!--include post item-->
                                <div class="col-sm-6 col-xs-12">
                                    <?php $this->load->view("partials/_post_item", ["post" => $item]); ?>
                                </div>

                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>


                <?php if ($settings->comment_system == 1 || $settings->facebook_comment_active == 1): ?>

                    <section id="comments" class="section section-related-posts">
                        <div class="section-head">
                            <ul class="nav nav-tabs comment-nav-tabs">
                                <?php if ($settings->comment_system == 1): ?>
                                    <li class="active">
                                        <a data-toggle="tab" href="#comment_tab_1">
                                            <h4 class="title"><?php echo html_escape(trans("title_comments")); ?>
                                                &nbsp;(<?php echo get_post_comment_count($post->id); ?>)</h4>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($settings->facebook_comment_active == 1): ?>
                                    <li class="<?php echo ($settings->comment_system != 1) ? 'active' : ''; ?>">
                                        <a data-toggle="tab" href="#comment_tab_2">
                                            <h4 class="title"><?php echo html_escape(trans("title_facebook_comments")); ?>
                                                (<span class="fb-comments-count"
                                                       data-href="<?php echo current_url(); ?>">0</span>)</h4>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>


                        <div class="tab-content">
                            <div id="comment_tab_1"
                                 class="tab-pane fade <?php echo ($settings->comment_system == 1) ? 'in active' : ''; ?>">
                                <!--Comment Box-->

                                <div class="col-sm-12">
                                    <div class="row row-make-comment">
                                        <?php if (auth_check()): ?>
                                            <!-- form make comment -->
                                            <form id="make-comment" method="post">
                                                <input type="hidden" name="post_id" value="<?php echo $post->id; ?>">
                                                <input type="hidden" name="user_id" value="<?php echo user()->id; ?>">
                                                <input type="hidden" name="parent_id" value="0">

                                                <div class="form-group">
                                            <textarea id="parent-comment-text"
                                                      class="form-control form-input form-textarea" name="comment"
                                                      maxlength="4999"
                                                      placeholder="<?php echo html_escape(trans("title_leave_reply")); ?>"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-custom pull-right">
                                                        <?php echo html_escape(trans("btn_submit")); ?>
                                                    </button>

                                                </div>
                                            </form><!-- form end -->
                                        <?php else: ?>
                                            <div class="form-group">
                                        <textarea class="form-control form-input form-textarea" name="comment"
                                                  maxlength="4999"
                                                  placeholder="<?php echo html_escape(trans("placeholder_comment")); ?>"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <a href="#" data-toggle="modal" data-target="#modal-login"
                                                   class="btn btn-primary btn-custom pull-right">
                                                    <?php echo html_escape(trans("btn_submit")); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div id="comment-result" class="row row-comments">
                                        <?php $this->load->view('partials/_comments', ['comments' => $comments, 'comment_post_id' => $post->id]); ?>
                                    </div>
                                    <input type="hidden" id="vr_comment_limit" value="5">
                                </div>

                            </div>
                            <div id="comment_tab_2"
                                 class="tab-pane fade <?php echo ($settings->comment_system != 1) ? 'in active' : ''; ?>">
                                <div class="col-sm-12">
                                    <div class="row row-make-comment">
                                        <div class="fb-comments" data-href="" data-width="100%" data-numposts="5"
                                             data-colorscheme="light"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                <?php endif; ?>


            </div>

            <div id="sidebar" class="col-sm-4 col-xs-12">
                <!--include sidebar -->
                <?php $this->load->view('partials/_sidebar'); ?>

            </div>
        </div>
    </div>


</div>
<!-- /.Section: wrapper -->



