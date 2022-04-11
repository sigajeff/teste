<?php
/****
Please, if you notice any important config file is missing, submit the requisition to https://github.com/sigajeff/atonal_bp.git
******/

//include utilities
include_php_files_in_folder( function_exists( 'get_template_directory' ) ? get_template_directory() . '/' : '' . 'inc/utils' );

//include custom post types
include_php_files_in_folder( function_exists( 'get_template_directory' ) ? get_template_directory() . '/' : '' . 'inc/cpt' );

/**** Config ****/
if(function_exists('get_template_directory')):

    $config_path =  get_template_directory() . '/inc/config/';

    //Remove actions - clean header
    include_once $config_path . '_remove-actions.php';

    //Remove admin bar body margin
    include_once $config_path . '_remove-actions.php';

    //Theme supports
    include_once $config_path . '_add-theme-support.php';

    //Menu locations
    include_once $config_path . '_register-menus.php';

    //Image sizes
    include_once $config_path . '_image-sizes.php';

    //Add custom css
    include_once $config_path . '_add-css.php';

    //Add custom js
    include_once $config_path . '_js-enqueue.php';

    //Add body classes
    include_once $config_path . '_add-classes-to-body.php';

    //Polylang vars
    include_once $config_path . '_polylang-strings.php';

    //Custom code to modify wordpress complex search
    include_once $config_path . '_post-content-to-meta-queries.php';

    //Enable subfields query for ACF
    include_once $config_path . '_acf-subfields-to-meta-queries.php';

    //Replace page title if page has Yoast SEO title defined
    include_once $config_path . '_yoast-seo-website-title.php';

endif;

//////Atonal Plugins
if(function_exists('get_template_directory')):
    $plugins_path = get_template_directory() . '/plugins'.'/';
    
    // Notes plugins
    // $GLOBALS['wpse72394_plugin_admin_css_classes']['v0'] = [ 
    //     '.acf-field-6178e06da145d' 
    // ]; include_once $plugins_path . 'notes/v0/setup.php';

    // Read-more plugins
    //include_once $plugins_path . 'read-more/v0/setup.php';

endif;


?>