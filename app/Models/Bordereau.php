<?php

namespace App\Models;

use App\Traits\HasPublicId;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proforma;

class Bordereau extends Model
{
    use HasPublicId;

    protected $table = 'bordereaux';

    public string $publicIdPrefix = 'bor';

    protected $guarded = [];

    /**
     * Articles du bordereau
     */
    public function articles()
    {
        return $this->hasMany(BordereauArticle::class);
    }

    /**
     * Proforma associée au bordereau
     */
    public function proforma()
    {
        return $this->belongsTo(Proforma::class, 'proforma_id');
    }
}
