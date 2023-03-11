<?php

namespace App\Services;

use App\Models\AuditTrail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuditTrailLogService
{
    public static function logAuditTrail($event, $model): void
    {
        $old_values = null;
        $new_values = null;

        if ($event == 'updated') {
            $old_values = json_encode($model->getOriginal());
            $new_values = json_encode($model->getAttributes());
        }

        if (Str::contains($event, 'created')) {
            $new_values = json_encode($model->getAttributes());
        }

        AuditTrail::create([
            'table_name' => $model->getTable(),
            'record_id' => $model->id,
            'user_id' => Auth::id() ? Auth::id() : 0,
            'action' =>  $event,
            'old_values' => $old_values,
            'new_values' => $new_values,
        ]);
    }
}
