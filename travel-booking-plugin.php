<?php

/**
 * Plugin Name: Travel Booking Platform
 */

if (!defined('ABSPATH')) exit;

require_once plugin_dir_path(__FILE__) . 'routes/TourRoutes.php';
require_once plugin_dir_path(__FILE__) . 'controllers/TourController.php';
require_once plugin_dir_path(__FILE__) . 'services/TourService.php';
require_once plugin_dir_path(__FILE__) . 'repositories/TourRepository.php';
require_once __DIR__ . '/models/Tour.php';

register_activation_hook(__FILE__, 'travel_booking_create_tables');

function travel_booking_create_tables()

{

    global $wpdb;

    $table_name = $wpdb->prefix . 'travel_tours';

    $charset_collate = $wpdb->get_charset_collate();

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    $sql = "CREATE TABLE $table_name (

        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,

        title VARCHAR(255) NOT NULL,

        destination VARCHAR(255) NOT NULL,

        description TEXT NULL,

        price DECIMAL(10,2) NOT NULL DEFAULT 0,

        duration VARCHAR(100) NULL,

        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

        PRIMARY KEY (id)

    ) $charset_collate;";

    dbDelta($sql);

    $count = $wpdb->get_var("SELECT COUNT(*) FROM $table");

    if ($count == 0) {

        travel_booking_seed_data();
    }
}

function travel_booking_seed_data()
{
    global $wpdb;

    $table = $wpdb->prefix . 'travel_tours';

    $wpdb->insert($table, [
        'title' => 'Tokyo Explorer',
        'destination' => 'Japan',
        'description' => 'Explore Tokyo city life',
        'price' => 1499,
        'duration' => '7 days'
    ]);

    $wpdb->insert($table, [
        'title' => 'Rome Adventure',
        'destination' => 'Italy',
        'description' => 'Discover ancient Rome',
        'price' => 1299,
        'duration' => '5 days'
    ]);
}
