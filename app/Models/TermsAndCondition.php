<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TermsAndCondition extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['desc'];

    // public function getTranslatableAttributes() {
    //     return true;
    // }
}
