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

      // Capture
      ob_start();
      
      ?> 
      <div class='ans_form_inside'>
          <div class='updated' id='ans_message'></div>
              <div class='ans_merge_var'>
             <label for='ans_mv_EMAIL' class='ans_var_label ans_header ans_header_email'>Email Address<span class='ans_required'>*</span></label>
               <input type='text' size='18' placeholder='' name='ans_mv_EMAIL' id='ans_mv_EMAIL' class='ans_input' />
              </div>
              <div class='ans_merge_var'>
             <label for='ans_mv_FNAME' class='ans_var_label ans_header ans_header_text'>First Name</label>
               <input type='text' size='18' placeholder='' name='ans_mv_FNAME' id='ans_mv_FNAME' class='ans_input' />
              </div>
              <div class='ans_merge_var'>
              <label for='ans_mv_LNAME' class='ans_var_label ans_header ans_header_text'>Last Name</label>
                <input type='text' size='18' placeholder='' name='ans_mv_LNAME' id='ans_mv_LNAME' class='ans_input' />
              </div>
              <div id='mc-indicates-required'> * = required field	</div>
              <div class='ans_signup_submit'>
  			    <input type='submit' name='ans_signup_submit' id='ans_signup_submit' value='Subscribe' class='button' />
          </div>
        </div> 
      <?php
      
      // End capture
      $output = ob_get_contents();
      ob_end_clean();
      return $output;
    }

  // Validate and action
  function handle_form_post(){
    
    utils\dbg_trace();
    
    global  $_POST;
    
    $email      = filter_var ( utils\get_value($_POST,'ans_mv_EMAIL', ''), FILTER_SANITIZE_EMAIL); 
    $first_name = filter_var ( utils\get_value($_POST,'ans_mv_FNAME', ''), FILTER_SANITIZE_STRING); 
    $last_name  = filter_var ( utils\get_value($_POST,'ans_mv_LNAME', ''), FILTER_SANITIZE_STRING); 

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

