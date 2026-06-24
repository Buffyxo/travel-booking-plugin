<?php

namespace TravelBooking\Services;

use TravelBooking\Models\BookingStatus;

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

        $data['booking_status'] = BookingStatus::PENDING;

        $data['created_at'] = current_time('mysql');

        return $this->bookingRepository->create($data);
    }

    public function getAllBookings(): array
    {
        return $this->bookingRepository->getAllBookings();
    }

    public function getBookingById(int $id)
    {

        return $this->bookingRepository->getBookingById($id);
    }

    public function confirmBooking(int $bookingId): bool
    {
        $booking =
            $this->bookingRepository->getBookingById($bookingId);

        if (!$booking) {
            throw new Exception('Booking not found');
        }

        if ($booking['booking_status'] !== BookingStatus::PENDING) {
            throw new Exception('Only pending bookings can be confirmed');
        }

        return $this->bookingRepository->updateStatus($bookingId, 'CONFIRMED');
    }

    public function cancelBooking(int $bookingId): bool
    {
        $booking =
            $this->bookingRepository->getBookingById($bookingId);

        if (!$booking) {
            throw new Exception('Booking not found');
        }

        if ($booking['booking_status'] !== BookingStatus::PENDING) {
            throw new Exception('Only pending bookings can be cancelled');
        }

        return $this->bookingRepository->updateStatus($bookingId, 'CANCELLED');
    }
}
