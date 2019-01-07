<?php
    function archive_default(){
        $default = 'cs';
        if(apply_filters( 'change_layout_page', $default ) == 'cs'){
            $colum_layout = 'cs';
        }elseif(apply_filters( 'change_layout_page', $default ) == 'sc'){
            $colum_layout = 'sc';
        }elseif(apply_filters( 'change_layout_page', $default ) == 'scs'){
            $colum_layout = 'scs';
        }elseif(apply_filters( 'change_layout_page', $default ) == 'c'){
            $colum_layout = 'c';
        }else{
            $colum_layout = $default;
        }
        ?>

        <div class="content_main <?php echo $colum_layout; ?>">
            <?php
            while (have_posts()) : the_post();

                the_title('<h1>','</h1>');
                the_content();

            endwhile; // End of the loop.
            ?>
        </div>

        <div class="sidebar_main <?php echo $colum_layout; ?>">
            <div class="row_fix">
                <?php get_sidebar(); ?>
            </div>
        </div>
        <?php
    }

    if(is_plugin_active( 'woocommerce/woocommerce.php' )){
        if(is_shop()){
            include "archive-shop.php";
        }else{
            archive_default();
        }
    }else{
        archive_default();
    }

