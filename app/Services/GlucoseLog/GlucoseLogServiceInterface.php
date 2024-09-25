<?php

namespace App\Services\GlucoseLog;

interface GlucoseLogServiceInterface
{
    public function store(array $data);
    public function update(array $data, $id);
    public function delete($id);
}
