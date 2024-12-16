<?php

namespace App\Services\SavedMenu;

use App\Models\SavedMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SavedMenuService
{
    public function getSavedMenuService()
    {
        $user = Auth::user();

        $getFoodMenus = DB::table('saved_menus')
            ->leftJoin('food_menus', 'saved_menus.menu_id', '=', 'food_menus.id')
            ->where('saved_menus.user_id', '=', $user->id)
            ->get();

        return $getFoodMenus;
    }


    public function createOrDeleteSavedMenuService(array $data)
    {
        $user = Auth::user();

        $data['user_id'] = $user->id;

        $savedMenu = SavedMenu::where('user_id', $data['user_id'])->where('menu_id', $data['menu_id'])->first();

        if ($savedMenu) {
            $savedMenu->delete();
        } else {
            DB::table('saved_menus')->insert($data);
        }

        return;
    }
}
