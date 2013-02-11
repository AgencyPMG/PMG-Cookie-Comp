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

class Front extends CookieBase
{
    const VER = 2;

    public function _setup()
    {
        if (is_user_logged_in()) {
            if (!$this->isTest()) {
                return;
            }

            if ($ip = $this->getSetting()->get('test_ip')) {
                $_SERVER['REMOTE_ADDR'] = $ip;
            }
        }

        if (!empty($_COOKIE[static::COOKIE])) {
            return;
        }

        add_action('wp_enqueue_scripts', array($this, 'enqueue'));
        add_action('wp_footer', array($this, 'modal'), 200);
    }

    public function enqueue()
    {
        wp_enqueue_script(
            'pmg_cookie',
            PMG_COOKIE_URL . 'js/cookie.js',
            array('jquery'),
            self::VER
        );

        wp_localize_script('pmg_cookie', 'pmg_cookie', array(
            'remote_ip' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : false,
            'ajax'      => admin_url('admin-ajax.php'),
            'action'    => static::AJAX,
            'dismiss'   => static::DISMISS,
        ));

        wp_enqueue_style(
            'pmg_cooke',
            PMG_COOKIE_URL . 'css/cookie.css',
            array(),
            self::VER,
            'screen'
        );
    }

    public function modal()
    {
        $msg = $this->getSetting()->get('message');
        $dismiss = $this->getSetting()->get('dismiss_text');
        $privacy = $this->getSetting()->get('privacy_link');
        $privacy_anchor = $this->getSetting()->get('privacy_text');

        if (!$msg) {
            return;
        }

        if (!$dismiss) {
            $dismiss = __('I Understand, Dimiss This Message', static::TD);
        }

        if (!$privacy_anchor) {
            $privacy_anchor = __('More Information', static::TD);
        }

        ?>
        <div class="pmg-cookie-wrap" style="display: none">
            <div class="pmg-cookie-pad">

                <div class="messaging">
                    <p class="message-wrap"><?php echo $msg; ?></p>
                    <div class="dismiss-wrap">
                        <input type="checkbox" class="pmg-cookie-dismiss" id="pmg-cookie-dismiss" />
                        <label for="pmg-cookie-dismiss"><?php echo esc_html($dismiss); ?></label>
                    </div>
                </div>

                <?php if ($privacy): ?>
                    <div class="more-info">
                        <a href="<?php echo esc_url($privacy); ?>"><?php echo esc_html($privacy_anchor); ?></a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
        <?php
    }
}
