<?php
		
/*
Plugin Name: KiwiChat NextClient
Plugin URI: https://kiwichat.github.io
Description: KiwiChat is an online chat client, your IRC client based on kiwiirc Add your networks. Join your channels.
Author: KiwiChat
Version: 3.0
Author URI: https://showchat.tk
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: kiwichat
*/

/*  Copyright 2019 KiwiChat <kiwichat@email.com>

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define( 'KIWICHAT_VERSION', '3.0' );

define( 'KIWIIRC', plugin_dir_path( __FILE__ ) );

define( 'KIWICHAT_URLBASE', 'https://kiwiirc.com/' );

if ( is_admin() ) {
    require_once( KIWIIRC . 'admin/admin.php' );
}
require_once( KIWIIRC . 'public/index.php' );

function kiwichat_plugin_links( $actions, $plugin_file ) {
    static $plugin;

    if ( !isset($plugin) )
        $plugin = plugin_basename(__FILE__);

    if ( $plugin == $plugin_file ) {
        $settings = array('settings' => '<a href="admin.php?page=settings_kiwichat">Settings</a>');
        $site_link = array('support' => '<a href="https://kiwichat.showchat.tk" target="_blank">Suport</a>');
        $actions = array_merge($site_link, $actions);
        $actions = array_merge($settings, $actions);
    }
    return $actions;
}

add_filter( 'plugin_action_links', 'kiwichat_plugin_links', 10, 5 );

/* We have set the default values */
function kiwichat_set_defaults()
{
    $config = array(
		'kiwichat_style'     => 'Radioactive',
		'kiwichat_server'    => 'irc.romaniachat.eu',
        'kiwichat_nick'      => 'KiwiChat_?',
        'kiwichat_chan'      => '#Romania',
        'kiwichat_height'    => '500',
        'kiwichat_width'     => '100%',
    );

    foreach ( $config as $key => $value )
    {
        if (!get_option($key)) {
            update_option($key, $value);
        }
    }
}

register_activation_hook( __FILE__, 'kiwichat_set_defaults');

?>
