<?php
/**
 * The plugin form rendering file
 *
 * @since             1.0.0
 * @package           Mixmat
 * @subpackage        Mixmat/includes
 *
*/
add_action( 'admin_footer', 'mixmat_render_mce_popup' );
add_action( 'media_buttons', 'mixmat_render_media_buttons' );

//move wpautop filter to AFTER shortcode is processed
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 99);
add_filter( 'the_content', 'shortcode_unautop',100 );


/**
 * HTML mark-up for an enclosing shortcode
 * make sure they are all loaded before calling into js
 * @wp do_shortcode()
 * @array .mxmt-xs-3, .mxmt-xs-4, .mxmt-xs-6, .mxmt-xs-8, .mxmt-xs-9, .mxmt-xs-12
 * @facevalue  1/4    1/3    1/2    2/3    3/4    one
 *
 * Custom shortcode callback function
 *
 * @param array  $atts
 * @param string $content
 * @return string
 */

function mixmat_shortcode_callback_one( $atts = null, $content = null ) {
    $defaults = array();
    $settings = shortcode_atts( $defaults, wp_parse_args( $atts ) );

    $output = '<div class="mxmt_one">' . shortcode_unautop( $content ) . '</div>';
    return $output;
}

// 1/2
function mixmat_shortcode_callback_one_half( $atts = null, $content = null ) {
    $defaults = array();
    $settings = shortcode_atts( $defaults, wp_parse_args( $atts ) );

    $output = '<div class="mxmt_one_half">' . shortcode_unautop ( $content ) . '</div>';
    return $output;
}

//1/4
function mixmat_shortcode_callback_one_fourth( $atts = null, $content = null ) {
    $defaults = array();
    $settings = shortcode_atts( $defaults, wp_parse_args( $atts ) );

    $output = '<div class="mxmt_one_fourth">' . shortcode_unautop( $content ) . '</div>';
    return $output;
}

//1/3
function mixmat_shortcode_callback_one_third( $atts = null, $content = null ) {
    $defaults = array();
    $settings = shortcode_atts( $defaults, wp_parse_args( $atts ) );

    $output = '<div class="mxmt_one_third">' . shortcode_unautop( $content ) . '</div>';
    return $output;
}

//2/3
function mixmat_shortcode_callback_two_thirds( $atts = null, $content = null ) {
    $defaults = array();
    $settings = shortcode_atts( $defaults, wp_parse_args( $atts ) );

    $output = '<div class="mxmt_two_thirds">' . shortcode_unautop( $content ) . '</div>';
    return $output;
}
//add_action( 'init',  'mixmat_shortcode_callback_one_third' );



//3/4
function mixmat_shortcode_callback_three_fourths( $atts = null, $content = null ) {
    $defaults = array();
    $settings = shortcode_atts( $defaults, wp_parse_args( $atts ) );

    $output = '<div class="mxmt_three_fourths">' . shortcode_unautop( $content ) . '</div>';
    return $output;
}
//add_action( 'init',  'mixmat_shortcode_callback_three_fourths' );



//last one half
function mixmat_shortcode_callback_last_one_half( $atts = null, $content = null ) {
    $defaults = array();
    $settings = shortcode_atts( $defaults, wp_parse_args( $atts ) );

    $output = '<div class="mxmt_last_one_half">' . shortcode_unautop( $content ) . '</div>';
    return $output;
}

//last_one_fourth
function mixmat_shortcode_callback_last_one_fourth( $atts = null, $content = null ) {
    $defaults = array();
    $settings = shortcode_atts( $defaults, wp_parse_args( $atts ) );

    $output = '<div class="mxmt_last_one_fourth">' . shortcode_unautop( $content ) . '</div>';
    return $output;
}

// last 1/3
function mixmat_shortcode_callback_last_one_third( $atts = null, $content = null ) {
    $defaults = array();
    $settings = shortcode_atts( $defaults, wp_parse_args( $atts ) );

    $output = '<div class="mxmt_last_one_third">' . shortcode_unautop( $content ) . '</div>';
    return $output;
}

//2/3
function mixmat_shortcode_callback_last_two_thirds( $atts = null, $content = null ) {
    $defaults = array();
    $settings = shortcode_atts( $defaults, wp_parse_args( $atts ) );

    $output = '<div class="mxmt_last_two_thirds">' . shortcode_unautop( $content ) . '</div>';
    return $output;
}

//3/4
function mixmat_shortcode_callback_last_three_fourths( $atts = null, $content = null ) {
    $defaults = array();
    $settings = shortcode_atts( $defaults, wp_parse_args( $atts ) );

    $output = '<div class="mxmt_last_three_fourths">' . shortcode_unautop( $content ) . '</div>';
    return $output;
}

//0/0
function mixmat_shortcode_callback_empty_row( $atts = null, $content = null ) {
    $defaults = array();
    $settings = shortcode_atts( $defaults, wp_parse_args( $atts ) );

    $output = '<div class="mxmt_empty_row">' . shortcode_unautop( $content ) . '</div>';
    return $output;
}

/**
 * Utility to add MCE Popup fired by custom Media Buttons button
 * @param $tgh string Text goes here translatable text string.
 * 
 * @since 1.0.7
 * @hook admin_footer
 */
