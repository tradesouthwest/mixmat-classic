<?php
/**
 * Plugin Name:       MixMat Classic
 * Plugin URI:        http://themes.tradesouthwest.com/wordpress/plugins/mixmat
 * Description:       Mixmat Page Mixer gives editors an easy way to sectionalize the posts and pages without knowing CSS or HTML.
 * Version:           1.0.63
 * Requires PHP:      7.1
 * Requires CP:       1.5.1
 * Author:            Larry Judd
 * Author URI:        http://tradesouthwest.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mixmat
 * Domain Path:       /languages
 * @wordpress-plugin
 * @link              http://tradesouthwest.com
 * @package           Mixmat
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/** Important constants
 *
 * @since   1.0.1
 *
 * @version - reserved
 * @plugin_url
 * @text_domain - reserved
 *
 */
//define( 'MXMT_VERSION', '1.0.0' );
define( 'MIXMAT_URL', plugin_dir_url(__FILE__));
//define( 'MXMT_TEXT', 'mixmat' );

//activate/deactivate hooks
function mixmat_plugin_activation() {

        return false;

}

function mixmat_plugin_deactivation() {

    //mixmat_deregister_shortcode
    //flush_rewrite_rules();

        return false;

}

//https://codex.wordpress.org/Shortcode_API
function mixmat_deregister_shortcode() {

    //shortcode_atts( $pairs, $atts )

}

/**
 * Initialise - load in translations
 * @since 1.0.0
 */
function mixmat_loadtranslations () {

    $plugin_dir = basename(dirname(__FILE__)).'/languages';
    load_plugin_textdomain( 'mixmat', false, $plugin_dir );

}
add_action('plugins_loaded', 'mixmat_loadtranslations');


/**
 * Plugin Scripts
 *
 * Register and Enqueues plugin scripts
 *
 * @since 1.0.0
 */
function mixmat_scripts() {

    // Register Styles
    wp_register_style( 'mixmat-style', MIXMAT_URL . 'css/mixmat-style.css' );
    //let WP handle ver and loading
    wp_enqueue_style(  'mixmat-style' );
}
add_action( 'wp_enqueue_scripts', 'mixmat_scripts' );

//load admin scripts as well @since 1.0.63
function mixmat_admin_scripts(){

    wp_register_script( 'mixmat-plugin', plugins_url( 'js/mixmat-plugin.js', 
    __FILE__ ), array( 'jquery' ), '1.0.63', true );
    
    wp_enqueue_script( 'mixmat-plugin' );
    wp_enqueue_script( 'wp-color-picker');

    wp_enqueue_style(  'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'mixmat_admin_scripts' );

    /* Add Editor Style */
    add_filter( 'mce_css', 'mixmat_plugin_editor_style' );
        /**
     * Add Editor Style
     * add additional editor style for my-plugin
     * 
     * @since 0.1.0
     */
    function mixmat_plugin_editor_style( $mce_css ){
     
        $mce_css .= ', ' . plugins_url( 'css/mixmat-editor-style.css', __FILE__ );
        return $mce_css;
    }

/** 
 * Removes empty paragraph tags from shortcodes in WordPress.
 */
function tg_remove_empty_paragraph_tags_from_shortcodes_wordpress( $content ) {
    $toFix = array( 
        '<p>['    => '[', 
        ']</p>'   => ']', 
        ']<br />' => ']'
    ); 
    return strtr( $content, $toFix );
}
add_filter( 'the_content', 'tg_remove_empty_paragraph_tags_from_shortcodes_wordpress' );
//activate and deactivate registered
register_activation_hook( __FILE__, 'mixmat_plugin_activation');
register_deactivation_hook( __FILE__, 'mixmat_plugin_deactivation');

//include admin and public views
require ( plugin_dir_path( __FILE__ ) . 'includes/mixmat-adminpage.php' ); 

add_action( 'init', 'mixmat_register_shortcodes_init');
function mixmat_register_shortcodes_init(){
    add_shortcode( 'one',  'mixmat_shortcode_callback_one' );
    add_shortcode( 'one_half',  'mixmat_shortcode_callback_one_half' );
    add_shortcode( 'one_fourth',  'mixmat_shortcode_callback_one_fourth' );
    add_shortcode( 'one_third',  'mixmat_shortcode_callback_one_third' );
    add_shortcode( 'two_thirds',  'mixmat_shortcode_callback_two_thirds' );
    add_shortcode( 'three_fourths',  'mixmat_shortcode_callback_three_fourths' );
    add_shortcode( 'last_one_half',  'mixmat_shortcode_callback_last_one_half' );
    add_shortcode( 'last_one_fourth',  'mixmat_shortcode_callback_last_one_fourth' );
    add_shortcode( 'last_one_third',  'mixmat_shortcode_callback_last_one_third' );
    add_shortcode( 'last_two_thirds',  'mixmat_shortcode_callback_last_two_thirds' );
    add_shortcode( 'last_three_fourths',  'mixmat_shortcode_callback_last_three_fourths' );
    add_shortcode( 'empty_row',  'mixmat_shortcode_callback_empty_row' );
}
?>
