<?php
    add_action('hook_header','func_header_logo',5);

    function func_header_logo(){
        echo '<header class="header">';
        echo '<div class="inner">';
        echo '<div class="logo_header">';
        the_custom_logo();
        echo '</div>';

        echo '<div class="fix_grow"></div>';
    }

    add_action('hook_header', 'func_header_menu',10);

    function func_header_menu(){
        echo '<div class="menu_header">';
        wp_nav_menu( array(
            'theme_location' => 'menu-1',
            'menu_id'        => 'primary-menu',
        ) );
        echo '</div>';
        echo '</div>';
        echo '</header>';
    }

    add_action('hook_header', 'func_get_yoast_breadcrumb');

    function func_get_yoast_breadcrumb(){
        if(!is_home() && !is_front_page()) :
            echo '<div id="breadcrumbs">';
            echo '<div class="inner">';
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<div class="breadcrumbs_nav">','</div>' );
            }
            echo '</div>';
            echo '</div>';
        endif;
    }

