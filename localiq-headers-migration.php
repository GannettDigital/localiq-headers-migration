<?php
/**
 * Migrate plugin data for HTTP headers.
 * 
 * @package   LOCALiQ\Plugin\Headers_Migration
 * @copyright Copyright (C) 2022 - LOCALiQ/Gannett
 * @license   https://choosealicense.com/licenses/mit/ MIT License
 * 
 * @wordpress-plugin
 * Plugin Name: LOCALiQ Headers Migration
 * Version:     0.1.0
 * Description: Migrate security header data from the `http-security` plugin to `Redirection`.
 * Author:      LOCALiQ
 * Author URI:  https://localiq.com
 * License:     MIT
 * Requires at least: 5.4
 * Requires PHP: 7.4
 */

 namespace LOCALiQ\Plugin\Headers_Migration;

 defined( 'ABSPATH' ) || die();

 spl_autoload_register(function ($class_name) {
  if ( false === strpos( $class_name, 'LOCALiQ' ) ) {
    return;
  }

  $parts = explode('\\', $class_name);
  $class = ($parts[count($parts) - 1]);
  $file = 'class-' . str_ireplace('_', '-', strtolower($class)) . '.php';

  include __DIR__ . '/classes/' . $file;
});

$http_security_mig = new HTTP_Security('x_frame');

/**
 * Fires once activated plugins have loaded.
 *
 */
add_action('plugins_loaded', function() : void {
  // include WP_PLUGIN_DIR . '/redirection/redirection-settings.php';
  var_dump(\red_get_options());
} );

