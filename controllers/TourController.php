<?php

class TourController
{
    private TourService $service;

    public function __construct()
    {
        $this->service = new TourService();
    }

    public function getAllTours()
    {
        $tours = $this->service->getAllTours();

        return rest_ensure_response([
            'success' => true,
            'data' => $tours
        ]);
    }
}
