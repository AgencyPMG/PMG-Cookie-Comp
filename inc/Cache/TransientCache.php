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
 * Cache the IP => country code with WordPress' transient API.
 *
 * @since   1.0
 */
class TransientCache implements CacheInterface
{
    /**
     * The TTL for the cache.
     *
     * @since   1.0
     * @access  private
     * @var     int
     */
    private $ttl;

    /**
     * Constructor.  Sets the TTL.
     *
     * @since   1.0
     * @access  public
     * @param   int $ttl Cache TTL, default 1 week.
     * @return  void
     */
    public function __construct($ttl=WEEK_IN_SECONDS)
    {
        $this->ttl = $ttl;
    }

    /**
     * {@inheritdoc}
     */
    public function get($ip)
    {
        return get_transient($this->getKey($ip));
    }

    /**
     * {@inheritdoc}
     */
    public function set($ip, $code)
    {
        return set_transient($this->getKey($ip), $code, $this->ttl);
    }

    /**
     * Get the transient key for a given IP address.
     * 
     * @since   1.0
     * @access  private
     * @param   string $ip
     * @return  string
     */
    private function getKey($ip)
    {
        return sprintf('pmg_cookie_geoip_%s', $ip);
    }
}
