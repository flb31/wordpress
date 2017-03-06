<?php

class Conf {
  const TEXT_DOMAIN = 'lumen';
  const POSTYPE_DEMO = 'demo';
  const LIMIT_POSTS = 10;
  const PREFIX_DEMO = self::POSTYPE_DEMO . '_';

  public static $POST_TYPES = array(
    self::POSTYPE_DEMO => array(
        'plural_label' => 'Demos',
        'singular_label' => 'Demo',
        'description' => 'Demo Lumen',
        'menu_position' => 3,
        'icon' => 'dashicons-admin-users',
        'text_domain' => self::TEXT_DOMAIN,
      ),
  );
}
