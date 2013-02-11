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
 * A cache that does nothing. Useful for testing.
 *
 * @since   1.0
 */
class NullCache implements CacheInterface
{
    /**
     * {@inheritdoc}
     */
    public function get($ip)
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function set($ip, $code)
    {
        return false;
    }
}
