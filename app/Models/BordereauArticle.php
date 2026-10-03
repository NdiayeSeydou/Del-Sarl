<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BordereauArticle extends Model
{
    use HasFactory;

    protected $table = 'bordereau_articles';

    protected $guarded = [];

    public function bordereau()
    {
        return $this->belongsTo(Bordereau::class);
    }
}
