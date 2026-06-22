<?php

namespace TravelBooking\Services;

use TravelBooking\Repositories\TourRepository;
use Exception;

class TourService
{
    private TourRepository $repository;

    public function __construct()
    {
        $this->repository = new TourRepository();
    }

    public function getAllTours(): array
    {
        return $this->repository->getAllTours();
    }

    public function getTourById(int $id)

    {
        return $this->repository->getTourById($id);
    }

    public function createTour(array $data): int
    {
        if (empty($data['title'])) {
            throw new Exception('Title is required');
        }

        if (empty($data['destination'])) {
            throw new Exception('Destination is required');
        }

        if ($data['price'] <= 0) {
            throw new Exception('Price must be greater than 0');
        }

        return $this->repository->create($data);
    }

    public function updateTour(int $id, array $data): bool
    {
        $tour = $this->repository->getTourById($id);

        if (!$tour) {
            throw new Exception('Tour not found');
        }

        return $this->repository->update($id, $data);
    }

    public function deleteTour(int $id)
    {
        $tour = $this->repository->getTourById($id);

        if (!$tour) {
            throw new Exception('Tour not found');
        }

        return $this->repository->delete($id);
    }
}
