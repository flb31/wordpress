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
add_action( PREFIX . '_head', 'meta_opengraph' );
add_action( PREFIX . '_head', 'meta_noindex' );
