<?php
/**
 * Adds Tin tuc widget
 */
class Tintuc_Widget extends WP_Widget {

    /**
     * Register widget with WordPress
     */
    function __construct() {
        parent::__construct(
            'tintuc_widget', // Base ID
            esc_html__( 'Tin tức mới nhất', 'pure' ), // Name
            array( 'description' => esc_html__( 'Tin tức thiết kế cho nextcore theme', 'pure' ), ) // Args
        );
    }

    /**
     * Widget Fields
     */
    private $widget_fields = array(
    );

    /**
     * Front-end display of widget
     */
    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        // Output widget title
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        ?>

        <div class="post_widget_custom">
            <?php
            global $post;
            if(is_search()){
                $arr = array(
                    'post_type' => 'post',
                    'posts_per_page' => '4',
                    'order' => 'desc',
                );
            }else{
                $arr = array(
                    'post_type' => 'post',
                    'posts_per_page' => '4',
                    'order' => 'desc',
                    'post__not_in' => array($post->ID),
                );
            }

            $query = new WP_Query($arr);

            if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                ?>
                <div class="item">
                    <a class="img" href="<?php the_permalink(); ?>">
                        <?php
                            add_image_size( 'cp-thumb', 600, 339, true );
                            the_post_thumbnail('widget_post_img');
                        ?>
                    </a>
                    <div class="content">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <time><?php echo get_the_date(); ?></time>
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            <?php
            endwhile;
            endif;
            wp_reset_query();
            ?>
        </div>

        <?php

        // Output generated fields

        echo $args['after_widget'];
    }

    /**
     * Back-end widget fields
     */
    public function field_generator( $instance ) {
        $output = '';
        foreach ( $this->widget_fields as $widget_field ) {
            $widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( $widget_field['default'], 'pure' );
            switch ( $widget_field['type'] ) {
                default:
                    $output .= '<p>';
                    $output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'pure' ).':</label> ';
                    $output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
                    $output .= '</p>';
            }
        }
        echo $output;
    }

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'pure' );
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'pure' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <?php
        $this->field_generator( $instance );
    }

    /**
     * Sanitize widget form values as they are saved
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        foreach ( $this->widget_fields as $widget_field ) {
            switch ( $widget_field['type'] ) {
                case 'checkbox':
                    $instance[$widget_field['id']] = $_POST[$this->get_field_id( $widget_field['id'] )];
                    break;
                default:
                    $instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
            }
        }
        return $instance;
    }
} // class Tintuc_Widget

// register Tin tuc widget
function register_tintuc_widget() {
    register_widget( 'Tintuc_Widget' );
}
add_action( 'widgets_init', 'register_tintuc_widget' );