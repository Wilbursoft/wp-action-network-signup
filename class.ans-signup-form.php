<?php

/**
 * class.ic-render.php
 * Public (non admin) rendering 
 */

require_once dirname( __FILE__ ) .'/wp-plugin-utils/lib/utils.php'; 
require_once dirname( __FILE__ ) .'/wp-plugin-utils/lib/class.render.php'; 
require_once dirname( __FILE__ ) .'/wp-plugin-utils/lib/class.form.php'; 
use wp_action_network_signup\plugin_utils as utils;


class ANS_Signup_Form extends utils\Form {
  
        
    // return the contents of the form 
    function get_form_contents_html(){

     
      // Open block
      $output = "<div class='ans_signup_form_inside'>";
      
      // Email 
      $output .= $this->hlp_get_input_html(
            "ans_mv_EMAIL",   // $field_name 
            "Email Address",  // $field_text
            "email required", // $placholder_text
            "ans_var",        // $div_class, 
            "ans_var_label",  // $label_class, 
            "ans_var_input"   // $input_class
            );
            
      // First Name 
      $output .= $this->hlp_get_input_html(
            "ans_mv_FNAME",   // $field_name 
            "First Name",     // $field_text
            "",               // $placholder_text
            "ans_var",        // $div_class, 
            "ans_var_label",  // $label_class, 
            "ans_var_input"   // $input_class
            );
            
      // Last name 
      $output .= $this->hlp_get_input_html(
            "ans_mv_LNAME",   // $field_name 
            "Last Name",      // $field_text
            "",               // $placholder_text
            "ans_var",        // $div_class, 
            "ans_var_label",  // $label_class, 
            "ans_var_input"       // $input_class
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
 