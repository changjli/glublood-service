<?php

namespace App\Services\FoodMenu;

use App\Models\FoodMenu;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FoodMenuService
{
    public function getAllFoodMenuService(string $keyword = null, int $limit = null)
    {
        $query = FoodMenu::query();

        if ($keyword) {
            $query->where('title', 'ilike', '%' . $keyword . '%');
        }
        if ($limit) {
            $query->limit($limit);
        }
        $getFoodMenus = $query->get();

        return $getFoodMenus;
    }

    public function getFoodMenuDetailService(int $id)
    {
        $getFoodMenu = FoodMenu::where('id', $id)->first();

        return $getFoodMenu;
    }
}
