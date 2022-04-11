<?php 
add_action('init','custom_theme_support');

function custom_theme_support(){
    //Habilitar menus
    add_theme_support('menus');

    ////Title tag must be declared for default
    add_theme_support( 'title-tag' );

    //allow post thumbnails
    add_theme_support( 'post-thumbnails');

    //ACF options Page
    if( function_exists('acf_add_options_page') )
            acf_add_options_page('Opções do site');
    
}
?>