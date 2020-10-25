<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Serialize implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, $key, $value, $attributes)
    {
        $encode   = ["h", "m", "e", "p", "#", "s", "%", "b", "o", "r", "$"];
        $decode = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "+"];
        return str_replace($encode, $decode, $value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  array  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, $key, $value, $attributes)
    {
        // $normal = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "+"];
        // $encode   = ["h", "m", "e", "p", "#", "s", "%", "b", "o", "r", "$"];
        // $trimIds = trim($value);
        // return str_replace($normal, $encode, $trimIds);
        return $value;
    }
}
