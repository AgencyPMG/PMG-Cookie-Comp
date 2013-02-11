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

class Admin extends CookieBase
{
    public function _setup()
    {
        $f = $this->getSetting();

        $f->add_section('msg', array(
            'title'     => __('Message', static::TD),
            'help'      => __('The message to display to EU visitors.', static::TD),
        ));

        $f->add_field('dismiss_text', array(
            'label'     => __('Dismiss Button Text', static::TD),
            'section'   => 'msg',
            'class'     => 'regular-text',
        ));

        $f->add_field('privacy_link', array(
            'label'     => __('Privacy Policy Link', static::TD),
            'section'   => 'msg',
            'class'     => 'regular-text',
            'cleaners'  => array('esc_url_raw'),
        ));

        $f->add_field('privacy_text', array(
            'label'     => __('Privacy Policy Anchor Text', static::TD),
            'section'   => 'msg',
            'class'     => 'regular-text',
        ));

        $f->add_field('message', array(
            'label'     => __('Message Text', static::TD),
            'section'   => 'msg',
            'type'      => 'textarea',
        ));

        $f->add_section('api', array(
            'title'     => __('GeoIP API', static::TD),
            'help'      => __('The client to use for GeoIP services.', static::TD),
        ));

        $f->add_field('api_client', array(
            'label'     => __('API Client', static::TD),
            'section'   => 'api',
            'type'      => 'select',
            'options'   => $this->getGeoIpClients(),
            'class'     => 'regular',
        ));

        $f->add_field('api_key', array(
            'label'     => __('API Key', static::TD),
            'section'   => 'api',
            'class'     => 'regular-text',
        ));

        $f->add_section('test', array(
            'title'     => __('Testing', static::TD),
        ));

        $f->add_field('test_ip', array(
            'label'     => __('Test IP Address', static::TD),
            'section'   => 'test',
            'class'     => 'regular-text',
        ));

        $f->add_field('test_mode', array(
            'label'     => __('Enable Test Mode', static::TD),
            'section'   => 'test',
            'type'      => 'checkbox',
            'class'     => 'regular',
        ));

        $this->getProject()->admin_page('pmg_cookie', $f, array(
            'title'     => __('Cookie Compliance Options', static::TD),
            'menu_name' => __('Cookie Compliance', static::TD),
            'parent'    => 'options-general.php',
            'slug'      => 'pmg-cookie-comp',
        ));
    }
}
