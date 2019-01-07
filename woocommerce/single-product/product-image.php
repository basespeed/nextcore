<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );

global $product;

$attachment_ids = $product->get_gallery_image_ids();

if(! $attachment_ids){
    $attachment_ids_class = 'no_gallery';
}

$slider_layout = apply_filters('change_slider_gallery_single_product', 'slider_colum');


if($slider_layout == 'rows') {
    ?>
    <div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>"
         style="opacity: 0; transition: opacity .25s ease-in-out;">
        <figure class="woocommerce-product-gallery__wrapper <?php echo $attachment_ids_class; ?>">
            <?php
            if ($product->get_image_id()) {
                echo '<div id="slide_main_single_product" data-flickity>';
                echo '<div class="item">';
                echo wp_get_attachment_image($post_thumbnail_id, array('1920', '1920'), "", array("class" => "img-responsive"));
                echo '</div>';

                foreach ($attachment_ids as $attachment_id) {
                    echo '<div class="item">';
                    echo '<div class="img">';
                    echo wp_get_attachment_image($attachment_id, array('1920', '1920'), "", array("class" => "img-responsive"));
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
            }

            if ($attachment_ids) :
                echo '<div id="slide_single_product">';
                echo '<div class="row_col">';

                if ($product->get_image_id()) {
                    echo '<div class="item">';
                    echo '<div class="img">';
                    echo wp_get_attachment_image($post_thumbnail_id, array('1024', '1024'), "", array("class" => "img-responsive"));
                    echo '</div>';
                    echo '</div>';
                }

                foreach ($attachment_ids as $attachment_id) {
                    echo '<div class="item">';
                    echo '<div class="img">';
                    echo wp_get_attachment_image($attachment_id, array('1024', '1024'), "", array("class" => "img-responsive"));
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
                echo '</div>';
            endif;
            ?>
        </figure>

    </div>
    <?php
}elseif($slider_layout == 'colums'){
?>
<div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>">
    <figure class="woocommerce-product-gallery__wrapper carousel-container colums <?php echo $attachment_ids_class; ?>">
        <?php
        if ($product->get_image_id()) {
            echo '<div class="carousel carousel-main" data-flickity>';

            echo '<div class="carousel-cell">';
            echo '<div class="img">';
            echo wp_get_attachment_image($post_thumbnail_id, array('1920', '1920'), "", array("class" => "img-responsive"));
            echo '</div>';
            echo '</div>';

            foreach ($attachment_ids as $attachment_id) {
                echo '<div class="carousel-cell">';
                echo '<div class="img">';
                echo wp_get_attachment_image($attachment_id, array('1920', '1920'), "", array("class" => "img-responsive"));
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        }

        if ($attachment_ids) :
            echo '<div class="carousel-nav">';
            echo '<div class="fix_row">';

            echo '<div class="carousel-cell is-nav-selected">';
            echo '<div class="img">';
            echo wp_get_attachment_image($post_thumbnail_id, array('1920', '1920'), "", array("class" => "img-responsive"));
            echo '</div>';
            echo '</div>';

            foreach ($attachment_ids as $attachment_id) {
                echo '<div class="carousel-cell">';
                echo '<div class="img">';
                echo wp_get_attachment_image($attachment_id, array('1024', '1024'), "", array("class" => "img-responsive"));
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
            echo '</div>';
        endif;
        ?>
    </figure>

    <figure class="woocommerce-product-gallery__wrapper mobile_slider_single_product <?php echo $attachment_ids_class; ?>">
        <?php
        if ($product->get_image_id()) {
            echo '<div id="slide_main_single_product_mobile" data-flickity>';
            echo '<div class="item">';
            echo wp_get_attachment_image($post_thumbnail_id, array('1920', '1920'), "", array("class" => "img-responsive"));
            echo '</div>';

            foreach ($attachment_ids as $attachment_id) {
                echo '<div class="item">';
                echo '<div class="img">';
                echo wp_get_attachment_image($attachment_id, array('1920', '1920'), "", array("class" => "img-responsive"));
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        }

        if ($attachment_ids) :
            echo '<div id="slide_single_product_mobile">';
            echo '<div class="row_col">';

            if ($product->get_image_id()) {
                echo '<div class="item">';
                echo '<div class="img">';
                echo wp_get_attachment_image($post_thumbnail_id, array('1024', '1024'), "", array("class" => "img-responsive"));
                echo '</div>';
                echo '</div>';
            }

            foreach ($attachment_ids as $attachment_id) {
                echo '<div class="item">';
                echo '<div class="img">';
                echo wp_get_attachment_image($attachment_id, array('1024', '1024'), "", array("class" => "img-responsive"));
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
            echo '</div>';
        endif;
        ?>
    </figure>
</div>

<?php
}

?>



