<?php

require_once dirname( __FILE__ ) .'/wp-plugin-utils/lib/utils.php'; 
use wp_action_network_signup\plugin_utils as utils;






// Wraps the Action Network API 
class Action_Network_API {
    
        // API key stored in constructor
        private $api_key = '';
        
        // These get set to mock HttpRequest instances to test
        static public $helper_curl_request = null;
        static public $curl_post_request = null;

        // Factory to create httpRequest to use to get the sign up helper url
        public function get_helper_curl_request($url){
   
            // Use overriden by mock  or create new 
            $return_value = (null!==self::$helper_curl_request) ?  self::$helper_curl_request :  new utils\CurlRequest($url);
            
            // No, create it
            return $return_value;
        }
        
        // Factory to create httpRequest to use to get the sign up helper url
        public function get_curl_post_request($post_url){
            
            // Use overriden by mock  or create new 
            $return_value = (null!==self::$curl_post_request) ?  self::$curl_post_request :  new utils\CurlRequest($post_url);
            
            // No, create it
            return $return_value;
        }
 
        // Construct with the api key
        public function __construct($api_key) {
            
            $this->api_key = $api_key;
      
        }
        
        // Add the person
        function add_person($identifier, $first_name, $last_name, $email ){
            
            /**
             * GET https://actionnetwork.org/api/v2/
             * Header:
             * Content-Type: application/json
             * OSDI-API-Token: your_api_key_here
             **/
             
             $url = "https://actionnetwork.org/api/v2/";
             
            // Create the httprequest object
            $curl_request = $this->get_helper_curl_request($url);
          
            // Set the headers
            $curl_request->set_option(CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
                "OSDI-API-Token: {$this->api_key}"
            ));
        
            // Execute
            $result = $curl_request->execute();
            
            if (! $result ){
                
                // API call failed
                utils\dbg_trace("call to {$url} failed. ");
                return false;
            }
            
            // Parse
            $parsed_result = json_decode($curl_request->get_exec_output(), true);
            
            // Close it
            $curl_request->close();
            
            // Get the links array
            if( ! isset($parsed_result['_links'])){
                
                // osdi:person_signup_helper not presnt 
                utils\dbg_trace("result from  {$url} did not contain [_links]. ");
                return false;
            }
            
            // De ref
            $links = $parsed_result['_links'];
            
            // Get sign up helper
            if( ! isset($links['osdi:person_signup_helper'])){
                
                // osdi:person_signup_helper not presnt 
                utils\dbg_trace("result from  {$url} did not contain [_links].[osdi:person_signup_helper]. ");
                return false;
            }
            
            // De ref
            $signup_helper = $links['osdi:person_signup_helper'];
            
            // Get the href
            if( ! isset($signup_helper['href'])){
                
                // osdi:person_signup_helper not presnt 
                utils\dbg_trace("result from  {$url} did not contain [_links].[osdi:person_signup_helper].[href]. ");
                return false;
            }
            
            // Store the sign up helper url
            $signup_helper_url = $signup_helper['href'];
            
         
            /**
             * 
             * POST $post_url (e.g. https://actionnetwork.org/api/v2/people/ )
             * Header:
             * Content-Type: application/json
             * OSDI-API-Token: your_api_key_here
             * 
             **/
            
            // Build the data to post 
            $post_data = array(
                'person' => array(
                    'identifiers' => [$identifier] ,
                    'family_name' => $last_name,
                    'given_name' => $first_name,
                    'email_addresses' => [ array (
                        'primary' => true,
                        'address' => $email,
                        'status' => 'subscribed'
                        )],
                    ),
                'add_tags' => [
                    'volunteer',
                    'member'
                  ]
            );
            
            
            // Encode it 
            $encoded_post_data = json_encode($post_data);
            
            // Get the Curl http request object
            $curl_post = $this->get_curl_post_request($signup_helper_url);
        
            // Set HTTP POST options 
            $curl_post->set_option( CURLOPT_POST, 1);
            $curl_post->set_option( CURLOPT_POSTFIELDS, $encoded_post_data );  
        
            // Set the headers
            $curl_post->set_option(CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
                "OSDI-API-Token: {$this->api_key}"
            ));
        
            // Post it
            $result = $curl_post->execute();
            
            // Parse
            $parsed_result = json_decode($curl_post->get_exec_output(), true);
            
            // Get return code
            $http_ret_code = $curl_post->get_info(CURLINFO_HTTP_CODE);
            if ( (200 !== $http_ret_code ) or ! $result){
                return false;
            }
         
            // Done 
            return $result;
            
        }
    
} 
