<?php

/**
*/
require_once dirname( __FILE__ ) . '/../wp-plugin-utils/lib/utils.php'; 
use wp_action_network_signup\plugin_utils as utils;
require_once dirname( __FILE__ ) . "/../class.ans-render.php";

class ANS_RenderTest extends WP_UnitTestCase
{


  

    
    // Run the tests
    public function test_methods(){
        
   	 
        /**
         *  Test init  
         **/
         
    
        // Do the init
        ob_start();
        $renderer = new ANS_Render();
        $output = ob_get_contents();
        $this->assertTrue("" == $output);
        ob_end_clean();
        


        /**
         *  Test rendering - with settings not initialised
         **/
         
        // Create empty output
        $output =  $renderer->render_shortcode();
        $this->assertTrue(utils\is_valid_html($output, true));
        $this->assertTrue(false !== strpos($output,'ans_signup_form'));
        $this->assertTrue(false !== strpos($output,'<form'));
        $this->assertTrue(false !== strpos($output,'<input'));
        
    }

}

