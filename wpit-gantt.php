<?php
/**
 * @package WPIT GANTT
 * @author Paolo Valenti
 * @version 1.1 some changes in CSS
 */
/*
Plugin Name: WPIT GANTT
Plugin URI: http://paolovalenti.info/gantt
Description: This plugin allow you to create and insert GANTT chart into pages and posts
Author: wolly
Text Domain: wpit-gantt
Domain Path: /lang
Version: 1.1
Author URI: http://paolovalenti.info
*/
/*
	Copyright 2012  Paolo Valenti aka Wolly  (email : wolly66@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

/**
 *Options name
 *wpit_gantt_num
 *wpit_gantt_title-(id)
 *wpit_gantt-(id)
 */
//Load textdomain


function wpit_gantt_init() {

	load_plugin_textdomain( 'wpit-gantt', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
}

add_action('plugins_loaded', 'wpit_gantt_init');


//define the plugin path with final trailing slash
define( 'WPIT_GANTT_PATH', plugin_dir_path(__FILE__) );

//Standard data
//$data = array();
//
//$data[] = array(
//  'label' => 'Project 1',
//  'start' => '2012-04-20',
//  'end'   => '2012-05-12'
//);
//
//$data[] = array(
//  'label' => 'Project 2',
//  'start' => '2012-04-22',
//  'end'   => '2012-05-22'
//);
//
//$data[] = array(
//  'label' => 'Project 3',
//  'start' => '2012-05-25',
//  'end'   => '2012-06-20'
//);
//
//$data[] = array(
//  'label' => 'Project 4',
//  'start' => '2012-05-06',
//  'end'   => '2012-06-17',
//  'class' => 'important',
//);
//
//$data[] = array(
//  'label' => 'Project 5',
//  'start' => '2012-05-11',
//  'end'   => '2012-06-03',
//  'class' => 'urgent',
//);
//
//$data[] = array(
//  'label' => 'Project 6',
//  'start' => '2012-05-15',
//  'end'   => '2012-07-03'
//);
//
//$data[] = array(
//  'label' => 'Project 7',
//  'start' => '2012-06-01',
//  'end'   => '2012-07-03',
//  'class' => 'important',
//);
//
//$data[] = array(
//  'label' => 'Project 8',
//  'start' => '2012-06-01',
//  'end'   => '2012-08-05'
//);
//
//$data[] = array(
//  'label' => 'Project 9',
//  'start' => '2012-07-22',
//  'end'   => '2012-09-05',
//  'class' => 'urgent',
//);
//
//$gantt_data_option = 'wpit_gantt-1';
//update_option( $gantt_data_option , $data);
//

//include all plugin files
require_once WPIT_GANTT_PATH . 'files/wpit-gantt-functions.php';

require_once WPIT_GANTT_PATH . 'files/wpit-gantt-start.php';

/**
     * Register with hook 'wp_enqueue_scripts', which can be used for front end CSS and JavaScript
     */
    add_action( 'wp_enqueue_scripts', 'wpit_gantt_stylesheet' );

    /**
     * Enqueue plugin style-file
     */
    function wpit_gantt_stylesheet() {
        // Respects SSL, Style.css is relative to the current file


        //wp_register_style( 'wpit_gant_screen', plugins_url('styles/css/screen.css' , __FILE__ ));
        //wp_register_style( 'wpit_gant_gantti', plugins_url('styles/css/gantti.css' , __FILE__ ));
		wp_register_style( 'wpit_gant_gantti', plugins_url('styles/css/gantti_'.get_option('wpit_gantt_style', 'dark').'.css' , __FILE__ ));
        //wp_enqueue_style( 'wpit_gant_screen' );
        wp_enqueue_style( 'wpit_gant_gantti' );
    }