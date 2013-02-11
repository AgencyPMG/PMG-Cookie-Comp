<?php
/**
 * PMG Cookie Compliance
 *
 * @category    WordPress
 * @package     PMGCookieComp
 * @author      Christopher Davis <chris@pmg.co>
 * @copyright   2013 Performance Media Group
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

namespace PMG\CookieComp;

!defined('ABSPATH') && exit;

use PMG\CookieComp\Client\InfoDBClient;
use PMG\CookieComp\Cache\TransientCache;
use PMG\CookieComp\Cache\NullCache;

class Ajax extends CookieBase
{
    public function _setup()
    {
        add_filter('pmg_cookie_geoip_client', array($this, 'client'), 10, 2);
        add_filter('pmg_cookie_ip_needs_message', array($this, 'needs_msg'), 10, 2);
        add_action('wp_ajax_' . static::AJAX, array($this, 'ip_ajax_cb'));
        add_action('wp_ajax_nopriv_' . static::AJAX, array($this, 'ip_ajax_cb'));
        add_action('wp_ajax_' . static::DISMISS, array($this, 'dismiss_ajax_cb'));
        add_action('wp_ajax_nopriv_' . static::DISMISS, array($this, 'dismiss_ajax_cb'));
    }

    public function needs_msg($zero, $ip)
    {
        if (!$ip) {
            return $zero;
        }

        $country = $this->getGeoIpClient($this->getSetting()->get('api_client'))->getCountry($ip);

        if ('gb' == strtolower($country)) {
            return '1';
        }

        $this->setDismissed();

        return $zero;
    }

    public function ip_ajax_cb()
    {
        $ip = isset($_GET['ip']) ? $_GET['ip'] : false;
        die(apply_filters('pmg_cookie_ip_needs_message', '0', $ip));
    }

    public function dismiss_ajax_cb()
    {
        $this->setDismissed();
        die('1');
    }

    /**
     * Hooked into `pmg_cookie_geoip_client`, returns an appropriate instance of a client
     * if it recognized $client_key.
     *
     * @since   1.0
     * @access  public
     * @param   null $null An empty placeholder.
     * @param   string $client_key The API client Key.
     * @return  MarkLogic\Cookie\Client\ClientInterface
     */
    public function client($null, $client_key)
    {
        if ('infodb' == $client_key) {
            $cache = $this->isTest() ? new NullCache() : new TransientCache();
            return new InfoDBClient($this->getSetting()->get('api_key'), $cache);
        }

        return $null;
    }

    private function setDismissed()
    {
        if (is_user_logged_in() && !$this->isTest()) {
            return;
        }

        setcookie(
            static::COOKIE,
            '1',
            time() + YEAR_IN_SECONDS,
            '/',
            COOKIE_DOMAIN
        );
    }
}
