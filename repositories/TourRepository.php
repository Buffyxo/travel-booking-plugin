<?php

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
}
