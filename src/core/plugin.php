<?php

namespace TravelBooking\Core;

use TravelBooking\Controllers\BookingController;
use TravelBooking\Routes\TourRoutes;
use TravelBooking\Controllers\TourController;
use TravelBooking\Repositories\BookingRepository;
use TravelBooking\Repositories\TourRepository;
use TravelBooking\Routes\BookingRoutes;
use TravelBooking\Services\BookingService;
use TravelBooking\Services\TourService;

class Plugin

{

    public function init(): void

    {

        $tourRepository = new TourRepository();
        $tourService = new TourService($tourRepository);
        $tourController = new TourController($tourService);
        $tourRoutes = new TourRoutes($tourController);

        $bookingRepository = new BookingRepository();
        $bookingService = new BookingService($bookingRepository, $tourRepository);
        $bookingController = new BookingController($bookingService);
        $bookingRoutes = new BookingRoutes($bookingController);

        add_action('rest_api_init', [$tourRoutes, 'register']);
        add_action('rest_api_init', [$bookingRoutes, 'register']);
    }
}
