<?php
get_header();

$default = 'cs';
if (apply_filters('change_layout_single', $default) == 'cs') {
    $colum_layout = 'cs';
} elseif (apply_filters('change_layout_single', $default) == 'sc') {
    $colum_layout = 'sc';
} elseif (apply_filters('change_layout_single', $default) == 'scs') {
    $colum_layout = 'scs';
} elseif (apply_filters('change_layout_single', $default) == 'c') {
    $colum_layout = 'c';
} else {
    $colum_layout = $default;
}
?>
    <main class="main">
        <div class="inner">
            <div class="content_main <?php echo $colum_layout; ?>">
                <div class="row_fix edit-single-post">
                    <?php
                    if (have_posts()) :
                        /* Start the Loop */
                        echo '<div class="content_single">';
                        while (have_posts()) : the_post();
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

            <div class="sidebar_main <?php echo $colum_layout; ?>">
                <div class="row_fix">
                    <?php get_sidebar(); ?>
                </div>
            </div>

        </div>
    </main><!-- #main -->
<?php

get_footer();
