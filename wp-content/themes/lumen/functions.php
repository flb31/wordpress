<?php

include 'lib/conf.php';
include 'lib/util.php';
include 'modules/thumb.php';
include 'modules/post-type.php';
include 'modules/general-setting.php';
include 'admin-login/login.php';
include 'admin-colors/admin-colors.php';


function load_post_type() {
  $types = Conf::$POST_TYPES;
  foreach($types as $post_type => $item) {
    new PostType($post_type, $item['taxonomy']);
  }
}

add_action('init', 'load_post_type', 0);
