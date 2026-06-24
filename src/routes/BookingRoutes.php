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

        register_rest_route('travel/v1', '/bookings', [
            'methods' => 'GET',

            'callback' => function () {

                return $this->controller->getAllBookings();
            },

            'permission_callback' => '__return_true'
        ]);

        register_rest_route('travel/v1', '/bookings/(?P<id>\d+)', [
            'methods' => 'GET',

            'callback' => function ($request) {

                return $this->controller->getBookingById($request);
            },

            'permission_callback' => '__return_true'
        ]);

        register_rest_route(
            'travel/v1',
            '/bookings/(?P<id>\d+)/confirm',
            [

                'methods' => 'POST',

                'callback' => function ($request) {

                    return $this->controller->confirmBooking($request);
                },

                'permission_callback' => '__return_true'
            ]
        );

        register_rest_route(
            'travel/v1',
            '/bookings/(?P<id>\d+)/cancel',
            [

                'methods' => 'POST',

                'callback' => function ($request) {

                    return $this->controller->cancelBooking($request);
                },

                'permission_callback' => '__return_true'
            ]
        );
    }
}
