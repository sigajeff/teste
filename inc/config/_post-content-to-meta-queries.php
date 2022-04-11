<?php
/* 
Solution created by Jeff Sobral @sigajeff @2021

This a simple, light and powerful function that filters the 'Wordpress Where' clause to allow comparitions to the posts content as meta queries. 

It's specially useful when there's the need to filter posts similar to the 's' WP_QUERY argument but along with meta queries which is not possible by Wordpress defaults

The usage: simply apply the same logic used in meta queries, but using 'post_content', 'post_title' and/or 'post_excerpt' as keys

example:
    $args = array(
        'lang' => 'pt', //this function does not conflit with plugins filters, just go ahead (example: polylang)
        'post_type' => 'produtos', 
        'post_status'   => 'publish',
        'posts_per_page' => 10,
        'paged' =>  1,
        'fields' => 'ids',
    );
    $args['meta_query] = [
        ['relation'] => 'OR'; //any relation you desire
        [
            'key' => 'acf_field', //any custom field (regular usage)
            'value' => $search, //any value (regular usage)
            'compare' => 'LIKE', //any comparition (regular usage)
        ],
        [
            'key' => 'post_title', //set the default post content of wordpress you desire ('post_content', 'post_title' and 'post_excerpt')
            'value' => $search, //any value
            'compare' => 'LIKE', //tested with 'LIKE and '=', works great and I can't realize other needs.
        ],
        [
            'key' => 'post_exerpt', // you can add how many times you need
            'value' => $search_2,
            'compare' => 'LIKE', 
        ],
    ];
    $the_query = new WP_Query( $args ); //jus query
    wp_reset_postdata(); //clean your query (WP recommendation)

    No conflicts: no need to worry, it won't conflict with other queries because it's a really especific replacement.

*/

function post_content_to_meta_queries($where, $wp_query){
    global $wpdb;


    //var_dump($wpdb);
    //if there is no metaquery, bye!
    $meta_queries = $wp_query->get( 'meta_query' );
    if( !$meta_queries || $meta_queries == '' ) return $where;

    //var_dump($where);

    //if only one relation
    $where = str_replace($wpdb->postmeta . ".meta_key = 'post_title' AND " . $wpdb->postmeta . ".meta_value", $wpdb->posts . ".post_title", $where);
    $where = str_replace($wpdb->postmeta . ".meta_key = 'post_content' AND " . $wpdb->postmeta . ".meta_value", $wpdb->posts . ".post_content", $where);
    $where = str_replace($wpdb->postmeta . ".meta_key = 'post_excerpt' AND " . $wpdb->postmeta . ".meta_value", $wpdb->posts . ".post_excerpt", $where);
    $where = str_replace($wpdb->postmeta . ".meta_key = 'p' AND " . $wpdb->postmeta . ".meta_value", $wpdb->posts . ".ID", $where);

    ////for nested relations

    //count the numbers of meta queries and make possible replacements
    $number_of_relations = count($meta_queries);

    //replace 'WHERE' using the multidimensional postmeta naming logic used by wordpress core
    $i = 1;
    while($i<=$number_of_relations && $number_of_relations > 0){
        $where = str_replace("mt".$i.".meta_key = 'post_title' AND mt".$i.".meta_value", $wpdb->posts . ".post_title", $where);
        $where = str_replace("mt".$i.".meta_key = 'post_content' AND mt".$i.".meta_value", $wpdb->posts . ".post_content", $where);
        $where = str_replace("mt".$i.".meta_key = 'post_excerpt' AND mt".$i.".meta_value", $wpdb->posts . ".post_excerpt", $where);
        $where = str_replace("mt".$i.".meta_key = 'p' AND mt".$i. ".meta_value", $wpdb->posts . ".ID", $where);
        
        
        $i++;
    }

    return $where;
}

add_filter('posts_where','post_content_to_meta_queries',10,2);

?>