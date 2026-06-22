<?php
error_log("TourRoutes loaded");

add_action('rest_api_init', function () {

    register_rest_route('travel/v1', '/tours', [
        'methods'  => 'GET',
        'callback' => function () {

            $controller = new TourController();
            return $controller->getAllTours();
        },
        'permission_callback' => '__return_true'
    ]);

    register_rest_route('travel/v1', '/tours/(?P<id>\d+)', [

        'methods'  => 'GET',

        'callback' => function ($request) {

            $controller = new TourController();
            return $controller->getTourById($request);
        },

        'permission_callback' => '__return_true'

    ]);

    register_rest_route('travel/v1', '/tours', [

        'methods' => 'POST',

        'callback' => function ($request) {

            $controller = new TourController();
            return $controller->createTour($request);
        },

        'permission_callback' => '__return_true'

    ]);

    register_rest_route('travel/v1', '/tours/(?P<id>\d+)', [

        'methods' => 'PUT',

        'callback' => function ($request) {

            $controller = new TourController();
            return $controller->updateTour($request);
        },

        'permission_callback' => '__return_true'


    ]);


    register_rest_route('travel/v1', '/tours/(?P<id>\d+)', [

        'methods' => 'DELETE',

        'callback' => function ($request) {

            $controller = new TourController();
            return $controller->deleteTour($request);
        },

        'permission_callback' => '__return_true'

    ]);
});
