<?php

/**
 * Info Cards Settings
 * Manages admin configurable options and settings for the plugin
 */


// includes 
require_once dirname( __FILE__ ) .'/wp-plugin-utils/lib/utils.php'; 
require_once dirname( __FILE__ ) .'/wp-plugin-utils/lib/class.settings.php'; 
use wp_action_network_signup\plugin_utils as utils;

// Trace
utils\dbg_trace("");


// Class to handle the settings
class ANS_Settings extends utils\Settings {
	

	// Constructor
	function __construct() {
		
		// Call parent 
		parent::__construct(
							"Action Network Signup",			// $option_page_title
							"wp-action-network-signup.php",	// $plugin_file_name
							"asn_settings",	// $option_group_page
							"asn_options"	// $option_name
							);
		
		// Trace
		utils\dbg_trace();
		
		// Our settings sections 
		$this->settings_sections = array (
			
			// Card appearance
			'form_appearance' => array (
				'title'		=> __( 'Form Appearance', 'action_network_signup' ),
				'desc_html' => "<p>" . __('These options change the appearance of the form.', 'action_network_signup')  . "</p>"
				),
				
			// Layout 
			'rest_api' => array (
				'title'		=> __( 'API', 'action_network_signup' ),
				'desc_html' => "<p>" . __('These options control connection to the Action Network service.', 'action_network_signup')  . "</p>"
				)
			);

		// Our settings fields 
		$this->settings_fields = array (
			
			// Form width
			'asn_form_width'	=> array (
				'title'			=> __('Form width', 'action_network_signup'),
				'units'			=> 'px.',
				'section'		=> 'form_appearance',
				'type'			=> 'integer', 
				'default'		=> 300,
				'min'			=> 10, 
				'max'			=> 1000,
				'format_msg'	=> __( 'Form width needs to be a whole number from 10-1000 px', 'action_network_signup' ), 
		     				
				),
				
			// API Key
			'asn_api_key'	=> array (
				'title'			=> __('Action Network API Key', 'action_network_signup'),
				'section'		=> 'rest_api',
				'type'			=> 'string', 
				'default'		=> '',
				'format_msg'	=> __( 'Enter a valida apie key from your account in the Action Network', 'action_network_signup' ), 
		     				
				)
			);
		
	}
	
	

}



