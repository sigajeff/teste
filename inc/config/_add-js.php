<?php
//model of args
// 'id'    => 'bundle',
// 'in_footer' => true,
// 'url' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js',
// 'path'  => false, //set false if external link  
// 'condition' => !is_admin() && $GLOBALS['pagenow'] != 'wp-login.php', // example: is_singular('produto') //set TRUE if always shown
// 'auto-version' => false, //change file version each time the code is updated, work only for local files
// 'deps' => false,
// 'version' => false,  'auto', //custom and fixed version or 'auto' for auto version
// 'extra-attribute' => false,
//////////////////////////////////////////////////////////////////////////////////////////
function add_all_js(){
    ///add your css here
    add_js([
        'id'    => 'bundle',
        'in_footer' => true,
        'url'   =>  assets_folder(true,false) . '/js/bundle.js',
        'path'   => assets_folder(false,false) . '/js/bundle.js',
        'condition' => !is_admin() && $GLOBALS['pagenow'] != 'wp-login.php',
        'auto-version' => 'auto', 
        'deps' => false,
        'version' => false, 
        'extra-attribute' => false,
    ]);
}
//////////////////////////////////////////////////////////////////////////////////////////
add_action( 'wp_enqueue_scripts' , 'enqueue_js' );
add_filter( 'script_loader_tag' , 'add_js_extra_attributes' , 10 , 3 );

function add_js(array $args){
    $GLOBALS['custom_js'][] = $args;
}

function enqueue_custom_script(){

    $GLOBALS['custom_js'] = [];
    $GLOBALS['js_extra_attributes'] = [];
    add_all_js();

    if(empty($GLOBALS['custom_js'])) return;

    foreach($GLOBALS['custom_js'] as $js_attr){

        //skip the item if do not match condition
        if(!$js_attr['condition']) continue;

        //generate auto version, change file version each time the code is updated, work only for local files
        $mod_date = ( $js_attr['version'] ==  'auto' && $js_attr['path'] && file_exists($js_attr['path']) ) ? date("Ymd.hi", stat( $js_attr['path'] )['ctime']) : false;
        $js_attr['version'] = ( $mod_date ) ? $mod_date : $js_attr['version'];

        //extra attributes
        if($js_attr['extra-attribute']) $GLOBALS['js_extra_attributes'][$js_attr['id']] = $js_attr['extra-attribute'];
        
        wp_enqueue_script(
            $js_attr['id'], //handle 
            $js_attr['url'], //source, 
            $js_attr['deps'], //deps
            $js_attr['version'],//version
            $js_attr['in_footer'] //in footer?
        );
    }
}

//add extra attributes for scripts
function add_js_extra_attributes($html,$handle){

    if( empty($GLOBALS['js_extra_attributes']) ) return $html;

    foreach($GLOBALS['js_extra_attributes'] as $js_id => $extra_attr){
        if($js_id === $handle)
            $html = str_replace("<script","<script " . $extra_attr, $html);
    }

    return $html;
}


?>