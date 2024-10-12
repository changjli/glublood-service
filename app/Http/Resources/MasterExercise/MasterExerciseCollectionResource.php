<?php

namespace App\Http\Resources\MasterExercise;

use App\Http\Resources\MasterExercise\MasterExerciseResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MasterExerciseCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request)
    {
        return $this->collection->map(function ($masterExercise) {
            return new MasterExerciseResource($masterExercise);
        });
    }
}
