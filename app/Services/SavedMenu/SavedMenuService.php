<?php

namespace App\Services\SavedMenu;

use App\Models\SavedMenu;
use Illuminate\Support\Facades\Auth;

class SavedMenuService
{
    public function createOrDeleteSavedMenuService(array $data)
    {
        $user = Auth::user();

        $data['user_id'] = $user->id;

        $savedMenu = SavedMenu::where('user_id', $data['user_id'])->where('menu_id', $data['menu_id']);

        if ($savedMenu) {
            $savedMenu->delete();
        } else {
            SavedMenu::create($data);
        }

        return;
    }
}
