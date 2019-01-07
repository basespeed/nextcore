<?php
/**
 * Nextcore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Nextcore
 */

if ( ! function_exists( 'nextcore_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function nextcore_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Nextcore, use a find and replace
         * to change 'nextcore' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'nextcore',  'languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'menu-1' => esc_html__( 'Primary', 'nextcore' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'nextcore_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ) );
    }
endif;
add_action( 'after_setup_theme', 'nextcore_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nextcore_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'nextcore_content_width', 640 );
}
add_action( 'after_setup_theme', 'nextcore_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nextcore_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'nextcore' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'nextcore' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'nextcore_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nextcore_scripts() {
    wp_enqueue_style( 'nextcore-style', get_stylesheet_uri() );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'nextcore_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/core/inc/lib/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/core/inc/lib/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/core/inc/lib/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/core/inc/lib/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require get_template_directory() . '/core/inc/lib/inc/jetpack.php';
}


if (defined('WP_DEBUG') && true === WP_DEBUG) {
    function core_style() {
        wp_enqueue_style( 'core-awesome', get_theme_file_uri().'/core/inc/assets/css/font-awesome.min.css', false );
        wp_enqueue_style( 'core-awesome', 'https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,900', false );
        wp_enqueue_style( 'core-style-fix', get_theme_file_uri().'/core/inc/assets/css/fix.css', false );
        wp_enqueue_style( 'core-style-flickity', get_theme_file_uri().'/core/inc/assets/plugin/flick/flickity.min.css', false );
        wp_enqueue_style( 'core-style-googleapis', 'https://fonts.googleapis.com/css?family=Nunito+Sans:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i', false );
        wp_enqueue_style( 'core-style', get_theme_file_uri().'/core/inc/assets/css/style.css', false );
    }
    add_action( 'wp_enqueue_scripts', 'core_style' );

    function core_script() {
        wp_enqueue_script( 'flickity-js', get_theme_file_uri().'/core/inc/assets/plugin/flick/flickity.pkgd.min.js', true );
        wp_enqueue_script( 'core-js', get_theme_file_uri().'/core/inc/assets/js/js.js', true );
    }
    add_action( 'wp_enqueue_scripts', 'core_script' );
}else{
    function core_style() {
        wp_enqueue_style( 'core-awesome', get_theme_file_uri().'/core/inc/assets/css/font-awesome.min.css', false );
        wp_enqueue_style( 'core-style-fix', get_theme_file_uri().'/core/inc/assets/css/fix.css', false );
        wp_enqueue_style( 'core-style-googleapis', 'https://fonts.googleapis.com/css?family=Nunito+Sans:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i', false );
        wp_enqueue_style( 'core-style-flickity', get_theme_file_uri().'/core/inc/assets/plugin/flick/flickity.min.css', false );
        wp_enqueue_style( 'core-style', get_theme_file_uri().'/core/inc/assets/css/style.min.css', false );
    }
    add_action( 'wp_enqueue_scripts', 'core_style' );

    function core_script() {
        wp_enqueue_script( 'flickity-js', get_theme_file_uri().'/core/inc/assets/plugin/flick/flickity.pkgd.min.js', true );
        wp_enqueue_script( 'core-js', get_theme_file_uri().'/core/inc/assets/js/js.min.js', true );
    }
    add_action( 'wp_enqueue_scripts', 'core_script' );
}

add_action('wp_enqueue_scripts','enq_menu_scripts_and_styles');

function enq_menu_scripts_and_styles() {
    // UI Core, loads jQuery as a dependancy
    wp_enqueue_script(
        'uicore',
        get_theme_file_uri().'/core/inc/assets/plugin/jquery-ui.min.js',
        array('jquery')
    );

    // UI Theme CSS
    wp_enqueue_style( 'structurecss', get_theme_file_uri().'/core/inc/assets/plugin/jquery-ui.structure.min.css' );
    wp_enqueue_style( 'themecss', get_theme_file_uri().'/core/inc/assets/plugin/jquery-ui.theme.min.css' );


}

//edit pagination
function core_paginate($prev_icon, $next_icon){
    global $wp_query;

    $big = 999999999; // need an unlikely integer

    echo '<nav class="pagination">';
    echo paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'prev_next'          => true,
        'prev_text'          => $prev_icon,
        'next_text'          => $next_icon,
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages
    ) );
    echo '</nav>';
}

//edit form search
function my_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <div><label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.apply_filters('hook_change_placeholder_search','Từ khóa cần tìm').'" />
    <button  type="submit" id="searchsubmit">'.apply_filters('hook_change_icon_search','<i class="fa fa-search" aria-hidden="true"></i>').'</button>
    </div>
    </form>';

    return $form;
}

