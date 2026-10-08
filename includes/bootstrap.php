<?php
/**
 * Application bootstrap. Include this from every public page.
 */
declare(strict_types=1);

if (!defined('INRYTH')) {
    define('INRYTH', true);
}

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

define('ROOT_PATH', dirname(__DIR__));
define('INCLUDES_PATH', __DIR__);
define('DATA_PATH', ROOT_PATH . '/data');
define('STORAGE_PATH', ROOT_PATH . '/storage');
define('ASSETS_PATH', ROOT_PATH . '/assets');

$config = require INCLUDES_PATH . '/config.php';
$GLOBALS['config'] = $config;

require_once INCLUDES_PATH . '/functions.php';
require_once INCLUDES_PATH . '/seo.php';

$data_cache = [];

function load_data(string $name): array
{
    global $data_cache;
    if (isset($data_cache[$name])) {
        return $data_cache[$name];
    }
    $file = DATA_PATH . '/' . $name . '.php';
    if (!is_file($file)) {
        return [];
    }
    $data_cache[$name] = require $file;
    return $data_cache[$name];
}

$schema_extra = [];
$GLOBALS['schema_extra'] =& $schema_extra;

$page = [
    'id' => 'home',
    'title' => $config['site_name'],
    'description' => $config['site_description'],
    'canonical' => '/',
    'robots' => 'index,follow',
    'og_type' => 'website',
    'og_image' => $config['og_image'],
    'schema' => 'WebPage',
    'breadcrumbs' => [],
    'whatsapp_message' => 'Hi, I would like to discuss digital marketing services.',
    'minimal_nav' => false,
    'hide_sticky_bar' => false,
    'body_class' => '',
];
