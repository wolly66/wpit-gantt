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
	add_menu_page('Gantt options', ' Gantt options' , 'administrator', 'gantt-options' , 'wpit_gantt_first');
	
}


?>