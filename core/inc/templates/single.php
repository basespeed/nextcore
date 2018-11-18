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
                        the_post_thumbnail();
                        the_title();
                        the_content();
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
