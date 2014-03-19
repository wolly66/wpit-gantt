<?php
/**
 * @package WPIT GANTT
 * @author Paolo Valenti
 */
/*
Opening page
*/

function wpit_gantt_first(){

	wpit_gantt_check_permissions();


		if ($_GET['page'] == 'gantt-options' && $_GET['action'] == 'delete') {
		$id = $_GET['id'];
        wpit_gantt_delete( $id );
        }
        else if ($_GET['page'] == 'gantt-options' && $_GET['action'] == 'new') {
        wpit_new_gantt();
        }
        else if ($_GET['page'] == 'gantt-options' && $_GET['action'] == 'data') {
        $id = $_GET['id'];
        wpit_gestione_gantt( $id );
        }
        else if ($_GET['page'] == 'gantt-options' && $_GET['action'] == 'update') {
		$id = $_GET['id'];
        wpit_gantt_update ( $id );
        
        
        } else {
	    wpit_gantt_diplay ();
	    }
        
}
        
function wpit_gantt_diplay () {

//Init page output        
	$th = ' ';

		//Page title
		$th .= "<div class=\"wrap\"><div id=\"icon-options-general\" class=\"icon32\"><br /></div><h2>" . __( 'GANTT Options' , 'wpit-gantt' ) . "<a href=\"admin.php?page=gantt-options&action=new\" class=\"add-new-h2\">" .   __( 'Add new' , 'wpit-gantt' )  . "</a></h2></div>\n";   


			//table header
			$th .= "<form action=\" \" method=\"post\">\n";
				$th .= "<table class=\"wp-list-table widefat\" cellspacing=\"0\">\n";
					$th .= "<thead>\n";
						$th .= "<tr>\n";
				        	$th .= "<th scope=\"col\" id=\"descr\" class=\"manage-column column-descr\">\n";
				        		$th .= "<span>" . __( 'GANTT Description' , 'wpit-gantt' ) . "</span>\n";
				        	$th .= "</th>\n";
				        	$th .= "<th scope=\"col\" id=\"descr\" class=\"manage-column column-descr\">\n";
				        		$th .= "<span>" . __( 'Cellwidth' , 'wpit-gantt' ) . "</span>\n";
				        	$th .= "</th>\n";
				        	$th .= "<th scope=\"col\" id=\"descr\" class=\"manage-column column-descr\">\n";
				        		$th .= "<span>" . __( 'Cellheight' , 'wpit-gantt' ) . "</span>\n";
				        	$th .= "</th>\n";
				        	$th .= "<th scope=\"col\" id=\"Shortcode\" class=\"manage-column column-descr\">\n";
				        		$th .= "<span>" . __( 'Shortcode' , 'wpit-gantt' ) . "</span>\n";
				        	$th .= "</th>\n";
				        $th .= "</tr>\n";
				    $th .= "</thead>\n";
				    //table body
				    $num_gantt = get_option( 'wpit_gantt_num' );
				    for ( $numerator = 1; $numerator <= $num_gantt; ++$numerator ) {
		
					    $gantt_option_name = 'wpit_gantt_title-' . $numerator;
					    $single_gantt = get_option( $gantt_option_name );
					    if (!empty($single_gantt)) {
						    $shortcode = '[gantt id="' . $numerator . '"]';
						    $sc = $single_gantt['title'];
						    $cw = $single_gantt['cellwidth'];
						    $ch = $single_gantt['cellheight'];
			
						$th .= "<tr valign=\"top\" class=\"post-$id\" id=\"post-$id\">\n";
							$th .= "<td><span>$sc</span>\n";
								$th .= "<div class=\"row-actions\">\n";
								$th .= "<div class=\"row-actions\">\n";
								$th .= "<span class=\"trash\">\n";
							
									
							
									$th .= "<a title=\"Manage data\" href=\"admin.php?page=gantt-options&action=data&id=$numerator\">" . __( 'View, Add, Modify, Delete data' , 'wpit-gantt' ) . " | </a>\n";
							
									$th .= "<a title=\"Modify GANTT\" href=\"admin.php?page=gantt-options&action=update&id=$numerator\">" . __( 'Modify GANTT' , 'wpit-gantt' ) . " | </a>\n";
									$th .= "<a title=\"Delete GANTT\" onclick=\"return confirm('Are you sure?')\" href=\"admin.php?page=gantt-options&action=delete&id=$numerator\">" . __( 'Delete GANTT' , 'wpit-gantt' ) . "</a>\n";


								$th .= "</div></div>\n";
							$th .= "</td>\n";
							$th .= "<td><span>$cw</span></td>\n";
							$th .= "<td><span>$ch</span></td>\n";
							$th .= "<td><span>$shortcode</span></td>\n";
							

						$th .= "</td></tr>\n";
}			
}        
				//table footer 
				$th .= "<tfoot>\n";
					$th .= "<tr>\n";
				        	$th .= "<th scope=\"col\" id=\"descr\" class=\"manage-column column-descr\">\n";
				        		$th .= "<span>" . __( 'GANTT Description' , 'wpit-gantt' ) . "</span>\n";
				        	$th .= "</th>\n";
				        	$th .= "<th scope=\"col\" id=\"descr\" class=\"manage-column column-descr\">\n";
				        		$th .= "<span>" . __( 'Cellwidth' , 'wpit-gantt' ) . "</span>\n";
				        	$th .= "</th>\n";
				        	$th .= "<th scope=\"col\" id=\"descr\" class=\"manage-column column-descr\">\n";
				        		$th .= "<span>" . __( 'Cellheight' , 'wpit-gantt' ) . "</span>\n";
				        	$th .= "</th>\n";
				        	$th .= "<th scope=\"col\" id=\"Shortcode\" class=\"manage-column column-descr\">\n";
				        		$th .= "<span>" . __( 'Shortcode' , 'wpit-gantt' ) . "</span>\n";
				        	$th .= "</th>\n";
				        $th .= "</tr>\n";
				$th .= "</tfoot>\n";
			$th .= "</table>\n";
		$th .= "</form>\n";


echo $th;

}	
//delete GANTT

