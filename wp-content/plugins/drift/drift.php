<?php
/*
 * Plugin Name: Drift
 * Version: 3.0.1
 * Description: Adds 100% free live chat & targeted messages to your website. Designed for internet businesses like yours to increase sales, conversions and better support your customers.
 * Author: Drift
 * Author URI: https://www.drift.com/?ref=wordpress
 * Plugin URI: https://www.drift.com/?ref=wordpress
 */

// Prevent Direct Access
defined('ABSPATH') or die("Restricted access!");

/*
* Define
*/
define('DRIFT_4f050d29b8BB9_VERSION', '3.0.1');
define('DRIFT_4f050d29b8BB9_DIR', plugin_dir_path(__FILE__));
define('DRIFT_4f050d29b8BB9_URL', plugin_dir_url(__FILE__));
defined('DRIFT_4f050d29b8BB9_PATH') or define('DRIFT_4f050d29b8BB9_PATH', untrailingslashit(plugins_url('', __FILE__)));

require_once(DRIFT_4f050d29b8BB9_DIR . 'includes/core.php');
require_once(DRIFT_4f050d29b8BB9_DIR . 'includes/menus.php');
require_once(DRIFT_4f050d29b8BB9_DIR . 'includes/admin.php');
require_once(DRIFT_4f050d29b8BB9_DIR . 'includes/embed.php');


?>
