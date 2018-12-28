<?php
/**
 * Initialization functions for nextcore_Tgm_Init
 *
 * @author      Edusite
 * @category    Admin
 * @package     Initialization
 * @version     2.0
 */


if ( ! defined( 'ABSPATH' ) ) exit;

class nextcore_Tgm_Init_Init{

    public static $instance;

    public static function init(){

        if ( is_null( self::$instance ) )
            self::$instance = new nextcore_Tgm_Init_Init();

        return self::$instance;
    }

    private function __construct(){

    }

    function body_class($classes){

        if(!is_user_logged_in()){
            $classes[] = 'logged-out';
        }
        return $classes;
    }


    function get_header(){


        if(empty($this->customizer))
            return;
        if(isset($this->customizer['header_style']))
            return $this->customizer['header_style'];
        else
            return;
    }

    function course_category($args){

        global $wp_query;
        if(is_tax()){
            $args['tax_query']=array();
            $args['tax_query']['relation'] = 'AND';
            $args['tax_query'][]=array(
                'taxonomy' => 'course-cat',
                'terms'    => array($wp_query->query_vars['course-cat']),
                'field'    => 'slug',
            );
        }
        return $args;
    }
}

nextcore_Tgm_Init_Init::init();

// Auto plugin activation
include "class-tgm-plugin-activation.php";

add_action( 'tgmpa_register', 'nextcore_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function nextcore_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        array(
            'name'                  => esc_html__('Advanced Custom Fields PRO', 'nextcore'),
            'slug'                  => 'advanced-custom-fields-pro',
            'source'                => get_template_directory_uri(). '/core/inc/lib/tgm/plugin/advanced-custom-fields-pro.zip',
            'required'              => true,
            'force_activation'      => false,
            'force_deactivation'    => true,
        ),

        array(
            'name'              => esc_html__('Elementor', 'nextcore'),
            'slug'              => 'elementor',
            'required'          => true,
            'force_activation'  => false,
            'force_deactivation'    => false,
        ),

        array(
            'name'                  => esc_html__('Elementor PRO', 'nextcore'),
            'slug'                  => 'elementor-pro',
            'source'                => get_template_directory_uri(). '/core/inc/lib/tgm/plugin/elementor-pro.zip',
            'required'              => true,
            'force_activation'      => false,
            'force_deactivation'    => true,
        ),

        array(
            'name'              => esc_html__('Contact Form 7', 'nextcore'),
            'slug'              => 'contact-form-7',
            'required'          => true,
            'force_activation'  => false,
        ),

        array(
            'name'              => esc_html__('kirki', 'nextcore'),
            'slug'              => 'kirki',
            'required'          => true,
            'force_activation'  => false,
            'force_deactivation'    => false,
        ),

        array(
            'name'              => esc_html__('Duplicate Post', 'nextcore'),
            'slug'              => 'duplicate-post',
            'required'          => true,
            'force_activation'  => false,
            'force_deactivation'    => false,
        ),

        array(
            'name'              => esc_html__('MailChimp for WordPress', 'nextcore'),
            'slug'              => 'mailchimp-for-wp',
            'required'          => true,
            'force_activation'  => false,
            'force_deactivation'    => false,
        ),

        array(
            'name'              => esc_html__('Yoast SEO', 'nextcore'),
            'slug'              => 'wordpress-seo',
            'required'          => true,
            'force_activation'  => false,
            'force_deactivation'    => false,
        ),

        array(
            'name'              => esc_html__('woocommerce', 'nextcore'),
            'slug'              => 'woocommerce',
            'required'          => true,
            'force_activation'  => false,
            'force_deactivation'    => false,
        ),


      /*  array(
            'name'              => esc_html__('reset wp', 'nextcore'),
            'slug'              => 'reset-wp',
            'required'          => true,
            'force_activation'  => false,
            'force_deactivation'    => false,
        ),*/


        /*inner*/

        /*array(
            'name'                  => esc_html__('univercore', 'nextcore'),
            'slug'                  => 'univercore',
            'source'                => get_template_directory_uri() . '/inc/import-files/plugins/univercore.zip',
            'required'              => true,
            'force_activation'      => false,
            'force_deactivation'    => true,
        ),*/


    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id'           => 'nextcore',
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'nextcore' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'nextcore' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'nextcore' ),
            'updating'                        => esc_html__( 'Updating Plugin: %s', 'nextcore' ),
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'nextcore' ),
            'notice_can_install_required'     => _n_noop(
                'This theme requires the following plugin: %1$s.',
                'This theme requires the following plugins: %1$s.',
                'nextcore'
            ),
            'notice_can_install_recommended'  => _n_noop(
                'This theme recommends the following plugin: %1$s.',
                'This theme recommends the following plugins: %1$s.',
                'nextcore'
            ),
            'notice_ask_to_update'            => _n_noop(
                'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                'nextcore'
            ),
            'notice_ask_to_update_maybe'      => _n_noop(
                'There is an update available for: %1$s.',
                'There are updates available for the following plugins: %1$s.',
                'nextcore'
            ),
            'notice_can_activate_required'    => _n_noop(
                'The following required plugin is currently inactive: %1$s.',
                'The following required plugins are currently inactive: %1$s.',
                'nextcore'
            ),
            'notice_can_activate_recommended' => _n_noop(
                'The following recommended plugin is currently inactive: %1$s.',
                'The following recommended plugins are currently inactive: %1$s.',
                'nextcore'
            ),
            'install_link'                    => _n_noop(
                'Begin installing plugin',
                'Begin installing plugins',
                'nextcore'
            ),
            'update_link'                     => _n_noop(
                'Begin updating plugin',
                'Begin updating plugins',
                'nextcore'
            ),
            'activate_link'                   => _n_noop(
                'Begin activating plugin',
                'Begin activating plugins',
                'nextcore'
            ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'nextcore' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'nextcore' ),
            'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'nextcore' ),
            'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'nextcore' ),
            'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'nextcore' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'nextcore' ),
            'dismiss'                         => esc_html__( 'Dismiss this notice', 'nextcore' ),
            'notice_cannot_install_activate'  => esc_html__( 'There are one or more required or recommended plugins to install, update or activate.', 'nextcore' ),
            'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'nextcore' ),
            'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
        ),
    );

    tgmpa( $plugins, $config );

}