function wpit_gantt_delete( $id ) {
	$gantt_option_name = 'wpit_gantt_title-' . $id;
	$gantt_data_option = 'wpit_gantt-' . $id;
	delete_option( $gantt_option_name );
	delete_option( $gantt_data_option );
}
//new GANTT

function wpit_new_gantt() {
	wpit_gantt_check_permissions();
	
  	echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div><h2>' .  __( 'New GANTT' , 'wpit-gantt' ) . '</h2>';	
		// if this fails, check_admin_referer() will automatically print a "failed" page and die.
		if ( isset($_POST['add']) && check_admin_referer('wpit-gant-new','_wpit-nonce-new') ) {
			
			$x = $_POST['gantt-num'];
			$n = $_POST['gantt-title'];
			$w = $_POST['gantt-cellwidth'];
			$h = $_POST['gantt-cellheight'];
			$t = $_POST['gantt-today'];
		
				$new_gantt_options = array(
											'title' => $n,
											'cellwidth' => $w,
											'cellheight' => $h,
											'today' => $t,
											);
											
					$option_name = 'wpit_gantt_title-' . $x;
					update_option( $option_name , $new_gantt_options);
					update_option( 'wpit_gantt_num' , $x );
					echo '<div id="message" class="updated fade"><p><strong>' . __('Settings saved.' , 'wpit-gantt') . '</strong></p></div>';
		
		}
	$num = get_option( 'wpit_gantt_num' );
	$num = ++$num;
	
	$wpit_std_data = array(
  							'gantt-title'      => 'New Gantt',
  							'gantt-cellwidth'  => 25,
  							'gantt-cellheight' => 35,
  							'gantt-today'      => 'true',
  							);
  		$n = $wpit_std_data['gantt-title'];
  		$w = $wpit_std_data['gantt-cellwidth'];
  		$h = $wpit_std_data['gantt-cellheight'];
  		$t = $wpit_std_data['gantt-today'];
	
	
?>		
				<form method="post" action=""> 
					<table class="form-table">
        				<tr valign="top">
        					<th scope="row"><?php echo __('Title: The title of the new GANTT' , 'wpit-gantt') ;  ?></th>
        						<td><input type="text" name="gantt-title" value="<?php echo $n ?>" class="large-text code" /></td>
        				</tr>
         
        				<tr valign="top">
        					<th scope="row"><?php echo  __('Cellwidth' , 'wpit-gantt') ; ?></th>
        						<td><input type="text" name="gantt-cellwidth" value="<?php echo $w ?>" class="large-text code"/></td>
        				</tr>
        
        				<tr valign="top">
        					<th scope="row"><?php echo  __('Cellheight' , 'wpit-gantt') ; ?></th>
        						<td><input type="text" name="gantt-cellheight" value="<?php echo $h ?>" class="large-text code"/></td>
        				</tr>
        				<tr valign="top">
        					<th scope="row"><?php echo  __('Today: (optional, default: true) Show or hide the today marker. It will be displayed by default' , 'wpit-gantt' ) ; ?></th>
        						<td><input type="text" name="gantt-today" value="<?php echo $t ?>" class="large-text code"/></td>
        				</tr>
    				</table>
				<p class="submit">
					 <?php wp_nonce_field('wpit-gant-new','_wpit-nonce-new'); ?>
					<input type="hidden" name="gantt-num" value="<?php echo $num ; ?>" />
					<input type="submit" name="add" class="button-primary" value="<?php _e('Add' , 'wpit-gantt') ?>" />
				</p>
			</form>
	</div>
	
<?php
	
}

