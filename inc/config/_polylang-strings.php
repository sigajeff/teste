<?php
// ‘$name’ => (required) name provided for sorting convenience (ex: ‘myplugin’)
// ‘$string’ => (required) the string to translate
// ‘$group’ => (optional) the group in which the string is registered, defaults to ‘polylang’
// ‘$multiline’ => (optional) if set to true, the translation text field will be multiline, defaults to false

function polylang_register_strings(){
    if(!function_exists('pll_register_string')) return;
    
    pll_register_string($name = 'publicado_em', $string = 'Publicado em', $group = 'Posts', $multiline = false);
  
}

add_action('init', 'polylang_register_strings');

?>