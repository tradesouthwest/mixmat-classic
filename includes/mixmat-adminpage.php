<?php 
/**
 * The admin-specific functionality of the plugin.
 *
 *
 * @package    Mixmat
 * @subpackage Mixmat/includes
 * @author     Larry Judd <tradesouthwest@gmail.com>
 */
add_action( 'admin_menu', 'mixmat_add_options_page' );
add_action( 'admin_init', 'mixmat_settings_init' );


    function mixmat_add_options_page() {

        add_menu_page(
            __( 'MixMat Options', 'mixmat' ),
            __( 'MixMat PageMix', 'mixmat' ),
            'manage_options',
            'mixmat',
            'mixmat_admin_options_page',
            'dashicons-text',
            14
        );
    }

/**
 * Provides a default value for the theme layout setting.
 *
 * @since    1.0.2
 */
function mixmat_options_defaults() {
    $defaults = array (
    'mixmat_color_field_0' => '',
    'mixmat_color_field_1' => '',
    'mixmat_theme_margins_option' => 10
    );
        return apply_filters ( 'mixmat_settings', $defaults );
}

/**
  * Register settings for options page
  *
  * @since    1.0.51
  */
function mixmat_settings_init() {
    
    if( false == get_option( 'mixmat_settings' ) ) {
		add_option( 'mixmat_settings', 
		apply_filters( 'mixmat_settings_init', mixmat_options_defaults() ) );
	} // end if
    

    add_settings_section(
        'mixmat_pluginPage_section',
        __( 'Change background of ALL sections', 'mixmat' ),
        'mixmat_settings_section_callback',
        'mixmat_admin_pluginPage'
    );

    //$id, $title, $callback, $page, $section = 'default', $args = array()
    add_settings_field(
        'mixmat_color_field_0',
        __( 'Select Background Color', 'mixmat' ),
        'mixmat_color_field_0_render',
        'mixmat_admin_pluginPage',
        'mixmat_pluginPage_section'
    );
    
    add_settings_field(
        'mixmat_color_field_1',
        __( 'Select Boxshadow Color', 'mixmat' ),
        'mixmat_color_field_1_render',
        'mixmat_admin_pluginPage',
        'mixmat_pluginPage_section'
    );

    add_settings_field(
        'mixmat_theme_adjustment_option',
        __( 'Alternate Theme Adjustment', 'mixmat' ),
        'mixmat_theme_adjustment_option_render',
        'mixmat_admin_pluginPage',
        'mixmat_pluginPage_section'
    );

    add_settings_field(
        'mixmat_theme_margins_option',
        __( 'Alternate Margins Adjustment (pxs)', 'mixmat' ),
        'mixmat_theme_margins_option_render',
        'mixmat_admin_pluginPage',
        'mixmat_pluginPage_section'
    );

        register_setting( 'mixmat_admin_pluginPage', 'mixmat_settings' );
    }


    /**
     * Text field for color picker
     *
     * @since    1.0.0
     * @options mixmat-settings
     */
    function mixmat_color_field_0_render(  ) {
        
        $options = get_option( 'mixmat_settings' );
        $mxmtcolor = empty($options['mixmat_color_field_0']) ? '#fafafa' 
                    : $options['mixmat_color_field_0'];
    ?>

    <input name="mixmat_settings[mixmat_color_field_0]" type="text" 
class="color-picker" id="mixmat_color" value="<?php echo esc_attr( $mxmtcolor ); ?>">

    <?php

    }
    function mixmat_color_field_1_render(  ) {

        $options = get_option( 'mixmat_settings' );
        $mxmtshado = empty($options['mixmat_color_field_1']) ? '#cdcdcd' 
                    : $options['mixmat_color_field_1'];
    ?>

    <input name="mixmat_settings[mixmat_color_field_1]" type="text" 
class="color-picker" id="mixmat_shado" value="<?php echo esc_attr( $mxmtshado ); ?>">

    <?php 
    echo "<p>";
    esc_html_e( 'To remove text shadow open the Select Color and tick Clear', 'mixmat' );
    echo "</p>"; 

    }
    /**
     * Wide theme option render
     * @since 1.0.5
     */
    function mixmat_theme_adjustment_option_render(  ) {

        $options = get_option( 'mixmat_settings' );
        $mxmtchk = (empty($options['mixmat_theme_adjustment_option'])) 
                    ? 0 : $options['mixmat_theme_adjustment_option'];
    ?>
    <input type="hidden" name="mixmat_settings[mixmat_theme_adjustment_option]" 
    value="0" />
    <input name="mixmat_settings[mixmat_theme_adjustment_option]" 
           value="1" 
           type="checkbox" <?php echo esc_attr( 
           checked( 1, $mxmtchk, false ) ); ?> /> 	

    <?php 
    echo "<p>";
    esc_html_e( 'Some themes may render the four box width ([one_fourth]) too thin. Try this to make them two wide.', 'mixmat' );
    echo "</p>"; 

    }
     /**
     * Wide theme option render
     * @since 1.0.5
     */
    function mixmat_theme_margins_option_render(  ) {

        $options = get_option( 'mixmat_settings' );
        $mxmtmrg = (empty($options['mixmat_theme_margins_option'])) 
                    ? 10 : $options['mixmat_theme_margins_option'];
    ?>
    <input name="mixmat_settings[mixmat_theme_margins_option]" value="<?php echo absint($mxmtmrg); ?>" 
           type="number" min="0" max="320" step="1" /> 	

    <?php 
    echo "<p>";
    esc_html_e( 'This setting changes the amount of vertical space between boxes. Set to 0 to no spacing (on desktop).', 'mixmat' );
    echo "</p>"; 

    }

    //callback for description of section
    function mixmat_settings_section_callback(  ) {

    echo __( 'If you need to change color of background for individual sections please read below to
    find your selector', 'mixmat' );

    }

    /**
     * Render mixmat options on Admin Page.
     *
     * @since    1.0.0
     */
     function mixmat_admin_options_page() {

        echo '<div id="mxmtWrap" class="wrap">';
        echo '<p><hr></p><h1><span class="dashicons dashicons-admin-settings" style="font-size: 24px">
        </span> '; esc_html_e( ' MixMat PageMixer', 'mixmat' );
        echo '</h1><table class="table"><tbody><tr><td>';
        ?>

        <form action='options.php' method='post'>

        <?php
        settings_fields( 'mixmat_admin_pluginPage' );
        do_settings_sections( 'mixmat_admin_pluginPage' );

        submit_button();
        ?>

        </form></td></tr></tbody></table>
        
        <?php
        echo mixmat_display_admin_instructions();
        echo '</div>';

        }


/**
 * Provide a admin data view for the plugin
 *
 * @since      1.0.0
 *
 * @string $admHTML
 * @returns HTML
 */

function mixmat_display_admin_instructions() {
$admHtml = '';
$admHtml .= '<h2>';
$admHtml .= __( 'Page Sections Builder Information', 'mixmat' );
$admHtml .= '</h2>';
$admHtml .= '<table class="widefat">
<thead>
<tr><th>Shortcode</th>  <th>Property</th>        <th>Real code class/selector</th><th>Width</th></tr></thead><tbody>
<tr><td>[one][/one]</td><td>Spans full width</td><td>mxmt_one</td>       <td>100&percnt;</td></tr>
<tr><td>[one_half][/one_half]</td><td>Spans half width</td><td>mxmt_one_half</td>       <td>50&percnt;</td></tr>
<tr><td>[one_third][/one_third]</td><td>One third of a row</td><td>mxmt_one_third</td><td>33.33&percnt;</td></tr>
<tr><td>[one_fourth][/one_fourth]</td><td>One quarter of a row</td><td>mxmt_one_fourth</td><td>25&percnt;</td></tr>
<tr><td>[three_fourths][/three_fourths]</td><td>Three quarters of a row</td><td>mxmt_three_fourths</td><td>75&percnt;</td></tr>
<tr><td>[two thirds][/two thirds]</td><td>Two thirds</td><td>mxmt_two_thirds</td><td>66.66&percnt;</td></tr>
<tr><td>[empty_row][/empty_row]</td><td>Divider</td><td>mxmt_empty_row</td><td>100&percnt;</td></tr>
<tr><td>[last_one_half][/last_one_half]</td><td>1/2 + 1/2 may not need this</td><td>mxmt_last_one_half</td><td>50&percnt;</td></tr>
<tr><td>[last_one_third][/last_one_third]</td><td>Last selectors float right</td><td>mxmt_last_one_third</td><td>33.33&percnt;</td></tr>
<tr><td>[last_one_fourth][/last_one_fourth]</td><td>1/4 width at end</td><td>mxmt_last_one_fourth</td><td>25&percnt;</td></tr>
<tr><td>[last_three_fourths][/last_three_fourths]</td><td>Use with 1/4</td><td>mxmt_last_three_fourths</td><td>75&percnt;</td></tr>
<tr><td>[last_two_thirds][/last_two_thirds]</td><td>Use with 1/3</td><td>mxmt_last_two_thirds</td><td>66.66&percnt;</td></tr>
</tbody></table>';
$admHtml .= '<div id="mxmt_one_half">
            <table class="widefat"><thead><tr><th>Shortcode List</th></thead><tbody>
            <tr><td><code>[one][/one]</code></td></tr>
            <tr><td><code>[one_half][/one_half]</code></td></tr>
            <tr><td><code>[one_third][/one_third]</code></td></tr>
            <tr><td><code>[one_fourth][/one_fourth]</code></td></tr>
            <tr><td><code>[three_fourths][/three_fourths]</code></td></tr>
            <tr><td><code>[two thirds][/two thirds]</code></td></tr>
            <tr><td><code>[empty_row][/empty_row]</code></td></tr>
            <tr class="bgb"><td><code>[last_one_half][/last_one_half]</code></td></tr>
            <tr class="bgb"><td><code>[last_one_third][/last_one_third]</code></td></tr>
            <tr class="bgb"><td><code>[last_one_fourth][/last_one_fourth]</code></td></tr>
            <tr class="bgb"><td><code>[last_three_fourths][/last_three_fourths]</code></td></tr>
            <tr class="bgb"><td><code>[last_two_thirds][/last_two_thirds]</code></td></tr>
            <tr class="bgb"><td>';
$admHtml .= __( 'Last block in any row uses the <b><em>last_</em></b> selector.','mixmat' );
$admHtml .= '</td></tr> </tbody></table>

            </div><div id="mxmt_last_one_half">';

$admHtml .= '<table class="widefat"><thead><tr><th>Details</th></thead><tbody><tr><td><br><p>';
$admHtml .= __ ( 'Combinations must add up to 1. The last block in a row uses last_block_name to keep track of your rows and to
allow HTML to know which is the last block on your row. Without last_block_name the page will not look the way you expect it to look.', 'mixmat' );
$admHtml .= '</p></td></tr><tr><td><b>Usage</b><br>[one_half]Content sits between start &amp; close tags.[/one_half]
<br><b>Every row must equal one</b>
<pre>
1/2 + last_1/2 = 1 ----- one = 1
1/3 + last_2/3 = 1 ----- 1/3 + 1/3 + last_1/3 = 1
1/4 + last_3/4 = 1 ----- 1/4 + 1/4 + 1/4 + last_1/4 = 1
3/4 + last_1/4 = 1 ----- 1/2 + 1/4 + last_1/4 = 1
</pre></tbody></table></div>';
$admHtml .= '<hr>';

    return $admHtml;

}


/**
 * Send css to head
 * Theme width adjustment options
 * @since 1.0.5
 */
function mixmat_display_options_css() {

        $options   = get_option( 'mixmat_settings' );
        $mxmtcolor = empty($options['mixmat_color_field_0']) ? '#fafafa' 
                    : $options['mixmat_color_field_0'];
        $mxmtshado = empty($options['mixmat_color_field_1']) ? '#cdcdcd' 
                    : $options['mixmat_color_field_1'];
        $mxmtchk   = (empty($options['mixmat_theme_adjustment_option']) ) 
                      ? 0 : $options['mixmat_theme_adjustment_option'];
        $mxmtmrg   = (empty($options['mixmat_theme_margins_option'])) 
                     ? 10 : $options['mixmat_theme_margins_option'];
        
        ob_start();
        echo '[class^="mxmt_"]{';
        
        if( !empty ( $mxmtcolor ) ) : 
        echo 'background: ' . $mxmtcolor . ';';
        else : 
        echo 'background: transparent;';
        endif; 
        
        
        if( !empty ( $mxmtshado ) ) : 
        echo 'box-shadow: 0 1px 2px ' . $mxmtshado . ';';
        else : 
        echo 'box-shadow: none;';
        endif; 

        echo '}';

        if ( $mxmtchk != 0 ) :  
        echo '@media screen and (min-width: 768px) and (max-width: 992px){
        .mxmt_one_fourth,.mxmt_last_one_fourth{width: 48%;}}';
        endif;

        if ( $mxmtmrg > 0 ) :  
        echo '@media screen and (min-width: 711px){.mxmt_empty_row, .mxmt_one, .mxmt.mxmt_one_fourth, .mxmt_one_third, .mxmt_one_half, .mxmt_two_thirds, .mxmt_three_fourths,
        .mxmt_last_one_fourth, .mxmt_last_one_third, .mxmt_last_one_half,.mxmt_last_two_thirds, 
        .mxmt_last_three_fourths{margin-bottom: '. $mxmtmrg .'px;}}';
        endif;
    
    $styles = ob_get_clean();

    wp_register_style( 'mixmat-entry-set', false );
    wp_enqueue_style(   'mixmat-entry-set' );
    wp_add_inline_style( 'mixmat-entry-set', $styles );
}
add_action( 'wp_enqueue_scripts', 'mixmat_display_options_css');

//add_action( 'wp_head', 'mixmat_display_options_css' );

//tinyMCE editor functions
require plugin_dir_path( __FILE__ ) . 'mixmat-editor.php'; 
