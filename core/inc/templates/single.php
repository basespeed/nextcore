<?php
get_header();
?>
    <main class="main">
        <div class="inner">
            <div class="content_main">
                <div class="row_fix edit-single-post">
                    <?php
                    if ( have_posts() ) :
                        /* Start the Loop */
                        echo '<div class="content_single">';
                        while ( have_posts() ) : the_post();
                        do_action('hook_loop_single_post');
                        /**
                         * Hook: hook_loop_single_post.
                         *
                         * @hooked hook_loop_single_post_image - 1
                         * @hooked hook_loop_single_post_title - 5
                         * @hooked hook_loop_single_post_count_view - 10
                         * @hooked hook_loop_single_post_content - 15
                         * @hooked hook_loop_single_post_comments_facebook - 20
                         */
                        endwhile;
                        echo '</div>';
                    else :
                        //empty
                    endif
                    ?>
                </div>
            </div>

            <div class="sidebar_main">
                <div class="row_fix">
                    <?php get_sidebar(); ?>
                </div>
            </div>

        </div>
    </main><!-- #main -->
<?php
get_footer();
