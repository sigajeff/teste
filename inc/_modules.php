<?php

//Include all files recursively inside a folder
function include_folder($dir){
    if(!is_dir($dir)) return;
    foreach (glob($dir ."/*.php") as $path){
        include_once $path;
    }
}

//change this var to true to test production on local environment
////insert a '.prod' file in theme root folder to test production environment
DEFINE('test_prod', false );

//check if it's dev or prod
DEFINE('is_dev', strpos( $_SERVER['HTTP_HOST'],'localhost') !== false && !CONSTANT('test_prod'));

//Define assets folder to dev if its local environment
DEFINE('assets', CONSTANT('is_dev') ? '/dev' : '/assets' );

//call elements inside folder;
include_folder( get_template_directory() . '/inc/utilities' );
include_folder( get_template_directory() . '/inc/cpt' );


?>