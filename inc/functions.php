<?php
/**
 * Marklogic Cookie Compliance
 *
 * Un-namespaced utilities.
 *
 * @category    WordPress
 * @package     PMGCookieComp
 * @author      Christopher Davis <chris@pmg.co>
 * @copyright   2013 Performance Media Group
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

!defined('ABSPATH') && exit;

use PMG\CookieComp\Admin;
use PMG\CookieComp\Front;
use PMG\CookieComp\Ajax;

/**
 * Hooked into `pmgcore_loaded`.  Fires all the functions necessary to
 * initilize the plugin.
 *
 * @since   1.0
 * @return  void
 */
function pmg_cookie_load()
{
    if (is_admin()) {
        if (defined('DOING_AJAX') && DOING_AJAX) {
            Ajax::init();
        } else {
            Admin::init();
        }
    } else {
        Front::init();
    }
}

/**
 * Activation hook.
 *
 * @since   1.0
 * @uses    add_option
 * @return  void
 */
function pmg_cookie_activate()
{
    add_option('pmg_cookie_opts', array(
        'dismiss_text'  => '',
        'privacy_link'  => '',
        'privacy_text'  => '',
        'message'       => '',
        'api_client'    => '',
        'api_key'       => '',
        'test_ip'       => '',
        'test_mode'     => 'off',
    ));
}

/**
 * Simple autoloader.
 *
 * @since   1.0
 * @return  boolean
 */
function pmg_cookie_autoload($cls)
{
    $cls = ltrim($cls, '\\');

    if (strpos($cls, 'PMG\\CookieComp') !== 0) {
        return false;
    }

    $cls = str_replace(
        array('\\', '_'), DIRECTORY_SEPARATOR,
        str_replace('PMG\\CookieComp', '', $cls)
    );

    if (file_exists(__DIR__ . "{$cls}.php")) {
        require_once __DIR__ . "{$cls}.php";
        return true;
    }

    return false;
}
