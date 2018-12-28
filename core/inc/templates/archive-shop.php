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
        <?php if ( is_active_sidebar( 'sidebar_shop' ) ) : ?>
            <?php dynamic_sidebar( 'sidebar_shop' ); ?>
        <?php endif; ?>
    </div>
</div>