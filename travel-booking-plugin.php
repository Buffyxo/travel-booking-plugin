<?php

/**
 * Plugin Name: Travel Booking Platform
 */

if (!defined('ABSPATH')) exit;

require_once __DIR__ . '/vendor/autoload.php';

use TravelBooking\Core\Plugin;

add_action('plugins_loaded', function () {

    (new Plugin())->init();
});

register_activation_hook(__FILE__, 'travel_booking_create_tables');

function travel_booking_create_tables()

{

    global $wpdb;

    $toursTable = $wpdb->prefix . 'travel_tours';

    $bookingsTable = $wpdb->prefix . 'travel_bookings';

    $charset_collate = $wpdb->get_charset_collate();

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    dbDelta("

        CREATE TABLE $toursTable (

            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,

            title VARCHAR(255) NOT NULL,

            destination VARCHAR(255) NOT NULL,

            description TEXT NULL,

            price DECIMAL(10,2) NOT NULL DEFAULT 0,

            duration VARCHAR(100) NULL,

            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

            PRIMARY KEY (id)

        ) $charset_collate;

    ");

    dbDelta("

        CREATE TABLE $bookingsTable (

            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,

            tour_id BIGINT UNSIGNED NOT NULL,

            customer_name VARCHAR(255) NOT NULL,

            customer_email VARCHAR(255) NOT NULL,

            number_of_guests INT NOT NULL,

            total_price DECIMAL(10,2) NOT NULL,

            booking_status VARCHAR(50) NOT NULL,

            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

            PRIMARY KEY (id)

        ) $charset_collate;

    ");

    $count = $wpdb->get_var("SELECT COUNT(*) FROM $toursTable");

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
