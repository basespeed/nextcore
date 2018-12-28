<?php
add_action('hook_loop_single_post','hook_loop_single_post_image',1);

function hook_loop_single_post_image(){
    add_image_size('img_single_post','960','640', true);
    the_post_thumbnail('img_single_post','<div class="img"></div>');
}

add_action('hook_loop_single_post','hook_loop_single_post_title',5);

function hook_loop_single_post_title(){
    the_title('<h1>','</h1>');
}

add_action('hook_loop_single_post','hook_loop_single_post_count_view',10);

function hook_loop_single_post_count_view(){
    setPostViews(get_the_ID());
    echo '<span class="count-views">';
    echo '<span class="line-count-views"> - </span>';
    echo getPostViews(get_the_ID());
    echo '</span>';
}

add_action('hook_loop_single_post','hook_loop_single_post_content',15);

function hook_loop_single_post_content(){
    echo '<div class="content-single-post">';
    the_content();
    echo '</div>';
}

add_action('hook_loop_single_post','hook_loop_single_post_comments_facebook',20);

function hook_loop_single_post_comments_facebook(){
    ?>
    <div class="plugin-fb-cmt">
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2&appId=696161147411431&autoLogAppEvents=1';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="100%" data-numposts="5"></div>
    </div>
    <?php
}
