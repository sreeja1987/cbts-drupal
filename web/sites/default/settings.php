<?php

/**
 * Load services definition file.
 */
$settings['container_yamls'][] = __DIR__ . '/services.yml';


/**
 * Skipping permissions hardening will make scaffolding
 * work better, but will also raise a warning when you
 * install Drupal.
 *
 * https://www.drupal.org/project/drupal/issues/3091285
 */
// $settings['skip_permissions_hardening'] = TRUE;

/**
 * Include the Pantheon-specific settings file.
 */
if (file_exists(__DIR__ . '/settings.pantheon.php')) {
  include __DIR__ . "/settings.pantheon.php";
}

/**
 * Configure the Config Sync Directory.
 * For Pantheon, this must be defined AFTER settings.pantheon.php.
 */
if (isset($app_root)) {
  // If in /web/sites/default, this points to /config/sync at the repo root.
  $settings['config_sync_directory'] = dirname($app_root) . '/config/sync';
}

/**
 * If there is a local settings file, then include it.
 */
$local_settings = __DIR__ . "/settings.local.php";
if (file_exists($local_settings)) {
  include $local_settings;
}

/**
 * DDEV-specific settings.
 */
$ddev_settings = __DIR__ . '/settings.ddev.php';
if (getenv('IS_DDEV_PROJECT') == 'true' && is_readable($ddev_settings)) {
  require $ddev_settings;
}
