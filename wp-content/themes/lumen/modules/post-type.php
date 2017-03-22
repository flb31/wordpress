<?php

class PostType {
  
  var $post_type;
  var $taxonomy;
  
  function __construct($post_type, $taxonomy) {
    $this->post_type = $post_type;
    $this->taxonomy = $taxonomy;

    add_action( 'init', array( $this, 'create_posttype'));
    add_action( 'init', array( $this, 'build_taxonomies'));
    add_action('admin_init', array( $this, 'customize_meta_boxes') );
    
    $file_name = dirname(__FILE__) . '/meta-box/' . $this->post_type . '.php';
    if(file_exists($file_name)) {
      include_once $file_name;
    }
    
    $function_name = 'meta_boxes_' . $this->post_type;
    if( function_exists($function_name) ) {
      add_filter( 'rwmb_meta_boxes', 'meta_boxes_' . $this->post_type );
    }
    
  }
  
  function customize_meta_boxes() {
    remove_post_type_support($this->post_type, 'editor');
  }
  
  function get_setting_post_type() {
    return Conf::$POST_TYPES[$this->post_type];
  }


  function create_posttype() {
    $setting = $this->get_setting_post_type();
    $plural_label = $setting['plural_label']; 
    $singular_label = $setting['singular_label']; 
    $menu_position = $setting['menu_position'];
    $icon = $setting['icon'];
    $text_domain = $setting['text_domain'];

    $args = array(
      'labels' => array(
        'name' => __( $plural_label ),
        'singular_name' => __( $singular_label ),
        'menu_name'           => __( $plural_label, $text_domain ),
        'parent_item_colon'   => __( 'Parent '.$singular_label, $text_domain ),
        'all_items'           => __( 'Todos los '.$plural_label, $text_domain ),
        'view_item'           => __( 'Ver '.$singular_label, $text_domain ),
        'add_new_item'        => __( 'Agregar nuevo '.$singular_label,  $text_domain ),
        'add_new'             => __( 'Agregar nuevo '.$singular_label, $text_domain ),
        'edit_item'           => __( 'Editar '.$singular_label, $text_domain ),
        'update_item'         => __( 'Actualizar '.$singular_label, $text_domain ),
        'search_items'        => __( 'Buscar '.$singular_label, $text_domain ),
        'not_found'           => __( $singular_label.' no encontrado', $text_domain ),
        'not_found_in_trash'  => __( "No hay $plural_label en la papelera", $text_domain )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => $this->post_type),
      'menu_position' => $menu_position,
      'menu_icon' => $icon
    );
    
    register_post_type( $this->post_type, $args);
  }


  function build_taxonomies() {
    register_taxonomy( $this->taxonomy, $this->post_type, array( 'hierarchical' => true, 'label' => 'Categorías', 'query_var' => true, 'rewrite' => true ) );

  }
}
