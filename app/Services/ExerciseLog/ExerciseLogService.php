<?php

namespace App\Services\ExerciseLog;

use App\Models\ExerciseLog;
use Illuminate\Support\Facades\Auth;

class ExerciseLogService implements ExerciseLogServiceInterface
{
    public function getByDate($date)
    {
        $user = Auth::user();

        $exerciseLogs = ExerciseLog::where('user_id', $user->id)
            ->where('date', $date)
            ->orderBy('start_time')
            ->get();

        return $exerciseLogs;
    }

    public function store(array $data)
    {
        $user = Auth::user();
        $data['user_id'] = $user->id;

        return ExerciseLog::create($data);
    }

    public function update(array $data, $id)
    {
        $exerciseLog = ExerciseLog::where('id', $id)->first();

        return $exerciseLog->update($data);
    }

    public function delete($id)
    {
        $exerciseLog = ExerciseLog::where('id', $id)->first();

        return $exerciseLog->delete();
    }
}
