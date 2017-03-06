<?php

class PostType {
  
  var $post_type;
  
  function __construct($post_type) {
    $this->post_type = $post_type;
    add_action( 'init', array( $this, 'create_posttype') );
    add_action( 'init', array( $this, 'custom_post_type'), 0 );
    add_action( 'init', array( $this, 'build_taxonomies'), 0 );
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


  /*
  * Creating a function to create the Custom Post Type
  */

  function custom_post_type() {

    $setting = $this->get_setting_post_type();
    $plural_label = $setting['plural_label']; 
    $description = $setting['description'];
    $menu_position = $setting['menu_position'];
    $text_domain = $setting['text_domain'];

  // Set other options for Custom Post Type

  $args = array(
    'label'               => __( $plural_label, $text_domain ),
    'description'         => __( $description, $text_domain ),
    // Features in Post Editor
    'supports'            => array( 'title', 'author', 'comments'  ),
    // Taxonomies or custom taxonomy.
    //'taxonomies'          => array( 'category' ),
    /* A hierarchical CPT is like Pages and can have
    * Parent and child items. A non-hierarchical CPT
    * is like Posts.
    */
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => $menu_position,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
  );

    // Registering Custom Post Type
    register_post_type( $this->post_type, $args );

  }


  function build_taxonomies() {
    register_taxonomy( $this->post_type, $this->post_type, array( 'hierarchical' => true, 'label' => 'Categorías', 'query_var' => true, 'rewrite' => true ) );

  }
}
