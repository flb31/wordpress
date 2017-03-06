<?php

include 'lib/conf.php';
include 'lib/util.php';
include 'modules/thumb.php';
include 'modules/post-type.php';
include 'modules/general-setting.php';
include 'admin-login/login.php';
include 'admin-colors/admin-colors.php';


function load_post_type() {
  $keys = array_keys(Conf::$POST_TYPES);
  foreach($keys as $post_type) {
    new PostType($post_type);
  }
}

add_action('init', 'load_post_type', 0);
