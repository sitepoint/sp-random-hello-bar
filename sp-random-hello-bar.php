<?php
/*
Plugin Name:  SP Random Hello Bar
Plugin URI:   https://github.com/sitepoint/sp-random-hello-bar
Description:  Displays a random hello bar after scrolling past an element of the page.
Version:      1.0.1
Author:       Brad Denver
License:      GPL2
*/

require_once(plugin_dir_path( __FILE__ ).'src/SitePoint/RandomHelloBar.php');

\SitePoint\RandomHelloBar::public_actions();

if (is_admin()) {
  \Sitepoint\RandomHelloBar::admin_actions();
}
