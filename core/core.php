<?php
Class NextCore{
    private static $instance;
    private static $url;

    public static function getInstance(){
        self::$instance = new NextCore();
        self::$instance->FunctionDefault();
        self::$instance->update();
        self::$instance->hook();
        self::$instance->widget();
        self::$instance->templates();
    }

    public function update(){
        /*Check Update Theme*/
        include "inc/lib/update/update.php";
        /*Check setting Plugin*/
        //include "inc/lib/tgm/init.php";
    }

    public function hook(){
        include "inc/lib/hook/hook-loop-archive-post.php";
        include "inc/lib/hook/hook-loop-single-post.php";
        include "inc/lib/hook/hook_header.php";
        include "inc/lib/hook/hook_footer.php";

        //woocommerce
        include "inc/lib/hook/woocommerce/hook_mini_cart.php";
        include "inc/lib/hook/woocommerce/hook_product_item.php";
        include "inc/lib/hook/woocommerce/content-product.php";
    }

    public function widget(){
        include "inc/lib/widget/widget_post.php";
    }

    public function templates(){
        function get_templates_archive(){
            include "inc/templates/archive.php";
        }
        function get_templates_search(){
            include "inc/templates/page-search.php";
        }
        function get_templates_single(){
            include "inc/templates/single.php";
        }
        function get_templates_archive_shop(){
            include "inc/templates/page-shop.php";
        }
        function get_templates_page(){
            include "inc/templates/page.php";
        }
    }

    public function FunctionDefault(){
        include "inc/lib/function-default.php";
    }
}

function getNextCore(){
    return NextCore::getInstance();
}

getNextCore();



function get_column_layout( $output ) {
    $output = 'c';
    return $output;
}
add_filter( 'hook_filter_change_layout', 'get_column_layout' );
