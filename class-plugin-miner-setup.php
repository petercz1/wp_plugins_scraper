<?php
namespace chipbug\plugin_miner;

class Plugin_Miner_Setup
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'plugin_miner_menu'));
    }
    public function plugin_miner_menu()
    {
        add_menu_page('plugin miner', 'plugin miner', 'manage_options', 'plugin-miner', array($this, 'get_plugin_data'));
    }
    private function get_plugin_data()
    {
        if (!function_exists('plugins_api')) {
            require_once __DIR__ . '/../../../wp-admin/includes/plugin-install.php';
        }
        $call_api = plugins_api('plugin_information', array('slug' => 'custom-favicon'));

        /** Check for Errors & Display the results */
        if (is_wp_error($call_api)) {
            echo '<pre>' . print_r($call_api->get_error_message(), true) . '</pre>';
        } else {
            echo '<pre>' . print_r($call_api, true) . '</pre>';
            if (!empty($call_api->downloaded)) {
                echo '<p>Downloaded: ' . print_r($call_api->downloaded, true) . ' times.</p>';
            }
        }
    }
    
    private function build_table()
    {
    }
}
