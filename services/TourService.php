<?php

class TourService
{
    private TourRepository $repository;

    public function __construct()
    {
        $this->repository = new TourRepository();
    }

    public function getAllTours(): array
    {
        $tours = $this->repository->getAllTours();

        // Business rule example: filter invalid tours
        return array_filter($tours, function ($tour) {
            return isset($tour['price']) && $tour['price'] > 0;
        });
    }
}
