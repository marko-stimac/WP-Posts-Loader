<?php
/**
 * Plugin Name: Posts loader
 * Description: Dinamically load posts
 * Version: 1.0.0
 * Author: Marko Štimac
 * Author URI: https://marko-stimac.github.io/
 */

namespace ms\PostsLoader;

define(__NAMESPACE__ . '\PLUGIN_VERSION', '1.0.0');
define(__NAMESPACE__ . '\PLUGIN_DIR', plugin_dir_url(__FILE__));

require_once 'includes/class-backend.php';
require_once 'includes/class-frontend.php';

//new Backend();
$posts_loader = new Frontend();
add_shortcode('posts-loader', array($posts_loader, 'showComponent'));
