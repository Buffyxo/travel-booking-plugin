<?php

namespace TravelBooking\Models;

class Booking
{
    public function __construct(
        public int $id,
        public int $tour_id,
        public string $customer_name,
        public string $customer_email,
        public int $number_of_guests,
        public float $total_price,
        public string $booking_status,
        public string $created_at
    ) {}
}
