<?php

namespace TravelBooking\Core;

use TravelBooking\Routes\TourRoutes;
use TravelBooking\Controllers\TourController;
use TravelBooking\Repositories\TourRepository;
use TravelBooking\Services\TourService;

class Plugin

{

    public function init(): void

    {

        $tourRepository = new TourRepository();
        $tourService = new TourService($tourRepository);
        $tourController = new TourController($tourService);
        $tourRoutes = new TourRoutes($tourController);

        add_action('rest_api_init', [$tourRoutes, 'register']);
    }
}
