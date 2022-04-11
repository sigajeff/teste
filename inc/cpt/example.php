<?php
///REGISTRAR CUSTOM POST 
//add_action( 'init', 'custom_post_type_example' );
 
function custom_post_type_example() {
 
  $labels = array(
    'name'               => __( 'Exemplos' ),
    'singular_name'      => __( 'Exemplo' ),
    'add_new'            => __( 'Adicionar Novo Exemplo' ),
    'add_new_item'       => __( 'Adicionar Novo Exemplo' ),
    'edit_item'          => __( 'Editar Exemplo' ),
    'new_item'           => __( 'Novo Exemplo' ),
    'all_items'          => __( 'Todos Exemplos' ),
    'view_item'          => __( 'Ver Exemplo' ),
    'search_items'       => __( 'Buscar Exemplo' ),
  );
 

  $args = array(
    'labels'            => $labels,
    'description'       => __('Arquivo de Exemplos'),
    'public'            => true,
    'menu_position'     => 5,
    'supports'          => array( 'title', 'editor','author','excerpt','thumbnail'),
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'has_archive'       => true,
    'menu_icon'         => 'dashicons-media-interactive',
    'query_var'         => 'example',
	'taxonomies'        => array(),
    'publicly_queryable' => true
  );
 
  register_post_type( 'example', $args);

  register_taxonomy('category_example', array('example'), array(
    "hierarchical" => true, 
    "label" => __("Categorias Exemplo"), 
    "singular_label" => __("Categoria Exemplo"), 
    "rewrite" => array('slug' => 'category_example'),
    "show_admin_column" => true
  )); 

  register_taxonomy('tag_example', array('example'), array(
    "hierarchical" => false, 
    "label" => __("Tags Exemplo"), 
    "singular_label" => __("Tag Exemplo"), 
    "rewrite" => array('slug' => 'tag_example'),
    "show_admin_column" => true
  )); 
  
}
  

?>