add_filter( 'get_search_form', 'my_search_form', 100 );

//change title archive
add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {

        $title = single_cat_title( '', false );

    } elseif ( is_tag() ) {

        $title = single_tag_title( '', false );

    } elseif ( is_author() ) {

        $title = '<span class="vcard">' . get_the_author() . '</span>' ;

    }

    return $title;

});

function prefix_category_title( $title ) {
    if ( is_tax() ) {
        $title = single_cat_title( '', false );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'prefix_category_title' );


//edit search post type
add_filter( 'pre_get_posts', 'my_search' );

function my_search($query) {

    // Check if we are on the front end main search query
    if ( !is_admin() && $query->is_main_query() && $query->is_search() ) {

        // Change the post_type parameter on the query
        $query->set('post_type', array('post','beauty'));
    }

    // Return the modified query
    return $query;
}


// function to display number of posts.

function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 lượt xem";
    }
    return $count.' lượt xem';
}

// function to count views.
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

//create sidebar shop
function create_sidebar_shop() {
    register_sidebar(
        array (
            'name' => __( 'Shop', 'nextcore' ),
            'id' => 'sidebar_shop',
            'description' => __( 'Sidebar shop for nextcore theme', 'nextcore' ),
            'before_widget' => '<div class="widget-content">',
            'after_widget' => "</div>",
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'create_sidebar_shop' );



// Polylang ELEMENTOR
add_filter( 'elementor/theme/get_location_templates/template_id', function( $post_id ) {
    if ( function_exists( 'pll_get_post' ) ) {
        $translation_post_id = pll_get_post( $post_id );
        if ( null === $translation_post_id ) {
            // the current language is not defined yet
            return $post_id;
        } elseif ( false === $translation_post_id ) {
            //no translation yet
            return $post_id;
        } elseif ( $translation_post_id > 0 ) {
            // return translated post id
            return $translation_post_id;
        }
    }
    return $post_id;
} );


//Change layout column
//**Woocommerce

add_filter('change_layout_single_shop',function ($output){
    $output = "sc";
    return $output;
});

add_filter('change_layout_archive_shop',function ($output){
    $output = "sc";
    return $output;
});

add_filter('change_layout_page_shop',function ($output){
    $output = "sc";
    return $output;
});

//**Template
add_filter('change_layout_archive',function ($output){
    $output = "cs";
    return $output;
});

add_filter('change_layout_page',function ($output){
    $output = "cs";
    return $output;
});

add_filter('change_layout_page_search',function ($output){
    $output = "cs";
    return $output;
});

add_filter('change_layout_single',function ($output){
    $output = "cs";
    return $output;
});

add_filter('change_slider_gallery_single_product',function ($output){
    $output = "rows";
    return $output;
});

$user = wp_get_current_user();

$current_user = wp_get_current_user();

if ($current_user->user_login == 'manager1') {
    function wpdocs_adjust_the_wp_menu() {
        remove_submenu_page( "themes.php", "theme-editor.php" );
        remove_submenu_page( "themes.php", "theme-editor.php" );
        remove_submenu_page( 'options-general.php', 'options-permalink.php' );
        remove_submenu_page( 'options-general.php', 'whl_settings' );
        remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
        remove_submenu_page( 'plugins.php', 'plugin-install.php' );
        remove_submenu_page( 'index.php', 'update-core.php' );
        remove_menu_page( 'plugins.php');
        remove_menu_page( 'tools.php');
        remove_menu_page( 'options-general.php');
        remove_menu_page( 'users.php' );
        remove_menu_page( 'users.php' );
        remove_menu_page( 'admin.php?page=elementor-tools' );
        remove_menu_page( 'edit.php?post_type=acf-field-group' );
        remove_menu_page( 'edit.php?post_type=elementor_library' );
        remove_menu_page( 'elementor' );
        remove_menu_page( 'update-core.php' );
        remove_menu_page( 'mlang' );
    }
    add_action( 'admin_menu', 'wpdocs_adjust_the_wp_menu', 999 );

    function restrict_admin_with_redirect() {

        $restrictions = array(
            'theme-editor.php',
            'themes.php',
            'options-permalink.php',
            'plugin-editor.php',
            'plugin-install.php',
            'plugins.php',
            'admin.php?page=elementor-tools',
            'update-core.php',
            'users.php',
            'user-new.php',
            'profile.php',
            'options-general.php',
            'options-general.php#whl_settings'
        );
        //$actual_link = "$_SERVER[REQUEST_URI]";
        $url = "$_SERVER[REQUEST_URI]";
        $lastSegment = basename(parse_url($url, PHP_URL_PATH));
        foreach ( $restrictions as $restriction ) {
            if($lastSegment == $restriction){
                return header("Location: ".get_home_url());
                var_dump($lastSegment);
            }

        }
    }

    add_action( 'admin_init', 'restrict_admin_with_redirect' );
}



if(is_plugin_active( 'woocommerce/woocommerce.php' )){
    //mini cart ajax
    add_filter( 'woocommerce_add_to_cart_fragments', function($fragments) {

        ob_start();
        ?>

        <span class="cart-contents">
        <?php echo WC()->cart->get_cart_contents_count(); ?>
    </span>

        <?php $fragments['span.cart-contents'] = ob_get_clean();

        return $fragments;

    } );

    add_filter( 'woocommerce_add_to_cart_fragments', function($fragments) {

        ob_start();
        ?>

        <div class="header-quickcart">
            <?php woocommerce_mini_cart(); ?>
        </div>

        <?php $fragments['div.header-quickcart'] = ob_get_clean();

        return $fragments;

    } );


    add_filter('change_layout_page',function ($output){
        $output = "c";
        return $output;
    });

    /**
     * Change a currency symbol
     */
    add_filter( 'woocommerce_currency_symbol', 'change_currency_symbol', 10, 2 );

    function change_currency_symbol( $symbols, $currency ) {
        if ( 'VND' === $currency ) {
            return 'vnđ';
        }

        return $symbols;
    }

    //Change text button woocommerce
    add_filter('woocommerce_product_add_to_cart_text', 'wh_archive_custom_cart_button_text');   // 2.1 +

    function wh_archive_custom_cart_button_text()
    {
        return __('Mua hàng', 'woocommerce');
    }

    //woocommerce
    function custom_theme_setup() {
        add_theme_support( 'woocommerce' );
    }
    add_action( 'after_setup_theme', 'custom_theme_setup' );

    add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

    function woo_remove_product_tabs( $tabs ) {
        /*unset( $tabs['description'] );          // Remove the description tab
        unset( $tabs['reviews'] );  */        // Remove the reviews tab
        unset( $tabs['additional_information'] );   // Remove the additional information tab
        return $tabs;
    }

    remove_filter( 'woocommerce_product_get_rating_html', 'pure_wc_get_rating_html', 10, 3 );
    remove_filter( 'woocommerce_get_star_rating_html', 'pure_wc_get_star_rating_html', 10, 3 );

    add_filter( 'woocommerce_product_get_rating_html', 'pure_wc_get_rating_html_edit', 10, 3 );

    function pure_wc_get_rating_html_edit( $html, $rating, $count ) {

        $html = '<div class="star-rating">';
        $html .= '<span class="stars"><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></span>';
        $html .= wc_get_star_rating_html( $rating, $count );
        $html .= '</div>';

        return $html;
    }


    add_filter( 'woocommerce_get_star_rating_html', 'pure_wc_get_star_rating_html_edit', 10, 3 );

    function pure_wc_get_star_rating_html_edit( $html, $rating, $count ) {

        $html = '<span class="star-rating-active" style="width:' . ( ( $rating / 5 ) * 100 ) . '%">';
        $html .= '<span class="stars star-active"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></span>';

        if ( 0 < $count ) {
            $html .= '<span class="txt" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';
            /* translators: 1: rating 2: rating count */
            $html .= sprintf( _n( 'Rated %1$s out of 5 based on %2$s customer rating', 'Rated %1$s out of 5 based on %2$s customer ratings', $count, 'woocommerce' ), '<strong class="rating" itemprop="ratingValue">' . esc_html( $rating ) . '</strong>', '<span class="rating" itemprop="reviewCount">' . esc_html( $count ) . '</span>' );
        } else {
            $html .= '<span class="txt" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">';
            $html .= '<meta itemprop="worstRating" content = "1">';
            $html .= sprintf( esc_html__( 'Rated %s out of %s', 'woocommerce' ), '<strong class="rating" itemprop="ratingValue">' . esc_html( $rating ) . '</strong>', '<span itemprop="bestRating">5</span>' );
        }
        $html .= '</span>';

        $html .= '</span>';

        return $html;
    }

    add_action( 'after_setup_theme', 'yourtheme_setup' );

    function yourtheme_setup() {
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }

    function mytheme_add_woocommerce_support() {
        add_theme_support( 'woocommerce' );
    }
    add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );
}



/*function add_copyright() {
    echo'<div id="add_copyright" class="add_copyright_vi"><div class="inner">© Bản quyền thuộc về bacsytuynh.com | Cung cấp bởi <a style="color: #FFF;" href="https://minhduongads.com/"> MinhDuongADS.Com</a></div></div>';

}
add_action('wp_footer', 'add_copyright',1000);*/

//disable editor new wordpress 5
add_filter('use_block_editor_for_post', '__return_false');

