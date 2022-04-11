<?php
//Register Menu Places
function register_custom_nav_menu(){

    $menus = [
    'main_menu' => 'Main Menu',
    'footer_menu' => 'Footer Menu',
    'social_menu'   => 'Social Menu',
    ];

    register_nav_menus( $menus );
}

add_action( 'after_setup_theme', 'register_custom_nav_menu', 0 );

?>