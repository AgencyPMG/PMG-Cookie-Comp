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

use PMG\Core\Project;
use PMG\CookieComp\Client\ClientInterface;

/**
 * Abstract base class for this plugin.
 *
 * @since   1.0
 */
abstract class CookieBase
{
    const COOKIE    = '_pmg_cookie_comp';
    const AJAX      = 'pmg_remote_ip';
    const DISMISS   = 'pmg_cookie_dismiss';
    const TD        = 'pmg-cookie-comp';

    /**
     * Container for the instances.
     *
     * @since   1.0
     * @access  private
     * @var     array
     */
    private static $reg = array();

    /**
     * Instace of the PMG\Core\Project for this plugin.
     *
     * @since   1.0
     * @access  private
     * @var     PMG\Core\Project
     */
    private $project;

    final public function __construct(Project $p)
    {
        $this->project = $p;
    }

    public function getProject()
    {
        return $this->project;
    }

    public function getSetting()
    {
        return $this->getProject()->setting('opts');
    }

    public static function instance()
    {
        $cls = get_called_class();

        if (!isset(self::$reg[$cls])) {
            self::$reg[$cls] = new $cls(pmgcore('pmg_cookie'));
        }

        return self::$reg[$cls];
    }

    public static function init()
    {
        add_action('pmgcore_loaded', array(static::instance(), '_setup'));
    }

    abstract public function _setup();

    public function getGeoIpClients()
    {
        return apply_filters('pmg_cookie_geoip_client_list', array(
            'infodb'    => __('InfoDB', static::TD),
        ));
    }

    public function getGeoIpClient($client_key)
    {
        $cls = apply_filters('pmg_cookie_geoip_client', null, $client_key);

        if ($cls && !$cls instanceof ClientInterface) {
            throw new BadClientException(sprintf('%s does not implement ClientInterface', get_class($cls)));
        }

        return $cls;
    }

    public function isTest()
    {
        return 'on' === $this->getSetting()->get('test_mode', 'off');
    }
}
