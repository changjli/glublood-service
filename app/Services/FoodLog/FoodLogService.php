<?php

namespace App\Services\FoodLog;

use App\Models\FoodLog;

class FoodLogService implements FoodLogServiceInterface
{
    public function getByDate(array $query)
    {
        $user = auth()->user();

        $foodLog = FoodLog::where('user_id', $user->id)
            ->where('date', $query['date'])
            ->get();

        return $foodLog;
    }

    public function store(array $data)
    {
        $user = auth()->user();
        $data['user_id'] = $user->id;

        return FoodLog::create($data);
    }

    public function update(array $data, $id)
    {
        $foodLog = FoodLog::where('id', $id)->first();

        return $foodLog->update($data);
    }

    public function delete($id)
    {
        $foodLog = FoodLog::where('id', $id)->first();

        return $foodLog->delete();
    }
}
