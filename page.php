<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nextcore
 */

get_header();
?>

<main class="main">
    <div class="inner">
        <?php
            if(is_plugin_active( 'woocommerce/woocommerce.php' )){
                if(is_shop()){
                    get_templates_archive_shop();
                }else {
                    get_templates_page();
                }
            }else{
                get_templates_page();
            }
        ?>
    </div>
</main><!-- #main -->

<?php
get_footer();
