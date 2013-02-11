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

namespace PMG\CookieComp\Client;

!defined('ABSPATH') && exit;

/**
 * The interface that all GeoIP clients much implement. Clients should deal
 * with their own caching.
 *
 * @since   1.0
 */
interface ClientInterface
{
    /**
     * Get a country code from an IP address.
     *
     * @since   1.0
     * @access  public
     * @param   string $ip The IP address
     * @return  string An ISO two letter country code.
     */
    public function getCountry($ip);
}
