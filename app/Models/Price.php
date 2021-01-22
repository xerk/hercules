<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Price extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name', 'currency', 'desc', 'price', 'currency', 'per_month', 'button_text'];

    public function priceLists() {
        return $this->hasMany(PriceList::class);
    }
}
