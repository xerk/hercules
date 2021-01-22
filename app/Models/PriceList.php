<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriceList extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name'];

    public function price() {
        return $this->belongsTo(Price::class);
    }
}
