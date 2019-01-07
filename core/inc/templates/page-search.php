<?php
get_header();

$default = 'cs';
if(apply_filters( 'change_layout_page_search', $default ) == 'cs'){
    $colum_layout = 'cs';
}elseif(apply_filters( 'change_layout_page_search', $default ) == 'sc'){
    $colum_layout = 'sc';
}elseif(apply_filters( 'change_layout_page_search', $default ) == 'scs'){
    $colum_layout = 'scs';
}elseif(apply_filters( 'change_layout_page_search', $default ) == 'c'){
    $colum_layout = 'c';
}else{
    $colum_layout = $default;
}
?>
    <main class="main">
        <div class="inner">
            <div class="content_main <?php echo $colum_layout; ?>">
                <div class="row_fix search">
                    <?php
                    if ( have_posts() ) :
                        echo '<h1>Tìm kiếm từ khóa: <span>"'.get_search_query().'"</span></h1>';

                        /* Start the Loop */
                        echo '<div class="post">';
                        echo '<div class="post_insider">';
                        while ( have_posts() ) : the_post();
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
                        echo '<h1>Tìm kiếm từ khóa: <span>"'.get_search_query().'"</span></h1>';
                        echo '<div class="search_empty">';
                            echo "<p>Dữ liệu trống !</p>";
                        echo '</div>';
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
