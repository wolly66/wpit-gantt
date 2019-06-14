<?php
/**
 * @package WPIT GANTT
 * @author Paolo Valenti
 */
/*
File for common functions
*/

// Check if gantt numerators exists, if not it creates the wpit_gantt_num option and set to 0 (only for internal purpose)
register_activation_hook( __FILE__, 'wpit_num_activation' );

function wpit_num_activation(){
$num = get_option( 'wpit_gantt_num' );

	if (empty($num)) {

		$num = 0;

		update_option( 'wpit_gantt_num' , $num );
	}
}
//End check

//check permissions to manage options
function wpit_gantt_check_permissions(){
if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' , 'wpit-gantt' ) );
	}
}

//Creation of administration menù and sub menù
add_action('admin_menu', 'wpit_backend_gantt');
function wpit_backend_gantt() {
	add_menu_page('Gantt', ' Gantt' , 'administrator', 'gantt-manage' , 'wpit_gantt_first', 'dashicons-text');

	add_submenu_page( 'gantt-manage', 'Manage Charts', 'Manage Charts', 'administrator', 'gantt-manage', 'wpit_gantt_first' );
	add_submenu_page( 'gantt-manage', 'Settings', 'Settings', 'administrator', 'gantt-settings', 'wpit_gantt_settings_page' );
}

//Options page
function wpit_gantt_register_settings_page() {
  add_options_page('Gantt Charts', 'Gantt Charts', 'manage_options', 'myplugin', 'wpit_gantt_settings_page');
}
add_action('admin_menu', 'wpit_gantt_register_settings_page');


function wpit_gantt_settings_page()
{
	if( isset($_POST['updated'] ) && $_POST['updated'] === 'true' ) wpit_gantt_handle_settings_form();
?>
  <div>
  <?php screen_icon(); ?>
  <h2><?php _e( 'Gantt Chart Settings', 'wpit-gantt' ) ?></h2>
  <form method="post">
   <input type="hidden" name="updated" value="true" />
   <?php wp_nonce_field( 'wpit_gantt_update', 'wpit_gantt_form' ); ?>

  <?php //settings_fields( 'wpit_gantt_options_group' ); ?>
  <table>
  <tr valign="top">
  <th scope="row"><label for="wpit_gantt_style"><?php _e( 'Style', 'wpit-gantt' ) ?> (light, dark) </label></th>
  <td><input type="text" id="wpit_gantt_style" name="wpit_gantt_style" value="<?php echo get_option('wpit_gantt_style', 'dark'); ?>" /></td>
  </tr>
  </table>
  <?php submit_button(); ?>
  </form>
  </div>
<?php
}

function wpit_gantt_handle_settings_form() {
    if(! isset( $_POST['wpit_gantt_form'] ) ||
        ! wp_verify_nonce( $_POST['wpit_gantt_form'], 'wpit_gantt_update' )
    ){ ?>
        <div class="error">
           <p><?php _e( 'Sorry, your nonce was not correct. Please try again.', 'wpit-gantt' ) ?></p>
        </div>
<?php
        exit;
    } else {
        // Handle our form data
		$style = sanitize_text_field( $_POST['wpit_gantt_style'] );
		update_option( 'wpit_gantt_style', $style );
?>
			<div class="updated">
				<p><? _e( 'Your fields were saved!', 'wpit-gantt' ) ?></p>
			</div>
<?php  }
}

?>
