<?php

namespace TravelBooking\Routes;

use TravelBooking\Controllers\TourController;

class TourRoutes
{
    public function __construct(private TourController $controller) {}

    public function register(): void
    {
        register_rest_route('travel/v1', '/tours', [

            'methods'  => 'GET',

            'callback' => function () {

                return $this->controller->getAllTours();
            },

            'permission_callback' => '__return_true'

        ]);

        register_rest_route('travel/v1', '/tours/(?P<id>\d+)', [

            'methods'  => 'GET',

            'callback' => function ($request) {

                return $this->controller->getTourById($request);
            },

            'permission_callback' => '__return_true'

        ]);

        register_rest_route('travel/v1', '/tours', [

            'methods' => 'POST',

            'callback' => function ($request) {

                return $this->controller->createTour($request);
            },

            'permission_callback' => '__return_true'

        ]);

        register_rest_route('travel/v1', '/tours/(?P<id>\d+)', [

            'methods' => 'PUT',

            'callback' => function ($request) {

                return $this->controller->updateTour($request);
            },

            'permission_callback' => '__return_true'


        ]);


        register_rest_route('travel/v1', '/tours/(?P<id>\d+)', [

            'methods' => 'DELETE',

            'callback' => function ($request) {

                return $this->controller->deleteTour($request);
            },

            'permission_callback' => '__return_true'

        ]);
    }
}