//update GANTT

function wpit_gantt_update ( $id ) {
	
	$gantt_option_name = 'wpit_gantt_title-' . $id;
	$single_gantt = get_option( $gantt_option_name );
	
	echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div><h2>' .  __( 'New GANTT' , 'wpit-gantt' ) . '</h2>';	
		// if this fails, check_admin_referer() will automatically print a "failed" page and die.
		if ( isset($_POST['add']) && check_admin_referer('wpit-gant-new','_wpit-nonce-new') ) {
			
			
			$n = $_POST['gantt-title'];
			$w = $_POST['gantt-cellwidth'];
			$h = $_POST['gantt-cellheight'];
			$t = $_POST['gantt-today'];
		
				$new_gantt_options = array(
											'title' => $n,
											'cellwidth' => $w,
											'cellheight' => $h,
											'today' => $t,
											);
				
				update_option( $gantt_option_name , $new_gantt_options);
				
					echo '<div id="message" class="updated fade"><p><strong>' . __('Settings saved.' , 'wpit-gantt') . '</strong></p></div>';
		
		}
	
	$n = $single_gantt['title'];
	$w = $single_gantt['cellwidth'];
	$h = $single_gantt['cellheight'];
	$t = $single_gantt['today'];
	
	
	?>		
				<form method="post" action=""> 
					<table class="form-table">
        				<tr valign="top">
        					<th scope="row"><?php echo __('Title: The title of the  GANTT' , 'wpit-gantt') ;  ?></th>
        						<td><input type="text" name="gantt-title" value="<?php echo $n ?>" class="large-text code" /></td>
        				</tr>
         
        				<tr valign="top">
        					<th scope="row"><?php echo  __('Cellwidth' , 'wpit-gantt') ; ?></th>
        						<td><input type="text" name="gantt-cellwidth" value="<?php echo $w ?>" class="large-text code"/></td>
        				</tr>
        
        				<tr valign="top">
        					<th scope="row"><?php echo  __('Cellheight' , 'wpit-gantt') ; ?></th>
        						<td><input type="text" name="gantt-cellheight" value="<?php echo $h ?>" class="large-text code"/></td>
        				</tr>
        				<tr valign="top">
        					<th scope="row"><?php echo  __('Today: (optional, default: true) Show or hide the today marker. It will be displayed by default' , 'wpit-gantt' ) ; ?></th>
        						<td><input type="text" name="gantt-today" value="<?php echo $t ?>" class="large-text code"/></td>
        				</tr>
    				</table>
				<p class="submit">
					 <?php wp_nonce_field('wpit-gant-new','_wpit-nonce-new'); ?>
					
					<input type="submit" name="add" class="button-primary" value="<?php _e('Update' , 'wpit-gantt') ?>" />
				</p>
			</form>
	</div>
	
<?php

	
	
	
}
//Manage data of a single GANTT
function wpit_gestione_gantt( $id ){
	wpit_gantt_check_permissions();
  	echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div><h2>' .  __( 'GANTT settings' , 'wpit-gantt' ) . '</h2>';	
		// if this fails, check_admin_referer() will automatically print a "failed" page and die.
		if ( isset($_POST['submit']) && check_admin_referer('wpit-gant-update','_wpit-nonce') ) {
		
		
				
		
			
			
					$new_options = $_POST['gantt'];
					$j = 0;
					foreach ($new_options as $pippo) {
					  
					  if (($pippo['class'] == '') && ($pippo['start'] == '') && ($pippo['end'] == '') && ($pippo['label'] == '')) {
					  	
					  
					  	$unset .= $j .',';
					  }
					$j = ++$j;
					}
					
					
		
		
		    
		    $transit = explode(' ', str_replace(',', ' ', $unset) );
		     foreach ($transit as $t) 
			     unset($new_options[$t]);
		     $new_options = array_values($new_options);
		    
			
				$gantt_data_option = 'wpit_gantt-' . $id;
				update_option( $gantt_data_option , $new_options);
					echo '<div id="message" class="updated fade"><p><strong>' . __('Settings saved.' , 'wpit-gantt') . '</strong></p></div>';
		
		}
		$gantt_data_option = 'wpit_gantt-' . $id;
		$options = get_option( $gantt_data_option );
				
			
				
			
?>		
				<form method="post" action=""> 
					<table class="form-table">
					
					<?php 
					$index = 0;
					if ( !empty($options)) {
					
					foreach ($options as $op) {
						$l = $op['label'];
						$s = $op['start'];
						$e = $op['end'];
						$c = $op['class'];
			
			?>
        				<tr valign="top">
        					<th scope="row"><?php echo __('Label: The label will be displayed in the sidebar' , 'wpit-gantt') ;  ?></th>
        						<td><input type="text" name="gantt[<?php echo $index; ?>][label]" value="<?php echo $l ?>" class="large-text code" /></td>
        				</tr>
         
        				<tr valign="top">
        					<th scope="row"><?php echo  __('Start: The start date. Must be in the following format: YYYY-MM-DD' , 'wpit-gantt') ; ?></th>
        						<td><input type="text" name="gantt[<?php echo $index; ?>][start]" value="<?php echo $s ?>" class="large-text code"/></td>
        				</tr>
        
        				<tr valign="top">
        					<th scope="row"><?php echo  __('End:   The end date. Must be in the following format: YYYY-MM-DD' , 'wpit-gantt') ; ?></th>
        						<td><input type="text" name="gantt[<?php echo $index; ?>][end]" value="<?php echo $e ?>" class="large-text code"/></td>
        				</tr>
        				<tr valign="top">
        					<th scope="row"><?php echo  __('Class: An optional class name. (available by default: important, urgent)' , 'wpit-gantt' ) ; ?></th>
        						<td><input type="text" name="gantt[<?php echo $index; ?>][class]" value="<?php echo $c ?>" class="large-text code"/></td>
        				</tr>
        				<tr>
        					<td><hr /></td>
        				</tr>
        				<?php $index++;
        				} //end foreach 
        				
	        				$index + 1;
	        				} //end empty options control
        				?>
        				<tr valign="top">
        					<th scope="row"><?php echo __('Label: The label will be displayed in the sidebar' , 'wpit-gantt') ;  ?></th>
        						<td><input type="text" name="gantt[<?php echo $index; ?>][label]" value="" class="large-text code" /></td>
        				</tr>
         
        				<tr valign="top">
        					<th scope="row"><?php echo  __('Start: The start date. Must be in the following format: YYYY-MM-DD' , 'wpit-gantt') ; ?></th>
        						<td><input type="text" name="gantt[<?php echo $index; ?>][start]" value="" class="large-text code"/></td>
        				</tr>
        
        				<tr valign="top">
        					<th scope="row"><?php echo  __('End:   The end date. Must be in the following format: YYYY-MM-DD' , 'wpit-gantt') ; ?></th>
        						<td><input type="text" name="gantt[<?php echo $index; ?>][end]" value="" class="large-text code"/></td>
        				</tr>
        				<tr valign="top">
        					<th scope="row"><?php echo  __('Class: An optional class name. (available by default: important, urgent)' , 'wpit-gantt' ) ; ?></th>
        						<td><input type="text" name="gantt[<?php echo $index; ?>][class]" value="" class="large-text code"/></td>
        				</tr>
        				<tr>
        					<td><hr /></td>
        				</tr>

    				</table>
				<p class="submit">
					 <?php wp_nonce_field('wpit-gant-update','_wpit-nonce'); ?>
					<input type="submit" name="submit" class="button-primary" value="<?php _e('Update' , 'wpit-gantt') ?>" />
				</p>
			</form>
	</div>
<?php
	
}

//render the GANTT chart
function wpit_render_gantt($atts){
   extract(shortcode_atts(array(
      'id' => ' ',
   ), $atts));
   
   $gantt_option_name = 'wpit_gantt_title-' . $id;
	$gantt_data_option = 'wpit_gantt-' . $id;
	$header = get_option( $gantt_option_name );
	$data = get_option( $gantt_data_option );
   require(WPIT_GANTT_PATH .'lib/gantti.php'); 
    

   	date_default_timezone_set('UTC');
   	setlocale(LC_ALL, 'en_US');
   	
    $gantti = new Gantti($data, $header);    
    
    return $gantti;
    }
function register_wpit_render_gantt(){
   add_shortcode('gantt', 'wpit_render_gantt');
}

add_action( 'init', 'register_wpit_render_gantt');

?>