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

        return [
            'success' => true,
            'data' => $tours
        ];
    }

    public function getTourById($request)

    {

        $id = (int) $request['id'];

        $tour = $this->service->getTourById($id);

        if (!$tour) {

            return new WP_REST_Response([

                'success' => false,

                'message' => 'Tour not found'

            ], 404);
        }

        return [

            'success' => true,

            'data' => $tour

        ];
    }
}
