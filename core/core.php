<?php
    Class NextCore{
        private static $instance;
        private static $url;

        public static function getInstance(){
            self::$instance = new NextCore();
            self::$instance->FunctionDefault();
            self::$instance->update();
        }

        public function FunctionDefault(){
            include "inc/lib/function-default.php";
        }

        public function update(){
            include "inc/lib/update/update.php";
        }
    }

    function getNextCore(){
        return NextCore::getInstance();
    }

    getNextCore();
?>

