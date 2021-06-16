<?php
add_action('admin_menu', array( $this, 'addPluginAdminMenu' ), 9);

public function addPluginAdminMenu() {
//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
add_menu_page(  $this->plugin_name, 'Plugin Name', 'administrator', $this->plugin_name, array( $this, 'displayPluginAdminDashboard' ), 'dashicons-editor-textcolor', 26 );

//add_submenu_page( '$parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
add_submenu_page( $this->plugin_name, 'Plugin Name Settings', 'Settings', 'administrator', $this->plugin_name.'-settings', array( $this, 'displayPluginAdminSettings' ));
}

public function displayPluginAdminSettings() {
   // set this var to be used in the settings-display view
   $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general';
   if(isset($_GET['error_message'])){
       add_action('admin_notices', array($this,'pluginNameSettingsMessages'));
       do_action( 'admin_notices', $_GET['error_message'] );
   }
   require_once 'partials/'.$this->plugin_name.'-admin-settings-display.php';
}

public function pluginNameSettingsMessages($error_message){
    switch ($error_message) {
        case '1':
            $message = __( 'There was an error adding this setting. Please try again.  If this persists, shoot us an email.', 'my-text-domain' );
            $err_code = esc_attr( 'plugin_name_example_setting' );
            $setting_field = 'plugin_name_example_setting';
            break;
    }
    $type = 'error';
    add_settings_error(
           $setting_field,
           $err_code,
           $message,
           $type
       );
}

public function registerAndBuildFields() {
         /**
        * First, we add_settings_section. This is necessary since all future settings must belong to one.
        * Second, add_settings_field
        * Third, register_setting
        */
add_settings_section(
      // ID used to identify this section and with which to register options
      'plugin_name_general_section',
      // Title to be displayed on the administration page
      '',
      // Callback used to render the description of the section
       array( $this, 'plugin_name_display_general_account' ),
      // Page on which to add this section of options
      'plugin_name_general_settings'
    );
    unset($args);
    $args = array (
              'type'      => 'input',
              'subtype'   => 'text',
              'id'    => 'plugin_name_example_setting',
              'name'      => 'plugin_name_example_setting',
              'required' => 'true',
              'get_options_list' => '',
              'value_type'=>'normal',
              'wp_data' => 'option'
          );
    add_settings_field(
      'plugin_name_example_setting',
      'Example Setting',
      array( $this, 'plugin_name_render_settings_field' ),
      'plugin_name_general_settings',
      'plugin_name_general_section',
      $args
    );


    register_setting(
            'plugin_name_general_settings',
            'plugin_name_example_setting'
            );

}

public function plugin_name_display_general_account() {
	  echo '<p>These settings apply to all Plugin Name functionality.</p>';
	} 

add_action('admin_init', array( $this, 'registerAndBuildFields' ));

?>
