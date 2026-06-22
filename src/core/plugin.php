<?php

namespace TravelBooking\Core;

use TravelBooking\Routes\TourRoutes;

class Plugin
{
    public function init(): void
    {
        add_action('rest_api_init', [$this, 'registerRoutes']);
    }

    public function registerRoutes(): void
    {
        (new TourRoutes())->register();
    }
}
