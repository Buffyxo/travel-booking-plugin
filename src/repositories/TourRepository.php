<?php

namespace TravelBooking\Repositories;

use TravelBooking\Models\Tour;

class TourRepository
{
    public function getAllTours(): array
    {
        global $wpdb;
        $table = $wpdb->prefix . 'travel_tours';

        $rows = $wpdb->get_results("SELECT * FROM $table", ARRAY_A);

        return array_map(function ($row) {

            return new Tour(

                (int)$row['id'],

                $row['title'],

                $row['destination'],

                (float)$row['price'],

                $row['duration']

            );
        }, $rows ?: []);
    }

    public function getTourById(int $id)
    {
        global $wpdb;

        $table = $wpdb->prefix . 'travel_tours';

        $sql = $wpdb->prepare(
            "SELECT * FROM $table WHERE id = %d",
            $id
        );

        $result = $wpdb->get_row($sql, ARRAY_A);

        return $result ?: null;
    }

    public function create(array $data): int
    {
        global $wpdb;

        $table = $wpdb->prefix . 'travel_tours';

        $wpdb->insert(
            $table,
            [
                'title' => $data['title'],
                'destination' => $data['destination'],
                'description' => $data['description'],
                'price' => $data['price'],
                'duration' => $data['duration']
            ],
            [
                '%s',
                '%s',
                '%s',
                '%f',
                '%s'
            ]
        );

        return (int) $wpdb->insert_id;
    }

    public function update(int $id, array $data): bool
    {
        global $wpdb;

        $table = $wpdb->prefix . 'travel_tours';

        $result = $wpdb->update(
            $table,
            [
                'title' => $data['title'],
                'destination' => $data['destination'],
                'description' => $data['description'],
                'price' => $data['price'],
                'duration' => $data['duration']
            ],
            [
                'id' => $id
            ],
            [
                '%s',
                '%s',
                '%s',
                '%f',
                '%s'
            ],
            [
                '%d'
            ]
        );

        return $result !== false;
    }

    public function delete(int $id): bool
    {
        global $wpdb;

        $table = $wpdb->prefix . 'travel_tours';

        $result = $wpdb->delete(
            $table,
            [
                'id' => $id
            ],
            [
                '%d'
            ]
        );

        return $result > 0;
    }
}
