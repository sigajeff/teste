<?php
function include_folder($dir){
    
    if(!is_dir($dir)) return;

    foreach (glob($dir ."/*.php") as $path){
        include_once $path;
    }
}
include_folder( get_template_directory() . '/inc/utilities' );
include_folder( get_template_directory() . '/inc/cpt' );


?>