<?php
/**
 * Plugin Name:          Time offer in Checkout Upsell
 * Plugin URI:           https://www.flycart.org/products/wordpress/upsell-order-bump-for-woocommerce
 * Description:          Adding Time Offers in Checkout Upsell 
 * Version:              1.3.0
 * Requires at least:    5.3
 * Requires PHP:         5.6
 * Author:               Flycart
 * Author URI:           https://www.flycart.org
 * Text Domain:          checkout-upsell-woocommerce
 * Domain Path:          /i18n/languages
 * License:              GPL v3 or later
 * License URI:          https://www.gnu.org/licenses/gpl-3.0.html
 * || empty($condition['method'] || empty($condition['method']
 * WC requires at least: 4.2
 * WC tested up to:      7.8
 */

defined('ABSPATH') or exit;

function checkPlugin() {
    add_filter('cuw_conditions',function($conditions){
        require 'TimeHelper.php';
        $conditions['time'] = array(
            'name' => __("Time", 'checkout-upsell-woocommerce'),
            'group' => __("Date & Time", 'checkout-upsell-woocommerce'),
            'handler' => new TimeHelper(),
            'campaigns' => ['pre_purchase', 'post_purchase'],
        );
        return $conditions;
    });
}
add_action( 'cuw_after_init', 'checkPlugin' );
