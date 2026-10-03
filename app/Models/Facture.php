<?php

namespace App\Models;

use App\Traits\HasPublicId;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasPublicId;

    public string $publicIdPrefix = 'fac';

    protected $guarded = [];

    public function articles()
    {
        return $this->hasMany(FactureArticle::class);
    }
}
