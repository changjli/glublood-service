<?php

namespace App\Services\FoodMenu;

use App\Models\FoodMenu;
use App\Models\SavedMenu;
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
        $user = Auth::user();

        $getFoodMenu = FoodMenu::where('id', $id)->firstOrFail();

        $getSavedMenu = SavedMenu::where('user_id', $user->id)->where('menu_id', $id)->first();

        $getFoodMenu['is_saved'] = $getSavedMenu ? true : false;

        return $getFoodMenu;
    }
}
