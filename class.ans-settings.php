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
							__("Signup for Action Network", 'action_network_signup' ),			// $option_page_title
							"wp-action-network-signup.php",									// $plugin_file_name
							"asn_settings",													// $option_group_page
							"asn_options"													// $option_name
							);
		
		// Trace
		utils\dbg_trace();
		
		// Our settings sections 
		$this->settings_sections = array (
			
				
			// Layout 
			'asn_rest_api' => array (
				'title'		=> __( 'API', 'action_network_signup' ),
				'desc_html' => "<p>" . __('This settings controls connection to The Action Network. <br><br> Get your API key from The Action Network portal. <br> <br> Once entered, use the [action-network-signup] short code to display the sign up form in a page or post.', 'action_network_signup')  . "</p>"
				)
			);

		// Our settings fields 
		$this->settings_fields = array (
			
				
			// API Key
			'asn_rest_api_key'	=> array (
				'title'			=> __('Action Network API Key', 'action_network_signup'),
				'section'		=> 'asn_rest_api',
				'type'			=> 'string', 
				'default'		=> __('[your-api-key-here]', 'action_network_signup'),
				'format_msg'	=> __( 'Enter a valid API key from your account in the Action Network.', 'action_network_signup' ), 
		     				
				)
			);
		
	}
	
	

}



