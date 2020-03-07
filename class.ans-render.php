<?php

/**
 * class.ic-render.php
 * Public (non admin) rendering 
 */

require_once dirname( __FILE__ ) .'/wp-plugin-utils/lib/utils.php'; 
require_once dirname( __FILE__ ) .'/wp-plugin-utils/lib/class.render.php'; 
require_once dirname( __FILE__ ) .'/wp-plugin-utils/lib/class.form.php'; 
use wp_action_network_signup\plugin_utils as utils;

require_once dirname( __FILE__ ) .'/class.ans-signup-form.php';


 
// Our plugins render class 
class ANS_Render extends utils\Render {
	
	// Our form
	private $signup_form = null;

	// Constructor
	function __construct() {
	  
	  // Call parent constructor
	  parent::__construct(
	      "action-network-signup"            // $short_code_tag
	      );
    
    // Create form
    $this->signup_form = new ANS_Signup_Form(
                                'ans_signup_form',              // $form_name
                                'ans_signup_form_id',           // $form_id
                                'Please enter a valid email.',   // $failed_msg
                                'You have been subscribed successfully!'                  // $success_msg
                                );
    
	}

  // Generate the CSS 
  function render_dynamic_css(){

 
  
    // Set the css properties
    echo (".ans_var_input {\n");
    echo ("  background-color: #fafafa;\n");
    echo ("  border-width: 1px;\n");
    echo ("  width: 100%;\n");
    echo ("}\n");
    
    echo (".ans_var {\n");
    echo ("  margin-bottom: 0.5em;\n");
    echo ("}\n");
  }
  

  // Render the short code 
  function render_shortcode(){
    
   
    // Trace
    utils\dbg_trace();
    
   
    $output = "<div id='ans_signup'>";
    $output .= $this->signup_form->get_form_html();
    $output .= "</div>";

    // Done
    return $output;
  }

}

