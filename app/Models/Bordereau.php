<?php

namespace App\Models;

use App\Traits\HasPublicId;
use Illuminate\Database\Eloquent\Model;

class Bordereau extends Model
{
    use HasPublicId;

    protected $table = 'bordereaux';

    public string $publicIdPrefix = 'bor';

    protected $guarded = [];

    public function articles()
    {
        return $this->hasMany(BordereauArticle::class);
    }
}
