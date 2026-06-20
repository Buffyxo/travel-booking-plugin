<?php

class TourRepository
{
    public function getAllTours(): array
    {
        global $wpdb;
        $table = $wpdb->prefix . 'travel_tours';

        return $wpdb->get_results("SELECT * FROM $table", ARRAY_A);
    }
}
