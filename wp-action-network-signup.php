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

// @codeCoverageIgnoreStart

// includes 
require_once dirname( __FILE__ ) .'/wp-plugin-utils/lib/utils.php';
use wp_action_network_signup\plugin_utils as utils;
require_once dirname( __FILE__ ) .'/class.ans-render.php';
require_once dirname( __FILE__ ) .'/class.ans-settings.php';

// trace
utils\dbg_trace("");

utils\dbg_trace("ANS_Settings object");
new ANS_Settings();

utils\dbg_trace("ANS_Render object");
new ANS_Render();

// @codeCoverageIgnoreEnd
