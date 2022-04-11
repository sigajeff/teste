<?php

function add_classes_to_body( $classes ){

    global $post;

    // if( !is_home() )
    //     $classes[] = 'header-container';

    return $classes;

}

add_filter( 'body_class', 'add_classes_to_body' );
?>