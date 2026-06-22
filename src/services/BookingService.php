<?php

namespace TravelBooking\Services;

use TravelBooking\Repositories\BookingRepository;
use TravelBooking\Repositories\TourRepository;
use Exception;

class BookingService
{
    public function __construct(private BookingRepository $bookingRepository, private TourRepository $tourRepository) {}

    public function createBooking(array $data): int
    {

        $tourId = (int) $data['tour_id'];

        $tour = $this->tourRepository->getTourById($tourId);

        if (!$tour) {
            throw new Exception('Tour not found');
        }

        if (empty($data['customer_name'])) {
            throw new Exception('Customer name is required');
        }

        if (empty($data['customer_email'])) {
            throw new Exception('Customer email is required');
        }

        if ($data['number_of_guests'] <= 0) {
            throw new Exception('Number of guests must be greater than 0');
        }

        $totalPrice = $data['number_of_guests'] * $tour['price'];

        $data['total_price'] = $totalPrice;

        $data['booking_status'] = 'PENDING';

        $data['created_at'] = current_time('mysql');

        return $this->bookingRepository->create($data);
    }
}
