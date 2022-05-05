<?php
/**
 * Shared bootstrap file
 */

use craft\helpers\App;

// Define path constants
define('CRAFT_BASE_PATH', __DIR__);
define('CRAFT_VENDOR_PATH', CRAFT_BASE_PATH . '/vendor');

// Load Composer's autoloader
require_once CRAFT_VENDOR_PATH . '/autoload.php';

// Load dotenv?
if (class_exists('Dotenv\Dotenv')) {
    Dotenv\Dotenv::createUnsafeImmutable(CRAFT_BASE_PATH)->safeLoad();
}

// Define additional PHP constants
// (see https://craftcms.com/docs/3.x/config/#php-constants)
define('CRAFT_ENVIRONMENT', App::env('ENVIRONMENT') ?: 'production');
define('CRAFT_LICENSE_KEY', App::env('CRAFT_LICENSE_KEY'));
define('CRAFT_STORAGE_PATH', App::env('CRAFT_STORAGE_PATH'));
define('CRAFT_STREAM_LOG', true);
