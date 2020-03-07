<?php

/**
* Plugin Name: Signup for Action Network
* Description: Creates a sign up form for The Action Network
* Version: 1.1.3
* Author: Guy Roberts
* Author URI: mailto:guywilliamwelchroberts@gmail.com
* License: GPL3
* Text Domain: action_network_signup
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
