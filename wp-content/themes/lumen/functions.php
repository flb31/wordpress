<?php

include 'lib/conf.php';
include 'lib/util.php';
include 'modules/thumb.php';
include 'modules/post-type.php';
include 'modules/general-setting.php';
include 'admin-login/login.php';
include 'admin-colors/admin-colors.php';


// Load actions
add_action('init', 'load_post_type', 0);
add_action( Conf::PREFIX . 'head', 'meta_opengraph' );
add_action( Conf::PREFIX . 'head', 'meta_noindex' );
add_action('get_header', 'get_start_page');
