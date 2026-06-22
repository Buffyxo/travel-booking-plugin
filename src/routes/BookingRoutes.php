<?php

namespace TravelBooking\Routes;

use TravelBooking\Controllers\BookingController;

class BookingRoutes
{
    public function __construct(private BookingController $controller) {}

    public function register(): void
    {
        register_rest_route('travel/v1', '/bookings', [

            'methods'  => 'POST',

            'callback' => function ($request) {

                return $this->controller->createBooking($request);
            },

            'permission_callback' => '__return_true'

        ]);
    }
}
