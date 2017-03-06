<?php

function my_login_stylesheet() {
  wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/admin-login/style-login.css' );
  //wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/style.js' );
}

function login_footer_custom(){
  ?>
  <div class="copyright">
    <a href="http://lumendigital.co/" target="_blank" title="Lumen Digital">
      <img src="<?= get_stylesheet_directory_uri() ?>/admin-login/img/Lumendigitallogologin.png" alt="">
    </a>
  </div>
<?php
}

function my_login_logo_url() {
  return home_url();
}

function change_text_login ( $text ) {
  if ($text == 'Username or Email'){
   $text = 'Usuario o Correo electrónico';
  }else if($text == '&larr; Volver a %s'){
   $text = 'Ir a Home';
  }
  return $text;
}

add_filter( 'gettext', 'change_text_login' );
add_filter( 'login_headerurl', 'my_login_logo_url' );
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );
add_action( 'login_footer', 'login_footer_custom' );