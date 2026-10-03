<?php

namespace App\Models;

use App\Traits\HasPublicId;
use Illuminate\Database\Eloquent\Model;

class Proforma extends Model
{
    use HasPublicId;

    public string $publicIdPrefix = 'pro';

    protected $guarded = [];

    public function articles()
    {
        return $this->hasMany(ProformaArticle::class);
    }
}
