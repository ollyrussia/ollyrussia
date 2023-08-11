<?php

/*
 * Plugin Name: WpSimpleTools Log Viewer
 * Description: Shows default WP / PHP log file from admin interface, gives the possibility to erase it.
 * Author: WpSimpleTools
 * Author URI: https://profiles.wordpress.org/wpsimpletools/#content-plugins
 * Version: 1.0.4
 * Plugin Slug: wpsimpletools-log-viewer
 * Text Domain: wpsimpletools-log-viewer
 */
if (! defined('ABSPATH')) {
    die('Don\'t call this file directly.');
}

//
function wpst_lw_create_menu() {

    add_management_page('Log viewer', 'Log viewer', 'manage_options', 'wpsimpletools-log-viewer', 'wpst_lw_viewer');
}
add_action('admin_menu', 'wpst_lw_create_menu');

// --------------
function wpst_lw_viewer() {

    echo '<div class="wrap">';
    echo '<h1>WpSimpleTools Log viewer</h1>';
    
    $logFile = ini_get('error_log');
    $logFile = str_replace('\\', DIRECTORY_SEPARATOR, $logFile);
    $logFile = str_replace('/', DIRECTORY_SEPARATOR, $logFile);
    
    if (isset($_POST['command']) && $_POST['command'] == 'CLEAR') {
        
        file_put_contents($logFile, '');
        
        $current_user = wp_get_current_user();
        error_log('Log is erased (' . $current_user->user_login . ' - ' . $current_user->user_email . ')');
        
        echo '<div class="notice notice-success is-dismissible">';
        echo '<p>' . __('Log erased.', 'wpsimpletools-log-viewer') . '</p>';
        echo '</div>';
    }
    
    if (! empty($logFile) && filesize($logFile) > 0) {
        
        echo '<p>' . __('Viewing file:', 'wpsimpletools-log-viewer') . ' ' . $logFile . '. <a href="">' . __('Click to update', 'wpsimpletools-log-viewer') . '</a>.</p>';
        
        echo '<pre class="log">';
        $myfile = fopen($logFile, 'r') or die(__('Unable to open file!', 'wpsimpletools-log-viewer'));
        echo fread($myfile, filesize($logFile));
        fclose($myfile);
        echo '</pre>';
        
        echo '<form method="post" action="" novalidate="novalidate" onsubmit="return confirm(\'' . __('You are about to erase the file.', 'wpsimpletools-log-viewer') . '\\n\\n' . __('Are you sure?', 'wpsimpletools-log-viewer') . '\');">';
        echo '<input type="hidden" name="command" id="command" value="CLEAR"></input>';
        echo '<p class="submit">';
        echo '<input type="submit" name="submit" id="submit" class="button button-secondary" value="' . __('Erase log file', 'wpsimpletools-log-viewer') . '">';
        echo '</p>';
        echo '</form>';
    } else {
        
        echo '<div class="notice notice-error">';
        echo '<p>' . __('Viewer error: log file name is empty.', 'wpsimpletools-log-viewer') . '</p>';
        echo '</div>';
    }
    
    echo '</div>';
}

function wpst_lw_head() {

    echo '<style type="text/css">' . PHP_EOL;
    echo 'pre.log{ background-color: #23282d; color: #ddd; overflow-y: scroll; line-height: 14px; font-size: 12px; padding: 4px; }' . PHP_EOL;
    echo '</style>' . PHP_EOL;
}
add_action('admin_head', 'wpst_lw_head');

?>
