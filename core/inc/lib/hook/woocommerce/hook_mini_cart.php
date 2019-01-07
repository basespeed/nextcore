<?php
    add_action('hook_mini_cart', 'func_mini_cart', 5);

    function func_mini_cart(){
        ?>
        <div class="mini_cart">
            <div class="counter">
                <a href="<?php echo get_permalink( wc_get_page_id( 'cart' ) ); ?>">
                    <div class="content">
                        <div class="icon"><i class="fa fa-shopping-basket" aria-hidden="true"></i></div>
                        <span class="cart-contents"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                    </div>
                </a>
            </div>
            <!--<div class="cart_item">
                <div class="header-quickcart">
                    <?php /*echo woocommerce_mini_cart(); */?>
                </div>
            </div>-->
        </div>
        <?php
    }