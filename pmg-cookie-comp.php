<?php
/**
 * Plugin Name: PMG Cookie Compliance
 * Plugin URI: https://github.com/AgencyPMG/PMG-Cookie-Comp
 * Description: Simple UK Cookie compliance.
 * Version: 1.0
 * Text Domain: pmg-cookie-comp
 * Author: Christopher Davis
 * Author URI: http://pmg.co/people/chris
 * License: GPL-2.0+
 *
 * Copyright 2013 Performance Media Group <http://pmg.co>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as 
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category    WordPress
 * @package     PMGCookieComp
 * @author      Christopher Davis <chris@pmg.co>
 * @copyright   2013 Performance Media Group
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

namespace PMG\CookieComp;

!defined('ABSPATH') && exit;

define('PMG_COOKIE_URL', plugins_url('/', __FILE__));

require __DIR__ . '/inc/functions.php';

spl_autoload_register('pmg_cookie_autoload');
register_activation_hook(__FILE__, 'pmg_cookie_activate');
add_action('pmgcore_loaded', 'pmg_cookie_load', 1);
