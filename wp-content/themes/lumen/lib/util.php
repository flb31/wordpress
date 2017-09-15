<?php

  function the_slug($echo=true){
    $slug = basename(get_permalink());
    do_action('before_slug', $slug);
    $slug = apply_filters('slug_filter', $slug);
    if( $echo ) echo $slug;
    do_action('after_slug', $slug);
    return $slug;
  }

  function args_category($custom_args = FALSE){
    $args = array('hide_empty' => 0, 'pad_counts' => true, 'parent' => 0, 'exclude' => 1);
    if(is_array($custom_args)){
      $args = array_merge($args, $custom_args);
    }
    return $args;
  }

  function title_section() {
    
    ob_start();
      single_cat_title();
      $cat_title = ob_get_contents();
    ob_end_clean();

    if(strlen( $cat_title ) > 0) {
      return $cat_title;
    } else {
      return get_the_title();
    }
  }

  function get_title_page($title) {
    return $title . ' :: ' . get_bloginfo('name');
  }

  function get_the_description() {
    
    $have_post = have_posts();
    the_post();
    $post_type = array('post', 'page');
    if($have_post && (in_array(get_post_type(), $post_type) || in_array(the_slug(false), get_static_page() ) ) ){
      $description = get_the_content();
    }else{
      $cat = get_query_var('cat');
      if($cat > 0){
        $category = get_category($cat);  
      }else{
        $category = get_category_by_slug(the_slug(false));
      }
      $description = $category->description;
    }
    
    return verify_description($description);
  }

  function get_static_page() {
    return array();
  }


  function verify_description($description){
    return (strlen($description) > 0)? cut_description($description) : get_option( 'meta_description' );
  }

  function cut_description($content){
    $max_length = 155;
    $content = clean_description($content);
    return substr($content, 0, $max_length);
  }

  function clean_description($content){  
    $content = strip_tags($content);
    $content = preg_replace('/\[[^\[\]]*\]/', '', $content);
    $content = trim($content);
    return $content;
  }

  function print_array($array, $die = false){
    echo '<pre>'; print_r($array); echo '</pre>';
    if($die){
      die;
    }
  }

  function to_string($html){
    return html_entity_decode(stripslashes_deep( $html));
  }
  
  function to_html($string){
    return html_entity_decode( stripslashes( $string ), ENT_QUOTES);
  }

  function rand_version() {
    return rand(100000, 1000000);
  }

  function get_string_date($date, $format = 'F Y'){
    return date_i18n($format, strtotime($date));
  }

  function get_current_url() {
    global $wp;
    $current_url = home_url(add_query_arg(array(),$wp->request)) . '/';
    return $current_url;
  }

  function clone_array($arr) {
    $clone = array();
    foreach ($arr as $k => $v) {
      if(is_array($v)){
        $clone[$k] = clone_array($v);
      }else {
        $clone[$k] = $v;
      }
    }
    return $clone;
  }

  function get_image_advance($id, $size, $tag, $once = TRUE) { 
    $images = rwmb_meta($tag, $size, $id);
    if(!$once) {
      return $images;
    }
    if(is_array($images) ) {
      foreach($images as $image) {
        return $image['url'];
      }
    }
    
    return FALSE;
  }

  function get_cat($slug) {
    $cat =  get_category_by_slug($slug);
    return ( !isset($cat) ) ? FALSE : $cat->term_id;
  }

  function LD_get_posts($post_type, $search, $page, $cat) {
    $post_type = 'post';
    $cat_id = get_cat($cat);
    
    if(isset( $page ) && is_numeric($page) && $page > 0) {
      $offset = $page * Conf::LIMIT_POSTS;
    } else {
      $offset = 0;
    }

    $args = array(
      'cat' => $cat_id,
      'post_type' => $post_type,
      's' => $search,
      'posts_per_page' => Conf::LIMIT_POSTS,
      'order' => 'DESC',
      'offset' => $offset
    );

    $posts = new WP_Query( $args );
    
    return $posts;
  }

  function LD_get_template_part($slug, $name = '', $data = FALSE) {
    process_set_var($data);
    get_template_part($slug, $name);
  }

  function process_set_var($data) {
    if(is_array($data)) {
      foreach($data as $key => $val) {
        set_query_var( Conf::PREFIX . $key, $val );
      }
    }
  }

  function load_post_type() {
    $types = Conf::$POST_TYPES;
    foreach($types as $post_type => $item) {
      new PostType($post_type, $item['taxonomy']);
    }
  }

  function meta_opengraph() {
    LD_get_template_part('partials/opengraph');
  }

  function meta_noindex() {
    LD_get_template_part('partials/noindex');
  }

  function get_start_page() {
    $description = get_the_description();
    $title_section = title_section();
    $title = get_title_page($title_section);
    
    $data = array(
      'description' => $description,
      'title_section' => $title_section,
      'title' => $title,
    );
    
    process_set_var($data);
  }