function mixmat_render_mce_popup() {

$tgh = __( 'Start content here', 'mixmat' );
?>
    <div id="mxmt_refer_shortcode" style="display:none;">

        <div>
            <div style="padding:15px 15px 0 15px;">
                <h3><?php esc_html_e('Mixmat PageMixer ','mixmat'); ?></h3>
<h3>First</h3>
<ul><li>Open <strong>Text</strong> tab in editor 
<div class="wp-editor-tabs"><button type="button" id="" class="wp-switch-editor switch-tmce">Visual</button>
<button type="button" id="" class="wp-switch-editor switch-html" style="background:#fefefe">Text</button>
</div></li>
</ul>
<table class="widefat" id="mxmtListB">
    <tbody><tr><td></tdf></tr></tbody>
</table>
<h3>Next</h3>
<ul><li>Determine layout and <strong>find code</strong> to use inside the Editor.
<div class="wp-editor-tabs"><button type="button" id="" class="wp-switch-editor switch-tmce">Visual</button>
<button type="button" id="" class="wp-switch-editor switch-html" style="background:#fefefe">Text</button>
</div></li>
</ul>
<table class="widefat" id="mxmtListC">
<thead><tr><th>columns</th><th>#of</th><th>copy (CTRL+C)</th></tr></thead>
    <tbody><tr><td>[________]</td><td>1</td><td>&lt;div class="mixmat_one"&gt;Text goes here&lt;/div></td></tr>
    <tr><td>[___][___]</td>
        <td>2</td><td>&lt;div class="mxmt_one_half"&gt;<?php print($tgh); ?>&lt;/div>
                    &lt;div class="mxmt_last_one_half"&gt;<?php print($tgh); ?>&lt;/div>
                    </td></tr>
    <tr><td>[__][__][__]</td>
        <td>3</td><td>&lt;div class="mixmat_one_third"&gt;<?php print($tgh); ?>&lt;/div>
                    &lt;div class="mixmat_one_third"&gt;<?php print($tgh); ?>&lt;/div>
                    &lt;div class="mixmat_last_one_third"&gt;<?php print($tgh); ?>&lt;/div>
                    </td></tr>
    <tr><td>[_][_][_][_]</td>
        <td>4</td><td>&lt;div class="mixmat_one_forth"&gt;<?php print($tgh); ?>&lt;/div>
                    &lt;div class="mixmat_one_forth"&gt;<?php print($tgh); ?>&lt;/div>
                    &lt;div class="mixmat_one_forth"&gt;<?php print($tgh); ?>&lt;/div>
                    &lt;div class="mixmat_last_one_forth"&gt;<?php print($tgh); ?>&lt;/div>
                    </td></tr></tbody>
</table>

<h3>Then</h3>
<ul><li>Paste the code (CTRL+V) into the <strong>Text Editor</strong>
<div class="wp-editor-tabs"><button type="button" id="" class="wp-switch-editor switch-tmce">Visual</button>
<button type="button" id="" class="wp-switch-editor switch-html" style="background:#fefefe">Text</button>
</div></li>
</ul>
<table class="widefat" id="mxmtListD"><tbody><tr><td>
&lt;div class="mxmt_one_half"&gt;Example two columns&lt;/div>
                    &lt;div class="mxmt_last_one_half"&gt;Last one half column&lt;/div>
                    </td></tr></tbody></table>
<h3>Last Step</h3>
<ul><li><strong>Switch to Visual Editor tab</strong>
<div class="wp-editor-tabs"><button type="button" id="" class="wp-switch-editor switch-tmce" style="background:#fefefe">Visual</button>
<button type="button" id="" class="wp-switch-editor switch-html" >Text</button>
</div></li>
</ul>
<table class="widefat" id="mxmtListD"><tbody><tr><td>
Have Fun and remember "Content is King/Queen"
</td></tr></tbody></table>
                <div style="padding:15px;"><!--
                    <input type="button" class="button-primary" value="Insert Shortcode"
                    onclick="InsertContainer()" name="submit" />&nbsp;&nbsp;&nbsp; -->
                    <a class="button" href="#" onclick="tb_remove();
                            return false;"><?php esc_html_e('Close', 'mixmat'); ?></a>
                </div>
                <div class="mxmt-footer">
                    <h5><?php esc_html_e( 'Examples', 'mixmat' ); ?></h5>
<p style="line-height: 1; margin: 6px 0;">1/2 + last_1/2 = 1 ----- one = 1</p>
<p style="line-height: 1; margin: 6px 0;">1/3 + last_2/3 = 1 ----- 1/3 + 1/3 + last_1/3 = 1</p>
<p style="line-height: 1; margin: 6px 0;">1/4 + last_3/4 = 1 ----- 1/4 + 1/4 + 1/4 + last_1/4 = 1</p>
<p style="line-height: 1; margin: 6px 0;">3/4 + last_1/4 = 1 ----- 1/2 + 1/4 + last_1/4 = 1</p>
<p><?php esc_html_e( 'Empty row [empty_row][/empty_row] is a spacer with border on top.', 'mixmat' ); ?></p>
<p><?php esc_html_e( 'As an alternative to copy/paste, you may type in shortcode', 'mixmat' ); ?></p>
</div>

            </div>

    </div>
    <?php

    }

/**
 * Utility to add MCE Popup button to the Media Buttons section which lies directly
 * above the Visual / Text Editor
 *
 * @hook media_buttons
 */
function mixmat_render_media_buttons() {

    ?>
    <a href = "#TB_inline?width=680&height=820&inlineId=mxmt_refer_shortcode"
    class = "button thickbox mxmt_doin_media_link" id = "add_div_shortcode"
    title = "choose shortcode">PageMixer</a>
    <?php
}


if ( !function_exists('mixmat_fix_shortcodes') ) {
    function mixmat_fix_shortcodes($content){
        $array = array (
            '<p>[' => '[',
            ']</p>' => ']',
            ']<br />' => ']'
        );
        $content = strtr($content, $array);
        return $content;
    }
    add_filter('the_content', 'mixmat_fix_shortcodes');
}
