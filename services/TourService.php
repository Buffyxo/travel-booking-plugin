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
        return $this->repository->getAllTours();
    }

    public function getTourById(int $id)

    {
        return $this->repository->getTourById($id);
    }
}
