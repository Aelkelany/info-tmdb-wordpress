<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// main class Ak Tmdb Info
class Ak_Tmdb_Info{
	// inicialization
	public function __construct(){
			add_action('add_meta_boxes', [$this, 'ak_eufi_add_metaboxes']);
			add_action('publish_post', [$this, 'ak_eufi_save_data']);	
	}
	// ---- Add Metaboxes ----
	// hook Constructor Callback 
	public function ak_eufi_add_metaboxes(){

		$title			= __('Ak Tmdb Info', AK_EUFI_DOMAIN);
		$post_types 	= $this->ak_eufi_get_post_types();
		add_meta_box( 'ak tmdb info',
						$title, 
						[$this, 'AK_eufi_show_metabox'],
						$post_types,
						'side',
						'high');
	}
	// add_meta_box Callback
	public function ak_eufi_show_metabox( $post ){
		$img 	 = $data['img'];
		$alt 	 = $data['alt'];

		include 'html/inc-metabox.php';	
	}
	// ----------------------
	// ---- Save Data ----
	// save data url and alt
	public function ak_eufi_save_data( $post_id ){
		
		$url = isset($_POST['akefi_url'])?esc_url_raw($_POST['akefi_url']):null;
		$alt = isset($_POST['akefi_alt'])?sanitize_text_field($_POST['akefi_alt']):null;
		if ( $url){ 				
			$image = media_sideload_image( $url, $post_id, $alt,'id' );
			set_post_thumbnail( $post_id, $image );
		}
	}
	// ----------------------
	// ------------------------------
	//        util functions 
	// ------------------------------
	// get list post types without exclude post types
	private function ak_eufi_get_post_types(){
		$excluded_types	= ['attachment', 'revision', 'nav_menu_item'];
		$post_types 	= array_diff( get_post_types( ['public'   => true], 'names' ), $excluded_types );

		return $post_types;
	}

}
?>
