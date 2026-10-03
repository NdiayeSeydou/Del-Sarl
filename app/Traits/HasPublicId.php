<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @mixin Model
 */
trait HasPublicId
{
    /**
     * Démarrage automatique du Trait pour les modèles Eloquent.
     */
    public static function bootHasPublicId(): void
    {
        static::creating(function (Model $model) {
            if (empty($model->public_id)) {
                $prefix = property_exists($model, 'publicIdPrefix') ? $model->publicIdPrefix : 'obj';
                $model->public_id = $prefix.'_'.Str::lower(Str::random(10));
            }
        });
    }

    /**
     * Utiliser 'public_id' au lieu de 'id' dans les routes Laravel (Route Model Binding).
     */
    public function getRouteKeyName(): string
    {
        return 'public_id';
    }
}
