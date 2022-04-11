<?php
function read_more_modif($content){
    $readmore = '<span class="more-text" data-target="more-text-' . get_the_ID() .'">';
    return str_replace( '<p><span id="more-' . get_the_ID() . '"></span></p>',  $readmore , $content );
    } 

add_filter( 'the_content', 'read_more_modif' );

function read_more_acf($content){
    $readmore = '<span class="more-text" data-target="more-text-' . get_the_ID() .'">';
    echo str_replace( '<p><!--more--></p>',  $readmore , $content );
} 
?>