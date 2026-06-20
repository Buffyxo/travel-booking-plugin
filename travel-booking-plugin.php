<?php

/**
 * Plugin Name: Travel Booking Platform
 */

if (!defined('ABSPATH')) exit;

require_once plugin_dir_path(__FILE__) . 'routes/TourRoutes.php';
require_once plugin_dir_path(__FILE__) . 'controllers/TourController.php';
require_once plugin_dir_path(__FILE__) . 'services/TourService.php';
require_once plugin_dir_path(__FILE__) . 'repositories/TourRepository.php';
