<?php


function setup_theme_admin_menus() {
  
  add_menu_page('Configuración General', 'Configuración', 'manage_options', 'menu_setting', 'theme_settings_page');
  add_submenu_page('menu_setting', 'Configuración General', 'General', 'manage_options', 'menu_setting', 'front_setting_page');
  
}


function theme_settings_page() {
 
}

function front_setting_page(){
  
  $array_fields = array(
    array('name' => 'facebook_url', 'type' => 'url', 'title' => 'Url Facebook'),
    array('name' => 'twitter_url', 'type' => 'url', 'title' => 'Url Twitter'),
    array('name' => 'instagram_url', 'type' => 'url', 'title' => 'Url Instagram'),
    array('name' => 'general_address', 'type' => 'textarea', 'title' => 'Dirección'),
    array('name' => 'general_city', 'type' => 'text', 'title' => 'Ciudad'),
    array('name' => 'general_phone', 'type' => 'tel', 'title' => 'Teléfono'),
    array('name' => 'general_email', 'type' => 'email', 'title' => 'Correo'),
  ); 
  
  ?>
    <div class="wrap">
        <h2>Configuración General</h2>
 
        <form method="POST" action="">
            <input type="hidden" name="update_general_setting" value="Y">
            <table class="form-table">
                <?php foreach($array_fields as $field): ?> 
                  <tr valign="top">
                      <th scope="row">
                          <label for="<?= $field['name'] ?>">
                              <?= $field['title'] ?>
                          </label> 
                      </th>
                      <td>
                          <?php if($field['type'] === 'textarea'): ?>
                            <textarea name="<?= $field['name'] ?>" cols="46" rows="4"><?= stripslashes( get_option( $field['name'] ) ) ?></textarea>
                          <?php else: ?>
                            <input type="<?= $field['type'] ?>" name="<?= $field['name'] ?>"  value="<?= stripslashes( get_option( $field['name'] ) ) ?>" class="regular-text ltr" />
                          <?php endif; ?>
                      </td>
                  </tr>
                <?php endforeach; ?>
                <tr>
                  <td>
                    <?php submit_button(); ?>
                  </td>
                </tr>
            </table>
        </form>
    </div>
<?php
}

function save_setting(){
  
  $skip = array('submit', 'update_general_setting');
  
  foreach($_POST as $key => $value){
    
    if(!in_array($key, $skip)){
      $value = process_data($key, $value);
      
      $value = esc_attr($value);
      update_option($key, $value);
    }
  }
  
?>
    <div id="message" class="updated">Configuración Guardada</div>
<?php
}

function process_data($key, $value){
  
  switch($key){
     case 'example':
      /* process */
      break;
  }
  
  return $value;
}


if ( $_POST['update_general_setting'] == 'Y') {
  save_setting();
}

add_action("admin_menu", "setup_theme_admin_menus");
