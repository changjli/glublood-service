<?php

namespace App\Services\FoodMenu;

use App\Models\FoodMenu;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FoodMenuService
{
    public function getAllFoodMenuService(string $keyword = null)
    {
        $getFoodMenus = [];
        if ($keyword) {
            $getFoodMenus = FoodMenu::where('title', 'ilike', '%' . $keyword . '%')->get();
        } else {
            $getFoodMenus = FoodMenu::all();
        }

        return $getFoodMenus;
    }

    public function getFoodMenuDetailService(int $id)
    {
        $getFoodMenu = FoodMenu::where('id', $id)->first();

        return $getFoodMenu;
    }
}
