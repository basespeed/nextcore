<?php
    add_action('hook_footer', 'func_hook_footer_copyright', 5);

    function func_hook_footer_copyright(){
        echo '<footer class="footer">';
            echo '<div class="inner"><a href="nextcore.com">© Design by Thanh Tung. Copyright © 2018 ©</a></div>';
        echo '</footer>';
    }