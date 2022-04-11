<?php
    //DO NOT WRITE FUNCTIONS HERE, USE THE FILE INC/_MODULES.PHP

    //change this var to true to test production on local environment
    DEFINE('test_prod', false );

    //check if it's dev or prod
    DEFINE('is_dev', strpos( $_SERVER['HTTP_HOST'],'localhost') !== false && !CONSTANT('test_prod'));
    DEFINE('assets_folder', CONSTANT('is_dev') ? 'dev' : 'assets');

    //Define assets folder to dev if its local environment
    //use assets_folder() to get url or directory path.
    //if URL is false, return DIR path;
    //if echo is false, return as string;
    function assets_folder($url = true, $echo = true){
        if($url){
            $return = ( function_exists( 'get_template_directory_uri') ? get_template_directory_uri() . '/' : '' ) . constant('assets');
        }else{
            $return = ( function_exists( 'get_template_directory') ? get_template_directory() . '/' : '' ) . constant('assets');
        }

        if(!$echo) return $return;

        echo $return;
    }

    ////Include all files recursively inside a folder
    function include_php_files_in_folder($dir){
        if(!is_dir($dir)) return;
        foreach (glob($dir ."/*.php") as $path){
            include_once $path;
        }
    }

    //rotas
    include_once('api/_router.php');

    //templates de ajax
    add_filter( 'wp_footer', function(){ get_template_part('/api/_templates'); } );

    //módulos
    include_once('inc/_modules.php');//módulos
    
?>