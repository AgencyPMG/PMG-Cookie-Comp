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

use PMG\CookieComp\Cache\CacheInterface;

/**
 * Abstract base class for clients.
 *
 * @since   1.0
 */
abstract class ClientAbstract
{
    /**
     * The cache object.
     *
     * @since   1.0
     * @access  private
     * @var     PMG\CookieComp\Cache\CacheInterface
     */
    private $cache;

    /**
     * The API key.
     *
     * @since   1.0
     * @access  private
     * @var     string
     */
    private $key;

    /**
     * constructor.  Set the cache and API key
     *
     * @since   1.0
     * @access  public
     * @param   string $key The api key.
     * @param   PMG\CookieComp\Cache\CacheInterface $cache
     * @return  void
     */
    public function __construct($key, CacheInterface $cache)
    {
        $this->key = $key;
        $this->cache = $cache;
    }

    /**
     * Set the cache object.
     *
     * @since   1.0
     * @access  public
     * @param   PMG\CookieComp\Cache\CacheInterface $cache
     * @return  void
     */
    public function setCache(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Get the cache.
     *
     * @since   1.0
     * @access  public
     * @return  PMG\CookieComp\Cache\CacheInterface
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * Set the api key
     *
     * @since   1.0
     * @access  public
     * @param   string $key
     * @return  void
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * Get the API key.
     *
     * @since   1.0
     * @access  public
     * @return  string
     */
    public function getKey()
    {
        return $this->key;
    }
}
