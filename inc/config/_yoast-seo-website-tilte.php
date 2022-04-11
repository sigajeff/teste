<?php

add_theme_support( 'title-tag' );

//SET PAGE TITLE AS YOASTSEO DEFINITION
if(!is_admin()){

    if(get_the_ID()){

        if(function_exists('YoastSEO')){
            $ogtitle = YoastSEO()->meta->for_post(get_the_ID())->open_graph_title;
        }
        
        if(isset($ogtitle)){
            if($ogtitle != null && $ogtitle != false){
                apply_filters( 'wp_title', $ogtitle , 10, 2 );
            }
        }

    }
}

?>