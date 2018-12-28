<div class="content_main">
    <?php
    while (have_posts()) : the_post();

        the_title('<h1>','</h1>');
        the_content();

    endwhile; // End of the loop.
    ?>
</div>

<div class="sidebar_main">
    <div class="row_fix">
        <?php get_sidebar(); ?>
    </div>
</div>