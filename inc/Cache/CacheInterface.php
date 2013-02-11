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

namespace PMG\CookieComp\Cache;

!defined('ABSPATH') && exit;

/**
 * Interface for the cache.
 *
 * @since   1.0
 */
interface CacheInterface
{
    /**
     * Get the country code for an IP from the cache.
     *
     * @since   1.0
     * @access  public
     * @param   string $ip The IP address
     * @return  false|string False on a miss, the ISO two letter country code otherwise.
     */
    public function get($ip);

    /**
     * Save the country code for a given IP in the cache.
     *
     * @since   1.0
     * @access  public
     * @param   string $ip The IP address
     * @param   string $code The ISO two letter country code to save
     * @return  void
     */
    public function set($ip, $code);
}
