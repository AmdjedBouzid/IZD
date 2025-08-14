<?php

namespace App\Traits;

use Illuminate\Support\Facades\Redis;

trait TracksChanges
{
    public static function bootTracksChanges()
    {
        static::created(function($model) {
            Redis::publish('model_changes', json_encode([
                'action' => 'created',
                'model' => get_class($model),
                'data' => $model
            ]));
        });

        static::updated(function($model) {
            Redis::publish('model_changes', json_encode([
                'action' => 'updated',
                'model' => get_class($model),
                'data' => $model
            ]));
        });

        static::deleted(function($model) {
            Redis::publish('model_changes', json_encode([
                'action' => 'deleted',
                'model' => get_class($model),
                'data' => $model
            ]));
        });
    }
}
