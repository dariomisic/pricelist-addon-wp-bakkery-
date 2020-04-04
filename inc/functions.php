<?php

/**
 * Pricelist - Addon for WPBakery Page Builder
 * @author miske
 */

// Exit if directly access
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

if( ! function_exists( 'vcat_show_notices_for_dependencies') ) {
    function vcat_show_notices_for_dependencies(){
        if( ! defined('WPB_VC_VERSION' ) ) {
	        vcat_print_notices( sprintf(
                __('<strong>WPBakery Page Builder</strong> Plugin is Missing. <a href="%s" target="_blank">Get it now</a> <strong>%s</strong> Plugin will be deactivated', 'obd-pricelist'),
                esc_url('#'), VCAT_PLUGIN_NAME ), 'error');
	        deactivate_plugins( VCAT_PLUGIN_FILE );
	        return;
        }
    }
}
add_action('admin_notices', 'vcat_show_notices_for_dependencies');


if( ! function_exists( 'vcat_print_notices' ) ) {
	/**
	 * Display WP Admin notices
	 *
	 * @param $message string empty
	 * @param $notice_type string success | error | warning success
	 * @param $is_dismissible boolean true | false true
	 */

    function vcat_print_notices($message = '', $notice_type = 'success', $is_dismissible = true) {
        printf('<div class="notice notice-%s %s"><p>%s</p></div>', $notice_type, $is_dismissible ? 'is-dismissible' : '', $message);
    }
}
