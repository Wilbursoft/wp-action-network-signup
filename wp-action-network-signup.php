<?php

/**
* Plugin Name: Action Network Sign Up
* Plugin URI: https://wilbursoft.com
* Description: Creates a sign up form for The Action Network
* Version: 1.0.0
* Author: Guy Roberts @ Wilbursoft 
* Author URI: https://wilbursoft.com
* License: GPL2
* Text Domain: action-network-signup
*/


// includes 
require_once dirname( __FILE__ ) .'/wp-plugin-utils/lib/utils.php';
use wp_action_network_signup\plugin_utils as utils;

// trace
utils\dbg_trace("");
