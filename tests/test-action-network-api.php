<?php

/**
* Test Utilities
*/

require_once dirname( __FILE__ ) .'/../action-network-api.php';

class Action_Network_API_Test extends WP_UnitTestCase
{
    // Create a helper_curl_request httpRequest object that behaves as expected
    static function create_happy_helper_curl_request_mock($test_case){
            
        $helper_curl_request = $test_case->createMock('HttpRequest');
        $helper_curl_request->method('set_option')->willReturn(true);
        $helper_curl_request->method('execute')->willReturn(true);
        $helper_curl_request->method('get_exec_output')
                            ->willReturn('{ "_links": {  "osdi:person_signup_helper": { "href": "https://testlink.com"}}}');
        
        
        // Return the mock object                 
        return $helper_curl_request;
    }
    
    // Create a $curl_post_request httpRequest object that behaves as expected
    static function create_happy_curl_post_request_mock($test_case){
        
        $curl_post_request = $test_case->createMock('HttpRequest');
        $curl_post_request->method('set_option')->willReturn(true);
        $curl_post_request->method('execute')->willReturn(true);
        $curl_post_request->method('get_info')->willReturn(200);
     
        // Return the mock object                 
        return $curl_post_request;
    }
    
    
    public function test_happy_path(){

        $this->assertTrue(true);
        
        
        // Create object and mocks
        $api_to_test = new Action_Network_API("a-test-api-key");
        
     
        // Assign the happy mocks
        Action_Network_API::$helper_curl_request  = self::create_happy_helper_curl_request_mock($this);
        Action_Network_API::$curl_post_request  = self::create_happy_curl_post_request_mock($this);

        
        $identifier = "my-test_id";
        $first_name = 'first';
        $last_name = 'last';
        $email = 'email@example.com';

        $this->assertTrue( true === $api_to_test->add_person($identifier, $first_name, $last_name, $email ));
        
        
  
    }

}

