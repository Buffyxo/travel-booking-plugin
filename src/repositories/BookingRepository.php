<?php

namespace TravelBooking\Repositories;

use TravelBooking\Models\Booking;

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

    public function getAllBookings(): array
    {
        global $wpdb;
        $table = $wpdb->prefix . 'travel_bookings';

        $rows = $wpdb->get_results("SELECT * FROM $table", ARRAY_A);

        return array_map(function ($row) {

            return new Booking(

                (int)$row['id'],

                (int)$row['tour_id'],

                $row['customer_name'],

                $row['customer_email'],

                (int)$row['number_of_guests'],

                (float)$row['total_price'],

                $row['booking_status'],

                $row['created_at']

            );
        }, $rows ?: []);
    }

    public function getBookingById(int $id)
    {
        global $wpdb;
        $table = $wpdb->prefix . 'travel_bookings';

        $sql = $wpdb->prepare("SELECT * FROM $table WHERE id = %d", $id);

        $result = $wpdb->get_row($sql, ARRAY_A);

        return $result ?: null;
    }

    public function updateStatus(int $bookingId, string $status): bool
    {
        global $wpdb;

        $table = $wpdb->prefix . 'travel_bookings';

        $result = $wpdb->update(
            $table,
            [
                'booking_status' => $status
            ],
            [
                'id' => $bookingId
            ],
            [
                '%s'
            ],
            [
                '%d'
            ]
        );

        return $result !== false;
    }
}
