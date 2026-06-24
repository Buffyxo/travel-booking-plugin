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

    public function getAllBookings()
    {
        $bookings = $this->service->getAllBookings();

        return [
            'success' => true,
            'data' => $bookings
        ];
    }

    public function getBookingById($request)
    {
        $id = (int) $request['id'];

        $booking = $this->service->getBookingById($id);

        if (!$booking) {

            return new WP_REST_Response([

                'success' => false,

                'message' => 'Booking not found'

            ], 404);
        }

        return [

            'success' => true,

            'data' => $booking

        ];
    }

    public function confirmBooking($request)
    {
        try {

            $success =
                $this->service->confirmBooking((int)$request['id']);

            return new WP_REST_Response([
                'success' => $success
            ]);
        } catch (Exception $e) {

            return new WP_REST_Response([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function cancelBooking($request)
    {
        try {

            $success =
                $this->service->cancelBooking(
                    (int)$request['id']
                );

            return new WP_REST_Response([
                'success' => $success
            ]);
        } catch (Exception $e) {

            return new WP_REST_Response([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
