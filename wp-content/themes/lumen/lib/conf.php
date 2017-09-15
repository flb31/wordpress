<?php

class Conf {
  const TEXT_DOMAIN = 'lumen';
  const LIMIT_POSTS = 10;
  const PREFIX = 'LD';
  
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
  
  public static function default_image_opengraph() {
    return self::custom_image(200, 200, '' );
  }
  
  public static function custom_image($width, $height, $text ) {
    return "https://placeholdit.imgix.net/~text?txtsize=33&txt={$text}&w={$width}&h={$height}&bg=cccccc&txtclr=ffffff";
  }
}
