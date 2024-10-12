<?php

namespace App\Services\MasterFood;

use App\Models\MasterFood;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MasterFoodService implements MasterFoodServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function search(string $query)
    {
        $data = MasterFood::select('id', 'food_name')
            ->where('food_name', 'ilike', '%' . $query . '%')
            ->orWhere('brand', 'ilike', '%' . $query . '%')
            ->orWhere('categories', 'ilike', '%' . $query . '%')
            ->get();

        return $data;
    }

    public function show($id)
    {
        $data = MasterFood::where('id', '=', $id)
            ->first();

        return $data;
    }
}
