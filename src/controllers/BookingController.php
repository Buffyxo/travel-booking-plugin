<?php

namespace TravelBooking\Controllers;

use TravelBooking\Services\BookingService;
use WP_REST_Response;
use Exception;

class BookingController
{

    public function __construct(private BookingService $service) {}

    public function createBooking($request)
    {
        try {
            $bookingId = $this->service->createBooking(

                $request->get_json_params()

            );

            return new WP_REST_Response([

                'success' => true,

                'booking_id' => $bookingId

            ], 201);
        } catch (Exception $e) {

            return new WP_REST_Response([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
