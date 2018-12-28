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
        wp_enqueue_style( 'core-style', get_theme_file_uri().'/core/inc/assets/css/style.css', false );
    }
    add_action( 'wp_enqueue_scripts', 'core_style' );

    function core_script() {
        wp_enqueue_script( 'core-js', get_theme_file_uri().'/core/inc/assets/js/js.js', true );
    }
    add_action( 'wp_enqueue_scripts', 'core_script' );
}else{
    function core_style() {
        wp_enqueue_style( 'core-awesome', get_theme_file_uri().'/core/inc/assets/css/font-awesome.min.css', false );
        wp_enqueue_style( 'core-style', get_theme_file_uri().'/core/inc/assets/css/style.min.css', false );
    }
    add_action( 'wp_enqueue_scripts', 'core_style' );

    function core_script() {
        wp_enqueue_script( 'core-js', get_theme_file_uri().'/core/inc/assets/js/js.min.js', true );
    }
    add_action( 'wp_enqueue_scripts', 'core_script' );
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


//edit search post type
add_filter( 'pre_get_posts', 'my_search' );

function my_search($query) {

    // Check if we are on the front end main search query
    if ( !is_admin() && $query->is_main_query() && $query->is_search() ) {

        // Change the post_type parameter on the query
        $query->set('post_type', 'post');
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