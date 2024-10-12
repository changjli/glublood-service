<?php

namespace App\Services\MasterFood;

interface MasterFoodServiceInterface
{
    public function search(string $query);
    public  function show($id);
}
