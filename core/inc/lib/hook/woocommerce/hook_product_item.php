<?php
    if(! function_exists('woo_percent_sale_product()')){
        function woo_percent_sale_product(){
            global $post, $product;

            $sale = false;

            if ( ( $product->is_type( 'simple' ) || $product->is_type( 'external' ) ) && $product->is_on_sale() ) {

                $product       = wc_get_product( $product->get_id() );
                $regular_price = $product->get_regular_price();
                $sale_price    = $product->get_sale_price();

                if ( $regular_price != '' ) {
                    $sale = ceil( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
                }
            } elseif ( $product->is_type( 'variable' ) && $product->is_on_sale() ) {

                $available_variations = $product->get_available_variations();

                $sale = array();

                foreach ( $available_variations as $val ) {
                    if ( $val['display_price'] > 0 ) {
                        $regular_price = $val['display_regular_price'];
                        $sale_price    = $val['display_price'];

                        $sale[] = ceil( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
                    } else {
                        $sale[] = '100';
                    }
                }

                $sale = max( $sale );
            }

            if ( $product->is_on_sale() && $sale ) {
                echo apply_filters( 'woocommerce_sale_flash', '<span class="sale-badge sale">-' . $sale . '%</span>', $post, $product );
            }
        }
    }

    remove_action('woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash' ,10);

    add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash_edit', 10);

    function woocommerce_show_product_loop_sale_flash_edit(){
        woo_percent_sale_product();
    }

    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);

    add_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash_single_edit' ,10);

    function woocommerce_show_product_sale_flash_single_edit(){
        woo_percent_sale_product();
    }