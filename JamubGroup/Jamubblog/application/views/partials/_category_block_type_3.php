<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--Category Block Type 3-->
<div class="col-sm-12 col-xs-12">
    <div class="row">
        <section class="section section-block-3">
            <div class="section-head" style="border-bottom: 2px solid <?php echo html_escape($category->color); ?>;">
                <h4 class="title" style="background-color: <?php echo html_escape($category->color); ?>">
                    <a href="<?php echo base_url(); ?>category/<?php echo html_escape($category->name_slug) ?>" style="color: <?php echo html_escape($category->color); ?>">
                        <?php echo html_escape($category->name); ?>
                    </a>
                </h4>

                <!--Include subcategories-->
                <?php $this->load->view('partials/_block_subcategories', ['category' => $category]); ?>

            </div><!--End section-head-->


            <div class="section-content">
                <div class="tab-content pull-left">

                    <div role="tabpanel" class="tab-pane fade in active" id="all-<?php echo html_escape($category->id); ?>">

                        <div class="row">
                            <?php $category_posts = helper_get_last_posts_by_category($category->id, 5); ?>
                            <?php foreach ($category_posts as $post): ?>

                                <?php $post_category = get_post_category($post); ?>

                                <!--include post item-->
                                <div class="col-sm-6 col-xs-12">
                                    <?php $this->load->view("partials/_post_item", ["post" => $post]); ?>
                                </div>
                                <?php break; ?>
                            <?php endforeach; ?>

                            <div class="col-sm-6">
                                <!--Print latest posts by category-->
                                <?php $count = 0; ?>
                                <?php foreach ($category_posts as $post): ?>
                                    <?php if ($count > 0): ?>

                                        <!--include small post item-->
                                        <?php $this->load->view("partials/_post_item_small", ["post" => $post]); ?>

                                    <?php endif; ?>
                                    <?php $count++; ?>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    </div>


                    <?php foreach (helper_get_subcategories($category->id) as $subcategory): ?>

                        <div role="tabpanel" class="tab-pane fade in " id="<?php echo html_escape($subcategory->name_slug); ?>-<?php echo html_escape($subcategory->id); ?>">

                            <div class="row">
                                <?php $subcategory_posts = helper_get_last_posts_by_subcategory($subcategory->id, 5); ?>
                                <?php foreach ($subcategory_posts as $post): ?>

                                    <!--include post item-->
                                    <div class="col-sm-6 col-xs-12">
                                        <?php $this->load->view("partials/_post_item", ["post" => $post]); ?>
                                    </div>
                                    <?php break; ?>
                                <?php endforeach; ?>

                                <div class="col-sm-6">
                                    <!--Print latest posts by category-->
                                    <?php $count = 0; ?>
                                    <?php foreach ($subcategory_posts as $post): ?>
                                        <?php if ($count > 0): ?>

                                            <!--include small post item-->
                                            <?php $this->load->view("partials/_post_item_small", ["post" => $post]); ?>

                                        <?php endif; ?>
                                        <?php $count++; ?>
                                    <?php endforeach; ?>
                                </div>

                            </div>
                        </div>

                    <?php endforeach; ?>

                </div>

            </div><!--End section-content-->
        </section><!--End section block 1-->
    </div>
</div>