<?php

class Conf {
  const TEXT_DOMAIN = 'lumen';
  const LIMIT_POSTS = 10;
  
  //Post type
  const POSTYPE_DEMO = 'demo';
  const PREFIX_DEMO = self::POSTYPE_DEMO . '_';

  public static $POST_TYPES = array(
    self::POSTYPE_DEMO => array(
        'taxonomy' => self::POSTYPE_DEMO . 's',
        'plural_label' => 'Demos',
        'singular_label' => 'Demo',
        'description' => 'Demo Lumen',
        'menu_position' => 3,
        'icon' => 'dashicons-admin-users', //Search icon in: https://developer.wordpress.org/resource/dashicons/
        'text_domain' => self::TEXT_DOMAIN,
      ),
  );
}
