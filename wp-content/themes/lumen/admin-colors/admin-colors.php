<?php

function additional_admin_color_schemes() {
  //Get the theme directory
  $theme_dir = get_template_directory_uri();
 
  //Ocean
  wp_admin_css_color( 'lumen', __( 'Lumen Digital' ),
    $theme_dir . '/admin-colors/lumen/colors.min.css',
    array( '#4ea1af', '#225962', '#f7d039', '#9a9a9a' )
  );
}

function set_default_admin_color($user_id) {
  $args = array(
    'ID' => $user_id,
    'admin_color' => 'lumen'
  );
  wp_update_user( $args );
}

function rename_fresh_color_scheme() {
  global $_wp_admin_css_colors;
  $color_name = $_wp_admin_css_colors['fresh']->name;
 
  if( $color_name == 'Default' ) {
    $_wp_admin_css_colors['fresh']->name = 'Lumen Digital';
  }
  return $_wp_admin_css_colors;
}

add_action('admin_init', 'additional_admin_color_schemes');
add_filter('admin_init', 'rename_fresh_color_scheme');
add_action('user_register', 'set_default_admin_color');