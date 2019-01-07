<?php
add_action('woocommerce_before_shop_loop_item', 'woocommerce_before_shop_loop_item_first', 1);

function woocommerce_before_shop_loop_item_first(){
    echo '<div class="insder">';
    echo '<div class="ground">';
}

add_action('woocommerce_after_shop_loop_item', 'woocommerce_after_shop_loop_item_last', 100);

function woocommerce_after_shop_loop_item_last(){
    echo '</div>';
    echo '</div>';
}

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail_edit', 10);

function woocommerce_template_loop_product_thumbnail_edit(){
    echo '<div class="img">';
    the_post_thumbnail();
    echo '</div>';
}


remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash', 10);
