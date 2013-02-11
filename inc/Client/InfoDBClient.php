<?php
/**
 * PMG Cookie Compliance
 *
 * @category    WordPress
 * @package     PMGCookeComp
 * @author      Christopher Davis <chris@pmg.co>
 * @copyright   2013 Performance Media Group
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

namespace PMG\CookieComp\Client;

!defined('ABSPATH') && exit;

/**
 * API client for InfoDB
 *
 * @link    http://ipinfodb.com/
 * @since   1.0
 */
class InfoDBClient extends ClientAbstract implements ClientInterface
{
    /**
     * API endpoint
     *
     * @since   1.0
     */
    const EP = 'http://api.ipinfodb.com/v3/ip-country/';

    /**
     * {@inheritdoc}
     */
    public function getCountry($ip)
    {
        if ($code = $this->getCache()->get($ip)) {
            return $code;
        }

        $resp = $this->request(array('ip' => $ip));

        $code = isset($resp['countryCode']) ? $resp['countryCode'] : false;

        if ($code) {
            $this->getCache()->set($ip, $code);
        }

        return $code;
    }

    /**
     * Make an HTTP request to the API.
     *
     * @since   1.0
     * @access  private
     * @param   array $q The URL query.
     * @return  false|array
     */
    public function request($qs)
    {
        $defaults = array(
            'key'       => $this->getKey(),
        );

        $qs = array_replace_recursive($defaults, $qs);

        $qs['format'] = 'json';

        $resp = wp_remote_get(self::EP . '?' . http_build_query($qs));

        if (
            $resp &&
            !is_wp_error($resp) &&
            200 == wp_remote_retrieve_response_code($resp)
        ) {
            return json_decode(wp_remote_retrieve_body($resp), true);
        }

        return false;
    }
}
