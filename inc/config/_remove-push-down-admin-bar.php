<?php
add_action('get_header', 'remove_admin_bar_html_margin');

function remove_admin_bar_html_margin() {
  remove_action('wp_head', '_admin_bar_bump_cb');
}

?>