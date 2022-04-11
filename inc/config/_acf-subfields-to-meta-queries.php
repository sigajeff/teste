<?php
//add acf subfiels to metaquery
function acf_subfields_query( $where ) {
	$parent_fields = [
        'layout',
        'template'
    ];
    foreach($parent_fields as $parent){
        $where = str_replace("meta_key = '".$parent."_$", "meta_key LIKE '".$parent."_%", $where);
    }

	return $where;
}

add_filter('posts_where', 'acf_subfields_query',10,2);
?>