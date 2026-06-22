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

    public function createTour($request)
    {
        try {
            $tourId = $this->service->createTour(
                $request->get_json_params()
            );

            return new WP_REST_Response([
                'success' => true,
                'id' => $tourId
            ], 201);
        } catch (Exception $e) {

            return new WP_REST_Response([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function updateTour($request)
    {
        $id = (int) $request['id'];

        $success = $this->service->updateTour(
            $id,
            $request->get_json_params()
        );

        return [
            'success' => $success
        ];
    }

    public function deleteTour($request)
    {
        try {
            $id = (int) $request['id'];

            $success = $this->service->deleteTour($id);

            return [
                'success' => $success
            ];
        } catch (Exception $e) {
            return new WP_REST_Response([

                'success' => false,

                'message' => $e->getMessage()

            ], 404);
        }
    }
}
