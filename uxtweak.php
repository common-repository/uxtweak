<?php
/**
 * @package   Uxtweak
 * @author    EliteSolutions
 * @link      https://www.uxtweak.com/
 * @copyright 2020
 *
 * Plugin Name:       Uxtweak 
 * Description:       Powerful research tools for improving usability of web sites and apps, from prototypes to production.
 * Version:           1.0
 * Author:            Uxtweak
 * Author URI:        https://www.uxtweak.com/
 */



function uxtweak_options_page_html() {
  ?>
  <div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <form action="options.php" method="post">
      <?php
      // output security fields for the registered setting "wporg_options"
      settings_fields( 'uxtweak' );
      // output setting sections and their fields
      do_settings_sections( 'uxtweak' );
      // output save settings button
      submit_button( __( 'Save Settings', 'textdomain' ) );
      ?>
    </form>
  </div>
  <?php
}


add_action( 'admin_menu', 'uxtweak_options_page' );
function uxtweak_options_page() {
  add_menu_page(
    'Uxtweak',
    'Uxtweak',
    'manage_options',
    'uxtweak',
    'uxtweak_options_page_html',
    plugin_dir_url(__FILE__) . 'images/icon-uxtweak.png',
    100
  );
}


function register_uxtweak_setting() {
  register_setting( 'uxtweak', 'uxtweak_script' ); 
  add_settings_section(
    'uxtweak_settings_section',
    'Uxtweak Settings Section', 'uxtweak_settings_section_callback',
    'uxtweak'
  );
  add_settings_field(
    'uxtweak_settings_field',
    'Uxtweak Setting Script', 'uxtweak_settings_field_callback',
    'uxtweak',
    'uxtweak_settings_section'
  );
} 
add_action( 'admin_init', 'register_uxtweak_setting' );


// section content cb
function uxtweak_settings_section_callback() {
  echo '<p>Uxtweak Section Introduction.</p>';
}

// field content cb
function uxtweak_settings_field_callback() {
  // get the value of the setting we've registered with register_setting()
  $uxtweak_setting = get_option('uxtweak_script');
  // output the field
  ?>
  <textarea  name="uxtweak_script" rows="10" cols="200"><?php echo isset( $uxtweak_setting ) ? esc_attr( $uxtweak_setting ) : ''; ?></textarea>
  <?php
}


add_action('wp_head', 'uxtweak_script_render');
function uxtweak_script_render(){
  $uxtweak_codescript = get_option('uxtweak_script');
  if (($uxtweak_codescript) || ($uxtweak_codescript != '') ) {
    echo $uxtweak_codescript;
  }
}