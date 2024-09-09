<?php

namespace App\Services\OpenFoodFacts;

interface OpenFoodFactsServiceInterface
{
    public function getByBarcode($barcode);
    public function search($keyword);
}
