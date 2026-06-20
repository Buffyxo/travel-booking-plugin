<?php

class Tour
{
    public function __construct(
        public int $id,
        public string $title,
        public string $destination,
        public float $price,
        public string $duration
    ) {}
}
