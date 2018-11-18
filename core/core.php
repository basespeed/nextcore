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

    public function FunctionDefault(){
        include "inc/lib/function-default.php";
    }

    public function update(){
        /*Check Update Theme*/
        include "inc/lib/update/update.php";
        /*Check setting Plugin*/
        include "inc/lib/tgm/init.php";
    }

    public function hook(){
        include "inc/lib/hook/hook-loop-post.php";
    }

    public function widget(){
        include "inc/lib/widget/widget_post.php";
    }

    public function templates(){
        function get_templates_archive(){
            include "inc/templates/archive-post.php";
        }
        function get_templates_search(){
            include "inc/templates/page-search.php";
        }
        function get_templates_single(){
            include "inc/templates/single.php";
        }
    }
}

function getNextCore(){
    return NextCore::getInstance();
}

getNextCore();




