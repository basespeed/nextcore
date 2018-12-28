<?php

add_action('hook_loop_post','hook_loop_post_thumbnail',1);

function hook_loop_post_thumbnail(){
    ?>
    <a href="<?php the_permalink(); ?>"  class="img">
        <?php
        add_image_size (  'featured_thumbnail', 960, 640, true);
        the_post_thumbnail( 'featured_thumbnail');
        ?>
    </a>
    <?php
}

add_action('hook_loop_post','hook_loop_post_title',5);

function hook_loop_post_title(){
    ?><a href="<?php the_permalink(); ?>"><?php the_title('<h3>','</h3>');?></a><?php
}

add_action('hook_loop_post','hook_loop_post_date',10);

function hook_loop_post_date(){
    ?><time><?php echo get_the_date(); ?></time><?php
}

add_action('hook_loop_post','hook_loop_post_count_view',20);

function hook_loop_post_count_view(){
    ?><span class="count-views"><?php
    echo ' - ';
    echo getPostViews(get_the_ID());
    ?></span><?php
}

add_action('hook_loop_post','hook_loop_post_meta',25);

function hook_loop_post_meta(){
    ?><?php echo the_excerpt(); ?><?php
}


add_action('hook_pagination','hook_pagination_default',1);

function hook_pagination_default(){
    //pagination
    $prev_icon = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
    $next_icon = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
    core_paginate($prev_icon,$next_icon);
}