<?php

/**
*/
require_once dirname( __FILE__ ) . '/../wp-plugin-utils/lib/utils.php'; 
use wp_action_network_signup\plugin_utils as utils;
require_once dirname( __FILE__ ) . "/../class.ans-signup-form.php";

class ANS_Signup_Form_Test extends WP_UnitTestCase
{


  

    
    // Run the tests
    public function test_get_form_contents_html(){
        
   	 
        /**
         *  Test get_form_contents_html
         **/
         
    
        // Do the init
        $form_name = 'my_test_form_signup';
        $form_id = 'my_test_id_signup';
        $failed_msg = 'failed-abc_signup';
        $success_msg = 'succees-xyz_signup';
        $form_to_test = new ANS_Signup_Form(
                                        $form_name, 
                                        $form_id,
                                        $failed_msg,
                                        $success_msg);
        
        $this->assertTrue(is_valid_html($form_to_test->get_form_contents_html()));

        /**
         *  Test post
         **/
         
        // Make a copy of to restore later
        global $_POST;
        $tmp_POST = $_POST;
        
        // Case #1 - Empty fields
	    $form_to_test = new ANS_Signup_Form( $form_name, $form_id,  $failed_msg, $success_msg);
 	    $_POST['form_name'] = $form_name;
 	    $_POST[$form_to_test->hlp_get_nonce_name()] = wp_create_nonce($form_to_test->hlp_get_nonce_action());
        $form_html = $form_to_test->get_form_html();
        $this->assertTrue(is_valid_html($form_html));
        $this->assertContains($failed_msg, $form_html);
        $this->assertTrue(false === strpos($form_html, $success_msg));
    
    
        // Case #2 - valid email 
        $_POST['ans_mv_EMAIL'] = 'test@test.com';
	    $form_to_test = new ANS_Signup_Form( $form_name, $form_id,  $failed_msg, $success_msg);
 	    $_POST['form_name'] = $form_name;
        $form_html = $form_to_test->get_form_html();
        $this->assertTrue(is_valid_html($form_html));
        $this->assertContains($success_msg, $form_html);
        $this->assertTrue(false === strpos($form_html, $failed_msg));
        
        // Restore
        $_POST = $tmp_POST;
        
    }

}

