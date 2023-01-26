/**
 * Mixmat custom script for colorpicker
 */
jQuery(document).ready(function($) {
    $("#mixmat_color").wpColorPicker();  
    $("#mixmat_shado").wpColorPicker(); 
    $(document).ajaxSuccess(function(e, xhr, settings) {
        $("#mixmat_color").wpColorPicker();
        $("#mixmat_shado").wpColorPicker(); 
    });
});

