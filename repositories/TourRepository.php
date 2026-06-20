<?php

class TourRepository
{
    public function getAllTours(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Tokyo Explorer',
                'destination' => 'Japan',
                'price' => 1499,
                'duration' => '7 days'
            ],
            [
                'id' => 2,
                'title' => 'Rome Adventure',
                'destination' => 'Italy',
                'price' => 1299,
                'duration' => '5 days'
            ],
            [
                'id' => 3,
                'title' => 'Broken Tour Example',
                'destination' => 'Nowhere',
                'price' => 0
            ]
        ];
    }
}
