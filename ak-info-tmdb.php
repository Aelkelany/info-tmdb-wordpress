<?php
 /*
 * Plugin Name:       AK TMDB INFO 
 * Plugin URI:       
 * Description:       This plugin allows to use info from TMDB.
 * Version:           1.0
 * Author:            Ahmed Elkelany
 * Author URI:        
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

//if this file is called directly, abort
if ( ! defined( 'ABSPATH' ) ) exit;

// constants definition
define('AK_EUFI_PATH_INCLUDE', plugin_dir_path( __FILE__ ).'includes/');
require_once AK_EUFI_PATH_INCLUDE.'class-ak-tmdb-info.php';
require_once AK_EUFI_PATH_INCLUDE.'plugin-settings-display.php';
new Ak_Tmdb_Info();
?>