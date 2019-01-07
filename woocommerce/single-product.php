<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );

$default = 'cs';
if (apply_filters('change_layout_single_shop', $default) == 'cs') {
	$colum_layout = 'cs';
} elseif (apply_filters('change_layout_single_shop', $default) == 'sc') {
	$colum_layout = 'sc';
} elseif (apply_filters('change_layout_single_shop', $default) == 'scs') {
	$colum_layout = 'scs';
} elseif (apply_filters('change_layout_single_shop', $default) == 'c') {
	$colum_layout = 'c';
} else {
	$colum_layout = $default;
}
?>
	<main class="main">
		<div class="inner">
			<div class="content_main <?php echo $colum_layout; ?>">
				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'single-product' ); ?>

				<?php endwhile; // end of the loop. ?>

			</div>
			<div class="sidebar_main <?php echo $colum_layout; ?>">
				<div class="row_fix">
					<?php
					if ( is_active_sidebar( 'sidebar_shop' ) ) :
						dynamic_sidebar( 'sidebar_shop' );
					endif;
					?>
				</div>
			</div>
		</div>
	</main>

<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
