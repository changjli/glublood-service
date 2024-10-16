<?php

namespace App\Services\GlucoseLog;

use App\Models\GlucoseLog;

class GlucoseLogService implements GlucoseLogServiceInterface
{
    public function getByDate(array $query)
    {
        $user = auth()->user();

        $glucoseLog = GlucoseLog::where('user_id', $user->id)
            ->where('date', $query['date'])
            ->get();

        return $glucoseLog;
    }
    
    public function store(array $data)
    {
        $user = auth()->user();
        $data['user_id'] = $user->id;

        GlucoseLog::create(attributes: $data);
    }

    public function update(array $data, $id)
    {
        $glucoseLog = GlucoseLog::where('id', $id)->first();

        return $glucoseLog->update($data);
    }

    public function delete($id)
    {
        $glucoseLog = GlucoseLog::where('id', operator: $id)->first();

        return $glucoseLog->delete();
    }
}
