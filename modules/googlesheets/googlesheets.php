<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Googlesheets 
Description: Googlesheets API.
Version: 1.0.0
Author: Babel
*/

define('GOOGLESHEET_MODULE_NAME', 'googlesheets');
//hooks()->add_action('app_admin_head', 'load_googlesheets_css');
//hooks()->add_action('app_admin_footer', 'load_googlesheets_js');
hooks()->add_action('admin_init', 'add_googlesheets_menu');



/**
* Register activation module hook
*/

register_activation_hook(GOOGLESHEET_MODULE_NAME, 'googlesheets_module_activation_hook');
$CI = & get_instance();

$CI->load->helper(GOOGLESHEET_MODULE_NAME . '/Googlesheets');

/**
 * spreadsheet online module activation hook
 */
function googlesheets_module_activation_hook()
{
    $CI = &get_instance();
    require_once(__DIR__ . '/install.php');
}


function add_googlesheets_menu()
{
    $CI = &get_instance();
    
    $CI->app_menu->add_sidebar_menu_item('Google Sheets', [
        'name'     => _l('GoogleSheets'),
        'icon'     => 'fa fa-file-text',  
        'href'     => admin_url('googlesheets'),
        'position' => 1,
    ]);

}