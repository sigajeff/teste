<?php
//model of args
// 'id'    => 'swiper-styles', //id 
// 'url'   =>  get_template_directory_uri() . '/assets/css/pos.min.css', // url
// 'path'   => get_template_directory() . '/assets/css/pos.min.css', //directory path
// 'condition' => !is_admin() && $GLOBALS['pagenow'] != 'wp-login.php', //condition to load the script
// 'version'   =>  'auto', //custom and fixed version or 'auto' for auto version
// 'extra-attribute'   => false, //if has extra attributes, insert a string with the values as should be copilled
// 'media' => 'all'
// 'deps' => array() //only works if footer
//////////////////////////////////////////////////////////////////////////////////////////
function add_all_css(){
    ///add your css here
    add_css($header = true, [
        'id'    => 'header-css',
        'url'   =>  assets_folder(true,false) . '/css/header.css',
        'path'   => assets_folder(false,false) . '/css/header.css',
        'condition' => !is_admin() && $GLOBALS['pagenow'] != 'wp-login.php',
        'version'   =>  'auto',
        'extra-attribute'   => false,
        'media' => 'all',
        'deps' => array()
    ]);

    add_css($header = false, [
        'id'    => 'footer-css',
        'url'   =>  assets_folder(true,false) . '/css/footer.css',
        'path'   => assets_folder(false,false) . '/css/footer.css',
        'condition' => !is_admin() && $GLOBALS['pagenow'] != 'wp-login.php',
        'version'   =>  'auto',
        'extra-attribute'   => false,
        'media' => 'all',
        'deps' => array()
    ]);
}

/////////////////////////////////////////////////////////////////////////////////////////
add_action( 'wp_enqueue_scripts' , function(){ enqueue_custom_styles(true); }  );
add_filter( 'style_loader_tag', 'add_css_extra_attributes', 10, 3 );
add_action( 'wp_footer' , function(){ enqueue_custom_styles(false); } );


function add_css($header = false, array $args){
    $header = $header ? 'header' : 'footer';
    $GLOBALS['custom_css'][$header][] = $args;
}

function enqueue_custom_styles($header = false){

    $GLOBALS['custom_css']['header'] = [];
    $GLOBALS['custom_css']['footer'] = [];
    $GLOBALS['css_extra_attributes'] = [];
    add_all_css();

    //footer
    if(!$header && !empty($GLOBALS['custom_css']['footer'])):

        foreach( $GLOBALS['custom_css']['footer'] as $css_attr ){

            //skip the item if do not match condition
            if(!$css_attr['condition']) continue;

            $url = $css_attr['url'];
            $extra_attr = ' ' . $css_attr['extra-attribute'];

            if(!$extra_attr){
                $extra_attr = '';
            }
            if( !file_exists($file_url) ) return false;
            return date("Ymd.hi", stat( $file_url )['ctime']);
            
            $mod_date = ( $css_attr['version'] ==  'auto' && $css_attr['path'] && file_exists($css_attr['path']) ) ? '?ver=' . date("Ymd.hi", stat( $css_attr['path'] )['ctime']) : false;

            $url .= ( $mod_date ) ? $mod_date : ( $css_attr['version'] != false  ? '?ver=' . $css_attr['version'] : '' );
            
            echo '<link rel="stylesheet" id="'.$css_attr['id'].'" href="'.$url.'" type="text/css" media="'.$css_attr['media'].'"'.$extra_attr.'>';   
        }

    endif;

    ///header
    if($header && !empty($GLOBALS['custom_css']['header'])):

        foreach( $GLOBALS['custom_css']['header'] as $css_attr ){

            //skip the item if do not match condition
            if(!$css_attr['condition']) continue;

            //define version
            $mod_date = ( $css_attr['version'] ==  'auto' && $css_attr['path'] && file_exists($css_attr['path']) ) ? date("Ymd.hi", stat( $css_attr['path'] )['ctime']) : false;
            $css_attr['version'] = ( $mod_date ) ? $mod_date : $css_attr['version'];

            //define extra attributes
            if($css_attr['extra-attribute']) $GLOBALS['css_extra_attributes'][$css_attr['id']] = $css_attr['extra-attribute'];
        
            wp_enqueue_style(
                $css_attr['id'], //handle 
                $css_attr['url'], //source, 
                $css_attr['deps'], //deps
                $css_attr['version'],//version
                $css_attr['media'] //media
            );
        }

    endif;
}

function add_css_extra_attributes($html,$handle){
    
    if(empty($GLOBALS['css_extra_attributes'])) return $html;
    foreach($GLOBALS['css_extra_attributes'] as $css_id => $extra_attr){
        if($css_id === $handle)
            $html = str_replace("<link","<link " . $extra_attr, $html);
    }
    return $html;
}
?>