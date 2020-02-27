<?php

/**
 * class.ic-render.php
 * Public (non admin) rendering 
 */

require_once dirname( __FILE__ ) .'/wp-plugin-utils/lib/utils.php'; 
require_once dirname( __FILE__ ) .'/wp-plugin-utils/lib/class.render.php'; 
use wp_action_network_signup\plugin_utils as utils;

 
// Our plugins render class 
class ANS_Render extends utils\Render {
	

	// Constructor
	function __construct() {
	  
	  // Call parent constructor
	  parent::__construct(
	      "action-network-signup"            // $short_code_tag
	      );
    
	}


  // Render the short code 
  function render_shortcode(){
    
   
    // Trace
    utils\dbg_trace();
    
    $output = "<p> ANS_Render </p>";

    // Done
    return $output;
  }

}

