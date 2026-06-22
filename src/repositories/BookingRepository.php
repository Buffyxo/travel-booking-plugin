<?php

namespace TravelBooking\Repositories;

class BookingRepository
{
    public function create(array $data): int
    {
        global $wpdb;

        $table = $wpdb->prefix . 'travel_bookings';

        $result = $wpdb->insert(
            $table,
            [
                'tour_id' => $data['tour_id'],
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'number_of_guests' => $data['number_of_guests'],
                'total_price' => $data['total_price'],
                'booking_status' => $data['booking_status'],
            ],
            [
                '%d',
                '%s',
                '%s',
                '%d',
                '%f',
                '%s',
                '%d'
            ]
        );



        if ($result === false) {

            throw new \Exception(

                'Failed to create booking'

            );
        }

        return (int) $wpdb->insert_id;
    }
}
