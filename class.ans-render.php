<?php

/**
 * class.ic-render.php
 * Public (non admin) rendering 
 */

require_once dirname( __FILE__ ) .'/wp-plugin-utils/lib/utils.php'; 
require_once dirname( __FILE__ ) .'/wp-plugin-utils/lib/class.render.php'; 
require_once dirname( __FILE__ ) .'/wp-plugin-utils/lib/class.form.php'; 
use wp_action_network_signup\plugin_utils as utils;


class ANS_Form extends utils\Form {
  
        
    // return the contents of the form 
    function get_form_contents_html(){

     
      // Open block
      $output = "<div class='ans_form_inside'>";
      
      // Email 
      $output .= $this->hlp_get_input_html(
            "ans_mv_EMAIL",   // $field_name 
            "Email Address",  // $field_text
            "email required",     // $placholder_text
            "ans_merge_var",  // $div_class, 
            "ans_var_label",  // $label_class, 
            "ans_input"       // $input_class
            );
            
      // First Name 
      $output .= $this->hlp_get_input_html(
            "ans_mv_FNAME",   // $field_name 
            "First Name",     // $field_text
            "",               // $placholder_text
            "ans_merge_var",  // $div_class, 
            "ans_var_label",  // $label_class, 
            "ans_input"       // $input_class
            );
            
      // Last name 
      $output .= $this->hlp_get_input_html(
            "ans_mv_LNAME",   // $field_name 
            "Last Name",      // $field_text
            "",               // $placholder_text
            "ans_merge_var",  // $div_class, 
            "ans_var_label",  // $label_class, 
            "ans_input"       // $input_class
            );
            
      // Submit
      $output .= $this->hlp_get_submit_html(
            "ans_signup_submit", // $submit_name
            "Subscribe",         // $submit_text,
            "ans_signup_submit",// $div_class, 
            "button"              // $input_class
            );
            
      // Close block 
      $output .= "</div>";
      
      // Done
      return $output;
    }

  // Validate and action
  function handle_form_post($post){
    
    utils\dbg_trace();
    
    // Sanitise inputs 
    $email      = filter_var ( utils\get_value($post,'ans_mv_EMAIL', ''), FILTER_SANITIZE_EMAIL); 
    $first_name = filter_var ( utils\get_value($post,'ans_mv_FNAME', ''), FILTER_SANITIZE_STRING); 
    $last_name  = filter_var ( utils\get_value($post,'ans_mv_LNAME', ''), FILTER_SANITIZE_STRING); 
    
    // Check the email is good.
    if(! utils\is_valid_email($email)){
      $this->set_post_invalid();
    }

  }
}
 
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
    $this->signup_form = new ANS_Form(
                                'ans_signup_form',              // $form_name
                                'ans_signup_form_id',           // $form_id
                                'Please enter a valid email',   // $failed_msg
                                'Submitted ok'                  // $success_msg
                                );
    
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

