<?php
get_header();
$default = 'cs';
if (apply_filters('change_layout_archive', $default) == 'cs') {
    $colum_layout = 'cs';
} elseif (apply_filters('change_layout_archive', $default) == 'sc') {
    $colum_layout = 'sc';
} elseif (apply_filters('change_layout_archive', $default) == 'scs') {
    $colum_layout = 'scs';
} elseif (apply_filters('change_layout_archive', $default) == 'c') {
    $colum_layout = 'c';
} else {
    $colum_layout = $default;
}
?>
    <main class="main">
        <div class="inner">
            <div class="content_main <?php echo $colum_layout; ?>">
                <div class="row_fix">
                    <?php
                    if (have_posts()) :
                        if (is_home() && is_front_page()) {
                            ?><h1 class="page-title"><?php the_title(); ?></h1><?php
                        } else {
                            echo '<h1>' . get_the_archive_title() . '</h1>';
                        }

                        /* Start the Loop */
                        echo '<div class="post">';
                        echo '<div class="post_insider">';
                        while (have_posts()) : the_post();
                            ?>
                            <div class="item">
                                <div class="insider">
                                    <?php
                                    do_action('hook_loop_post');
                                    /**
                                     * Hook: hook_loop_post.
                                     *
                                     * @hooked hook_loop_post_thumbnail - 1
                                     * @hooked hook_loop_post_title - 5
                                     * @hooked hook_loop_post_date - 10
                                     * @hooked hook_loop_post_meta - 15
                                     */
                                    ?>
                                </div>
                            </div>
                        <?php
                        endwhile;
                        echo '</div>';
                        echo '</div>';
                        //Pagination
                        do_action('hook_pagination');
                    /**
                     * Hook: hook_pagination.
                     *
                     * @hooked hook_pagination_default - 1
                     */
                    else :
                        //empty
                    endif;
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
