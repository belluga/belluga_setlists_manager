<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\BSON\ObjectId;

class ObjectIdCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return string
     */
    public function get($model, string $key, $value, array $attributes): string
    {
        return (string) $value;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param Model $model
     * @param string $key
     * @param array $value
     * @param array $attributes
     * @return ObjectID
     * @throws \Exception
     */
    public function set($model, string $key, $value, array $attributes): ObjectID
    {
        if(!is_string( $value)){
            throw new \Exception("ObjectId value should be a string.");
        }
        return new ObjectID($value);
    }
}
